def iter_solve(guess, done, update, iteration_limit=32):
    """Return the result of repeatedly applying UPDATE, 
    starting at GUESS, until DONE yields a true value 
    when applied to the result.  Causes error if more than
    ITERATION_LIMIT applications of UPDATE are necessary."""

    while not done(guess):
        if iteration_limit <= 0:
            raise ValueError("failed to converge")
        guess, iteration_limit = update(guess), iteration_limit-1
    return guess

def newton_solve(func, deriv, start, tolerance):
    """Return x such that |FUNC(x)| < TOLERANCE, given initial
    estimate START and assuming DERIV is the derivatative of FUNC."""
    def close_enough(x):
        return abs(func(x)) < tolerance
    def newton_update(x):
        return x - func(x) / deriv(x)

    return iter_solve(start, close_enough, newton_update)

def square_root(a):
     return newton_solve(lambda x: x*x - a, lambda x: 2 * x, 
                         a/2, 1e-5)

def logarithm(a, base = 2):
     return newton_solve(lambda x: base**x - a, 
                         lambda x: x * base**(x-1),
                         1, 1e-5)


def find_root(func, start=1, tolerance=1e-5):
    def approx_deriv(f, delta = 1e-5):
        return lambda x: (func(x + delta) - func(x)) / delta
    return newton_solve(func, approx_deriv(func), start, tolerance)

def iter_solve2(guess, done, update, state = None):
    """Return the result of repeatedly applying UPDATE, 
    starting at GUESS, until DONE yields a true value 
    when applied to the result.  Besides a guess, UPDATE 
    also takes and returns a state value, also passed to
    DONE."""
    while not done(guess, state):
        guess, state = update(guess, state)
    return guess


def secant_solve(func, start0, start1, tolerance):
    def close_enough(x, state):
        return abs(func(x)) < tolerance
    def secant_update(xk, xk1):
        return xk - func(xk) * (xk - xk1) / (func(xk) - func(xk1)), xk
    return iter_solve2(start1, close_enough, secant_update, start0)

def square_root2(a):
     return secant_solve(lambda x: x*x - a, a, a/2, 1e-5)

def logarithm2(a, base = 2):
     return secant_solve(lambda x: base**x - a, 0.5, 1, 1e-5)


