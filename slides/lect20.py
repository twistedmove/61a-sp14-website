from ucb import trace

# Memoized version of count_change 
def memoized_count_change(amount, coins = (50, 25, 10, 5, 1)):
    memo_table = {}
    def count_change(amount, coins): 
        if (amount, coins) not in memo_table:
            memo_table[amount,coins] \
               = full_count_change(amount, coins)
        return memo_table[amount,coins]
    def full_count_change(amount, coins):
        if amount == 0:
            return 1
        elif not coins:
            return 0
        elif amount >= coins[0]:
            return count_change(amount, coins[1:]) \
                   + count_change(amount-coins[0], coins)
        else:
            return count_change(amount, coins[1:])

    return count_change(amount,coins)

# Memoized version of count_change with full_count_change traced.
def traced_count_change(amount, coins = (50, 25, 10, 5, 1)):
    memo_table = {}
    def count_change(amount, coins): 
        if (amount, coins) not in memo_table:
            memo_table[amount,coins] \
               = full_count_change(amount, coins)
        return memo_table[amount,coins]
    @trace
    def full_count_change(amount, coins):
        if amount == 0:
            return 1
        elif not coins:
            return 0
        elif amount >= coins[0]:
            return count_change(amount, coins[1:]) \
                   + count_change(amount-coins[0], coins)
        else:
            return count_change(amount, coins[1:])

    return count_change(amount,coins)

# Dynamic programming version of count_change
def count_change(amount, coins = (50, 25, 10, 5, 1)):
    # memo_table[amt][k] = count_change(amt, coins[-k:])
    memo_table = [ [-1] * (len(coins)+1) for i in range(amount+1) ]
    def count_change(amount, coins):
        if memo_table[amount][len(coins)] == -1:
            raise RuntimeError("unfilled memo: {0}, {1}".format(amount,len(coins)))
        return memo_table[amount][len(coins)]
    def full_count_change(amount, coins):
        if amount == 0:
            return 1
        elif not coins:
            return 0
        elif amount >= coins[0]:
            return count_change(amount, coins[1:]) \
                   + count_change(amount-coins[0], coins)
        else:
            return count_change(amount, coins[1:])
    for a in range(0, amount+1):
        memo_table[a][0] = full_count_change(a, ()) 
    for k in range(1, len(coins)+1):
        for a in range(0, amount+1):
             memo_table[a][k] = full_count_change(a, coins[-k:])
    return count_change(amount, coins)

