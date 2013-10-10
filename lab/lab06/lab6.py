from operator import sub, add, mul

# Rlist definition
class Rlist():
    class EmptyList():
        def __repr__(self):
            return "Rlist.empty"

    empty = EmptyList()

    def __init__(self, first, rest=empty):
        self.first = first
        self.rest = rest

    def __repr__(self):
        args = repr(self.first)
        if self.rest is not Rlist.empty:
            args += ", " + repr(self.rest)
        return "Rlist({})".format(args)

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
    >>> list = Rlist(3, Rlist(2, Rlist(1)))
    >>> mapl(list, lambda x: x*x)
    Rlist(9, Rlist(4, Rlist(1)))
    """
    "*** YOUR CODE HERE ***"

def filterl(lst, pred):
    """ Filters LST based on PRED
    >>> list = Rlist(4, Rlist(3, Rlist(2, Rlist(1))))
    >>> filterl(list, lambda x: x % 2 == 0)
    Rlist(4, Rlist(2))
    """
    "*** YOUR CODE HERE ***"

def reverse(lst):
    """ Reverses LST with foldl
    >>> reverse(Rlist(3, Rlist(2, Rlist(1))))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reverse(Rlist(1))
    Rlist(1)
    >>> reverse(Rlist.empty)
    Rlist.empty
    """
    "*** YOUR CODE HERE ***"

# Extra for Experts:
def reverse2(lst):
    """ Reverses LST without the Rlist constructor
    >>> reverse2(Rlist(3, Rlist(2, Rlist(1))))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reverse2(Rlist(1))
    Rlist(1)
    >>> reverse2(Rlist.empty)
    Rlist.empty
    >>>
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



class Tree(object):

    def __init__(self, entry, left=None, right=None):
        self.entry = entry
        self.left = left
        self.right = right

    def __repr__(self):
        args = repr(self.entry)
        if self.left or self.right:
            args += ', {0}, {1}'.format(repr(self.left), repr(self.right))
        return 'Tree({0})'.format(args)

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
    """ Return the number of non-empty nodes in TREE
    >>> t
    Tree(4, Tree(2, Tree(8, Tree(7), None), Tree(3, Tree(1), Tree(6))), Tree(1, Tree(5), Tree(3, Tree(2), Tree(9))))
    >>> size_of_tree(t)
    12
    """
    "*** YOUR CODE HERE ***"


def deep_tree_reverse(tree):
    """ Reverses the order of a tree
    >>> a = t.copy()
    >>> deep_tree_reverse(a)
    >>> a
    Tree(4, Tree(1, Tree(3, Tree(9), Tree(2)), Tree(5)), Tree(2, Tree(3, Tree(6), Tree(1)), Tree(8, None, Tree(7))))
    """
    "*** YOUR CODE HERE ***"


def filter_tree(tree, pred):
    """ Removes TREE if entry of TREE satisfies PRED
    >>> a = t.copy()
    >>> filter_tree(a, lambda x: x % 2 == 0)
    Tree(4, Tree(2, Tree(8), None), None)
    >>> a = t.copy()
    >>> filter_tree(a, lambda x : x > 2)
    Tree(4)
    """
    "*** YOUR CODE HERE ***"

def max_of_tree(tree):
    """ Returns the max of all the values of each node in TREE
    >>> t
    Tree(4, Tree(2, Tree(8, Tree(7), None), Tree(3, Tree(1), Tree(6))), Tree(1, Tree(5), Tree(3, Tree(2), Tree(9))))
    >>> max_of_tree(t)
    9
    """
    "*** YOUR CODE HERE ***"
