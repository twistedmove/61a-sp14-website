"""Homework 12 -- Vote for your favorite Project 4 Contest entry."""

def featherweight():
    """Return the integer number of your favorite featherweight entry.

    >>> isinstance(featherweight(), int)
    True
    >>> 0 <= featherweight() <= 37
    True
    """
    return -1  # Change to a positive integer

def heavyweight():
    """Return the integer number of your favorite heavyweight entry.

    >>> isinstance(heavyweight(), int)
    True
    >>> 38 <= heavyweight() <= 49
    True
    """
    return -1  # Change to a positive integer

# These lines will be used to tally your vote.  Please do not change them.
print('Feather', featherweight())
print('Heavy', heavyweight())
