import sys
from math import sqrt

n = int(sys.argv[1]) if len(sys.argv) > 1 else 10

sin60 = sqrt(3) / 2

def make_triangle(x, y, s, n):
    """Draw an nth approximation to Sierpinski's gasket, with lower-left
    corner at (x,y), and size s x s.  Writes Postscript commands to the
    the standard output to do the drawing."""
    if n == 0:
        print("{0} {1} moveto {2} 0 rlineto -{3} {4} rlineto closepath fill" 
              .format(x, y, s, s/2, s*sin60))
    else:
        make_triangle(x, y, s/2, n - 1)
        make_triangle(x + s/2, y, s/2, n - 1)
        make_triangle(x + s/4, y + sin60*s/2, s/2, n-1)

def draw_gasket(n):
    print("%!")
    make_triangle(100, 100, 400, n)
    
def make_change(amount, coins = (50, 25, 10, 5, 1)):
    """A sequence of integers giving a number of each type of coin
    in COINS such that the value of the indicated numbers of coins
    will by exactly AMOUNT.  Assumes coins[-1] is 1.
    >>> tuple(make_change(81))
    (1, 1, 0, 1, 1)
    >>> tuple(make_change(47)
    (0, 1, 2, 0, 2)
    >>> tuple(make_change(47, (50, 25, 5, 1))
    (0, 1, 4, 2)
    """
    if len(coins) == 0:
        if amount != 0:
            raise ValueError("cannot change {0}".format(amount))
        return ()
    else:
        return (amount // coins[0],) \
               + make_change(amount%coins[0], coins[1:])
        
