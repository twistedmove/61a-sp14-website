class Range:
    def __init__(self, low, high):
        self._low = low
        self._high = high
    def __iter__(self):
        return RangeIter(self)

class RangeIter:
    def __init__(self, limits):
        self._bound = limits._high
        self._next = limits._low
        
    def __next__(self):
        if self._next >= self._bound:
            raise StopIteration
        else:
            self._next += 1
            return self._next-1

class rational:
    def __init__(self, numer=0, denom=1):
        if type(numer) is not int or type(denom) is not int:
            raise TypeError("numerator or denominator not int")
        if denom == 0:
            raise ZeroDivisionError("denominator is 0")
        d = gcd(numer,denom)
        self._numer, self._denom = numer // d, denom // d

    def __add__(self, y):
        y = rational._coerceToRational(y)
        return rational(self._numer * y._denom + self._denom * y._numer,
                        self._denom * y._denom)

    def _coerceToRational(y):
        if type(y) is rational:
            return y
        else:
            return rational(y)

    @property
    def numer(self):
        """My numerator in lowest terms."""
        return self._numer

    @property
    def denom(self):
        """My denominator in lowest terms."""
        return self._denom

"""
>>> two_thirds = rational(4, 6)
>>> two_thirds.numer
2
>>> two_thirds.denom
3
"""

class RestrictedInt:
    """If R is RestrictedInt(L, U), then assign  R.x = V first checks
    that L <= V <= U and then causes R.x to be V.
    >>> v = RestrictedInt(0, 10)
    >>> v.x
    0
    >>> v.x = 5
    >>> v.x
    5
    >>> v.x = 11
    Traceback (most recent call last):
        ...
    AssertionError
    """

    def __init__(self, low, high): 
        self._low, self._high, self._x = low, high, low
    def _getx(self): return self._x
    def _setx(self, val): 
        assert self._low <= val <= self._high
        self._x = val
    x = property(_getx, _setx)

