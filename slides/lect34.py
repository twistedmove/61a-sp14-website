# Iterators

class Letters(object):

    def __init__(self, start, finish):
        self.current = start
        self.finish = finish

    def __next__(self):
        if self.current > self.finish:
            raise StopIteration
        result = self.current
        self.current = chr(ord(result)+1)
        return result

    def __iter__(self):
        return self

def for_each(sequence, function):
    """Apply function to each element of a sequence."""
    iterator = sequence.__iter__()
    try:
        while True :
            element = iterator.__next__()
            function(element)
    except StopIteration:
        pass
		
# Generator functions

def letters(start, finish):
    """Return a generator over letters."""
    current = start
    while current <= finish:
        yield current
        current = chr(ord(current)+1)

# Streams

class Stream(object):
    """A lazily computed recursive list."""

    def __init__(self, first, compute_rest, empty=False):
        self.first = first
        self._compute_rest = compute_rest
        self.empty = empty
        self._rest = None
        self._computed = False

    @property
    def rest(self):
        assert not self.empty, 'Empty streams have no rest.'
        if not self._computed:
            self._rest = self._compute_rest()
            self._computed = True
        return self._rest

    def __str__(self):
        if self.empty:
            return '<empty stream>'
        return '[{0}, ...]'.format(self.first)

empty_stream = Stream(None, None, True)

def make_integer_stream(first=1):
    """Return an infinite stream of increasing integers.

    >>> from operator import add
    >>> reduce_stream(add, truncate_stream(make_integer_stream(1), 10), 0)
    55
    """
    def compute_rest():
        return make_integer_stream(first+1)
    return Stream(first, compute_rest)

# Stream manipulation

def map_stream(fn, s):
    """Return a stream of the values of fn applied to the elements of stream s.

    >>> s = make_integer_stream(3)
    >>> stream_to_list(truncate_stream(map_stream(lambda x: x*x, s), 4))
    [9, 16, 25, 36]
    """
    if s.empty:
        return s
    def compute_rest():
        return map_stream(fn, s.rest)
    return Stream(fn(s.first), compute_rest)

def filter_stream(fn, s):
    """Return a stream of the elements of s for which fn is true."""
    if s.empty:
        return s
    def compute_rest():
        return filter_stream(fn, s.rest)
    if fn(s.first):
        return Stream(s.first, compute_rest)
    return compute_rest()

def reduce_stream(fn, s, n):
    """Accumulate the elements of s using two-argument fn, starting with n."""
    if s.empty:
        return n
    return reduce_stream(fn, s.rest, fn(n, s.first))

def truncate_stream(s, k):
    """Return a stream over the first k elements of stream s."""
    if s.empty or k == 0:
        return empty_stream
    def compute_rest():
        return truncate_stream(s.rest, k-1)
    return Stream(s.first, compute_rest)

def stream_to_list(s):
    """Return a list containing the elements of stream s."""
    r = []
    while not s.empty:
        r.append(s.first)
        s = s.rest
    return r

def combine_streams(f, s0, s1):
    """Return a stream of the elements of S0 and S1 combined in pairs with
    two-argument function F."""
    def compute_rest():
        return combine_streams(f, s0.rest, s1.rest)
    if s0.empty:
        return s0
    elif s1.empty:
        return s1
    else:
        return Stream(f(s0.first, s1.first), compute_rest)

# Iterators and streams

def iterator_to_stream(iterator):
    """Return a stream over the elements of an iterator."""
    def compute_rest():
        try:
            first = iterator.__next__()
            return Stream(first, compute_rest)
        except:
            return empty_stream
    return compute_rest()
            
def positives():
    """Return a generator over positive integers."""
    i = 1
    while True:
        yield i
        i += 1

# Streams example

def primes(pos_stream):
    """Return a stream of primes.
    
    pos_stream -- a stream of positive integers, starting with 2.

    >>> p1 = primes(make_integer_stream(2))
    >>> stream_to_list(truncate_stream(p1, 7))
    [2, 3, 5, 7, 11, 13, 17]
    >>> p2 = primes(iterator_to_stream(positives()).rest)
    >>> stream_to_list(truncate_stream(p2, 7)) 
    [2, 3, 5, 7, 11, 13, 17]
    """
    def not_divisible(x):
        return x % pos_stream.first != 0
    def compute_rest():
        return primes(filter_stream(not_divisible, pos_stream.rest))
    return Stream(pos_stream.first, compute_rest)
