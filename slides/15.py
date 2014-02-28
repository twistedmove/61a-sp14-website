class Account:  # Type name                   
    _total_deposits = 0      # Define/initialize a class attribute

    # constructor method    
    def __init__(self, initial_balance):      
        self._balance = initial_balance      
        Account._total_deposits += initial_balance # Use the class name                                              
    def balance(self): # instance method
        return self._balance # instance~variable                
                                              
    def deposit(self, amount):                
        if amount < 0:
            raise ValueError("negative deposit")
        self._balance += amount
        Account._total_deposits += amount

    def withdraw(self, amount):
        if 0 <= amount <= self.__balance:
            self._balance -= amount 
        else: raise ValueError("bad withdrawal")
   
    @staticmethod
    def total_deposits():     # Define a class method.
        return Account._total_deposits

"""
>>> mine = Account(1000)
>>> mine.deposit(100)   
>>> mine.balance()      
1100                    
>>> mine.withdraw(200)  
>>> mine.balance()      
900                     
>>> acct1 = Account(1000)
>>> acct2 = Account(10000)
>>> acct1.deposit(300)
>>> Account.total_deposits()
11300
>>> acct1.total_deposits()
11300
"""

class Polygon:
    def is_simple(self):
        """True iff I am simple (non-intersecting)."""
    def area(self): ...
    def bbox(self):
        """(xlow, ylow, xhigh, yhigh) of bounding rectangle."""
    def num_sides(self): ...
    def vertices(self):
        """My vertices, ordered clockwise, as a sequence 
        of (x, y) pairs."""
    def describe(self):
        """A string describing me."""

class Polygon:
    def is_simple(self): raise NotImplemented
    def area(self): raise NotImplemented
    def vertices(self): raise NotImplemented
    def bbox(self):
        V = self.vertices()
        xlow, ylow =  xhigh, yhigh = V[0]
        for x, y in V[1:]: 
            xlow, ylow = min(x, xlow), min(y, ylow), 
            xhigh, yhigh = max(x, xhigh), max(y, yhigh), 
        return xlow, ylow, xhigh, yhigh
    def num_sides(self): return len(self.vertices())
    def describe(self):
        return "A polygon with vertices {0}".format(self.vertices())


class SimplePolygon(Polygon):
    def is_simple(self): return True
    def area(self):
        a = 0.0
        V = self.vertices()
        for i in range(len(V)-1):
            a += V[i][0] * V[i+1][1] - V[i+1][0]*V[i][1]
        return -0.5 * a 

class Square(SimplePolygon):
    def __init__(self, xll, yll, side):
        """A square with lower-left corner at (xll,yll) and
        given length on a side."""
        self._x = xll
        self._y = yll
        self._s = side
    def vertices(self):
        x0, y0, s = self._x, self._y, self._s
        return ((x0, y0), (x0, y0+s), (x0+s, y0+s), 
                (x0+s, y0), (x0, y0))
    def describe(self):
        return "A {0}x{0} square with lower-left corner ({1},{2})" \
               .format(self._s, self._x, self._y)

