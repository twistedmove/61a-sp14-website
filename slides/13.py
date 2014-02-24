#!/usr/bin/env python3
# -*-Python-*-

from operator import add
from functools import reduce
import turtle

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
