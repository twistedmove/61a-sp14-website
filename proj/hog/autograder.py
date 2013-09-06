"""Common utility functions for automatic grading."""

import sys, os, io, traceback
import signal
import time
from doctest import DocTestFinder, DocTestRunner
from collections import namedtuple, defaultdict

Test = namedtuple('Test', ['name', 'fn'])
TESTS = []

# set path for autograder to test current working directory
sys.path[0:0] = [ os.getcwd() ]


def test(fn):
    """Decorator to register a test. A test returns a true value on failure."""
    TESTS.append(Test(fn.__name__, fn))
    return fn


def test_all(project_name, tests=TESTS):
    """Run all TESTS. Exits with a useful code: 0 for ok, 1 for problems."""
    for test in tests:
        underline('Test {0}'.format(test.name))
        try:
            failure = test.fn()
        except Exception as inst:
            traceback.print_exc()
            failure = True
        if failure:
            sys.exit(1)
        print()
    sys.exit(0)


class Timeout(Exception):
    pass

def handler(signum, frame):
    raise Timeout

TIMEOUT = 100
def test_eval(func, inputs, timeout=None, **varargs):
    if timeout is None:
        timeout = TIMEOUT
    if type(inputs) is not tuple:
        inputs = (inputs,)
    try:
        signal.signal(signal.SIGALRM, handler)
        signal.alarm(timeout)
        r = func(*inputs, **varargs)
        return r
    finally:
        signal.signal(signal.SIGALRM, signal.SIG_IGN)


def check_func(func, tests,
               comp = lambda x, y: x == y,
               in_print = repr, out_print = repr):
    """Test FUNC according to sequence TESTS.  Each item in TESTS consists of
    (I, V, D=None), where I is a tuple of inputs to FUNC (if not a tuple,
    (I,) is substituted) and V is the proper output according to comparison
    COMP.  Prints erroneous cases.  In case of error, uses D as the test
    description, or constructs a description from I and V otherwise.
    Returns 0 for all correct, or the number of tests failed."""
    code = 0
    for input, output, *desc in tests:
        try:
            val = test_eval(func, input)
        except:
            fail_msg = "Function {0} failed".format(func.__name__)
            if desc:
                print(fail_msg, desc[0])
            else:
                print(fail_msg, "with input", in_print(input))
            traceback.print_exception(*sys.exc_info(), limit=2)
            code += 1
            continue
        if not comp(val, output):
            wrong_msg = "Wrong result from {0}:".format(func.__name__)
            if desc:
                print(wrong_msg, desc[0])
            else:
                print(wrong_msg, "input", in_print(input))
                print("   returned", val, "not", out_print(output))
            code += 1
    return code


def check_doctest(func_name, module, ref_module=None, run=True):
    """Check that MODULE.FUNC_NAME doctest matches REF_MODULE and passes."""
    func = getattr(module, func_name)
    if ref_module is not None:
        ref_func = getattr(ref_module, func_name)
        if type(func) == type:          # hacky way to get classes to work
            func = object.__new__(func)
            func.__name__ = ref_func.__name__
        if func.__doc__ != ref_func.__doc__ and type(func) != type:
            func.__doc__ = ref_func.__doc__
    tests = DocTestFinder().find(func)
    if not tests:
        print("No doctests found for " + func_name)
        return True
    if run:
        fn = lambda: DocTestRunner().run(tests[0], out = lambda x: None)
        result = test_eval(fn, tuple())
        if result.failed != 0:
            print("A doctest example failed for " + func_name + ".")
            return True
    return False


def underline(s):
    """Print string S, double underlined in ASCII."""
    print(s)
    print('='*len(s))

