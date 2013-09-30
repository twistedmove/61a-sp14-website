"""
Code for CS61A lab 6, Fall 2013. 
"""

def build_successors_table(tokens):
    """Return a dictionary: keys are words; values are lists of successors.
    >>> text = ['We', 'came', 'to', 'investigate', ',', 'catch', 'bad', 'guys', 'and', 'to', 'eat', 'pie', '.']
    >>> table = build_successors_table(text)
    >>> table
    {'and': ['to'], 'We': ['came'], 'bad': ['guys'], 'pie': ['.'], ',': ['catch'], '.': ['We'], 'to': ['investigate', 'eat'], 'investigate': [','], 'catch': ['bad'], 'guys': ['and'], 'eat': ['pie'], 'came': ['to']}
    """
    table = {}
    prev = '.'
    for word in tokens:
        if prev in table:
            "**FILL THIS IN**"

        else:
            "**FILL THIS IN**"

        prev = word
    return table

def construct_sent(word, table):
    """Prints a random sentence starting with word, sampling from table"""
    import random
    result = ' '
    while word not in ['.', '!', '?']:
        "** FILL THIS IN**"

    return result + word

def shakespeare_tokens(path = 'shakespeare.txt', url = 'http://inst.eecs.berkeley.edu/~cs61a/fa11/shakespeare.txt'):
    """Return the words of Shakespeare's plays as a list"""
    import os
    from urllib.request import urlopen
    if os.path.exists(path):
        return open('shakespeare.txt', encoding='ascii').read().split()
    else:
        shakespeare = urlopen(url)
        return shakespeare.read().decode(encoding='ascii').split()
