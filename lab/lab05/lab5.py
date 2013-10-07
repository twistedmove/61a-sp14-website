# Q1

def max_char(sentence):
    """Returns the character that appears the most number of times
    in sentence (a string).

    >>> max_char('see spot run')
    's'
    >>> max_char('mississippi')
    'i'
    """
    "*** YOUR CODE HERE ***"

# Q2

def max_word(sentence):
    """Returns the word that occurs the most number of times in
    sentence (a string).

    >>> max_word('To be or not to be')
    'to'
    """
    "*** YOUR CODE HERE ***"

# Q3

def deep_len(tup):
    """Calculates the length of a possibly nested tuple.

    >>> deep_len((1, 2, 3, 4))  # normal tuple
    4
    >>> deep_len((1, (2, 3), 4))
    4
    >>> deep_len((1, (2, (3, (4,)))))
    4
    >>> deep_len((1, (), 2))  # empty nested tuples don't count
    2
    """
    "*** YOUR CODE HERE ***"

# Q4

def merge(seq1, seq2):
    """Merges all elements (including duplicates) of seq1 and seq2
    in sorted order.

    >>> merge((1, 3, 5), (2, 4))
    (1, 2, 3, 4, 5)
    >>> merge((), (1, 2, 3))
    (1, 2, 3)
    """
    "*** YOUR CODE HERE ***"

# Q5

def mergesort(seq):
    """Mergesort algorithm.

    >>> mergesort((4, 2, 5, 2, 1))
    (1, 2, 2, 4, 5)
    >>> mergesort(())   # sorting an empty list
    ()
    >>> mergesort((1,))   # sorting a one-element list
    (1,)
    """
    "*** YOUR CODE HERE***"

# Q6

def map(fn, seq):
    """Applies fn onto each element in seq and returns a list.

    >>> map(lambda x: x*x, [1, 2, 3])
    [1, 4, 9]
    """
    "*** YOUR CODE HERE ***"

def filter(pred, seq):
    """Keeps elements in seq only if they satisfy pred.

    >>> filter(lambda x: x % 2 == 0, [1, 2, 3, 4])
    [2, 4]
    """
    "*** YOUR CODE HERE ***"

def reduce(combiner, seq):
    """Combines elements in seq using combiner.

    >>> reduce(lambda x, y: x + y, [1, 2, 3, 4])
    10
    >>> reduce(lambda x, y: x * y, (1, 2, 3))
    6
    >>> reduce(lambda x, y: x * y, [4])
    4
    """
    "*** YOUR CODE HERE ***"

# Q9

def make_fib():
    """Returns a function that returns the next Fibonacci number
    every time it is called.

    >>> fib = make_fib()
    >>> fib()
    0
    >>> fib()
    1
    >>> fib()
    1
    >>> fib()
    2
    >>> fib()
    3
    """
    "*** YOUR CODE HERE ***"

# Q10

def make_test_dice(seq):
    """Makes deterministic dice.

    >>> dice = make_test_dice([2, 6, 1])
    >>> dice()
    2
    >>> dice()
    6
    >>> dice()
    1
    >>> dice()
    2
    >>> other = make_test_dice([1])
    >>> other()
    1
    >>> dice()
    6
    """
    "*** YOUR CODE HERE ***"

# Q11

def make_bank(balance):
    """Returns a bank function with a starting balance. Supports
    withdrawals and deposits.

    >>> bank = make_bank(100)
    >>> bank('withdraw', 40)    # 100 - 40
    60
    >>> bank('deposit', 20)     # 60 + 20
    80
    >>> bank('withdraw', 90)    # 80 - 90; not enough money
    'Insufficient funds'
    """
    def bank(message, amount):
        "*** YOUR CODE HERE ***"
    return bank
