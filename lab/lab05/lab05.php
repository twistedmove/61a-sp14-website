<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
    <meta name="description" content ="CS61A: Structure and Interpretation of Computer Programs" /> 
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, John DeNero, Berkeley, EECS" />
    <meta name="author" content ="Paul Hilfinger, Soumya Basu, Rohan Chitnis, Andrew Huang, Robert Huang, Michelle Hwang,
                                  Joy Jeng, Keegan Mann, Mark Miyashita, Allen Nguyen, Julia Oh, Steven Tang, Albert Wu, Chenyang Yuan, Marvin Zhang" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <style type="text/css">@import url("../lab_style.css");</style>
    <style type="text/css">@import url("../61a_style.css");</style>

    <title>CS 61A Spring 2014: Lab 5</title> 

    <?php
    /* So all of the PHP in this file is to allow for this nice little trick to 
     * help us avoid having two versions of the questions lying around in the 
     * repository, which often leads to the two versions going out of sync which 
     * leads to annoyance for students.
     *
     * The idea's pretty simple for the PHP part, just simply have two dates: 
     *
     *    1. The current date
     *    2. The date the solutions should be released
     *
     * Using these, we now wrap our solutions in a simple PHP if statement that 
     * checks if the date is past the release date and only includes the code on 
     * the page displayed (what the server gives back to the browser) if the 
     * solutions are supposed to be released.
     *
     * We also use some PHP to create unique IDs for each of the show/hide 
     * buttons and solution divs, which are then used in the PHP generated 
     * jQuery code that we use to create the nice toggling effect.
     *
     * I apologize if the PHP/jQuery is really offensively bad, this is 
     * literally the most I've written of either for a single project so far.
     * Comments/suggestions are most welcome!
     *
     * - Tom Magrino (tmagrino@berkeley.edu)
     */
    $BERKELEY_TZ = new DateTimeZone("America/Los_Angeles");
    $RELEASE_DATE = new DateTime("3/6/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 5</h1>
<h2 id="title-sub">Mutable Data and Object-Oriented Programming</h2>
<h2>Starter Files</h2>

<p>We've provided a set of starter files with skeleton code for the
exercises in the lab. You can get them in the following places:</p>

<ul>
<li><a href="starter/nonlocal.py">nonlocal.py</a></li>
<li><a href="starter/oop.py">oop.py</a></li>
</ul>

<h2>Nonlocal</h2>

<p>Consider the following function:</p>

<pre><code>def make_counter():
    """Makes a counter function.

    &gt;&gt;&gt; counter = make_counter()
    &gt;&gt;&gt; counter()
    1
    &gt;&gt;&gt; counter()
    2
    """
    count = 0
    def counter():
        count = count + 1
        return count
    return counter
</code></pre>

<p>Try running this function's doctests. You'll find that it causes the
following error:</p>

<pre><code>UnboundLocalError: local variable 'count' referenced before assignment
</code></pre>

<p>Why does this happen? Normally, when we create variables (like <code>count
= ...</code> in <code>counter</code>), we create the variable in the local frame. Thus
<code>count</code> is marked as a local variable in the <code>counter</code> function.
However, notice that we tried to compute <code>count + 1</code> before the local
variable was created! That's why we get the <code>UnboundLocalError</code>.</p>

<p>To avoid this problem, we introduce the <code>nonlocal</code> keyword. It allows
us to update a variable in a parent frame. Consider this improved
example:</p>

<pre><code> def make_counter():
    """Makes a counter function.

    &gt;&gt;&gt; counter = make_counter()
    &gt;&gt;&gt; counter()
    1
    &gt;&gt;&gt; counter()
    2
    """
    count = 0
    def counter():
        nonlocal count
        count = count + 1
        return count
    return counter
</code></pre>

<p>Notice the <code>nonlocal count</code>. This declares the <code>count</code> variable as a
nonlocal variable, so now we can update <code>count</code>.</p>

<h3 class='question'>Question 1</h3>

<p>Predict what Python will display when the following
lines are typed into the interpreter:</p>

<pre><code>&gt;&gt;&gt; def make_funny_adder(n):
...     def adder(x):
...         if x == 'new':
...             nonlocal n
...             n = n + 1
...         else:
...             return x + n
...     return adder
&gt;&gt;&gt; h = make_funny_adder(3)
&gt;&gt;&gt; h(5)
______
&gt;&gt;&gt; j = make_funny_adder(7)
&gt;&gt;&gt; j(5)
______
&gt;&gt;&gt; h('new')
&gt;&gt;&gt; h(5)
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <ol>
<li>8</li>
<li>12</li>
<li>9</li>
</ol>

  </div>
<?php } ?>
<h3 class='question'>Question 2</h3>

<p>Write a function <code>make_fib</code> that returns a function that reurns the
next Fibonacci number each time it is called.</p>

<pre><code>def make_fib():
    """Returns a function that returns the next Fibonacci number
    every time it is called.

    &gt;&gt;&gt; fib = make_fib()
    &gt;&gt;&gt; fib()
    0
    &gt;&gt;&gt; fib()
    1
    &gt;&gt;&gt; fib()
    1
    &gt;&gt;&gt; fib()
    2
    &gt;&gt;&gt; fib()
    3
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>def make_fib():
    cur, next = 0, 1
    def fib():
        nonlocal cur, next
        result = cur
        cur, next = next, cur + next
        return result
    return fib
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 3</h3>

<p>Recall <code>make_test_dice</code> from the Hog project.  <code>make_test_dice</code> takes
in a sequence of numbers and returns a zero-argument function. This
zero-argument function will cycle through the list, returning one
element from the list every time. Implement <code>make_test_dice</code>.</p>

<pre><code>def make_test_dice(seq):
    """Makes deterministic dice.

    &gt;&gt;&gt; dice = make_test_dice([2, 6, 1])
    &gt;&gt;&gt; dice()
    2
    &gt;&gt;&gt; dice()
    6
    &gt;&gt;&gt; dice()
    1
    &gt;&gt;&gt; dice()
    2
    &gt;&gt;&gt; other = make_test_dice([1])
    &gt;&gt;&gt; other()
    1
    &gt;&gt;&gt; dice()
    6
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>def make_test_dice(seq):
    count = 0
    def dice():
        nonlocal count
        result = seq[count]
        count = (count + 1) % len(seq)
        return result
    return dice
</code></pre>

  </div>
<?php } ?>
<h2>Object Oriented Programming</h2>

<h3 class='question'>Question 4</h3>

<p>Predict the result of evaluating the following calls in the
interpreter. Then try them out yourself!</p>

<pre><code>&gt;&gt;&gt; class Account(object):
...     interest = 0.02
...     def __init__(self, account_holder):
...         self.balance = 0
...         self.holder = account_holder
...     def deposit(self, amount):
...         self.balance = self.balance + amount
...         print("Yes!")
...
&gt;&gt;&gt; a = Account("Billy")
&gt;&gt;&gt; a.account_holder
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>AttributeError: 'Account' object has no attribute 'account_holder'
</code></pre>

  </div>
<?php } ?>
<pre><code>&gt;&gt;&gt; a.holder
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>'Billy'
</code></pre>

  </div>
<?php } ?>
<pre><code>&gt;&gt;&gt; class CheckingAccount(Account):
...     def __init__(self, account_holder):
...         Account.__init__(self, account_holder)
...     def deposit(self, amount):
...         Account.deposit(self, amount)
...         print("Have a nice day!")
...
&gt;&gt;&gt; c = CheckingAccount("Eric")
&gt;&gt;&gt; a.deposit(30)
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>Yes!
</code></pre>

  </div>
<?php } ?>
<pre><code>&gt;&gt;&gt; c.deposit(30)
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>Yes!
Have a nice day!
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 5</h3>

<p>Consider the following basic definition of a <code>Person</code> class:</p>

<pre><code>class Person(object):

    def __init__(self, name):
        self.name = name

    def say(self, stuff):
        return stuff

    def ask(self, stuff):
        return self.say("Would you please " + stuff)

    def greet(self):
        return self.say("Hello, my name is " + self.name)
</code></pre>

<p>Modify this class to add a <code>repeat</code> method, which repeats the last
thing said. Here's an example of its use:</p>

<pre><code>&gt;&gt;&gt; steven = Person("Steven")
&gt;&gt;&gt; steven.repeat()       # starts at whatever value you'd like
"I squirreled it away before it could catch on fire."
&gt;&gt;&gt; steven.say("Hello")
"Hello"
&gt;&gt;&gt; steven.repeat()
"Hello"
&gt;&gt;&gt; steven.greet()
"Hello, my name is Steven"
&gt;&gt;&gt; steven.repeat()
"Hello, my name is Steven"
&gt;&gt;&gt; steven.ask("preserve abstraction barriers")
"Would you please preserve abstraction barriers"
&gt;&gt;&gt; steven.repeat()
"Would you please preserve abstraction barriers"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>class Person(object):

    def __init__(self, name):
        self.name = name
        self.previous = "I squirreled it away before it could catch on fire"

    def say(self, stuff):
        self.previous = stuff
        return stuff

    def ask(self, stuff):
        return self.say("Would you please " + stuff)

    def greet(self):
        return self.say("Hello, my name is " + self.name)

    def repeat(self):
        return self.say(self.previous)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 6</h3>

<p>Suppose now that we wanted to define a class called <code>DoubleTalker</code> to
represent people who always say things twice:</p>

<pre><code>&gt;&gt;&gt; steven = DoubleTalker("Steven")
&gt;&gt;&gt; steven.say("hello")
"hello hello"
&gt;&gt;&gt; steven.say("the sky is falling")
"the sky is falling the sky is falling"
</code></pre>

<p>Consider the following three definitions for <code>DoubleTalker</code>:</p>

<pre><code>class DoubleTalker(Person):
    def __init__(self, name):
        Person.__init__(self, name)
    def say(self, stuff):
        return Person.say(self, stuff) + " " + self.repeat()

class DoubleTalker(Person):
    def __init__(self, name):
        Person.__init__(self, name)
    def say(self, stuff):
        return stuff + " " + stuff

class DoubleTalker(Person):
    def __init__(self, name):
        Person.__init__(self, name)
    def say(self, stuff):
        return Person.say(self, stuff + " " + stuff)
</code></pre>

<p>Determine which of these definitions work as intended. Also determine
for which of the methods the three versions would respond differently.
(Don't forget about the <code>repeat</code> method!)</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <p>The last one works as intended.  For the first and second ones,
calling <code>repeat</code> would fail.</p>

  </div>
<?php } ?>
<h3 class='question'>Question 7</h3>

<p>Here are the <code>Account</code> and <code>CheckingAccount</code> classes from lecture:</p>

<pre><code>class Account(object):
    """A bank account that allows deposits and withdrawals."""

    interest = 0.02

    def __init__(self, account_holder):
        self.balance = 0
        self.holder = account_holder

    def deposit(self, amount):
        """Increase the account balance by amount and return the
        new balance."""
        self.balance = self.balance + amount
        return self.balance

    def withdraw(self, amount):
        """Decrease the account balance by amount and return the
        new balance."""
        if amount &gt; self.balance:
            return 'Insufficient funds'
        self.balance = self.balance - amount
        return self.balance

class CheckingAccount(Account):
    """A bank account that charges for withdrawals."""

    withdraw_fee = 1
    interest = 0.01

    def withdraw(self, amount):
        return Account.withdraw(self, amount + self.withdraw_fee)
</code></pre>

<p>Modify the code so that both classes have a new attribute,
<code>transactions</code>, that is a list keeping track of any transactions
performed. For example:</p>

<pre><code>&gt;&gt;&gt; eric_account = Account(“Eric”)
&gt;&gt;&gt; eric_account.deposit(1000000)   # depositing my paycheck for the week
1000000
&gt;&gt;&gt; eric_account.transactions
[(‘deposit’, 1000000)]
&gt;&gt;&gt; eric_account.withdraw(100)      # buying dinner
999900
&gt;&gt;&gt; eric_account.transactions
[(‘deposit’, 1000000), (‘withdraw’, 100)]
</code></pre>

<p>Don't repeat code if you can help it; use inheritance!</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
    <pre><code>class Account(object):
    """A bank account that allows deposits and withdrawals."""

    interest = 0.02

    def __init__(self, account_holder):
        self.balance = 0
        self.holder = account_holder
        self.transactions = []

    def deposit(self, amount):
        """Increase the account balance by amount and return the new balance."""
        self.transactions.append(('deposit', amount))
        self.balance = self.balance + amount
        return self.balance

    def withdraw(self, amount):
        """Decrease the account balance by amount and return the new balance."""
        self.transactions.append(('withdraw', amount))
        if amount &gt; self.balance:
            return 'Insufficient funds'
        self.balance = self.balance - amount
        return self.balance

class CheckingAccount(Account):
    """A bank account that charges for withdrawals."""

    withdraw_fee = 1
    interest = 0.01

    def withdraw(self, amount):
        return Account.withdraw(self, amount + self.withdraw_fee)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 8</h3>

<p>We'd like to be able to cash checks, so let's add a <code>deposit_check</code>
method to our <code>CheckingAccount</code> class. It will take a <code>Check</code> object
as an argument, and check to see if the <code>payable_to</code> attribute matches
the <code>CheckingAccount</code>'s holder. If so, it marks the <code>Check</code> as
deposited, and adds the amount specified to the <code>CheckingAccount</code>'s
total. Here's an example:</p>

<pre><code>&gt;&gt;&gt; check = Check(“Steven”, 42)  # 42 dollars, payable to Steven
&gt;&gt;&gt; steven_account = CheckingAccount(“Steven”)
&gt;&gt;&gt; eric_account = CheckingAccount(“Eric”)
&gt;&gt;&gt; eric_account.deposit_check(check)  # trying to steal steven’s money
The police have been notified.
&gt;&gt;&gt; eric_account.balance
0
&gt;&gt;&gt; check.deposited
False
&gt;&gt;&gt; steven_account.balance
0
&gt;&gt;&gt; steven_account.deposit_check(check)
42
&gt;&gt;&gt; check.deposited
True
&gt;&gt;&gt; steven_account.deposit_check(check)  # can't cash check twice
The police have been notified.
</code></pre>

<p>Write an appropriate <code>Check</code> class, and add the <code>deposit_check</code> method
to the <code>CheckingAccount</code> class. Make sure not to copy and paste code!
Use inheritance whenever possible.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton10">Toggle Solution</button>
  <div id="toggleText10" style="display: none">
    <pre><code>class Account(object):
    """A bank account that allows deposits and withdrawals."""

    interest = 0.02

    def __init__(self, account_holder):
        self.balance = 0
        self.holder = account_holder
        self.transactions = []

    def deposit(self, amount):
        """Increase the account balance by amount and return the
        new balance."""
        self.transactions.append(('deposit', amount))
        self.balance = self.balance + amount
        return self.balance

    def withdraw(self, amount):
        """Decrease the account balance by amount and return the
        new balance."""
        self.transactions.append(('withdraw', amount))
        if amount &gt; self.balance:
            return 'Insufficient funds'
        self.balance = self.balance - amount
        return self.balance

class CheckingAccount(Account):
    """A bank account that charges for withdrawals."""

    withdraw_fee = 1
    interest = 0.01

    def withdraw(self, amount):
        return Account.withdraw(self, amount + self.withdraw_fee)

    def deposit_check(self, check):
        if check.payable_to != self.holder or check.deposited:
            print("The police have been notified")
        else:
            self.deposit(check.amount)
            check.deposited = True

class Check(object):
    def __init__(self, payable_to, amount):
        self.payable_to = payable_to
        self.amount = amount
        self.deposited = False
</code></pre>

  </div>
<?php } ?>
<p></p>

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 11; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
