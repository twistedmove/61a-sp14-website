from functools import reduce
from operator import add

def solve_maze(row0, col0, maze):
    """Assume that MAZE is a rectangular 2D array (list of lists) where
    maze[r][c] is true iff there is a concrete block occupying 
    column c of row r.  ROW0 and COL0 are the initial row and column
    of the prisoner.  Returns true iff there is a path of empty
    squares that are horizontally or vertically adjacent to each other
    starting with (ROW0, COL0) and ending outside the maze."""
    visited = set()   # Set of visited cells
    cols, rows = range(len(maze[0])), range(len(maze))
    def escapep(r, c): 
        """True iff is a path of empty, unvisited cells from (R, C) out        of maze."""
        if r not in rows or c not in cols:
             return True
        elif maze[r][c] or (r, c) in visited:
             return False
        else:
             visited.add((r,c))
             return escapep(r+1, c) or escapep(r-1, c) \
                 or escapep(r, c+1) or escapep(r, c-1)
    return escapep(row0, col0)

def count_change(amount, denoms = (50, 25, 10, 5, 1)):
    """The number of ways to change AMOUNT cents given the
    denominations of coins and bills in DENOMS.
    >>> # 9 cents = 1 nickel and 4 pennies, or 9 pennies
    >>> count_change(9)
    2
    >>> # 12 cents = 1 dime and 2 pennies, 2 nickels and 2 pennies, 
    >>> # 1 nickel and 7 pennies, or 12 pennies
    >>> count_change(12)
    4
    """
    if amount == 0:        return 1
    elif len(denoms) == 0:  return 0
    elif amount >= denoms[0]:
         return count_change(amount-denoms[0], denoms) \
                + count_change(amount, denoms[1:])
    else:
         return count_change(amount, denoms[1:])

def count_change(amount, denoms = (50, 25, 10, 5, 1)):
    memo_table = {}# Indexed by pairs (row, column)
    # Local definition hides outer one so we can cut-and-paste
    # from the unmemoized solution.
    def count_change(amount, denoms): 
        if (amount, denoms) not in memo_table:
              memo_table[amount,denoms] \
                 = full_count_change(amount, denoms)
        return memo_table[amount,denoms]
    def full_count_change(amount, denoms):
        # unmemoized original solution goes here verbatim
        if amount == 0:        return 1
        elif len(denoms) == 0:  return 0
        elif amount >= denoms[0]:
             return count_change(amount-denoms[0], denoms) \
                    + count_change(amount, denoms[1:])
        else:
             return count_change(amount, denoms[1:])

    return count_change(amount, denoms)

def count_change2(amount, denoms = (50, 25, 10, 5, 1)):
    # memo_table[amt][k] contains the value computed for 
    #   count_change(amt, denoms[k:])
    memo_table = [ [-1] * (len(denoms)+1) for i in range(amount+1) ]
    def count_change(amount, denoms): 
        if memo_table[amount][len(denoms)] == -1:
              memo_table[amount][len(denoms)] \
                 = full_count_change(amount, denoms)
        return memo_table[amount][len(denoms)]
    def full_count_change(amount, denoms):
        # unmemoized original solution goes here verbatim
        if amount == 0:        return 1
        elif len(denoms) == 0:  return 0
        elif amount >= denoms[0]:
             return count_change(amount-denoms[0], denoms) \
                    + count_change(amount, denoms[1:])
        else:
             return count_change(amount, denoms[1:])

    return count_change(amount, denoms)

def count_change3(amount, denoms = (50, 25, 10, 5, 1)):
    memo_table = [ [-1] * (len(denoms)+1) for i in range(amount+1) ]
    def count_change(amount, denoms):
        return memo_table[amount][len(denoms)]
    def full_count_change(amount, denoms):
        # unmemoized original solution goes here verbatim
        if amount == 0:        return 1
        elif len(denoms) == 0:  return 0
        elif amount >= denoms[0]:
             return count_change(amount-denoms[0], denoms) \
                    + count_change(amount, denoms[1:])
        else:
             return count_change(amount, denoms[1:])


    for a in range(0, amount+1): 
        memo_table[a][0] = full_count_change(a, ())  
    for k in range(1, len(denoms) + 1):
        for a in range(1, amount+1):
             memo_table[a][k] = full_count_change(a, denoms[-k:])
    return count_change(amount, denoms)

class ExprTree:
    def __init__(self, operator):
        self.__operator = operator

    @property
    def operator(self):
        return self.__operator

    @property
    def left(self):
        raise NotImplementedError

    @property
    def right(self):
        raise NotImplementedError

class Leaf(ExprTree):
    pass

class Inner(ExprTree):
    def __init__(self, operator,
                 left, right):
         ExprTree.__init__(self, operator)
         self.__left = left;
         self.__right = right
    @property
    def left(self):
        return self.__left
    @property
    def right(self):
        return self.__right

class Tree:
    """A Tree consists of a label and a sequence 
    of 0 or more Trees, called its children."""

    def __init__(self, label, *children):
        """A Tree with given label and children. 
        For convenience, if children[k] is not a Tree,
        it is converted into a leaf whose operator is
        children[k]."""
        self.__label = label;
        self.__children = \
          [ c if type(c) is Tree else Tree(c) 
              for c in children]

# class Tree:
    @property
    def is_leaf(self):
        return self.arity == 0

    @property
    def label(self):
        return self.__label

    @property
    def arity(self):
        """The number of my children."""
        return len(self.__children)

    def __iter__(self):
        """An iterator over my children."""
        return iter(self.__children)

    def __getitem__(self, k):
        """My kth child."""
        return self.__children[k]

def leaf_count(T):
    """Number of leaf nodes in the Tree T."""
    if T.is_leaf:
        return 1
    else:
        s = 0
        for child in T:
            s += leaf_count(child)
        return s
        # Can you put the else clause in one line instead?
        return functools.reduce(operator.add, map(leaf_count, T), 0)

def tree_contains(T, x):
    """True iff x is a label in T."""

def tree_to_list_preorder(T):
    """The list of all labels in T, listing the labels 
    of trees before those of their children, and listing their 
    children left to right (preorder)."""
    return (T.label, ) + \
           reduce(add, map(tree_to_list_preorder, T, ()))

class BinaryTree(Tree):
    @property
    def is_empty(self):
         """This tree contains no labels or children."""

    @property
    def left(self): 
        return self[0]

    @property
    def right(self):
        return self[1]

    """The empty tree"""
    empty_tree = ... 

def tree_find(T, x):
    """True iff x is a label in set T, represented as a search tree.
    That is, T 
       (a) Represents an empty tree if its label is None, or
       (b) has two children, both search trees, and all labels in 
           T[0] are less than T.label, and all labels in T[1] are 
           greater than T.label."""
    if T.is_empty:
        return False
    if x == T.label:
        return True
    if x < T.label:
        return tree_find(T.left, x)
    else:
        return tree_find(T.right, x)

