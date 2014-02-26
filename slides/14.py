def make_pair(left, right):
    """
    >>> p = make_pair(4, 7)
    >>> p(0)
    4
    >>> p(1)
    7"""
    def result(key):
        if key == 0:
            return left
        else:
            return right
    return result

def make_counter(value):
    """A counter that increments and returns its value on each
    call, starting with VALUE.
    >>> c = make_counter(0)
    >>> c()
    1
    >>> c()
    2"""
    def result():
        nonlocal value
        value += 1
        return value
    return result

def mut_rlist(head, rest):
    """
    >>> r = mut_rlist(1, None)
    >>> rest(r) # None
    >>> set_rest(r, mut_rlist(2, None))
    >>> first(r)
    1
    >>> first(rest(r))
    2"""
    def result(key, newval=None):
        nonlocal head, rest
        if key == 0: return head
        if key == 1: return rest
        if key == 2: head = newval;
        if key == 3: rest = newval;
    return result
def first(r): return r(0)
def rest(r): return r(1)
def set_first(r, v): return r(2, v)
def set_rest(r, v): return r(3, v)

def frequencies(L):
    """A dictionary giving, for each w in L, the number of times w 
    appears in L.
    >>> frequencies(['the', 'name', 'of', 'the', 'name', 'of', 'the',
    ...              'song'])
    {'of': 2, 'the': 3, 'name': 2, 'song': 1}
    """
    result = {}
    for word in L:
        result[word] = result.get(word, 0) + 1
    return result

def is_duplicate(L):
    """True iff L contains a duplicated item."""
    items = {}
    for x in L:
        if x in items: return True
        items[x] = True   # Or any value
    return False

def common_keys(D0, D1):
    """Return dictionary containing the keys in both D0 and D1."""
    result = {}
    for x in D0:
         if x in D1: result[x] = True
    return result

# And now with sets:

def is_duplicate(L):
    """True iff L contains a duplicated item."""
    items = set()
    for x in L:
        if x in items: return True
        items.add(x)
    return False

def common_keys(D0, D1):
    """Return set containing the keys in both D0 and D1."""
    return set(D0) & set(D1)
