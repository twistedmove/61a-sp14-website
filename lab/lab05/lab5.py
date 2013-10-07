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

# Q3

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

# Q6

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

# Q7

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
