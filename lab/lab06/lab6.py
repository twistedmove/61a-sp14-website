from operator import sub, add, mul


# Rlist definition
class Rlist():
    class EmptyList():
        pass

    empty = EmptyList()

    def __init__(self, first, rest=empty):
        self.first = first
        self.rest = rest

def foldl(rlist, fn, z):
    """ Left fold
    >>> lst = Rlist(3, Rlist(2, Rlist(1)))
    >>> foldl(lst, sub, 0) # (((0 - 3) - 2) - 1)
    -6
    >>> foldl(lst, add, 0) # (((0 + 3) + 2) + 1)
    6
    >>> foldl(lst, mul, 1) # (((1 * 3) * 2) * 1)
    6
    """
    if rlist == Rlist.empty:
        return z
    return foldl(______, ______, ______)

def foldr(rlist, fn, z):
    """ Right fold
    >>> lst = Rlist(3, Rlist(2, Rlist(1)))
    >>> foldr(lst, sub, 0) # (3 - (2 - (1 - 0)))
    2
    >>> foldr(lst, add, 0) # (3 + (2 + (1 + 0)))
    6
    >>> foldr(lst, mul, 1) # (3 * (2 * (1 * 1)))
    6
    """
    "*** YOUR CODE HERE ***"

def mapl(lst, fn):
    """ Maps FN on LST
    >>> lst = Rlist(3, Rlist(2, Rlist(1)))
    >>> mapped = mapl(lst, lambda x: x*x)
    >>> print(rlist_string(mapped))
    Rlist(9, Rlist(4, Rlist(1)))
    """
    "*** YOUR CODE HERE ***"

def filterl(lst, pred):
    """ Filters LST based on PRED
    >>> lst = Rlist(4, Rlist(3, Rlist(2, Rlist(1))))
    >>> filtered = filterl(lst, lambda x: x % 2 == 0)
    >>> print(rlist_string(filtered))
    Rlist(4, Rlist(2))
    """
    "*** YOUR CODE HERE ***"

def reverse(lst):
    """ Reverses LST with foldl
    >>> reversed = reverse(Rlist(3, Rlist(2, Rlist(1))))
    >>> print(rlist_string(reversed))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reversed = reverse(Rlist(1))
    >>> print(rlist_string(reversed))
    Rlist(1)
    >>> reversed = reverse(Rlist.empty)
    >>> print(rlist_string(reversed))
    Rlist.empty
    """
    "*** YOUR CODE HERE ***"

# Extra for Experts:
def reverse2(lst):
    """ Reverses LST without the Rlist constructor
    >>> reversed = reverse2(Rlist(3, Rlist(2, Rlist(1))))
    >>> print(rlist_string(reversed))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reversed = reverse2(Rlist(1))
    >>> print(rlist_string(reversed))
    Rlist(1)
    >>> reversed = reverse2(Rlist.empty)
    >>> print(rlist_string(reversed))
    Rlist.empty
    """
    "*** YOUR CODE HERE ***"

identity = lambda x: x

# Extra for Experts:
def foldl2(rlist, fn, z):
    """ Extra for Experts
    >>> list = Rlist(3, Rlist(2, Rlist(1)))
    >>> foldl2(list, sub, 0) # (((0 - 3) - 2) - 1)
    -6
    >>> foldl2(list, add, 0) # (((0 + 3) + 2) + 1)
    6
    >>> foldl2(list, mul, 1) # (((1 * 3) * 2) * 1)
    6
    """
    def step(x, g):
        "*** YOUR CODE HERE ***"
    return foldr(rlist, step, identity)(z)


# Tree definition
class Tree(object):

    def __init__(self, entry, left=None, right=None):
        self.entry = entry
        self.left = left
        self.right = right

    def copy(self):
        left = self.left.copy() if self.left else None
        right = self.right.copy() if self.right else None
        return Tree(self.entry, left, right)

t = Tree(4,
         Tree(2, Tree(8, Tree(7)),
              Tree(3, Tree(1), Tree(6))),
         Tree(1, Tree(5),
              Tree(3, Tree(2), Tree(9))))


def size_of_tree(tree):
    r""" Return the number of non-empty nodes in TREE
    >>> print(tree_string(t)) # doctest: +NORMALIZE_WHITESPACE
        -4--
       /    \
       2    1-
      / \  /  \
     8  3  5  3
    /  / \   / \
    7  1 6   2 9
    >>> size_of_tree(t)
    12
    """
    "*** YOUR CODE HERE ***"


def deep_tree_reverse(tree):
    r""" Reverses the order of a tree
    >>> a = t.copy()
    >>> deep_tree_reverse(a)
    >>> print(tree_string(a)) # doctest: +NORMALIZE_WHITESPACE
       --4---
      /      \
      1-     2-
     /  \   /  \
     3  5   3  8
    / \    / \  \
    9 2    6 1  7
    """
    "*** YOUR CODE HERE ***"


def filter_tree(tree, pred):
    r""" Removes TREE if entry of TREE satisfies PRED
    >>> a = t.copy()
    >>> filtered = filter_tree(a, lambda x: x % 2 == 0)
    >>> print(tree_string(filtered)) # doctest: +NORMALIZE_WHITESPACE
       4
      /
     2
    /
    8
    >>> a = t.copy()
    >>> filtered = filter_tree(a, lambda x : x > 2)
    >>> print(tree_string(filtered))
    4
    """
    "*** YOUR CODE HERE ***"

def max_of_tree(tree):
    r""" Returns the max of all the values of each node in TREE
    >>> print(tree_string(t)) # doctest: +NORMALIZE_WHITESPACE
        -4--
       /    \
       2    1-
      / \  /  \
     8  3  5  3
    /  / \   / \
    7  1 6   2 9
    >>> max_of_tree(t)
    9
    """
    "*** YOUR CODE HERE ***"
