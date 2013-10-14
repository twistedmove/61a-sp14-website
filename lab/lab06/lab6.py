from operator import sub, add, mul

# Inheritance

class Animal:
    def __init__(self):
        self.is_alive = True  # It's alive!!

class Pet(Animal):
    def __init__(self, name, year_of_birth, owner=None):
        Animal.__init__(self)   # call the parent's constructor
        self.name = name
        self.age = current_year - year_of_birth
        self.owner = owner

    def eat(self, thing):
        print(self.name + " ate a " + str(thing) + "!")

    def talk(self):
        print("...")

# Q1
class Cat(Pet):
    def __init__(self, name, year_of_birth, owner, lives=9):
        "*** YOUR CODE HERE ***"

    def talk(self):
        """A cat says 'Meow!' when asked to talk."""
        "*** YOUR CODE HERE ***"

    def lose_life(self):
        """A cat can only lose a life if they have at least one
        life. When there are zero lives left, the 'is_alive'
        variable becomes False.
        """
        "*** YOUR CODE HERE ***"

# Q2
class NoisyCat(Cat):
    def __init__(self, name, year_of_birth, owner, lives=9):
        "*** YOUR CODE HERE ***"
        # hint: do you need to write another __init__?

    def talk(self):
        """A NoisyCat will always repeat what he/she said
        twice."""
        "*** YOUR CODE HERE ***"


# Rlist definition
class Rlist:
    """A recursive list consisting of a first element and the rest.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> print(rlist_expression(s.rest))
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
        self.first = first
        self.rest = rest

    def __getitem__(self, i):
        if i == 0:
            return self.first
        else:
            return self.rest[i-1]

    def __len__(self):
        return 1 + len(self.rest)

def rlist_expression(s):
    """Return a string that would evaluate to s."""
    if s.rest is Rlist.empty:
        rest = ''
    else:
        rest = ', ' + rlist_expression(s.rest)
    return 'Rlist({0}{1})'.format(s.first, rest)

# Problem 2
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

# Problem 3
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

# Problem 4
def mapl(lst, fn):
    """ Maps FN on LST
    >>> lst = Rlist(3, Rlist(2, Rlist(1)))
    >>> mapped = mapl(lst, lambda x: x*x)
    >>> print(rlist_expression(mapped))
    Rlist(9, Rlist(4, Rlist(1)))
    """
    "*** YOUR CODE HERE ***"

# Problem 5
def filterl(lst, pred):
    """ Filters LST based on PRED
    >>> lst = Rlist(4, Rlist(3, Rlist(2, Rlist(1))))
    >>> filtered = filterl(lst, lambda x: x % 2 == 0)
    >>> print(rlist_expression(filtered))
    Rlist(4, Rlist(2))
    """
    "*** YOUR CODE HERE ***"

# Problem 6
def reverse(lst):
    """ Reverses LST with foldl
    >>> reversed = reverse(Rlist(3, Rlist(2, Rlist(1))))
    >>> print(rlist_expression(reversed))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reversed = reverse(Rlist(1))
    >>> print(rlist_expression(reversed))
    Rlist(1)
    >>> reversed = reverse(Rlist.empty)
    >>> reversed == Rlist.empty
    True
    """
    "*** YOUR CODE HERE ***"

# Problem 6 Extra for Experts:
def reverse2(lst):
    """ Reverses LST without the Rlist constructor
    >>> reversed = reverse2(Rlist(3, Rlist(2, Rlist(1))))
    >>> print(rlist_expression(reversed))
    Rlist(1, Rlist(2, Rlist(3)))
    >>> reversed = reverse2(Rlist(1))
    >>> print(rlist_expression(reversed))
    Rlist(1)
    >>> reversed = reverse(Rlist.empty)
    >>> reversed == Rlist.empty
    True
    """
    "*** YOUR CODE HERE ***"

identity = lambda x: x

# Problem 7 Extra for Experts:
def foldl2(rlist, fn, z):
    """ Write foldl using foldr
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
class Tree:

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

# Problem 8
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

# Problem 9
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

# Problem 10
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

# Problem 11
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


###########################################################
# Tree printing functions, kindly provided by Joseph Hui. #
# You do not need to look at these.                       #
###########################################################

def tree_string(tree):
    return "\n".join(tree_block(tree)[0])

def tree_block(tree):
    """Returns a list of strings, each string being
    one line in a rectangle of text representing the
    tree.
    Also returns the index in the string which is
    centered above the tree's root.

    num_width: The width of the widest number in the tree (100 => 3)
    """
    #If no children, just return string
    if tree.left is None and tree.right is None:
        return [str(tree.entry)], len(str(tree.entry))//2
    num_width = len(str(tree.entry)) #Width of this tree's entry
    #If only right child:
    if tree.left is None:
        r_block, r_cent = tree_block(tree.right)
        #Add left padding if necessary
        if r_cent < num_width*3/2:
            padding = ' '*((num_width*3)//2-r_cent)
            r_cent += ((num_width*3)//2-r_cent) #Record new center
            for line_index in range(len(r_block)):
                r_block[line_index] = padding+r_block[line_index]

        #Generate top two lines
        t_line = str(tree.entry)
        t_line += '-'*(r_cent-len(t_line))
        t_line += ' '*(len(r_block[0])-len(t_line))
        m_line = ' '*r_cent + '\\'
        m_line += ' '*(len(r_block[0])-len(m_line))

        return [t_line, m_line]+r_block, num_width//2
    #If only left child:
    if tree.right is None:
        l_block, l_cent = tree_block(tree.left)
        #Add right padding if necessary
        if len(l_block[0]) < l_cent+1+num_width:
            padding = ' '*(l_cent+1+num_width-len(l_block[0]))
            for line_index in range(len(l_block)):
                l_block[line_index] = l_block[line_index]+padding
        #Generate lines
        t_line = ' '*(l_cent+1)
        t_line += '-'*(len(l_block[0])-l_cent-1-num_width)
        t_line += str(tree.entry)
        m_line = ' '*l_cent+'/'
        m_line += ' '*(len(l_block[0]) - len(m_line))
        return [t_line, m_line]+l_block, len(t_line)-num_width//2
    #Otherwise, has both
    l_block, l_cent = tree_block(tree.left)
    r_block, r_cent = tree_block(tree.right)

    #Pad left block
    spacing = r_cent+len(l_block)-l_cent-2
    padding = ' '*max(1, (spacing-num_width))
    for line_index in range(len(l_block)):
        l_block[line_index] = l_block[line_index]+padding

    #Add left and right blocks
    new_block = []
    for line_index in range(max(len(l_block), len(r_block))):
        new_line = l_block[line_index] if line_index < len(l_block) else ' '*len(l_block[0])
        new_line += r_block[line_index] if line_index < len(r_block) else ' '*len(r_block[0])
        new_block.append(new_line)
    r_cent += len(l_block[0])

    #Generate top lines
    my_cent = (l_cent+r_cent)//2
    t_line = ' '*(l_cent+1)
    t_line += '-'*(my_cent-num_width//2-len(t_line))
    t_line += str(tree.entry)
    t_line += '-'*(r_cent-len(t_line))
    t_line += ' '*(len(new_block[0])-len(t_line))

    m_line = ' '*l_cent + '/'
    m_line += ' '*(r_cent-len(m_line)) + '\\'
    m_line += ' '*(len(new_block[0])-len(m_line))

    return [t_line, m_line]+new_block, my_cent
