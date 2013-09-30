####################
# IMMUTABLE RLISTS #
####################

empty_rlist = None

def rlist(first, rest):
    return (first, rest)

def first(s):
    return s[0]

def rest(s):
    return s[1]

def len_rlist(s):
    """Return the length of a recrusive list s."""
    if s == empty_rlist:
        return 0
    return 1 + len_rlist(rest(s))

def getitem_rlist(s, i):
    """Return the element at index i of recursive list s."""
    if i == 0:
        return first(s)
    return getitem_rlist(rest(s), i - 1)

def reverse_rlist(s):
    """Return a reversed version of a recursive list s."""
    rev_list = empty_rlist
    while s != empty_rlist:
        rev_list = rlist(first(s), rev_list)
        s = rest(s)
    return rev_list

##################
# MUTABLE RLISTS #
##################

def mutable_rlist():
    """Return a functional implementation of a mutable recursive list."""
    contents = empty_rlist
    def dispatch(message, value=None):
        nonlocal contents
        if message == 'len':
            return len_rlist(contents)
        elif message == 'getitem':
            return getitem_rlist(contents, value)
        elif message == 'push_first':
            contents = rlist(value, contents)
        elif message == 'pop_first':
            f = first(contents)
            contents = rest(contents)
            return f
        elif message == 'str':
            return str(contents)
        "*** YOUR CODE GOES HERE ***"

    return dispatch

def to_mutable_rlist(source):
    """Return a functional list with the same contents as source."""
    s = mutable_rlist()
    for element in reversed(source):
        s('push_first', element)
    return s

##############
# DICTIONARY #
##############
def dictionary():
    """Return a functional implementation of a dictionary."""
    records = []
    def getitem(key):
        for k, v in records:
            if k == key:
                return v
    def setitem(key, value):
        for item in records:
            if item[0] == key:
                item[1] = value
                return
        records.append([key, value])
    def dispatch(message, key=None, value=None):
        if message == 'getitem':
            return getitem(key)
        elif message == 'setitem':
            setitem(key, value)
        elif message == 'keys':
            return tuple(k for k, _ in records)
        elif message == 'values':
            return tuple(v for _, v in records)
        "*** YOUR CODE GOES HERE ***"

    return dispatch
