from operator import add, mul
from functools import reduce

def values_demos():
    eval('200')
    eval('None')
    eval('1 + 2 +' + ' 3')
    curry = eval('lambda f: lambda x: lambda y: f(x, y)')
    curry(add)(3)(4)


def string_demos():
    'here' in "Where's Waldo?"
    'Mississippi'.count('i')
    'Mississippi'.count('issi')
    hex(ord('A'))
    print('\a')
    print('1\n2\n3')
    from unicodedata import lookup, name
    name('a')
    lookup('WHITE FROWNING FACE')
    lookup('SNOWMAN')
    lookup('SKULL AND CROSSBONES')
    lookup('THAI CHARACTER KHOMUT')
    frown = lookup('WHITE FROWNING FACE')
    len(frown)
    len(frown.encode('utf8'))
    dir('')
    "hello".capitalize()
    "hello".upper()

map_demo = map(print, (1,2,3,4))

def fib(k):
    """Compute the kth Fibonacci number.

    >>> fib(1)
    0
    >>> fib(2)
    1
    >>> fib(11)
    55
    """
    if k == 1:
        return 0
    previous, current = 0, 1  # current is the second Fibonacci number.
    for _ in range(2, k):
         previous, current = current, previous + current
    return current

def even(n):
    return n % 2 == 0

def sum_even_fibs(n):
    """Sum the first n even Fibonacci numbers.

    >>> sum_even_fibs(11)
    44
    """
    return sum(filter(even, map(fib, range(1, n+1))))

def first(s):
    return s[0]

def capitalized(s):
    return len(s) > 0 and s[0].isupper()

def acronym(name):
    """Return a tuple of the letters that form the acronym for name.

    >>> acronym('University of California Berkeley')
    ('U', 'C', 'B')
    """
    return tuple(map(first, filter(capitalized, name.split())))

def acronym_gen(name):
    """Return a tuple of the letters that form the acronym for name.

    >>> acronym_gen('University of California Berkeley')
    ('U', 'C', 'B')
    """
    return tuple(w[0] for w in name.split() if capitalized(w))

berkeley = 'University of California at Berkeley'
sum_even_fibs(11)
acronym(berkeley)

