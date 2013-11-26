"""This module implements a declarative Logic language using Scheme syntax.

Logic is a variant of the Prolog language, based on scmlog by Paul Hilfinger
and the logic programming example in SICP.

All valid logic expressions are Scheme lists.  Valid forms include:

(fact ...):  Assert a consequent, followed by zero or more hypotheses
(query ...): Query zero or more relations simultaneously
(load PATH): Load a .logic file by evaluating its expressions
"""

from scheme import Frame
from scheme_reader import Pair, nil, read_line
from scheme_primitives import *
from ucb import main, trace

import scheme
import scheme_reader
import scheme_test

facts = []
debug = False

#############
# Inference #
#############

class SpecialFrame(Frame):
    def __init__(self, parent):
        Frame.__init__(self, parent)
        self.diffs = {}

    def diff(self, sym, val):
        debug_print("{} diff {}".format(sym, val))
        self.diffs[sym] = val

    def all_diffs(self):
        rval = {}
        for k, v in self.diffs.items():
            rval[k] = v

        if self.parent:
            for k, v in self.parent.all_diffs().items():
                rval[k] = v

        return rval

    def define(self, sym, val):
        for sym, val in self.all_diffs().items():
            evaled = lookup(sym, self)
            stored = lookup(val, self)
            if evaled == stored:
                debug_print("{} is equal to {}".format(evaled, stored))
                return False
        Frame.define(self, sym, val)
        return True

def do_query(clauses):
    """Yield all bindings that simultaneously satisfy clauses."""
    for env in search(clauses, SpecialFrame(None), 0):
        rval = [(v, ground(v, env)) for v in get_vars(clauses)]
        yield rval

def debug_print(*s):
    if debug:
        print(*s)

DEPTH_LIMIT = 20
def search(clauses, env, depth):
    """Search for an application of rules to establish all the clauses,
    non-destructively extending the unifier env.  Limit the search to
    the nested application of depth rules."""
    if clauses is nil:
        yield env
    elif DEPTH_LIMIT is None or depth <= DEPTH_LIMIT:
        debug_print("Searching", clauses, "with", "")
        if clauses.first != nil:
            if clauses.first.first == "diff":
                items = clauses.first.second
                first = lookup(items.first, env)
                second = lookup(items.second.first, env)
                debug_print("Diff {} {}".format(first, second))
                if lookup(first, env) == lookup(second, env):
                    return

                if isvar(first):
                    env.diff(first, second)
                elif isvar(second):
                    env.diff(second, first)

                for item in search(clauses.second, env, depth):
                    yield item
                return

        for fact in facts:
            debug_print("Trying", fact, "for", clauses.first, "env", "")
            fact = rename_variables(fact, get_unique_id())
            env_head = SpecialFrame(env)
            if unify(fact.first, clauses.first, env_head):
                debug_print("{} worked on {} env {}".format(fact.first, clauses.first, env_head))
                for env_rule in search(fact.second, env_head, depth+1):
                    # debug_print("found {} for search for {}".format(env_rule, fact.second))
                    for result in search(clauses.second, env_rule, depth+1):
                        yield result

def unify(e, f, env):
    """Destructively extend env so as to unify (make equal) e and f, returning
    True if this succeeds and False otherwise.  env may be modified in either
    case (its existing bindings are never changed)."""
    # debug_print("unifying {} and {} env {}".format(e, f, env))
    e = lookup(e, env)
    f = lookup(f, env)
    if e == f:
        return True
    elif isvar(e):
        return env.define(e, f)
    elif isvar(f):
        return env.define(f, e)
    elif scheme_atomp(e) or scheme_atomp(f):
        return False
    else:
        return unify(e.first, f.first, env) and unify(e.second, f.second, env)

################
# Environments #
################

def lookup(sym, env):
    """Look up a symbol repeatedly until it is fully resolved."""
    try:
        return lookup(env.lookup(sym), env)
    except:
        return sym

def ground(expr, env):
    """Replace all variables with their values in expr."""
    if scheme_symbolp(expr):
        resolved = lookup(expr, env)
        if expr != resolved:
            return ground(resolved, env)
        else:
            return expr
    elif scheme_pairp(expr):
        return Pair(ground(expr.first, env), ground(expr.second, env))
    else:
        return expr

#####################
# Support functions #
#####################

def get_vars(expr):
    """Return all logical vars in expr as a list."""
    if isvar(expr):
        return [expr]
    elif scheme_pairp(expr):
        vs = get_vars(expr.first)
        for v in get_vars(expr.second):
            if v not in vs:
                vs.append(v)
        return vs
    else:
        return []

IDENTIFIER = 0
def get_unique_id():
    """Return a unique identifier."""
    global IDENTIFIER
    IDENTIFIER += 1
    return IDENTIFIER

def rename_variables(expr, n):
    """Rename all variables in expr with an identifier N."""
    if isvar(expr):
        return expr + '_' + str(n)
    elif scheme_pairp(expr):
        return Pair(rename_variables(expr.first, n),
                    rename_variables(expr.second, n))
    else:
        return expr

def isvar(symbol):
    """Return whether symbol is a logical variable."""
    return scheme_symbolp(symbol) and symbol.startswith("?")

##################
# User Interface #
##################

def process_input(expr, env):
    """Process an input expr, which may be a fact or query."""
    if not scheme_listp(expr):
        print('Improperly formed expression.')
    elif expr.first in ("fact", "!"):
        facts.append(expr.second)
    elif expr.first in ("query", "?"):
        results = do_query(expr.second)
        success = False
        for result in results:
            if not success:
                print('Success!')
            success = True
            result_str = "\t".join("{0}: {1}".format(k[1:], v) for k, v in result)
            if result_str:
                print(result_str)
        if not success:
            print('Failed.')
    elif expr.first == "load":
        scheme.scheme_load(expr.second.first, env)
    else:
        print("Please provide a fact or query.")

@main
def run(*argv):
    scheme_reader.buffer_input.__defaults__ = ('logic> ',)
    scheme_reader.buffer_lines.__defaults__ = ('logic> ',)
    scheme.scheme_eval = process_input
    if argv and argv[0] == '-test':
        scheme_test.run_tests(*argv[1:])
    else:
        scheme.run(*argv)
