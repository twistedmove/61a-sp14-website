#   The CSUA is holding an 18 hour hackathon
#   starting 5/2 at 7pm in the Woz.  Prizes
#   include 27" monitors, mechanical
#   keyboards, external HDs, and more.  Food
#   will be provided throughout.



class Stream:
    """A lazily computed recursive list.

    >>> s = Stream(1, lambda: Stream(6-2, lambda: Stream(9)))
    >>> s.first
    1
    >>> s.rest.first
    4
    >>> s.rest
    Stream(4, <...>)
    >>> s.rest.rest.first
    9
    """

    class empty:
        def __repr__(self):
            return 'Stream.empty'

    empty = empty()

    def __init__(self, first, compute_rest=lambda: Stream.empty):
        assert callable(compute_rest), 'compute_rest must be callable.'
        self.first = first
        self._compute_rest = compute_rest

    @property
    def rest(self):
        """Return the rest of the stream, computing it if necessary."""
        if self._compute_rest is not None:
            self._rest = self._compute_rest()
            self._compute_rest = None
        return self._rest

    def __repr__(self):
        return 'Stream({0}, <...>)'.format(repr(self.first))

def s_to_list(s, lim=10):
    result = []
    for i in range(lim):
        if s is Stream.empty:
            break
        result.append(s.first)
        s = s.rest
    return result

def make_integer_s(first):
    return Stream(first, lambda: make_integer_s(first+1))

# The stream 0  1  2  3 ...
ints = make_integer_s(0)

def inv(x):
    return 1/x

def map_s(fn, s):
    """The stream of results of applying FN to the elements of
    S."""
    if s is Stream.empty:
        return Stream.empty
    else:
        return Stream(fn(s.first), lambda: map_s(fn, s.rest))

def combine_s(fn, s0, s1):
    """The stream of results of applying two-argument function
    FN to the elements of S0 and S1 in pairs."""
    if s0 is Stream.empty or s1 is Stream.empty:
        return Stream.empty
    else:
        return Stream(fn(s0.first, s1.first),
                      lambda: combine_s(fn, s0.rest, s1.rest))

def const_s(v):
    """The constant stream of Vs."""
    result = Stream(v, lambda: result)
    return result


# Factorial stream

from operator import add, mul

"""
Want the stream, F,  of factorials:
   0! 1! 2! 3! 4!  5!... == 1  1  2  6  24  120 ...

We see the following relationship between F and ints.rest:

   F         = 1  1  2  6  24  120 ...
 X ints.rest = 1  2  3  4   5    6
               1  2  6 24 120  ...
   
In other words, multiplying the elements of F by the corresponding elements of
ints.rest gives us F.rest.

Therefore, we can define F like this:

    F = Stream(1,  lambda: combine_s(mul, ints.rest, F))

The 'lambda' here is important.  First, Stream requires a function as its
second argument.  Second, F is not evaluated until the lambda function is
called, which is AFTER the value of F is initialized (otherwise, we'd try to
access F before the assignment completed).

Now consider this familiar series for the transcendental constant e:

    1 + 1 + 1/2! + 1/3! + ...

We can easily define the items in this infinite sum as a stream:

    map_s(inv, F)

But we still have to add them.  We can't do an infinite sum, but we can
do the sequence (stream) of partial sums:

 e   =  1  1+1   1+1+1/2!   1+1+1/2!+1/3!   ...

and look at the relationship between this and map_s(inv, F):


   e                  =  1     1+1      1+1+1/2!       1+1+1/2!+1/3!   ...
+ map_s(inv, F).rest  =  1     1/2!     1/3!       
                        1+1   1+1+1/2!  1+1+1/2!+1/3!
                      =
                        e.rest

so                  

e = Stream(1, lambda: something that produces e.rest)
e = Stream(1, lambda: combine_s(add, map_s(inv, F).rest, e))

or

e = Stream(1, lambda: combine_s(add, map_s(inv, F.rest), e))

"""



#Trees


class BinTree:

    def __init__(self, label, left = None, right = None):
        self._left = left or empty_tree
        self._right = right or empty_tree
        self._label = label

    @property
    def is_empty(self):
        return False

    @property
    def label(self):
        return self._label

    @property
    def left(self): 
        return self._left

    @property
    def right(self):
        return self._right

    def __str__(self):
        return "({} {} {})".format(self.label, self.left, self.right)

"""The empty tree"""
class Empty(BinTree):
    @property
    def is_empty(self): return True
    def __init__(self): pass
    def __str__(self): return "()"

empty_tree = Empty()


def list_to_BinTree(L):
    """A balanced BinTree containing the elements of L in in-order."""
    if len(L) == 0:
        return empty_tree
    M = len(L) // 2
    return BinTree(L[M], list_to_BinTree(L[0:M]),
                   list_to_BinTree(L[M+1:]))

aTree = list_to_BinTree(list(range(32)))

"""
aTree is

                        16
               8                    24
         4         12            20            28
       2   6    10    14     18      22     26     30
     1  3 5 7  9  11 13 15  17 19  21  23 25  27 29  31
   0


We can describe a path through this tree from the root by giving a sequence of
True/False values: True means "go left", False means "go right".  So

    >>> p = tree_path(aTree, [True, False, True])
    >>> next(p)
    16
    >>> next(p)
    8
    >>> next(p)
    12
    >>> next(p)
    10
    >>> next(p)
    Traceback (most recent call last):
      ...
    StopIteration

That is, I want tree_path to return an *iterator* that gives the labels
in a given tree along a given path."""

def tree_path(tree, path):
    """An iterator of the items of TREE from the root
    along the path described by PATH, where a true
    value in PATH indicates a left child and a false
    value indicates a right child.  If PATH is too
    long for the tree, excess path items are
    discarded."""
    
    class Iter:
        def __init__(self):
            self._tree = tree
            self._path = path

        def __next__(self):
            if self._tree.is_empty:
                raise StopIteration
            value = self._tree.label
            if len(self._path) == 0:
                self._tree = empty_tree
            elif self._path[0]:
                self._tree = self._tree.left
                self._path[0:1] = []
                # or del self._path[0] or self._path.pop(0)
            else:
                self._tree = self._tree.left
                self._path[0:1] = []
            return value

        # Optional method so that you can write, e.g.,
        #    for p in tree_path(T, L): ...
        def __iter__(self):
            return self

    return Iter()
