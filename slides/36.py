######################################################
# Compute whether sqrt(51) - 4 < pi using generators #
######################################################

def sqrt(a):
    """Yield approximations that converge to the square root of a.

    >>> print_iterator(sqrt(51))
    [1, 26.0, 13.98076923076923, 8.81431859062533, 7.300179298823895, ...]
    """
    x = 1
    while True:
        yield x
        x = (x + a/x)/2

def pi():
    """Yield approximations that converge to pi.

    >>> print_iterator(sqrt(51))
    [1, 26.0, 13.98076923076923, 8.81431859062533, 7.300179298823895, ...]
    """
    total, k = 0, 1
    while True:
        yield total
        total += 8/((4*k-3)*(4*k-1))
        k += 1

def four():
    while True:
        yield 4

def subtract(x, y):
    while True:
        yield next(x)-next(y)

def print_iterator(iterator, k=5):
    elements = []
    for _ in range(k):
        elements.append(next(iterator))
    print(str(elements)[:-1] + ', ...]')

def less_than_0(s):
    """Return True if iterator s converges to a number less than 0.

    >>> a = subtract(sqrt(51), four())
    >>> less_than_0(subtract(a, pi()))
    True
    """
    current = next(s)
    while True:
        last, current = current, next(s)
        if last < 0 and current < last:
            return True

###################################################
# Compute whether sqrt(51) - 4 < pi using streams #
###################################################

def sqrt_stream(a, x=1):
    """Compute a stream of approximations to sqrt(a), starting with x.

    >>> sqrt_of_2_approximations = sqrt_stream(2)
    >>> first_k(sqrt_of_2_approximations, 5)
    [1, 1.5, 1.4166666666666665, 1.4142156862745097, 1.4142135623746899]
    """
    def compute_rest():
        next_x = (x + a/x)/2
        return sqrt_stream(a, next_x)
    return Stream(x, compute_rest)

def pi_stream(total=0, k=1):
    """Compute a stream of approximations to pi, starting at total.

    >>> first_k(pi_stream(), 5)
    [0, 2.6666666666666665, 2.895238095238095, 2.976046176046176, 3.017071817071817]
    """
    def compute_rest():
        term = 8/(4*k-3)/(4*k-1)
        return pi_stream(total+term, k+1)
    return Stream(total, compute_rest)

def subtract_streams(s1, s2):
    """Return the difference of two streams as a stream."""
    first = s1.first - s2.first
    def compute_rest():
        return
    return Stream(first, lambda: subtract_streams(s1.rest, s2.rest))

def stream_less_than_0(s):
    """Return True if stream s converges to a number less than 0.

    >>> pi = pi_stream()
    >>> fours = Stream(4, lambda: fours)
    >>> a = subtract_streams(sqrt_stream(51), fours)
    >>> stream_less_than_0(subtract_streams(a, pi))
    True
    """
    while True:
        if s.first < 0 and s.rest.first < s.first:
            return True
        s = s.rest

########################
# Streams (Lecture 30) #
########################

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
