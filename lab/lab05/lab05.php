<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
    <meta name="description" content ="CS61A: Structure and Interpretation of Computer Programs" /> 
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, John DeNero, Berkeley, EECS" />
    <meta name="author" content ="John DeNero, Soumya Basu, Jeff Chang, Brian Hou, Andrew Huang, Robert Huang, Michelle Hwang, Richard Hwang,
                                  Joy Jeng, Keegan Mann, Stephen Martinis, Bryan Mau, Mark Miyashita, Allen Nguyen, Julia Oh, Vaishaal
                                  Shankar, Steven Tang, Sharad Vikram, Albert Wu, Chenyang Yuan" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <style type="text/css">@import url("../lab_style.css");</style>
    <style type="text/css">@import url("../61a_style.css");</style>

    <title>CS 61A Fall 2013: Lab 5</title> 

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
    $RELEASE_DATE = new DateTime("10/10/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 5</h1>
<h2>Mutable Data and Sequence Processing</h2>
<p>We've provided a starter file with skeleton code for the exercises in
the lab. You can get it at the following link:</p>

<ul>
<li><a href="./lab5.py">lab5.py</a></li>
</ul>

<h3>Nonlocal</h3>

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

<p><strong>Problem 1</strong>: Predict what Python will display when the following
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
<p><strong>Problem 2</strong>: Write a function <code>make_fib</code> that returns a function
that reurns the next Fibonacci number each time it is called.</p>

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
<p><strong>Problems 3</strong>: Recall <code>make_test_dice</code> from the Hog project.
<code>make_test_dice</code> takes in a sequence of numbers and returns a
zero-argument function. This zero-argument function will cycle through
the list, returning one element from the list every time. Implement
<code>make_test_dice</code>.</p>

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
<p><strong>Problem 4</strong>: Recall the <code>make_withdraw</code> function from lecture:</p>

<pre><code>def make_withdraw(balance):
    """Return a withdraw function with a starting balance."""
    def withdraw(amount):
        nonlocal balance
        if amount &gt; balance:
            return 'Insufficient funds'
        balance = balance - amount
        return balance
    return withdraw
</code></pre>

<p>Write a new function <code>make_bank</code>, which should also return another
function. This new function should be able to withdraw and deposit
money. See the doctests for behavior:</p>

<pre><code>def make_bank(balance):
    """Returns a bank function with a starting balance. Supports
    withdrawals and depositis.

    &gt;&gt;&gt; bank = make_bank(100)
    &gt;&gt;&gt; bank('withdraw', 40)    # 100 - 4
    60
    &gt;&gt;&gt; bank('deposit', 20)     # 60 + 20
    80
    &gt;&gt;&gt; bank('withdraw', 90)    # 80 - 90; not enough money
    'Insufficient funds'
    """
    def bank(message, amount):
        "*** YOUR CODE HERE ***"
    return bank
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>def make_bank(balance):
    def bank(message, amount):
        nonlocal balance
        if message == 'deposit':
            amount = -amount
        if amount &gt; balance:
            return 'Insufficient funds'
        balance = balance - amount
        return balance
    return bank
</code></pre>

  </div>
<?php } ?>
<h3>Sequence Processing</h3>

<p>The <strong>sequence abstraction</strong> is a fundamental concept in Python and
many other programming languages. In Python, a sequence is defined to
be any object that</p>

<ul>
<li>Has a finite length</li>
<li>Supports element selection (through zero-based indexing)</li>
</ul>

<p>Some examples of sequences in Python include tuples, lists, and
strings:</p>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3)
&gt;&gt;&gt; len(x)
3
&gt;&gt;&gt; x[0]
1
&gt;&gt;&gt; s = 'hello world!'
&gt;&gt;&gt; len(s)
12
&gt;&gt;&gt; s[0]
'h'
</code></pre>

<p>We can also iterate over sequences with <code>for</code> loops:</p>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3)
&gt;&gt;&gt; for item in x:
...     print(item)
1
2
3
&gt;&gt;&gt; s = 'to eat'
&gt;&gt;&gt; for letter in s:
...     print(letter)
t
o

e
a
t
</code></pre>

<p>Some Python sequences also support other features, like slicing and
membership testing:</p>

<pre><code>&gt;&gt;&gt; L = [1, 2, 3, 4]
&gt;&gt;&gt; L[1:3]
[2, 3]
&gt;&gt;&gt; s = 'cs 61a'
&gt;&gt;&gt; '61' in s
True
</code></pre>

<p><strong>Problem 5</strong>: Implement <code>max_char</code>, a function that takes a
sentence (as a string) and returns the character that appears the most
number of times in the sentence. If there is a tie, return the
character that appears first.</p>

<p><em>Hint</em>: strings have a <code>count</code> method that can count the number of
occurrences of a given substring. For example, <code>'hi there'.count('h')</code>
will evaluate to 2.</p>

<pre><code>def max_char(sentence):
    """Returns the character that appears the most number of times
    in sentence (a string).

    &gt;&gt;&gt; max_char('see spot run')
    's'
    &gt;&gt;&gt; max_char('mississippi')
    'i'
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def max_char(sentence):
    letter, num = None, 0
    for char in sentence:
        if sentence.count(char) &gt; num:
            letter = char
            num = sentence.count(char)
    return letter
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 6</strong>: Implement <code>max_word</code>, a function that takes a sentence
(as a string) and returns the word (in lower case) that appears the
most number of times in the sentence. If there is a tie, return the
character that appears first. You can assume there's no punctuation.</p>

<p>Your function should ignore capitalization. For example, 'text' is the
same English word as 'Text', but in Python, <code>'text' != 'Text'</code>.
Luckily, string objects have a <code>lower()</code> method that might help. For
example, <code>'TExt'.lower() == 'text'</code>.</p>

<p>In addition, strings also have a method called <code>split()</code>. This will
split a given string on whitespace. For example, <code>'hello
world'.split() == ['hello', 'world']</code>.</p>

<pre><code>def max_word(sentence):
    """Returns the word that occurs the most number of times in
    sentence (a string).

    &gt;&gt;&gt; max_word('To be or not to be')
    'to'
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def max_word(sentence):
    words = sentence.split()
    best, num = None, 0
    for word in words:
        word = word.lower()
        if words.count(word) &gt; num:
            best = word
            num = words.count(word)
    return best
</code></pre>

  </div>
<?php } ?>
<h3>Map, filter, and reduce</h3>

<p>Python has many powerful tools for sequence processing. Three of the
most common are <code>map</code>, <code>filter</code>, and <code>reduce</code>:</p>

<ul>
<li><code>map(fn, seq)</code>: applies a function <code>fn</code> onto every element in the
given sequence <code>seq</code>.</li>
<li><code>filter(pred, seq)</code>: keeps elements in the sequence <code>seq</code> only if
those elements satisfy the predicate function <code>pred</code> (that is, for
an element <code>x</code>, keep it only if <code>pred(x)</code> is True).</li>
<li><code>reduce(combiner, seq)</code>: combines all elements in the sequence <code>seq</code>
with the <code>combiner</code> function (which must take two arguments).
<em>Note</em>: <code>reduce</code> must be imported from the module <code>functools</code></li>
</ul>

<p>Note that <code>map</code> and <code>filter</code> return <code>map</code> objects and <code>filter</code>
objects, respectively. You can cast the results as lists. Some
examples:</p>

<pre><code>&gt;&gt;&gt; map(lambda x: x*x, [1, 2, 3])
&lt;map object at ...&gt;
&gt;&gt;&gt; list(map(lambda x: x*x, [1, 2, 3]))
[1, 4, 9]

&gt;&gt;&gt; filter(lambda x: x % 2 == 0, (1, 2, 3, 4))
&lt;filter object at ...&gt;
&gt;&gt;&gt; list(filter(lambda x: x % 2 == 0, (1, 2, 3, 4)))
[2, 4]

&gt;&gt;&gt; from functools import reduce
&gt;&gt;&gt; reduce(lambda x, y: x + y, [1, 2, 3, 4])  # 1 + 2 + 3 + 4
10
</code></pre>

<p><strong>Problem 7</strong>: as an exercise, implement three functions <code>map</code>,
<code>filter</code>, and <code>reduce</code> to behave like their built-in counterparts. For
<code>map</code> and <code>filter</code>, you can return the results as Python lists.</p>

<pre><code>def map(fn, seq):
    """Applies fn onto each element in seq and returns a list.

    &gt;&gt;&gt; map(lambda x: x*x, [1, 2, 3])
    [1, 4, 9]
    """
    "*** YOUR CODE HERE ***"

def filter(pred, seq):
    """Keeps elements in seq only if they satisfy pred.

    &gt;&gt;&gt; filter(lambda x: x % 2 == 0, [1, 2, 3, 4])
    [2, 4]
    """
    "*** YOUR CODE HERE ***"

def reduce(combiner, seq):
    """Combines elements in seq using combiner.

    &gt;&gt;&gt; reduce(lambda x, y: x + y, [1, 2, 3, 4])
    10
    &gt;&gt;&gt; reduce(lambda x, y: x * y, (1, 2, 3))
    6
    &gt;&gt;&gt; reduce(lambda x, y: x * y, [4])
    4
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>def map(fn, seq):
    result = []
    for elem in seq:
        result.append(fn(seq))
    return result

def filter(pred, seq):
    result = []
    for elem in seq:
        if pred(seq):
            result.append(seq)
    return result

def reduce(combiner, seq):
    total = seq[0]
    for elem in seq[1:]:
        total = combiner(total, elem)
    return total
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 8</strong>: Fill in the blanks for the following lines so that
each expression evaluates to the expected output:</p>

<pre><code>&gt;&gt;&gt; list(map(_______, [1, 3, -1, -4, 2]))
[1, 1, -1, -1, 2]
&gt;&gt;&gt; list(filter(______, [1, 7, 14, 21, 28, 35, 49]))
[1, 14, 28, 49]
&gt;&gt;&gt; reduce(_______, 'hello')
'olleh'
&gt;&gt;&gt; reduce(______, map(______, 'nnnnn')) + ' batman!'
'nanananana batman!'
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <ul>
<li><code>list(map(lambda x: x // abs(x), [1, 3, -1, -4, 2]))</code></li>
<li><code>list(filter(lambda x: x // 7 % 2 == 0, [1, 7, 14, 21, 28, 35, 49]))</code></li>
<li><code>reduce(lambda x, y: y + x, 'hello')</code></li>
<li><code>reduce(lambda x, y: x + y, map(lambda s: s + 'a', 'nnnnn')) + ' batman!'</code></li>
</ul>

  </div>
<?php } ?>
<h3>Extra Questions</h3>

<p><strong>Problem 9</strong>: Implement a function <code>deep_len</code> that takes in a
(possibly) nested tuple and calculates its length. For example, the
expression <code>deep_len((1, (2, 3), 4))</code> would evaluate to 4, as opposed
to 3 (as the built-in len would report). The tuples can have an
arbitrary amount of nesting.</p>

<p><em>Hint</em>: the built-in <code>type</code> function can tell you the type of an
object.  For example,</p>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3)
&gt;&gt;&gt; type(x) == tuple
True
</code></pre>

<p>You can choose to use iteration or not, but either way, you will most
likely use some sort of recursion.</p>

<pre><code>def deep_len(tup):
    """Calculates the length of a possibly nested tuple.

    &gt;&gt;&gt; deep_len((1, 2, 3, 4))  # normal tuple
    4
    &gt;&gt;&gt; deep_len((1, (2, 3), 4))
    4
    &gt;&gt;&gt; deep_len((1, (2, (3, (4,)))))
    4
    &gt;&gt;&gt; deep_len((1, (), 2))  # empty  # nested tuples don't count
    2
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <pre><code>def deep_len(tup):
    if not tup:
        return 0
    elif type(tup[0]) == tuple:
        return deep_len(tup[0]) + deep_len(tup[1:])
    else:
        return 1 + deep_len(tup[1:])
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 10</strong>: Implement a function <code>merge</code>, which takes two sorted
tuples and returns a tuple that contains all elements in both tuples
(including duplicates) in sorted order. The sequences do not have to
have the same length.</p>

<p><em>Hint</em>: Try doing this recursively.</p>

<pre><code>def merge(seq1, seq2):
    """Merges all elements (including duplicates) of seq1 and seq2
    in sorted order.

    &gt;&gt;&gt; merge((1, 3, 5), (2, 4))
    (1, 2, 3, 4, 5)
    &gt;&gt;&gt; merge((), (1, 2, 3))
    (1, 2, 3)
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
    <pre><code>def merge(seq1, seq2):
    if not seq1 or not seq2:
        return seq1 + seq2
    elif seq1[0] &lt; seq2[0]:
        return (seq1[0],) + merge(seq1[1:], seq2)
    else:
        return (seq2[0],) + merge(seq1, seq2[1:])
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 11</strong>: <a href="http://en.wikipedia.org/wiki/Merge_sort">Mergesort</a> is
a type of sorting algorithm. It follows a naturally recursive
procedure:</p>

<ul>
<li>Break the input tuple into equally-sized halves</li>
<li>Recursively sort both halves</li>
<li>Merge the sorted halves.</li>
</ul>

<p>Using your <code>merge</code> function from the previous question, implement
<code>mergesort</code>.</p>

<p><em>Challenge</em>: Implement mergesort iteratively, without using recursion.</p>

<pre><code>def mergesort(seq):
    """Mergesort algorithm.

    &gt;&gt;&gt; mergesort((4, 2, 5, 2, 1))
    (1, 2, 2, 4, 5)
    &gt;&gt;&gt; mergesort(())     # sorting an empty list
    ()
    &gt;&gt;&gt; mergesort((1,))   # sorting a one-element list
    (1,)
    """
    "*** YOUR CODE HERE***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton10">Toggle Solution</button>
  <div id="toggleText10" style="display: none">
    <pre><code># recursive version
def mergesort(seq):
    if len(seq) &lt; 2:
        return seq
    mid = len(seq) // 2
    return merge(mergesort(seq[:mid]), mergesort(seq[mid:]))

# iterative version
def mergesort(seq):
    if not seq:
        return ()
    queue = [(elem,) for elem in seq]
    while len(queue) &gt; 1:
        first, second = queue.pop(0), queue.pop(0)
        queue.append(merge(first, second))
    return queue[0]
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
