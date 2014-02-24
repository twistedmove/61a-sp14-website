from operator import *
from functools import reduce
import turtle

def deltas(L):
    """Given that L is a sequence of N items, return
    the (N-1)-item sequence (L[1]-L[0], L[2]-L[1],...)."""
    return map(sub, tuple(L)[1:], L)

def indent_lines(s, n):
    """The result of indenting each line in s by n spaces."""
    return "\n".join(map(lambda line: " " * n + line, 
                         s.split('\n')))

#    print(indent_lines(open("afile").read(), 4))

import re
def indent_lines(s, n):
    return re.sub(r'(?m)^', ' ' * n, s)

def values_demos():
    eval('200')
    eval('None')
    eval('1 + 2 +' + ' 3')
    curry = eval('lambda f: lambda x: lambda y: f(x, y)')
    curry(add)(3)(4)

def string_demos():
    'here' in "Where's Waldo?"
    'Mississippi'.count('i')
    'Mississippi'.count('issi')
    hex(ord('A'))
    print('\a')
    print('1\n2\n3')
    from unicodedata import lookup, name
    name('a')
    lookup('WHITE FROWNING FACE')
    lookup('SNOWMAN')
    lookup('SKULL AND CROSSBONES')
    lookup('THAI CHARACTER KHOMUT')
    frown = lookup('WHITE FROWNING FACE')
    len(frown)
    len(frown.encode('utf8'))
    dir('')
    "hello".capitalize()
    "hello".upper()

map_demo = map(print, (1,2,3,4))

def fib(k):
    """Compute the kth Fibonacci number.

    >>> fib(1)
    0
    >>> fib(2)
    1
    >>> fib(11)
    55
    """
    if k == 1:
        return 0
    previous, current = 0, 1  # current is the second Fibonacci number.
    for _ in range(k-2):
         previous, current = current, previous + current
    return current

def even(n):
    return n % 2 == 0

def sum_even_fibs(n):
    """Sum the first n even Fibonacci numbers.

    >>> sum_even_fibs(10)
    44
    >>> sum(map(fib, filter(even, range(1, 11))))
    55
    """
    return sum(filter(even, map(fib, range(1, n+1))))

def first(s):
    return s[0]

def capitalized(s):
    return len(s) > 0 and s[0].isupper()

def acronym(name):
    """Return a tuple of the letters that form the acronym for name.

    >>> acronym('University of California Berkeley')
    ('U', 'C', 'B')
    """
    return tuple(map(first, filter(capitalized, name.split())))

def acronym_gen(name):
    """Return a tuple of the letters that form the acronym for name.

    >>> acronym_gen('University of California Berkeley')
    ('U', 'C', 'B')
    """
    return tuple(w[0] for w in name.split() if capitalized(w))

berkeley = 'University of California Berkeley'
acronym(berkeley)




### The Game of Life (with immutable data) ###

def rotate2(A, dr, dc):
    """Given that A is a 2-dimensional sequence the result of rotating each
    row of A by DC columns and each column by DR rows. That is, a new
    2D tuple, B, in which B[r+dr][c+dc] is A[r][c], wrapping at the ends.
    >>> rotate2( ((1, 2, 3), (4, 5, 6), (7, 8, 9), (10, 11, 12)), 1, -1)
    ((11, 12, 10), (2, 3, 1), (5, 6, 4), (8, 9, 7))"""
    def rotate(R, d):
        # Negative slice indices count from the right.
        if d < 0:
            return R[-len(R)-d: ] + R[0: -d]
        else:
            return R[-d:] + R[0: len(R)-d]
    rows = tuple(map(lambda row: rotate(row, dc), A))
    return rotate(rows, dr)

def map2(f, A, B):
    """Given that A and B are 2-dimensional sequences, the result of
    applying f to corresponding elements of A and B(as a tuple of tuples).
    Extra rows or columns in one or the other argument are thrown away.
    >>> map2(add, [[1, 2, 3], [4, 5, 6]], [[7, 8, 9], [10, 11, 12]])
    ((8, 10, 12), (14, 16, 18))
    """
    return tuple(map(lambda ra, rb: tuple(map(f, ra, rb)),
                     A, B))

def neighbor_count(A):
    """Given a life board A, the number of neighbors corresponding to each
    cell as a tuple of tuples, assuming the board wraps around.
    >>> neighbor_count(((0, 0, 0, 0),
    ...                 (0, 1, 0, 0),
    ...                 (0, 1, 1, 0),
    ...                 (0, 0, 0, 0)))
    ((1, 1, 1, 0), (2, 2, 3, 1), (2, 2, 2, 1), (1, 2, 2, 1))
    """
    sum2 = lambda A, B: map2(add, A, B)
    neighbors = ((-1, -1), (-1, 0), (-1, 1),
                 (0, -1),           (0, 1),
                 (1, -1),  (1, 0),  (1, 1))
    return reduce(sum2,
                  map(lambda d: rotate2(A, d[0], d[1]),
                      neighbors))

def next_alive(neighbors, occupants):
    """Returns the number of occupants of a Life cell in the next
    generation if that cell currently contains OCCUPANTS organisms
    (0 or 1) and NEIGHBORS occupied neighbor cells."""
    return bool((occupants == 0 and neighbors == 3) or
                (occupants == 1 and 2 <= neighbors <= 3))

def life_generation(A):
    """The next Life generation after A (assuming the board wraps around)."""
    return map2(next_alive, neighbor_count(A), A)

def pb(A):
    print('\n'.join(map(lambda R: reduce(add, map(lambda x: ".*"[x], R)), A)))

def make_shape(rows, cols, shape):
    board = [ [0] * cols for r in range(rows) ]
    for row, col in shape:
        board[row][col] = 1
    return board

def print_generations(start, n):
    """Print N generations of Life, played on a wrapped board, starting
    with START. Returns the last generation."""
    pb(start)
    for c in range(n):
        print("---")
        start = life_generation(start)
        pb(start)
    return start

def display_generations(start, n):
    disp(start)
    for c in range(n):
        start = life_generation(start)
        disp(start)
    return start

GLIDER = (0, 1), (1, 2), (2, 0), (2, 1), (2, 2)

def disp(A, cellsize = 1 / 10.5):
    turtle.clear()
    turtle.shape("square")
    turtle.penup()
    turtle.speed(0)
    turtle.shapesize(0.5, 0.5, 1)
    turtle.ht()
    top = len(A) / cellsize
    left = -len(A[0]) / cellsize
    for r in range(len(A)):
        for c in range(len(A[r])):
            if A[r][c]: 
                turtle.goto(c * 10.5 + left, top - r * 10.5)
                turtle.stamp()
