# Information hiding

class FibIter:
    """An iterator over Fibonacci numbers.

    >>> fibs = FibIter()
    >>> [next(fibs) for _ in range(10)]
    [0, 1, 1, 2, 3, 5, 8, 13, 21, 34]
    """
    def __init__(self):
        self._next = 0
        self._addend = 1

    def __next__(self):
        result = self._next
        self._addend, self._next = self._next, self._addend + self._next
        return result

def fib_generator():
    """A generator function for Fibonacci numbers.

    >>> fibs = fib_generator()
    >>> [next(fibs) for _ in range(10)]
    [0, 1, 1, 2, 3, 5, 8, 13, 21, 34]
    """
    yield 0
    previous, current = 0, 1
    while True:
        yield current
        previous, current = current, previous + current

class empty_iterator:
    """An iterator over no values."""
    def __next__(self):
        raise StopIteration
empty_iterator = empty_iterator()


# Streams

class Stream:
    """A lazily computed recursive list.

    >>> s = Stream(1, lambda: Stream(6-2, lambda: Stream(9)))
    >>> s.first
    1
    >>> s.rest.first
    4
    >>> s.rest
    Stream(4, <...>)
    >>> s.rest.rest.first
    9
    """

    class empty:
        def __repr__(self):
            return 'Stream.empty'

    empty = empty()

    def __init__(self, first, compute_rest=lambda: Stream.empty):
        assert callable(compute_rest), 'compute_rest must be callable.'
        self.first = first
        self._compute_rest = compute_rest

    @property
    def rest(self):
        """Return the rest of the stream, computing it if necessary."""
        if self._compute_rest is not None:
            self._rest = self._compute_rest()
            self._compute_rest = None
        return self._rest

    def __repr__(self):
        return 'Stream({0}, <...>)'.format(repr(self.first))

def first_k(s, k):
    """Return up to k elements of stream s as a list.

    >>> s = Stream(1, lambda: Stream(4, lambda: Stream(9)))
    >>> first_k(s, 2)
    [1, 4]
    >>> first_k(s, 5)
    [1, 4, 9]
    """
    elements = []
    while s is not Stream.empty and k > 0:
        elements.append(s.first)
        s, k = s.rest, k-1
    return elements

def integer_stream(first=1):
    """Return a stream of consecutive integers, starting with first.

    >>> s = integer_stream(3)
    >>> s
    Stream(3, <...>)
    >>> m = map_stream(lambda x: x*x, s)
    >>> first_k(m, 5)
    [9, 16, 25, 36, 49]
    """
    def compute_rest():
        return integer_stream(first+1)
    return Stream(first, compute_rest)

def square_stream(s):
    """Return a stream of the squares of the elements in stream s.

    >>> s = integer_stream(1)
    >>> first_k(square_stream(s), 5)
    [1, 4, 9, 16, 25]
    """
    first_squared = s.first * s.first
    return Stream(first_squared, lambda: square_stream(s.rest))

def add_streams(s1, s2):
    """Return the sum of two streams as a stream.

    >>> s = integer_stream(3)
    >>> t = integer_stream(6)
    >>> st = add_streams(s, t) # 3+6, 4+7, 5+8, ...
    >>> first_k(st, 5)
    [9, 11, 13, 15, 17]

    >>> twos = Stream(2, lambda: twos)
    >>> evens = Stream(2, lambda: add_streams(twos, evens))
    >>> first_k(evens, 8)
    [2, 4, 6, 8, 10, 12, 14, 16]

    >>> ints = integer_stream(1)
    >>> odds = add_streams(ints, ints.rest) # 1+2, 2+3, 3+4, ...
    >>> squares = Stream(1, lambda: add_streams(odds, squares))
    >>> first_k(squares, 5)
    [1, 4, 9, 16, 25]

    >>> fib = Stream(0, lambda: Stream(1, lambda: add_streams(fib, fib.rest)))
    >>> first_k(fib, 8)
    [0, 1, 1, 2, 3, 5, 8, 13]
    """
    first = s1.first + s2.first
    def compute_rest():
        return add_streams(s1.rest, s2.rest)
    return Stream(first, compute_rest)

def map_stream(fn, s):
    """Map a function fn over the elements of a stream s.

    >>> s = integer_stream(3)
    >>> s
    Stream(3, <...>)
    >>> m = map_stream(lambda x: x*x, s)
    >>> first_k(m, 5)
    [9, 16, 25, 36, 49]
    """
    if s is Stream.empty:
        return s
    def compute_rest():
        return map_stream(fn, s.rest)
    return Stream(fn(s.first), compute_rest)

def filter_stream(fn, s):
    """Filter stream s with predicate function fn."""
    if s is Stream.empty:
        return s
    def compute_rest():
        return filter_stream(fn, s.rest)
    if fn(s.first):
        return Stream(s.first, compute_rest)
    else:
        return compute_rest()

def primes(positives):
    """Return a stream of primes, given a stream of positive integers.

    >>> positives = integer_stream(2)
    >>> first_k(primes(positives), 8)
    [2, 3, 5, 7, 11, 13, 17, 19]
    """
    def not_divisible(x):
        return x % positives.first != 0
    def compute_rest():
        return primes(filter_stream(not_divisible, positives.rest))
    return Stream(positives.first, compute_rest)
