# Numeric expressions
2013
2000 + 13
1 + 1 + 1 + 2 * 3 * 5 * 67

# Call expressions
max(7.5, 9.5)
pow(100, 2)
pow(2, 100)
max(1, -2, 3, -4)
max(min(1, -2), min(pow(3, 5), -4))

# Importing and arithmetic with call expressions
from operator import add, mul
add(1, 2)
mul(3, 3)
mul(add(2, mul(4, 6)), add(3, 5))

from math import sqrt
sqrt(169)

# Objects
shakes = open('shakespeare.txt')
text = shakes.read().split()
len(text)
text.count('the')
text.count('thou')
text.count('forsooth')

# Sets
words = set(text)
len(words)
max(words)
max(words, key=len)

# Combinations and definitions
'draw'[::-1]
{w for w in words if w == w[::-1] and len(w)>4}
{w for w in words if w[::-1] in words and len(w) == 4}

def is_two_four_letter_words(w):
    return len(w)==8 and w[:4] in words and w[4:] in words

{w for w in words if is_two_four_letter_words(w)}
