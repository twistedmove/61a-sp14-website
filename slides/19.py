def near(L, x, delta):
    """True iff X differs from some member of sequence L by no 
    more than DELTA."""
    for y in L:
        if abs(x-y) <= delta:
            return True
    return False

def is_unduplicated(L, pred):
    """True iff the first x in L such that pred(x) is not
    a duplicate. Also true if there is no x with pred(x)."""
    i = 0
    while i < len(L):
        x = L[i]
        i += 1
        if pred(x):
            while i < len(L):
                if x == L[i]:
                    return False
                i += 1
    return True

def is_substring(sub, seq):
    """True iff SUB[0], SUB[1], ... appear consecutively in sequence SEQ."""
    if len(sub) == 0 or sub == seq:
        return True
    elif len(sub) > len(seq):
        return False
    else:
        return is_substring(sub, seq[1:]) or is_substring(sub, seq[:-1])

def binary_search(L, x):
    """Return True iff X occurs in sorted list L."""
    low, high = 0, len(L)
    while low < high:
        m = (low + high) // 2
        if x < L[m]: high = m
        if x > L[m]: low = m+1
        else:        return True
    return False

