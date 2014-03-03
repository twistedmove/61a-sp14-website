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

class CheckingAccount(Account):
    """A bank account that charges for withdrawals.

    >>> ch = CheckingAccount('Jack')
    >>> ch.balance = 20
    >>> ch.withdraw(5)
    14
    >>> ch.interest
    0.01
    """

    withdraw_fee = 1
    interest = 0.01

    def withdraw(self, amount):
        return Account.withdraw(self, amount + self.withdraw_fee)


class Bank:
    """A bank has accounts and pays interest.

    >>> bank = Bank()
    >>> john = bank.open_account('John', 10)
    >>> jack = bank.open_account('Jack', 5, CheckingAccount)
    >>> jack.interest
    0.01
    >>> john.interest = 0.06
    >>> bank.pay_interest()
    >>> john.balance()
    10.6
    >>> jack.balance()
    5.05
    """
    def __init__(self):
        self.accounts = []

    def open_account(self, holder, amount, account_type=Account):
        """Open an account_type for holder and deposit amount."""
        account = account_type(holder)
        account.deposit(amount)
        self.accounts.append(account)
        return account

    def pay_interest(self):
        """Pay interest to all accounts."""
        for account in self.accounts:
            account.deposit(account.balance() * account.interest)


class SavingsAccount(Account):
    """A bank account that charges for deposits."""

    deposit_fee = 2

    def deposit(self, amount):
        return Account.deposit(self, amount - self.deposit_fee)


class AsSeenOnTVAccount(CheckingAccount, SavingsAccount):
    """A bank account that charges for everything."""

    def __init__(self, account_holder):
        self._holder = account_holder
        self._balance = 1  # A free dollar!



supers = [c.__name__ for c in AsSeenOnTVAccount.mro()]
