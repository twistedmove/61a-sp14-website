# Tuples are sequences

odds = (41, 43, 47, 49)
len(odds)
odds[1]
odds[0] * odds[3] + len(odds)
odds[odds[3]-odds[2]]

# Recursive list abstract data type

empty_rlist = None

def rlist(first, rest):
    """Return a recursive list from its first element and the rest."""
    return (first, rest)

def first(s):
    """Return the first element of a recursive list s."""
    return s[0]

def rest(s):
    """Return the rest of the elements of a recursive list s."""
    return s[1]

### +++ === ABSTRACTION BARRIER === +++ ###

# Recursive list examples

counts = rlist(1, rlist(2, rlist(3, rlist(4, empty_rlist))))
alts = rlist(1, rlist(2, rlist(1, rlist(2, empty_rlist))))
both = rlist(alts, rlist(counts, empty_rlist))

# Which of these evaluates to 3?
# first(rest(rest(first(rest(both)))))
# first(rest(first(rest(rest(both)))))
# first(rest(first(rest(first(both)))))
# first(rest(rest(rest(first(both)))))
# first(first(rest(rest(first(both)))))

# Implementing the sequence abstraction

def len_rlist(s):
    """Return the length of recursive list s.

    >>> len_rlist(counts)
    4
    >>> len_rlist(both)
    2
    """
    length = 0
    while s != empty_rlist:
        s, length = rest(s), length + 1
    return length

def getitem_rlist(s, i):
    """Return the element at index i of recursive list s.

    >>> getitem_rlist(alts, 3)
    2
    """
    while i > 0:
        s, i = rest(s), i - 1
    return first(s)

# Recursive implementation

def len_rec(s):
    """Return the length of recursive list s.

    >>> len_rec(counts)
    4
    """
    if s == empty_rlist:
        return 0
    else:
        return 1 + len_rec(rest(s))

def getitem_rec(s, i):
    """Return the element at index i of recursive list s.

    >>> getitem_rec(alts, 3)
    2
    """
    if i == 0:
        return first(s)
    else:
        return getitem_rec(rest(s), i-1)

def reverse(s):
    """Return s reversed.

    >>> r = rlist(4, rlist(3, rlist(2, rlist(1, empty_rlist))))
    >>> reverse(counts) == r
    True
    """
    return reverse_to(s, empty_rlist)

def reverse_to(s, result):
    if s == empty_rlist:
        return result
    else:
        return reverse_to(rest(s), rlist(first(s), result))
