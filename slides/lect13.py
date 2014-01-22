from ucb import main, interact

from functools import reduce

def partition(L, x):
    """Rearrange the elements of L so that all items < 'x' appear
    before all items >= 'x', and all are otherwise in their original
    order.  Modifies and returns L.
    >>> L = [0, 9, 6, 2, 5, 11, 1]
    >>> partition(L, 5)
    [0, 2, 1, 9, 6, 5, 11]
    >>> L
    [0, 2, 1, 9, 6, 5, 11]
    """
    L[:] = list(filter(lambda y: y < x, L)) \
           + list(filter(lambda y: y >= x, L))
    return L

def collapse_runs(L):
    """Remove the second and subsequent consecutive duplicates of 
    values in L, modifying and returning L.
    >>> x = [1, 2, 1, 1, 1, 2, 0, 0]
    >>> collapse_runs(x)
    [1, 2, 1, 2, 0]
    >>> x
    [1, 2, 1, 2, 0]"""
    n = 1
    while n < len(L):
        if L[n] == L[n-1]:
            L[n-1:n] = []   # or del L[n-1]
        else:
            n += 1
    return L

# Here's another method that avoids repeatedly shifting pieces of the
# list.

def collapse_runs(L):
    """Remove the second and subsequent consecutive duplicates of 
    values in L, modifying and returning L.
    >>> x = [1, 2, 1, 1, 1, 2, 0, 0]
    >>> collapse_runs(x)
    [1, 2, 1, 2, 0]
    >>> x
    [1, 2, 1, 2, 0]"""
    n, k = 0, 1
    while k < len(L):
        if L[n] == L[k]:
            k += 1
        else:
            n, k, L[n] = n+1, k+1, L[k]
    # Remove the leftovers.  Practical note: shrinking a list from
    # the right is cheap.
    del L[n+1:]
    return L

