# Tree class (binary trees with internal values)

def fib(n):
    """Return the nth Fibonacci number."""
    if n == 1:
        return 0
    elif n == 2:
        return 1
    else:
        return fib(n-2) + fib(n-1)

class Tree:
    """A binary tree with internal entries.

    >>> t = Tree(5, Tree(2, Tree(1), None), Tree(8, None, Tree(9)))
    >>> t.entry
    5
    >>> t.left
    Tree(2, Tree(1), None)
    >>> t.right.right.entry
    9
    """

    def __init__(self, entry, left=None, right=None):
        self.entry = entry
        self.left = left
        self.right = right

    def __repr__(self):
        args = repr(self.entry)
        if self.left or self.right:
            args += ', {0}, {1}'.format(repr(self.left), repr(self.right))
        return 'Tree({0})'.format(args)

def fib_tree(n):
    """Return a Tree that represents a recursive Fibonacci calculation.

    >>> fib_tree(4)
    Tree(2, Tree(1), Tree(1, Tree(0), Tree(1)))
    """
    if n == 1:
        return Tree(0)
    elif n == 2:
        return Tree(1)
    else:
        left = fib_tree(n-2)
        right = fib_tree(n-1)
        entry = left.entry + right.entry
        return Tree(entry, left, right)

def count_entries(tree):
    """Return the number of entries in a Tree.

    >>> count_entries(fib_tree(6))
    15
    """
    if tree is None:
        return 0
    else:
        left = count_entries(tree.left)
        right = count_entries(tree.right)
        return 1 + left + right

# Counting factors

from math import sqrt

def divides(k, n):
    """Return whether k evenly divides n."""
    return n % k == 0

def count_factors(n):
    """Count the positive integers that evenly divide n.

    >>> count_factors(576)
    21
    """
    factors = 0
    for k in range(1, n+1):
        if divides(k, n):
            factors += 1
    return factors

def count_factors_fast(n):
    """Count the positive integers that evenly divide n.

    >>> count_factors(8)
    4
    >>> count_factors_fast(576)
    21
    """
    sqrt_n = sqrt(n)
    k, factors = 1, 0
    while k < sqrt_n:
        if divides(k, n):
            factors += 2
        k += 1
    if k * k == n:
        factors += 1
    return factors

# Exponentiation

def exp(b, n):
    """Return b to the n.

    >>> exp(2, 10)
    1024
    """
    if n == 0:
        return 1
    else:
        return b * exp(b, n-1)

def square(x):
    return x*x

def fast_exp(b, n):
    """Return b to the n.

    >>> fast_exp(2, 10)
    1024
    """
    if n == 0:
        return 1
    elif n % 2 == 0:
        return square(fast_exp(b, n//2))
    else:
        return b * fast_exp(b, n-1)
