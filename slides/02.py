# Imports
from math import pi
pi * 71 / 223
from math import sin
sin(pi/2)

# Assignment
radius = 10
2 * radius
area, circ = pi * radius * radius, 2 * pi * radius

# Function values
max
max(3, 4)
f = max
f(3, 4)
max = 7
f(3, 4)
f(3, max)
f = 2
# f(3, 4)

# User-defined functions
from operator import add, mul
add(2, 3)
mul(2, 3)

def square(x):
    return mul(x, x)

square(21)
square(add(2, 5))
square(square(3))

def sum_squares(x, y):
    return add(square(x), square(y))
sum_squares(3, 4)
sum_squares(5, 12)

# Name conflicts
def square(square):
    return mul(square, square)
square(4)

# Print
print('Go Bears')
print(-2)
print(1, 2, 3)
print(print(1), print(2))
