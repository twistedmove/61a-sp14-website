"""Starter file for rlists lab"""

###################
# RECURSIVE LISTS #
###################

# rlist abstraction
empty_rlist = None

def rlist(first, rest=empty_rlist):
    return (first, rest)

def first(rlist):
    return rlist[0]

def rest(rlist):
    return rlist[1]

def tup_to_rlist(tup):
    """Converts a tuple to an rlist.

    >>> tup = (1, 2, 3, 4)
    >>> r = tup_to_rlist(tup)
    >>> first(r)
    1
    >>> first(rest(rest(r)))
    3
    >>> r = tup_to_rlist(())
    >>> r is empty_rlist
    True
    """
    "*** YOUR CODE HERE ***"

def len_rlist(lst):
    """Returns the length of the rlist.

    >>> lst = tup_to_rlist((1, 2, 3, 4))
    >>> len_rlist(lst)
    4
    >>> lst = tup_to_rlist(())
    >>> len_rlist(lst)
    0
    """
    "*** YOUR CODE HERE ***"

def getitem_rlist(i, lst):
    """Returns the ith item in the rlist. If the index exceeds the
    length of the rlist, return 'Error'.

    >>> lst = tup_to_rlist((1, 2, 3, 4))
    >>> getitem_rlist(0, lst)
    1
    >>> getitem_rlist(3, lst)
    4
    >>> getitem_rlist(4, lst)
    'Error'
    """
    "*** YOUR CODE HERE ***"


def insert_rlist(r, item, index):
    """ Returns an rlist matching r but with the given item
    inserted at the specified index. If the index is greater than
    the current length, the item is appended to the end of the
    list.

    >>> r = rlist(1, rlist(2, rlist(3)))
    >>> new = insert_rlist(r, 9001, 1)
    >>> first(r)
    1
    >>> first(rest(r))  # second element
    9001
    """
    "*** Your code here. ***"

