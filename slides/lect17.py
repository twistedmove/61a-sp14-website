from fractions import gcd
from math import frexp, isnan, isinf, trunc

class rational:
    """Represents an immutable rational number."""

    def __init__(self, numer, denom = 1):
        """The rational number numer/denom.  numer may be a float, in which
        case denom must be 1."""
        if type(denom) is not int:
            raise TypeError("Denominator must be integral: {0}".format(denom))
        if denom == 0:
            raise ValueError("Denominator cannot be 0.")
        if type(numer) is not int:
            if denom != 1:
                raise TypeError("Numerator must be integral: {0}".format(numer))
            elif type(numer) is not float or isnan(numer) or isinf(numer):
                raise TypeError("Bad numerator: {0}".format(numer))
            else:
                numer, expon = frexp(numer)
                while trunc(numer) != numer:
                    numer *= 2
                    expon -= 1
                if expon > 0:
                    numer, denom = int(numer) * 2 ** expon, 1
                else:
                    numer, denom = int(numer), 2 ** -expon
        g = gcd(numer, denom)
        self.__numer, self.__denom = numer // g, denom // g

    @property
    def numer(self):
        """The value x such that x/y is my value in lowest terms.  Negative
        if I am negative."""
        return self.__numer

    @property
    def denom(self):
        """My denominator in lowest terms.  Always positive."""
        return self.__denom

    @staticmethod
    def _coerce(y):
        if type(y) is rational:
             return y
        else:
             return rational(y)
        
    def __str__(self):
        if self.denom == 1:
            return str(self.numer)
        else:
            return "{0}/{1}".format(self.numer, self.denom)
    def __repr__(self):
        if self.denom == 1:
            return "rational({0})".format(self.numer)
        else:
            return "rational({0},{1})".format(self.numer, self.denom)

    def __add__(self, y):
        y = rational._coerce(y)
        return rational(self.numer * y.denom + self.denom * y.numer,
                        self.denom * y.denom)
    def __radd__(self, y):
        return rational(y) + self

    def __sub__(self, y):
        y = rational._coerce(y)
        return rational(self.numer * y.denom - self.denom * y.numer,
                        self.denom * y.denom)
    def __rsub__(self, y):
        return rational(y) - self

    def __mul__(self, y):
        y = rational._coerce(y)
        return rational(self.numer * y.numer, self.denom * y.denom)
    def __rmul__(self, y):
        return self * rational(y)

    def __truediv__(self, y):
        y = rational._coerce(y)
        return rational(self.numer * y.denom, self.denom * y.numer)
    def __rtruediv__(self, y):
        return self / rational(y)

    def __pow__(self, y):
        if type(y) is not int:
            raise NotImplementedError
        return rational(self.numer**y, self.denom**y)

    def __bool__(self):
        return self.numer != 0

    def __lt__(self, y):
        y = rational._coerce(y)
        return self.numer*y.denom < self.denom*y.numer
    def __gt__(self, y):
        y = rational._coerce(y)
        return self.numer*y.denom > self.denom*y.numer
    def __le__(self, y):
        y = rational._coerce(y)
        return self.numer*y.denom <= self.denom*y.numer
    def __ge__(self, y):
        y = rational._coerce(y)
        return self.numer*y.denom >= self.denom*y.numer
    def __eq__(self, y):
        y = rational._coerce(y)
        return self.numer == y.numer and self.denom == y.denom
    def __ne__(self, y):
        y = rational._coerce(y)
        return self.numer != y.numer or self.denom != y.denom
    
    def __hash__(self):
        return self.numer * self.denom

