from ucb import main, interact

import time
def make_dice(sides = 6, seed = None):
    """A new 'sides'-sided die that yields numbers between 1 and
    'sides' when called.  'seed' controls the sequence of values.
    If it is defaulted, the system chooses a non-deterministic value."""

    if seed == None:
         seed = int(time.time() * 100000)
    a, c, m = 25214903917, 11, 2**48  # From Java

    def die():
        nonlocal seed
        seed = (a*seed + c) % m
        return seed % sides + 1
    return die

@main
def prog():
    interact()

