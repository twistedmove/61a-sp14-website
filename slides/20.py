# Implementing generic string functions

def repr(x):
    return type(x).__repr__(x)

def str(x):
    t = type(x)
    if hasattr(t, '__str__'):
        return t.__str__(x)
    else:
        return user_repr(x)

class Bear:
    "A bear."

oski = Bear()
Bear.__repr__ = lambda self: 'Bear()'
oski.__repr__ = lambda: 'oski'
Bear.__str__ = lambda self: 'Grr'
oski.__str__ = lambda: 'Go Bears'

# Rational numbers

class Rational:
    """A mutable fraction.

    >>> f = Rational(3, 5)
    >>> f
    Rational(3, 5)
    >>> print(f)
    3/5
    >>> f.float_value
    0.6
    >>> f.numer = 4
    >>> f.float_value
    0.8
    >>> f.denom -= 3
    >>> f.float_value
    2.0
    """

    def __init__(self, numer, denom):
        self.numer = numer
        self.denom = denom

    def __repr__(self):
        return 'Rational({0}, {1})'.format(self.numer, self.denom)

    def __str__(self):
        return '{0}/{1}'.format(self.numer, self.denom)

    @property
    def float_value(self):
        return self.numer/self.denom

# Complex numbers

from math import atan2, sin, cos, pi

def add_complex(z1, z2):
    """Return a complex number z1 + z2"""
    return ComplexRI(z1.real + z2.real, z1.imag + z2.imag)

def mul_complex(z1, z2):
    """Return a complex number z1 * z2"""
    return ComplexMA(z1.magnitude * z2.magnitude, z1.angle + z2.angle)


class ComplexRI:
    """A rectangular representation of a complex number.

    >>> from math import pi
    >>> add_complex(ComplexRI(1, 2), ComplexMA(2, pi/2))
    ComplexRI(1.0000000000000002, 4.0)
    >>> mul_complex(ComplexRI(0, 1), ComplexRI(0, 1))
    ComplexMA(1.0, 3.141592653589793)
    >>> ComplexRI(1, 2) + ComplexMA(2, 0)
    ComplexRI(3.0, 2.0)
    >>> ComplexRI(0, 1) * ComplexRI(0, 1)
    ComplexMA(1.0, 3.141592653589793)
    """

    def __init__(self, real, imag):
        self.real = real
        self.imag = imag

    @property
    def magnitude(self):
        return (self.real ** 2 + self.imag ** 2) ** 0.5

    @property
    def angle(self):
        return atan2(self.imag, self.real)

    def __repr__(self):
        return 'ComplexRI({0}, {1})'.format(self.real,
                                            self.imag)

    def __add__(self, other):
        return add_complex(self, other)

    def __mul__(self, other):
        return mul_complex(self, other)


class ComplexMA:
    """A polar representation of a complex number."""

    def __init__(self, magnitude, angle):
        self.magnitude = magnitude
        self.angle = angle

    @property
    def real(self):
        return self.magnitude * cos(self.angle)

    @property
    def imag(self):
        return self.magnitude * sin(self.angle)

    def __repr__(self):
        return 'ComplexMA({0}, {1})'.format(self.magnitude,
                                            self.angle)

    def __add__(self, other):
        return add_complex(self, other)

    def __mul__(self, other):
        return mul_complex(self, other)
