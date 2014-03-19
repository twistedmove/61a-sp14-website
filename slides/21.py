class Tree:
    """A Tree consists of a label and a sequence 
    of 0 or more Trees, called its children."""

    def __init__(self, label, *children):
        """A Tree with given label and children."""
        self._label = label
        self._children = list(children)

    @property
    def is_leaf(self):
        return self.arity == 0
    @property
    def label(self):
        return self._label

    @property
    def arity(self):
        """The number of my children."""
        return len(self._children)
    def __iter__(self):
        """An iterator over my children."""
        return iter(self._children)
    def __getitem__(self, k):
        """My kth child."""
        return self._children[k]

    def __str__(self):
        """My printed string representation (leaves print only 
        their labels).
        >>> str(Tree(3, Tree(2), Tree(3), Tree(4, Tree(5), Tree(6))))
        '(3 2 3 (4 5 6))'
        """
        if self.is_leaf:
            return str(self.label)
        return "(" + str(self.label) + " " + \
               " ".join(map(str, self)) + ")"

    def __repr__(self):
        """My string representation for the interpreter, etc.
        >>> Tree(3, Tree(2), Tree(3), Tree(4, Tree(5), Tree(6)))
        Tree:(3 2 3 (4 5 6))"""
        return "Tree:" + str(self)

def tree_contains(T, x):
    """True iff x is a label in T."""
    if x == T.label:
       return True
    else:
       for c in T:
           if tree_contains(c, x):
               return True
    return False

# Alternative implementation:

def tree_contains(T, x):
    """True iff x is a label in T."""
    return x == T.label or \
           any(map(lambda C: tree_contains(C, x), T))

from functools import reduce
from operator import add
def tree_to_list_preorder(T):
    """The list of all labels in T, listing the labels 
    of trees before those of their children, and listing their 
    children left to right (preorder).
    >>> B = Tree(4, Tree(5), Tree(6, Tree(7), Tree(5, Tree(4))))
    >>> B
    Tree:(4 5 (6 7 (5 4)))
    >>> tree_to_list_preorder(B)
    (4, 5, 6, 7, 5, 4)
    """
    return sum(map(tree_to_list_preorder, T), (T.label,))

class BinTree(Tree):
    def __init__(self, label, left=None, right=None):
        Tree.__init__(self, label,
                      left or BinTree.empty_tree,
                      right or BinTree.empty_tree)
        # or super().__init__(label, left or ...)

    @property
    def is_empty(self):
         """This tree contains no labels or children."""
         return self is BinTree.empty_tree
         
    @property
    def left(self): 
        return self[0]

    @property
    def right(self):
        return self[1]

    # The empty binary tree.  This definition is a placeholder, the
    # real definition is just below. (We can't call BinTree while its
    # still being defined.)
    empty_tree = None

# Make BinTree.empty_tree be an arbitrary node with no children
BinTree.empty_tree = BinTree(None)

def tree_find(T, x):
    """True iff x is a label in set T, represented as a search tree.
    That is, T 
       (a) Is an empty tree if T.is_empty(), or
       (b) Has two children, T.left and T.right, both search trees,
            and all labels in T.left are less than T.label, 
            and all labels in T.right are greater than T.label."""
    if T.is_empty:
        return False
    if x == T.label:
        return True
    if x < T.label:
        return tree_find(T.left, x)
    else:
        return tree_find(T.right, x)

def tree_find(T, x):
    """True iff x is a label in set T, represented as a search tree.
    That is, T 
       (a) Is an empty tree if T.is_empty(), or
       (b) Has two children, T.left and T.right, both search trees,
            and all labels in T.left are less than T.label, 
            and all labels in T.right are greater than T.label."""
    while not T.is_empty:
        if x == T.label:
            return True
        elif x < T.label:
            T = T.left
        else:
            T = T.right
    return False

