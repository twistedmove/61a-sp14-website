class Tree:
    """A Tree consists of a label and a sequence of 0 or more
    Trees, called its children."""

    def __init__(self, label, *children):
        """A Tree with given label and children.  For convenience,
        if children[k] is not a Tree, it is converted into a leaf
        whose operator is children[k]."""
        self.__label = label;
        self.__children = \
          [ c if type(c) is Tree else Tree(c) for c in children]

    @property
    def is_leaf(self):
        return self.arity == 0

    @property
    def label(self):
        return self.__label

    @property
    def arity(self):
        return len(self.__children)

    def __getitem__(self, k):
        return self.__children[k]

    def __iter__(self):
        return iter(self.__children)

    def __repr__(self):
        if self.is_leaf:
            return "Tree({0})".format(self.label)
        else:
            return "Tree({0}, {1})" \
               .format(self.label, str(self.__children)[1:-1])

from functools import reduce
from operator import add

def leaf_count(T):
    """Number of leaf nodes in the Tree T."""
    if T.is_leaf:
        return 1
    else:
#        s = 0
#        for child in T:
#            s += leaf_count(child)
#        return s
        return reduce(add, map(leaf_count, T))

def tree_contains(T, x):
    """True iff x is a label in T."""
    if T.label == x:
        return True
    for c in T:
        if tree_contains(c, x):
            return True
    return False

def tree_contains2(T, x):
    """True iff x is a label in T."""
    return T.label == x or any(map(lambda tree: tree_contains(tree, x), T))

def tree_to_list_preorder(T):
    return [T.label] + reduce(add, map(tree_to_list_preorder, T), [])

def tree_find(T, x):
    """True iff x is a label in set T, represented as a search tree.
    That is, T 
       (a) Represents an empty tree if its label is None, or
       (b) has two children, both search trees, and all labels in 
           T[0] are less than T.label, and all labels in T[1] are 
           greater than T.label."""
    if T.label is None:
        return False
    else:
        return x == T.label \
               or (x < T.label and tree_find(T[0], x)) \
               or (x > T.label and tree_find(T[1], x))

