from ucb import main, interact
from operator import *

def deltas(L):
    """Given that L is a sequence of N items, return
    the (N-1)-item sequence (L[1]-L[0], L[2]-L[1],...)."""

    return map(sub, tuple(L)[1:], L)


def with_border(B):
    """Life board B with a layer of 0's around the edges."""
    m, n = len(B), len(B[0])
    return   [ [0] * (n+2) ] \
           + list(map(lambda row: [0] + row + [0], B)) \
           + [ [0] * (n+2) ] 

def add3(x, y, z):
    return x + y + z
def add3_seq(X, Y, Z):
    """Result of adding corresponding items in sequences X, Y, and Z.
    >>> add3_seq([1, 2, 3, 4], [5, 10, 15, 20], [20, 30, 40, 50])
    [26, 42, 58, 74]
    >>> add3_seq([1, 2, 3, 4], [5, 10, 15], [20, 30])
    [26, 42]
    """
    return list(map(add3, X, Y, Z))
def sub_seq(X, Y):
    """Result of subtracting corresponding items of Y from X.
    >>> sub_seq([10, 15, 20, 25], [1, 2, 3, 4])
    [9, 13, 17, 21]
    """
    return list(map(sub, X, Y))

sample1 = [
    [0,0,0,0,0,0,0,0,],
    [0,0,1,1,1,0,0,0,],
    [0,0,1,1,1,0,0,0,],
    [0,0,1,0,1,0,0,0,],
    [0,0,0,0,0,0,0,0,],
    [0,0,1,0,0,1,1,0,],
    [0,0,0,0,0,1,1,0,],
    [0,0,0,0,0,0,0,0,],
]

small_sample1 = [
    [1, 1],
    [1, 0]
]

def neighbors(board):
    """A list of list of integers, NC, such that NC[i][j]
    is the number of occupied neighbor cells of board[i][j].

    To break this down, consider a small example:
    >>> x0 = with_border(small_sample1)
    >>> x0
    [[0, 0, 0, 0], [0, 1, 1, 0], [0, 1, 0, 0], [0, 0, 0, 0]]
    >>> x1 = list(map(add3_seq, x0, x0[1:], x0[2:]))
    >>> x1
    [[0, 2, 1, 0], [0, 2, 1, 0]]
    >>> x2 = list(map(lambda row: list(map(add3, row, row[1:], row[2:])), x1))
    >>> x2
    [[3, 3], [3, 3]]
    >>> list(map(sub_seq, x2, small_sample1))
    [[2, 2], [2, 3]]
    """

    board1 = with_border(board)
    return list(map(sub_seq,
                    map(lambda row: map(add3, row, row[1:], row[2:]),
                        map(add3_seq,
                            board1,
                            board1[1:],
                            board1[2:])),
                    board))

# An alternative that uses comprehensions:

def neighbors2(board):
   """A list of list of integers, NC, such that NC[i][j]
   is the number of occupied neighbor cells of board[i][j]."""

   m = len(board)
   n = len(board[0])
   B = with_border(board)
   return [ [ B[i-1][j-1]+B[i-1][j]+B[i-1][j+1]
              +B[i][j-1]+B[i][j+1]
              +B[i+1][j-1]+B[i+1][j]+B[i+1][j+1]
              for j in range(1, n+1) ] 
            for i in range(1, m+1)  ]



@main
def run():
    interact()

