from operator import *
def reduce(f, seq, init):
    """If SEQ is a sequence of length n>=0, returns sn, where
    s0 = INIT, s1=F(s0, SEQ[0]), s2=F(s1, SEQ[1]), ...
    >>> L = (2, 3, 4)
    >>> reduce(add, L, 0)
    9
    >>> reduce(mul, L, 1)
    24
    >>> reduce(lambda x, y: rlist(y, x), L, empty_rlist)
    (4, (3, (2, None)))
    """
    result = init
    for p in seq:
        result = f(result, p)
    return result


def map(f, seq):
    """Assuming SEQ is the sequence containing s1, s2, ..., sn, 
    returns the tuple (F(s1), F(s2), ..., F(sn))."""
    result = ()
    for p in seq:
        result = result + (f(p), )
    return result

def filter(pred, seq):
    """Assuming SEQ is the sequence containing s1, s2, ..., sn, 
    returns tuple containing only those si for which PRED(si) is true."""
    result = ()
    for p in seq:
        result = result + (p,) if pred(p) else result
    return result

# Or...
def filter(pred, seq):
    return (x for x in seq if pred(x))

def partition(L, x):
    """Returns result of rearranging the elements of L so that 
    all items < X appear before all items >= X, 
    and all are otherwise in their original order.
    >>> L = (0, 9, 6, 2, 5, 11, 1)
    >>> partition(L, 5)
    (0, 2, 1, 9, 6, 5, 11)
    """
    return tuple((y in L if y < x)) + tuple((y in L if y >= x))

def collapse_runs(L):
    """Return result of removing the second and subsequent consecutive
    duplicates of values in L,
    >>> x = (1, 2, 2, 1, 1, 1, 2, 0, 0)
    >>> collapse_runs(x)
    (1, 2, 1, 2, 0)
    """
    
    return tuple( (L[k] for k in range(len(L)) if k==0 or L[k-1]!=L[k]) )
