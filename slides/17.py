# Recursive list class

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

s = Rlist(1, Rlist(2, Rlist(3)))

def extend_rlist(s1, s2):
    """Return a list containing the elements of s1 followed by those of s2.

    >>> extend_rlist(s.rest, s)
    Rlist(2, Rlist(3, Rlist(1, Rlist(2, Rlist(3)))))
    """
    if s1 is Rlist.empty:
        return s2
    else:
        return Rlist(s1.first, extend_rlist(s1.rest, s2))

def range_rlist(start, end):
    """Return a recursive list representing a range from start to end.

    >>> range_rlist(2, 6)
    Rlist(2, Rlist(3, Rlist(4, Rlist(5))))
    """
    if start >= end:
        return Rlist.empty
    else:
        return Rlist(start, range_rlist(start+1, end))

def double_rlist(s):
    """Return a list that results from doubling each element of s.

    >>> double_rlist(s)
    Rlist(2, Rlist(4, Rlist(6)))
    """
    if s is Rlist.empty:
        return s
    else:
        return Rlist(2*s.first, double_rlist(s.rest))

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

def sum_list_of_lists(s):
    """Sum all numbers in an Rlist of Rlists.

    >>> ss = map_rlist(s, lambda n: range_rlist(n, 4))
    >>> ss
    Rlist(Rlist(1, Rlist(2, Rlist(3))), Rlist(Rlist(2, Rlist(3)), Rlist(Rlist(3))))
    >>> sum_list_of_lists(ss)
    14
    """
    if s is Rlist.empty:
        return 0
    elif s.first is Rlist.empty:
        return sum_list_of_lists(s.rest)
    else:
        all_but_first_number = Rlist(s.first.rest, s.rest)
        return s.first.first + sum_list_of_lists(all_but_first_number)

# Trees as nested tuples

t = ((1, 2), (3, 4), 5)

def count_leaves(tree):
    """Return the number of leaves in a tree.

    >>> count_leaves(t)
    5
    """
    if type(tree) != tuple:
        return 1
    else:
        return sum(map(count_leaves, tree))

def map_tree(tree, fn):
    """Return a tree with fn mapped to the leaves of tree.

    >>> map_tree(t, lambda x: x*x)
    ((1, 4), (9, 16), 25)
    """
    if type(tree) != tuple:
        return fn(tree)
    else:
        return tuple(map_tree(branch, fn) for branch in tree)

# Tree class (binary trees with internal entries).

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

def fib_tree(n):
    """Return a Tree that represents a recursive Fibonacci calculation.

    >>> fib_tree(3)
    Tree(1, Tree(0), Tree(1))
    """
    if n == 1:
        return Tree(0)
    elif n == 2:
        return Tree(1)
    else:
        left = fib_tree(n-2)
        right = fib_tree(n-1)
        return Tree(left.entry + right.entry, left, right)

def sum_entries(t):
    """Return the sum of entries in t.

    >>> sum_entries(fib_tree(5))
    10
    """
    if t is None:
        return 0
    else:
        return t.entry + sum_entries(t.left) + sum_entries(t.right)

def count_entries(t):
    """Return the sum of entries in t.

    >>> sum_entries(fib_tree(5))
    10
    """
    if t is None:
        return 0
    else:
        return 1 + count_entries(t.left) + count_entries(t.right)

# Memoization

def memo(f):
    """Return a memoized version of single-argument function f.

    >>> big_fib_tree = fib_tree(35)
    >>> big_fib_tree.entry
    5702887
    >>> big_fib_tree.left is big_fib_tree.right.right
    True
    >>> sum_entries(big_fib_tree)
    142587180
    >>> count_entries(big_fib_tree)
    18454929
    """
    cache = {}
    def memoized(n):
        if n not in cache:
            cache[n] = f(n)
        return cache[n]
    return memoized

# fib_tree = memo(fib_tree)
sum_entries = memo(sum_entries)
count_entries = memo(count_entries)
