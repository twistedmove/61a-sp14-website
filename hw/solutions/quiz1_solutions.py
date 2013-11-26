# Name:
# Email:

# Q1.

def triangular(x, y, z):
    """Return whether x, y, and z are triangular.

    >>> triangular(3, 4, 5)
    True
    >>> triangular(3, 14, 5) # 14 is greater than 3 + 5
    False
    >>> triangular(7.5, 3.5, 4) # 7.5 is equal to 3.5 + 4
    False
    >>> result = triangular(5, 4, 3) # Return, don't print
    >>> result
    True
    >>> triangles = [(1, 2, 2), (2, 1, 2), (2, 2, 1), (2, 2, 2), (4, 3, 5),
    ... (3, 5, 4), (5, 3, 4), (4, 5, 3), (5, 4, 3)]
    >>> [triangular(*t) for t in triangles].count(False)
    0
    >>> lines = [(1, 2, 3), (2, 1, 3), (1, 3, 2), (3, 1, 2), (2, 3, 1),
    ... (3, 2, 1)]
    >>> [triangular(*t) for t in lines].count(True)
    0
    >>> other = [(0.1, 0.1, 1), (0.1, 1, 0.1), (1, 0.1, 0.1)]
    >>> [triangular(*t) for t in other].count(True)
    0
    """
    return x + y + z > 2 * max(x, y, z)

# Q2.

def next_square(x):
    """Return the smallest perfect square greater than x.

    >>> next_square(10)
    16
    >>> next_square(39)
    49
    >>> next_square(100)
    121
    >>> result = next_square(2) # Return, don't print
    >>> result
    4
    >>> cases = [(1, 4), (2, 4), (3, 4), (4, 9), (8, 9), (9, 16), (15, 16),
    ... (16, 25), (24, 25), (25, 36), (26, 36)]
    >>> [next_square(s) == t for s, t in cases].count(False)
    0
    """
    k = 1
    while k * k <= x:
        k = k + 1
    return k * k

# Q3.

def digit_span(x):
    """Return the difference between x's largest and smallest digits.

    >>> digit_span(2013) # 3 - 0 = 3
    3
    >>> digit_span(75) # 7 - 5 = 2
    2
    >>> digit_span(2345678765432) # 8 - 2 = 6
    6
    >>> result = digit_span(6473465) # Return, don't print
    >>> result
    4
    >>> cases = [(1084, 8), (3105, 5), (7000, 7), (174, 6), (714, 6),
    ... (147, 6), (121, 1), (33553355335544664466446644, 3)]
    >>> [digit_span(s) == t for s, t in cases].count(False)
    0
    """
    largest, smallest = x % 10, x % 10
    x = x // 10
    while x > 0:
        largest = max(largest, x % 10)
        smallest = min(smallest, x % 10)
        x = x // 10
    return largest - smallest

