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
    def set_child(self, k, val):
        """Set my Kth child to VAL, which should be a tree."""
        self._children[k] = val

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

    def set_left(self, newval):
        """Assuming NEWVAL is a BinTree, sets SELF.left to NEWVAL."""
        self.set_child(0, newval)

    def set_right(self, newval):
        """Assuming NEWVAL is a BinTree, sets SELF.right to NEWVAL."""
        self.set_child(1, newval)

    # The empty binary tree.  This definition is a placeholder, the
    # real definition is just below. (We can't call BinTree while its
    # still being defined.)
    empty_tree = None

# Make BinTree.empty_tree be an arbitrary node with no children
BinTree.empty_tree = BinTree(None)

def tree_add(T, x):
    """Assuming T is a binary search tree, a new binary search tree 
    that contains all previous values in T, plus X 
    (if not previously present)."""
    if T.is_empty:
        return BinTree(x)
    elif x == T.label:
        return T
    elif x < T.label:
        return BinTree(T.label, tree_add(T.left, x), T.right)
    else:
        return BinTree(T.label, T.left, tree_add(T.right, x))

def dtree_add(T, x):
    """Assuming T is a binary search tree, a binary search tree 
    that contains all previous values in T, plus X 
    (if not previously present). May destroy the initial contents
    of T."""
    if T.is_empty:
        return BinTree(x)
    elif x == T.label:
        return T
    elif x < T.label:
        T.set_left(dtree_add(T.left, x))
        return T
    else:
        T.set_right(dtree_add(T.right, x))
        return T

def list_to_tree(L):
    """Assuming L is a sorted list, a (nearly) balanced 
    search tree containing exactly the values in L."""
    if len(L) == 0:
        return Tree.empty_tree
    else:
        root_index = len(L) // 2
        return BinTree(L[root_index],
                       list_to_tree(L[:root_index]), 
                       list_to_tree(L[root_index+1:]))

def tree_to_list_preorder(T):
    """The list of all labels in T, listing the labels 
    of trees before those of their children, and listing their 
    children left to right (preorder)."""
    if T.is_empty:
        return ()
    else:
        return (T.label,) + tree_to_list_preorder(T.left) \
                          + tree_to_list_preorder(T.right)

