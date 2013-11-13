#  Name:
#  Email:

# Q1.

class Amount(object):
    """An amount of nickels and pennies.

    >>> a = Amount(3, 7)
    >>> a.nickels
    3
    >>> a.pennies
    7
    >>> a.value
    22
    >>> a.nickels = 5
    >>> a.value
    32
    >>> a.value = 8
    >>> a.pennies = 3
    """
    def __init__(self, nickels, pennies):
        self.nickels = nickels
        self.pennies = pennies

    @property
    def value(self):
        return 5 * self.nickels + self.pennies

    @value.setter
    def value(self, value):
        self.nickels = value // 5
        self.pennies = value % 5

class MinimalAmount(Amount):
    """An amount of nickels and pennies that is initialized with no more than
    four pennies, by converting excess pennies to nickels.

    >>> a = MinimalAmount(3, 7)
    >>> a.nickels
    4
    >>> a.pennies
    2
    >>> a.value
    22
    """
    def __init__(self, nickels, pennies):
        self.nickels = nickels + pennies // 5
        self.pennies = pennies % 5

# Q2.

class Square(object):
    def __init__(self, side):
        self.side = side

class Rect(object):
    def __init__(self, width, height):
        self.width = width
        self.height = height

def apply(operator_name, shape):
    """Apply operator to shape.

    >>> apply('area', Square(10))
    100
    >>> apply('perimeter', Square(5))
    20
    >>> apply('area', Rect(5, 10))
    50
    >>> apply('perimeter', Rect(2, 4))
    12
    """
    return apply_implementations[(operator_name, type(shape))](shape)

apply_implementations = {
        ('area', Square): lambda s: s.side ** 2,
        ('area', Rect): lambda r: r.width * r.height,
        ('perimeter', Square): lambda s: s.side * 4,
        ('perimeter', Rect): lambda r: 2 * (r.width + r.height)}

# Q3.

def empty(s):
    return len(s) == 0

def set_contains2(s, v):
    """Return true if set s contains value v as an element.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
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

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
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

def adjoin_set2(s, v):
    """Return a set containing all elements of s and element v.

    Assume that s is an Rlist with elements sorted from least to greatest.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> adjoin_set2(s, 2.5)
    Rlist(1, Rlist(2, Rlist(2.5, Rlist(3))))
    >>> adjoin_set2(s, 0.5)
    Rlist(0.5, Rlist(1, Rlist(2, Rlist(3))))
    >>> adjoin_set2(s, 3)
    Rlist(1, Rlist(2, Rlist(3)))
    """
    if empty(s) or s.first > v:
        return Rlist(v, s)
    elif s.first == v:
        return s
    else:
        return Rlist(s.first, adjoin_set2(s.rest, v))

def union_set2(set1, set2):
    """Return a set containing all elements either in set1 or set2.

    Assume that set1 and set2 are both Rlists with elements sorted from least
    to greatest.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> t = Rlist(1, Rlist(3, Rlist(5)))
    >>> union_set2(s, t)
    Rlist(1, Rlist(2, Rlist(3, Rlist(5))))
    >>> union_set2(s.rest, t)
    Rlist(1, Rlist(2, Rlist(3, Rlist(5))))
    >>> union_set2(Rlist.empty, intersect_set2(s.rest, t))
    Rlist(3)
    """
    if empty(set1):
        return set2
    elif empty(set2):
        return set1
    else:
        e1, e2 = set1.first, set2.first
        if e1 == e2:
            return Rlist(e1, union_set2(set1.rest, set2.rest))
        elif e1 < e2:
            return Rlist(e1, union_set2(set1.rest, set2))
        elif e2 < e1:
            return Rlist(e2, union_set2(set1, set2.rest))

# Q4.

class Tree(object):
    """A tree with internal values."""

    def __init__(self, entry, left=None, right=None):
        self.entry = entry
        self.left = left
        self.right = right

    def __repr__(self):
        args = repr(self.entry)
        if self.left or self.right:
            args += ', {0}, {1}'.format(repr(self.left), repr(self.right))
        return 'Tree({0})'.format(args)

def big_tree(left, right):
    """Return a tree set of unique elements between left and right.

    This function creates binary search trees for testing.

    >>> big_tree(0, 12)
    Tree(6, Tree(2, Tree(0), Tree(4)), Tree(10, Tree(8), Tree(12)))
    """
    if left > right:
        return None
    split = left + (right - left)//2
    return Tree(split, big_tree(left, split-2), big_tree(split+2, right))

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

def intersect_set3(set1, set2):
    """Return a set containing all elements common to set1 and set2.

    >>> s, t = big_tree(0, 12), big_tree(6, 18)
    >>> intersect_set3(s, t)
    Tree(8, Tree(6), Tree(10, None, Tree(12)))
    """
    s1, s2 = map(tree_to_ordered_sequence, (set1, set2))
    return ordered_sequence_to_tree(intersect_set2(s1, s2))

def union_set3(set1, set2):
    """Return a set containing all elements either in set1 or set2.

    >>> s, t = big_tree(6, 12), big_tree(10, 16)
    >>> union_set3(s, t)
    Tree(10, Tree(6, None, Tree(9)), Tree(13, Tree(11), Tree(15)))
    """
    s1, s2 = map(tree_to_ordered_sequence, (set1, set2))
    return ordered_sequence_to_tree(union_set2(s1, s2))


def tree_to_ordered_sequence(s):
    """Return an ordered sequence containing the elements of tree set s.

    Assume that s is a well-formed binary search tree.

    >>> b = big_tree(0, 9)
    >>> tree_to_ordered_sequence(b)
    Rlist(1, Rlist(4, Rlist(7, Rlist(9))))
    """
    def ttos_iter(s, r):
        if s is None:
            return r
        return ttos_iter(s.left, Rlist(s.entry, ttos_iter(s.right, r)))
    return ttos_iter(s, Rlist.empty)


def partial_tree(s, n):
    """Return a balanced tree of the first n elements of Rlist s, along with
    the rest of s. A tree is balanced if

      (a) the number of entries in its left branch differs from the number
          of entries in its right branch by at most 1, and

      (b) its non-empty branches are also balanced trees.

    Examples of balanced trees:

    Tree(1)                    # branch difference 0 - 0 = 0
    Tree(1, Tree(2), None)     # branch difference 1 - 0 = 1
    Tree(1, None, Tree(2))     # branch difference 0 - 1 = -1
    Tree(1, Tree(2), Tree(3))  # branch difference 1 - 1 = 0

    Examples of unbalanced trees:

    Tree(1, Tree(2, Tree(3)), None)  # branch difference 2 - 0 = 2
    Tree(1, Tree(2, Tree(3), None),
            Tree(4, Tree(5, Tree(6), None), None)) # Unbalanced right branch

    >>> s = Rlist(1, Rlist(2, Rlist(3, Rlist(4, Rlist(5)))))
    >>> partial_tree(s, 3)
    (Tree(2, Tree(1), Tree(3)), Rlist(4, Rlist(5)))
    >>> t = Rlist(-2, Rlist(-1, Rlist(0, s)))
    >>> partial_tree(t, 7)[0]
    Tree(1, Tree(-1, Tree(-2), Tree(0)), Tree(3, Tree(2), Tree(4)))
    >>> partial_tree(t, 7)[1]
    Rlist(5)
    """
    if n == 0:
        return None, s
    left_size = (n-1)//2
    right_size = n - left_size - 1
    left, rest = partial_tree(s, left_size)
    entry, rest = rest.first, rest.rest
    right, rest = partial_tree(rest, right_size)
    return Tree(entry, left, right), rest

def ordered_sequence_to_tree(s):
    """Return a balanced tree containing the elements of ordered Rlist s.

    Note: this implementation is complete, but the definition of partial_tree
    above is not complete.

    >>> ordered_sequence_to_tree(Rlist(1, Rlist(2, Rlist(3))))
    Tree(2, Tree(1), Tree(3))
    >>> b = big_tree(0, 20)
    >>> elements = tree_to_ordered_sequence(b)
    >>> elements
    Rlist(1, Rlist(4, Rlist(7, Rlist(10, Rlist(13, Rlist(16, Rlist(19)))))))
    >>> ordered_sequence_to_tree(elements)
    Tree(10, Tree(4, Tree(1), Tree(7)), Tree(16, Tree(13), Tree(19)))
    """
    return partial_tree(s, len(s))[0]

# Q5.

def mario_number(level):
    """Return the number of ways that Mario can perform a sequence of steps
    or jumps to reach the end of the level without ever landing in a Piranha
    plant. Assume that every level begins and ends with a space.

    >>> mario_number(' P P ')   # jump, jump
    1
    >>> mario_number(' P P  ')   # jump, jump, step
    1
    >>> mario_number('  P P ')  # step, jump, jump
    1
    >>> mario_number('   P P ') # step, step, jump, jump or jump, jump, jump
    2
    >>> mario_number(' P PP ')  # Mario cannot jump two plants
    0
    >>> mario_number('    ')    # step, jump ; jump, step ; step, step, step
    3
    >>> mario_number('    P    ')
    9
    >>> mario_number('   P    P P   P  P P    P     P ')
    180
    """
    def ways(n):
        if n == len(level)-1:
            return 1
        if n >= len(level) or level[n] == 'P':
            return 0
        return ways(n+1) + ways(n+2)
    return ways(0)

# Q6.

def has_cycle(s):
    """Return whether Rlist s contains a cycle.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> s.rest.rest.rest = s
    >>> has_cycle(s)
    True
    >>> t = Rlist(1, Rlist(2, Rlist(3)))
    >>> has_cycle(t)
    False
    """
    lists = set()
    while s != Rlist.empty:
        if s in lists:
            return True
        lists.add(s)
        s = s.rest
    return False

def has_cycle_constant(s):
    """Return whether Rlist s contains a cycle.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> s.rest.rest.rest = s
    >>> has_cycle_constant(s)
    True
    >>> t = Rlist(1, Rlist(2, Rlist(3)))
    >>> has_cycle_constant(t)
    False
    """
    if s == Rlist.empty:
        return False
    else:
      slow, fast = s, s.rest
      while fast != Rlist.empty:
          if fast.rest == Rlist.empty:
              return False
          elif fast == slow or fast.rest == slow:
              return True
          else:
              slow, fast = slow.rest, fast.rest.rest
      return False

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


