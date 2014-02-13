# Rational arithmetic

def add_rational(x, y):
    """Add rational numbers x and y."""
    nx, dx = numer(x), denom(x)
    ny, dy = numer(y), denom(y)
    return make_rat(nx * dy + ny * dx, dx * dy)

def mul_rational(x, y):
    """Multiply rational numbers x and y."""
    return make_rat(numer(x) * numer(y), denom(x) * denom(y))

def equal_rational(x, y):
    """Return whether rational numbers x and y are equal."""
    return numer(x) * denom(y) == numer(y) * denom(x)

# Constructor and selectors

def make_rat(n, d):
    """Construct a rational number x that represents n/d."""
    return (n, d)

def numer(r):
    """Return the numerator of rational number R."""
    return r[0]

def denom(r):
    """Return the denominator of rational number R."""
    return r[1]


# String conversion

def rational_to_string(x):
    """Return a string 'n/d' for numerator n and denominator d."""
    return '{0}/{1}'.format(numer(x), denom(x))


# Improved constructor

from fractions import gcd
def make_rat(n, d):
    """Construct a rational number x that represents n/d in lowest terms."""
    g = gcd(n, d)
    return (n//g, d//g)


# Functional pair

def pair(x, y):
    """Return a functional pair."""
    def dispatch(m):
        if m == 0:
            return x
        elif m == 1:
            return y
    return dispatch

def getitem_pair(p, i):
    """Return the element at index i of pair p."""
    return p(i)

# Using functional pairs:
def make_rat(n, d):
    g = gcd(n, d)
    return pair(n//g, d//g)

def numer(r):
    """Return the numerator of rational number R."""
    return r(0)

def denom(r):
    """Return the denominator of rational number R."""
    return r(1)

