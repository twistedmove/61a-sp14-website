class Account:
    
    __total_deposits = 0 

    def __init__(self, initial_balance):      
        if initial_balance <= 0:
            raise ValueError("insufficient starting balance")
        self.__balance = initial_balance      
        Account.__total_deposits += initial_balance

    def balance(self):
        return self.__balance
                                              
    def deposit(self, amount):
        if amount < 0:
            raise ValueError("negative deposit")
        self.__balance += amount
        Account.__total_deposits += amount

    def deposit(self, amount):                
        if amount < 0:
            raise ValueError("negative deposit")
        self.__balance += amount

    def withdraw(self, amount):
        if 0 <= amount <= self.__balance:
            self.__balance -= amount 
            Account.__total_deposits -= amount
        else: raise ValueError("bad withdrawal")

    @staticmethod
    def total_deposits():
        return Account.__total_deposits


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
        self.__x = xll
        self.__y = yll
        self.__s = side
    def vertices(self):
        x0, y0, s = self.__x, self.__y, self.__s
        return ((x0, y0), (x0, y0+s), (x0+s, y0+s), 
                (x0+s, y0), (x0, y0))
    def describe(self):
        return "A {0}x{0} square with lower-left corner ({1},{2})" \
               .format(self.__s, self.__x, self.__y)
