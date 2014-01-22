class Range:
    class _RangeIterator:
        def __init__(self, aRange):
            self.range = aRange
            self.i = self.range.low

        def __next__(self):
            if self.range.step < 0 and self.i <= self.range.high or \
               self.range.step >= 0 and self.i >= self.range.high:
                raise StopIteration
            else:
                v = self.i
                self.i += self.range.step
                return v

        def __iter__(self):
            return self

    def __init__(self, *bounds):
        if len(bounds) == 1:
            self.low, self.high, self.step = 0, bounds[0], 1
        elif len(bounds) == 2:
            self.low, self.high, self.step = bounds[0], bounds[1], 1
        elif len(bounds) == 3:
            self.low, self.high, self.step = bounds
        else:
            raise TypeError("too many arguments to Range")

    def __iter__(self):
        return Range._RangeIterator(self)

    
            
