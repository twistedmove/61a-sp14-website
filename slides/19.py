# Take 1: Sets as unordered sequences

def empty(s):
    return s is Rlist.empty

def set_contains(s, v):
    """Return true if set s contains value v as an element.

    >>> set_contains(s, 2)
    True
    >>> set_contains(s, 5)
    False
    """
    if empty(s):
        return False
    elif s.first == v:
        return True
    else:
        return set_contains(s.rest, v)

def adjoin_set(s, v):
    """Return a set containing all elements of s and element v.

    >>> t = adjoin_set(s, 4)
    >>> t
    Rlist(4, Rlist(1, Rlist(2, Rlist(3))))
    """
    if set_contains(s, v):
        return s
    else:
        return Rlist(v, s)

def intersect_set(set1, set2):
    """Return a set containing all elements common to set1 and set2.

    >>> t = adjoin_set(s, 4)
    >>> intersect_set(t, map_rlist(s, lambda x: x*x))
    Rlist(4, Rlist(1))
    """
    in_set2 = lambda v: set_contains(set2, v)
    return filter_rlist(set1, in_set2)

def union_set(set1, set2):
    """Return a set containing all elements either in set1 or set2.

    >>> t = adjoin_set(s, 4)
    >>> union_set(t, s)
    Rlist(4, Rlist(1, Rlist(2, Rlist(3))))
    """
    not_in_set2 = lambda v: not set_contains(set2, v)
    set1_not_set2 = filter_rlist(set1, not_in_set2)
    return extend_rlist(set1_not_set2, set2)

# Take 2: Sets as (sorted) ordered sequences

def set_contains2(s, v):
    """Return true if set s contains value v as an element.

    >>> set_contains2(s, 2)
    True
    >>> set_contains2(s, 5)
    False
    """
    if empty(s) or s.first > v:
        return False
    elif s.first == v:
        return True
    else:
        return set_contains2(s.rest, v)

def intersect_set2(set1, set2):
    """Return a set containing all elements common to set1 and set2.

    >>> t = Rlist(2, Rlist(3, Rlist(4)))
    >>> intersect_set2(s, t)
    Rlist(2, Rlist(3))
    """
    if empty(set1) or empty(set2):
        return Rlist.empty
    else:
        e1, e2 = set1.first, set2.first
        if e1 == e2:
            return Rlist(e1, intersect_set2(set1.rest, set2.rest))
        elif e1 < e2:
            return intersect_set2(set1.rest, set2)
        elif e2 < e1:
            return intersect_set2(set1, set2.rest)

# Take 3: Sets as trees

def set_contains3(s, v):
    """Return true if set s contains value v as an element.

    >>> t = Tree(2, Tree(1), Tree(3))
    >>> set_contains3(t, 3)
    True
    >>> set_contains3(t, 0)
    False
    >>> set_contains3(big_tree(20, 60), 34)
    True
    """
    if s is None:
        return False
    elif s.entry == v:
        return True
    elif s.entry < v:
        return set_contains3(s.right, v)
    elif s.entry > v:
        return set_contains3(s.left, v)

def adjoin_set3(s, v):
    """Return a set containing all elements of s and element v.

    >>> b = big_tree(0, 9)
    >>> b
    Tree(4, Tree(1), Tree(7, None, Tree(9)))
    >>> adjoin_set3(b, 5)
    Tree(4, Tree(1), Tree(7, Tree(5), Tree(9)))
    """
    if s is None:
        return Tree(v)
    elif s.entry == v:
        return s
    elif s.entry < v:
        return Tree(s.entry, s.left, adjoin_set3(s.right, v))
    elif s.entry > v:
        return Tree(s.entry, adjoin_set3(s.left, v), s.right)

# From lecture 17: Recursive lists and trees

class Rlist:
    """A recursive list consisting of a first element and the rest.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> s.rest
    Rlist(2, Rlist(3))
    >>> len(s)
    3
    >>> s[1]
    2
    """

    class EmptyList:
        def __len__(self):
            return 0
        def __repr__(self):
            return "Rlist.empty"

    empty = EmptyList()

    def __init__(self, first, rest=empty):
        assert type(rest) is Rlist or rest is Rlist.empty
        self.first = first
        self.rest = rest

    def __getitem__(self, index):
        if index == 0:
            return self.first
        else:
            return self.rest[index-1]

    def __len__(self):
        return 1 + len(self.rest)

    def __repr__(self):
        return rlist_expression(self)

def rlist_expression(s):
        """Return a string that would evaluate to s."""
        if s.rest is Rlist.empty:
            rest = ''
        else:
            rest = ', ' + rlist_expression(s.rest)
        return 'Rlist({0}{1})'.format(s.first, rest)

def extend_rlist(s1, s2):
    """Return a list containing the elements of s1 followed by those of s2.

    >>> extend_rlist(s.rest, s)
    Rlist(2, Rlist(3, Rlist(1, Rlist(2, Rlist(3)))))
    """
    if s1 is Rlist.empty:
        return s2
    else:
        return Rlist(s1.first, extend_rlist(s1.rest, s2))

def map_rlist(s, fn):
    """Return a list resulting from mapping fn over the elements of s.

    >>> map_rlist(s, lambda x: x*x)
    Rlist(1, Rlist(4, Rlist(9)))
    """
    if s is Rlist.empty:
        return s
    else:
        return Rlist(fn(s.first), map_rlist(s.rest, fn))

def filter_rlist(s, fn):
    """Filter the elemenst of s by predicate fn.

    >>> filter_rlist(s, lambda x: x % 2 == 1)
    Rlist(1, Rlist(3))
    """
    if s is Rlist.empty:
        return s
    else:
        rest = filter_rlist(s.rest, fn)
        if fn(s.first):
            return Rlist(s.first, rest)
        else:
            return rest

s = Rlist(1, Rlist(2, Rlist(3))) # A set is an Rlist with no duplicates

class Tree:
    """A binary tree with internal entries."""

    def __init__(self, entry, left=None, right=None):
        self.entry = entry
        self.left = left
        self.right = right

    def __repr__(self):
        if self.left or self.right:
            args = self.entry, self.left, self.right
            return 'Tree({0}, {1}, {2})'.format(*args)
        else:
            return 'Tree({0})'.format(self.entry)

def big_tree(left, right):
    """Return a tree of elements between left and right.

    >>> big_tree(0, 12)
    Tree(6, Tree(2, Tree(0), Tree(4)), Tree(10, Tree(8), Tree(12)))
    """
    if left > right:
        return None
    split = left + (right - left)//2
    return Tree(split, big_tree(left, split-2), big_tree(split+2, right))
