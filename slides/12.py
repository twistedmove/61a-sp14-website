# Sequence iteration

stairs = (1, 2, 3, 4, 5, 4, 3, 4, 5, 6, 7)

from operator import getitem

def count_while(s, value, getitem=getitem, len=len):
    """Count the number of occurrences of value in sequence s.

    >>> stairs.count(4)
    3
    >>> count_while(stairs, 4)
    3
    """
    total, index = 0, 0
    while index < len(s):
        if getitem(s, index) == value:
            total = total + 1
        index = index + 1
    return total

def count(s, value):
    """Count the number of occurrences of value in sequence s.

    >>> count(stairs, 4)
    3
    """
    total = 0
    for elem in s:
        if elem == value:
            total = total + 1
    return total

def count_same(pairs):
    """Count the number of pairs that contain the same value repeated.

    >>> pairs = ((1, 2), (2, 2), (2, 3), (4, 4))
    >>> count_same(pairs)
    2
    """
    same_count = 0
    for x, y in pairs:
        if x == y:
            same_count = same_count + 1
    return same_count

few = range(-2, 2)
many = range(-2, 50000000)

# List mutation

suits = ['coin', 'string', 'myriad']  # A list literal
suits.pop()             # Removes and returns the final element
suits.remove('string')  # Removes the first element that equals the argument
suits.append('cup')              # Add an element to the end
suits.extend(['sword', 'club'])  # Add all elements of a list to the end
suits[2] = 'spade'  # Replace an element
suits
suits[0:2] = ['heart', 'diamond']  # Replace a slice
[suit.upper() for suit in suits]
[suit[1:4] for suit in suits if len(suit) == 5]

# Dictionaries

numerals = {'I': 1.0, 'V': 5, 'X': 10}
numerals['X']
numerals['I'] = 1
numerals['L'] = 50
numerals
sum(numerals.values())
dict([(3, 9), (4, 16), (5, 25)])
numerals.get('A', 0)
numerals.get('V', 0)
{x: x*x for x in range(3,6)}

# {[1]: 2}
# {1: [2]}
# {([1], 2): 3}
# {tuple([1, 2]): 3}

# Identity and equality

def ident():
    suits = ['heart', 'diamond']
    s = suits
    t = list(suits)
    suits += ['spade', 'club']
    t[0] = suits
    print(t)
    suits.append('Joker')
    print(t)
    t[0].pop()
    print(s)
