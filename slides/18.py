def desc_time(expr, setup="", number=1000):
    time = 1e6 * min(timeit.repeat(expr, setup, number=number)) / number
    return "{} loops, best of 3: {:.2g} usec per loop"\
          .format(number, int(time))

def find_first(L, p):
    """The index of the first item in list L that satisfies
    predicate function P, or -1 if none does."""
    for i, x in enumerate(L): # Yields (0, L[0]), (1, L[1]),...
        if p(x): return i
    return -1

def find_common(L0, L1):
    """Returns True iff L0 and L1 have an item in common."""
    for x in L0:
        for y in L1:
            if x == y: return True
    return False

def are_duplicates(L):
    for i, x in enumerate(L):
        for j, y in enumerate(L, i+1): # Starts at i+1
            if x == y: return True
    return False

