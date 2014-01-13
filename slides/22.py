# Recursive lists with cycles.

class Rlist:
    """A recursive list consisting of a first element and the rest.

    >>> s = Rlist(1, Rlist(2, Rlist(3)))
    >>> s.first = 5
    >>> t = s.rest
    >>> t.rest = s
    >>> s.first
    5
    >>> s.rest.rest.rest.rest.rest.first
    2
    """
    class EmptyList:
        def __len__(self):
            return 0
    empty = EmptyList()

    def __init__(self, first, rest=empty):
        assert type(rest) is Rlist or rest is Rlist.empty
        self.first = first
        self.rest = rest

s = Rlist(1, Rlist(2, Rlist(3)))

def rlist(first, rest=None):
    """Return a mutable recursive list represented as a function.

    >>> s = rlist(1, rlist(2, rlist(3)))
    >>> s('first=', 5)
    >>> t = s('rest')
    >>> t('rest=', s)
    >>> s('first')
    5
    >>> s('rest')('rest')('rest')('rest')('rest')('first')
    2
    """
    def dispatch(message, value=None):
        nonlocal first, rest
        if message == 'first':
            return first
        elif message == 'rest':
            return rest
        elif message == 'first=':
            first = value
        elif message == 'rest=':
            rest = value
        else:
            return 'Unknown message'
    return dispatch




