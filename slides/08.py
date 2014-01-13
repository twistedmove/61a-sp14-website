# Ordering

def cascade(n):
    """Print a cascade of prefixes of n.

    >>> cascade(1234)
    1234
    123
    12
    1
    12
    123
    1234
    """
    if n < 10:
        print(n)
    else:
        print(n)
        cascade(n//10)
        print(n)

def cascade2(n):
    """Print a cascade of prefixes of n."""
    print(n)
    if n >= 10:
        cascade(n//10)
        print(n)

# Tree recursion

def fib(n):
    if n == 1:
        return 0
    elif n == 2:
        return 1
    else:
        return fib(n-2) + fib(n-1)

def count_partitions(n, m):
    if n == 0:
        return 1
    elif n < 0:
        return 0
    elif m  == 0:
        return 0
    else:
        with_m = count_partitions(n-m, m)
        without_m = count_partitions(n, m-1)
        return with_m + without_m

def ways_to_score_at_least(k, n):
    """How many ways to score k points in n rolls.

    >>> ways_to_score_at_least(3, 1)
    4
    >>> ways_to_score_at_least(7, 2)
    19
    >>> ways_to_score_at_least(9, 2)
    10
    >>> ways_to_score_at_least(10, 5)
    3125
    """
    if k <= 0:
        return pow(5, n)
    elif n == 0:
        return 0
    else:
        total, d = 0, 2
        while d <= 6:
            total, d = total + ways_to_score_at_least(k-d, n-1), d + 1
        return total

# A sampled version using hog.py
#
# >>> def roll_more_than(k, n):
# ...     if roll_dice(n) >= k:
# ...             return 1
# ...     else:
# ...             return 0
# ...
# >>> avg = make_averaged(roll_more_than)

