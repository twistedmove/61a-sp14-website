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

    def preorder_values(self):
         """My labels, delivered in preorder (node label first,
         then labels of left child in preorder, then labels of
         right child in preorder.
         >>> T = BinTree(10, BinTree(5, BinTree(2), BinTree(6)), BinTree(15))
         >>> for v in T.preorder_values():
         ...     print(v, end=" ")
         10 5 2 6 15 
         >>> list(T.preorder_values())
         [10, 5, 2, 6, 15]"""
         return tree_iter(self)

    def inorder_values(self): 
        """An iterator over my labels in order.
        >>> T = BinTree(10, BinTree(5, BinTree(2), BinTree(6)), BinTree(15))
        >>> for v in T.inorder_values():
        ...     print(v, end=" ")
        2 5 6 10 15 """
        return inorder_tree_iter(self)

    def __repr__(self): 
        """A string representing me (used by the interpreter).
        >>> T = BinTree(10, BinTree(5, BinTree(2), BinTree(6)), BinTree(15))
        >>> T
        {2, 5, 6, 10, 15}"""
        return "{" + ', '.join(map(repr, self.inorder_values())) + "}"
        # Or, the long way:

        #       result = "{"
        #       for v in self.inorder_values():
        #           if result != "{":
        #               result += ", "
        #           result += repr(v)
        #       return result + "}"



    def __str__(self):
       return self.repr()

# Make BinTree.empty_tree be an arbitrary node with no children
BinTree.empty_tree = BinTree(None)

class tree_iter:
    def __init__(self, the_tree): 
        self._work_queue = [ the_tree ]

    def __next__(self):
        while len(self._work_queue) > 0:
            subtree = self._work_queue.pop(0) # Get first item
            if subtree.is_empty:
                pass
            else:
                self._work_queue[0:0] =  subtree.left, subtree.right
                return subtree.label
        raise StopIteration

    def __iter__(self): return self

# Alternative implementation, adding and removing from the end of the
# work queue instead of the beginning: 
class tree_iter:
    def __init__(self, the_tree): 
        self._work_queue = [ the_tree ]

    def __next__(self):
        while len(self._work_queue) > 0:
            subtree = self._work_queue.pop()
            if subtree.is_empty:
                pass
            else:
                self._work_queue += subtree.right, subtree.left 
                # Reversed!
                return subtree.label
        raise StopIteration

    def __iter__(self): return self

class inorder_tree_iter:
    def __init__(self, the_tree): 
        # As suggested previously, we'll keep work_queue in the 
        # reverse of the order it needs to be processed for speed.
        self._work_queue = [ the_tree ]

    def __next__(self):
        # What goes here?
        raise StopIteration

    def __iter__(self): return self

 
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

def intersection(s1, s2):
    """A binary search tree containing the values that are in both
    search trees S1 and S2.
    >>> T1 = BinTree(9, BinTree(3, BinTree(0), BinTree(6)),
    ...                 BinTree(15, BinTree(12), BinTree(18)))
    >>> T2 = BinTree(10, BinTree(6, BinTree(4, BinTree(2)),
    ...                             BinTree(8)),
    ...                  BinTree(14, BinTree(12), BinTree(18, BinTree(16))))
    >>> T1
    {0, 3, 6, 9, 12, 15, 18}
    >>> T2
    {2, 4, 6, 8, 10, 12, 14, 16, 18}
    >>> intersection(T1, T2)
    {6, 12, 18}
    """
    it1, it2 = s1.inorder_values(), s2.inorder_values()
    v1, v2 = next(it1, None), next(it2, None)
    result = BinTree.empty_tree
    while v1 is not None and v2 is not None:
        if v1 == v2:
            result = dtree_add(result, v1)
            v1, v2 = next(it1, None), next(it2, None)
        elif v1 < v2:
            v1 = next(it1, None)
        else: 
            v2 = next(it2, None)
    return result

