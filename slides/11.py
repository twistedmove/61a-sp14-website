# Rlists

# The empty rlist (unique).
empty_rlist = None
def rlist(first, rest = empty_rlist):
    """A recursive list, r, such that first(R) is FIRST and 
    rest(R) is REST, which must be an rlist."""
    return first, rest
def first(r):
    """The first item in R."""
    return r[0]
def rest(r):
    """The tail of R: the sequence consisting of items 1, 2,...,
    renumbered from 0."""
    return r[1]


# The sequence 1, 3, 0, 4
L = rlist(1, rlist(3, rlist(0, rlist(4, empty_rlist))))
# The sequence containing sequences (0, 1) and (2, 3)
L = rlist(rlist(0, rlist(1, empty_list)),
          rlist(rlist(2, rlist(3, empty_list)),
                empty_rlist))

# Length

def len_rlist(s):               # A sequence is:
    """The length of rlist S."""
    if s == empty_rlist:        # * Empty or...
        return 0
    else:
        return 1 + len_rlist(rest(s)) 
                                # A first element and
                                # the rest of the list
# Tail-recursive version

def len_rlist(s):            
    """The length of rlist S."""
    def len(sofar, s):
        """Return SOFAR + the length of rlist S."""
        if s == empty_rlist: 
            return sofar
        else:
            return len(sofar + 1, rest(s))
    len(0, s)

# Iterative version

def len_rlist(s):
    sofar = 0
    while s != empty_rlist:
        sofar, s = sofar+1, rest(s)
    return sofar

# getitem

def getitem_rlist(s, k):
    """Return the element at index K of recursive list S.
    Assumes K >= 0.
    >>> getitem_rlist(rlist(2, rlist(3, rlist (4))), 1)
    3"""

    if k == 0:
        return first(s)
    else:
        return getitem_rlist(rest(s), k-1)

# Iterative version

def getitem_rlist(s, k):
    """Return the element at index K of recursive list S.
    Assumes K >= 0."""

    while k != 0:
        s, k = rest(s), k-1
    return first(s)

# Map

def square_rlist(s):
    """The list of squares of the elements of rlist S."""
    if s == empty_rlist:
        return empty_rlist:
    else:
        return rlist(first(s)**2, square_rlist(rest(s)))
def map_rlist(f, s):
    """The list of values F(x) for each element x of S in order."""
    if s == empty_rlist:
        return empty_rlist
    else:  
        return rlist(f(first(s)), map_rlist(f, rest(s)))

# Alternative definition

def square_rlist2(s):
    return map_rlist(lambda x: x*x, s)

# Extend

def extend_rlist(left, right):
    """The sequence of items of rlist `left'
    followed by the items of `right'."""
    if left == empty_rlist:
         return right
    else:
         return rlist(first(left), extend_rlist(rest(left), right))

# Reverse

def reverse_rlist(L):
    def reverse_extend(to_do, already_done):
        """The result of extending ALREADY_DONE with
        the reverse of TO_DO."""
        if to_do == empty_rlist:
            return empty_rlist
        else:
            return reverse_extend(rest(to_do), 
                                  rlist(first(to_do), already_done))
    reverse_extend(L, empty_rlist)
