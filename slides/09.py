# Test-driven development

from ucb import trace, interact
from turtle import *
from math import sqrt

def occurs(x, pair):
    """X occurs at least once in numeric pair PAIR.

    >>> occurs(3, ())
    False
    >>> occurs(3, (2, 3))
    True
    >>> occurs(3, (3, 2))
    True
    >>> occurs(3, (1, 2))
    False
    >>> occurs(3, ((1, 2), ((), (2, ((), 3)))))
    True
    """
    if x == pair:
        return True
    
    elif pair == () or type(pair) is int:
        return False
    else:
        return occurs(x, pair[0]) or occurs(x, pair[1])

def first_leaf(pair):
    """The first leaf in PAIR, reading left to right.
    >>> first_leaf(())
    ()
    >>> first_leaf(5)
    5
    >>> first_leaf((((3, ()), (2, 1)), ()))
    3
    >>> first_leaf(((((), 3), (2, 1)), ()))
    ()
    """

    if type(pair) is int or pair == ():
        return pair
    else:
        return first_leaf(pair[0])

def sierpinski(x, y, side, depth):
    """Draw a Sierpinski triangle of given DEPTH with given SIDE and
    lower-left corner at (X, Y).  A depth of 0 draws a triangle,
    a depth of 1 draws a triangle of three triangles, etc."""

    def triangle(x, y, side):
        """Assuming current heading is 30, draw a filled triangle with
        its lower-left corner at (X, Y), and given SIDE."""
        penup()
        goto(x, y)
        pendown()
        begin_fill()
        setheading(30)
        forward(side)
        right(120)
        forward(side)
        right(120)
        forward(side)
        end_fill()

    if depth == 0:
        triangle(x, y, side)
    else:
        height = 0.25 * sqrt(3) * side

        sierpinski(x, y, side/2, depth-1)
        sierpinski(x + side/4, y + height, side/2, depth-1)
        sierpinski(x + side/2, y, side/2, depth-1)

def draw_triangle(x, y, side, depth):
    """Draw a Sierpinski triangle of given SIDE and DEPTH with lower-left
    corner at (X, Y) after first clearing the screen and initializing the
    graphics package."""
    mode('logo')
    clear()
    sierpinski(x, y, side, depth)
    

def gcd(m, n):
    """Return the largest k that evenly divides both m and n.

    k, m, and n are all positive integers.

    >>> gcd(12, 8)
    4
    >>> gcd(16, 12)
    4
    >>> gcd(16, 8)
    8
    >>> gcd(2, 16)
    2
    >>> gcd(24, 42)
    6
    >>> gcd(5, 5)
    5
    """
    if m == n:
        return m
    elif m < n:
        return gcd(n, m)
    else:
        return gcd(m-n, n)

# Decorators

def trace1(fn):
    """Return a function equivalent to fn that also prints trace output.

    fn -- a function of one argument.
    """
    def traced(x):
        print('Calling', fn, 'on argument', x)
        return fn(x)
    return traced

@trace1
def square(x):
    return x*x

@trace1
def sum_squares_up_to(n):
    total, k = 0, 1
    while k <= n:
        total, k = total + square(k), k + 1
    return total

interact()
