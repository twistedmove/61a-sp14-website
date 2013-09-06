# Operators
from operator import add, mul
2 + 3
add(2, 3)
2 + 3 * 4 + 5
add(add(2, mul(3, 4)) , 5)
(2 + 3) * (4 + 5)
mul(add(2, 3), add(4, 5))

# Division
from operator import floordiv, truediv, mod
2013 / 10
2013 // 10
2013 % 10
floordiv(2013, 10)
truediv(2013, 10)
mod(2013, 10)

# Multiple return values
def divide_exact(n, d):
    return n // d, n % d
quotient, remainder = divide_exact(2013, 10)

# Dostrings, doctests, & default arguments
def divide_exact(n, d):
    """Return the quotient and remainder of dividing N by D.

    >>> quotient, remainder = divide_exact(2013, 10)
    >>> quotient
    201
    >>> remainder
    3
    """
    return floordiv(n, d), mod(n, d)

# Boolean values and operators
4 < 2
5 >= 5
True and False
True or False
not False

# Conditional expressions
def absolute_value(x):
    """Return the absolute value of X.

    >>> absolute_value(-3)
    3
    """
    if x < 0:
        return -x
    elif x == 0:
        return 0
    else:
        return x

# Summation via while
i, total = 0, 0
while i < 3:
    i = i + 1
    total = total + i
total

# Combinations
def choose(total, selection):
    """Return the number of ways to choose SELECTION items from TOTAL.

    choose(n, k) is typically defined in math as:  n! / (n-k)! / k!

    >>> choose(5, 2)
    10
    >>> choose(6, 3)
    20
    >>> choose(20, 6)
    38760
    """
    ways = 1
    selected = 0
    while selected < selection:
        selected = selected + 1
        ways, total = ways * total // selected, total - 1
    return ways

