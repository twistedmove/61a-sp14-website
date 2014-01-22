def frequencies(L):
    freq = {}
    for w in L:
        freq[w] = freq.get(w, 0) + 1
    return freq

