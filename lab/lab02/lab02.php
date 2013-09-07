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

<title>CS 61A Fall 2013: Lab 2</title> 

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
$RELEASE_DATE = new DateTime("09/12/2013", $BERKELEY_TZ);
$CUR_DATE = new DateTime("now", $BERKELEY_TZ);
$q_num = 0; // Used to make unique ids for all solutions and buttons
?>
</head> 

<body style="font-family: Georgia,serif;"> 

<h1>CS61A Lab 2: Control Flow</h1>
<h3>Week 3, Fall 2013</h3>

<h3 class="section_title">Python flags</h3>
Sometimes, you can append certain "flags" on the command line to inspect your code further. Here are a few useful
ones that'll come in handy this semester. If you want to learn more about other python flags, you can type 
<span class="code"> man python</span>

<p><b>no flags:</b> Adding no flags will directly run your python script, meaning that python will
run the code in the file you provide and return you to the command line. <br>
USAGE: <span class="code">python3 FILE_NAME</span>

<p><b>-i</b>: The <i>-i</i> option runs your Python script, and throws you into an interactive session. 
If you omit the -i option, Python will only run your script. See the next section regarding interactive sessions to learn more!<br>

USAGE: <span class="code">python3 -i FILE_NAME<span class="code"></p>

<p><b>-m doctest</b>: Using <i>-m doctest</i> option will be useful on your homeworks and projects to help you test your code
by showing you whether your code is working as you intend it to. Doctests are marked by triple quotations (""") and are
usually located within the function. <br>
USAGE: <span class="code">python3 -m doctest FILE_NAME<span class="code"></p>


<p><b>-v</b>: The <i>-v</i> option signifies a verbose option. You can append this flag to the <i>-m doctest</i> flag to
show both passing and failing tests. With the <i>-v</i> flag, you will be notified of all results (both failing and passing tests). <br>
USAGE: <span class="code">python3 -m doctest -v FILE_NAME<span class="code"></p>

<h3 class="section_title">Interactive sessions:</h3>

Sometimes, you just want to try some things out in the python interpreter. If you want to test out
functions in a file, you'll need the <span class='code'>-i</span> flag as we specified above.

However, if you just need to try something out in the interpreter, without any user defined functions
this is how you start an interactive session:<br>
USAGE: <span class="code">python3</span><br>
On Cygwin:<br>
USAGE: <span class="code">python3 -i</span><br>

<br>

<h3 class="section_title">Warm Up: What would Python print?</h3>
<p>Predict what Python will print in response to each of these expressions.  
Then try it and make sure your answer was correct, or if not, that you understand why! If 
you don't remember how to start Python, type in: <tt>python3</tt> into the command line.
</p>
<pre class="codemargin">
# Q1
>>> a = 1
>>> b = a + 1
>>> a + b + a * b 
______________

# Q2
>>> a == b
______________

# Q3
>>> z, y = 1, 2
>>> print(z)
______________

# Q4
>>> def square(x):
...     print(x * x)        # Hit enter twice
...
>>> a = square(b)
______________

# Q5
>>> print(a)
______________

# Q6
>>> def square(y):
...     return y * y        # Hit enter twice
...
>>> a = square(b)
>>> print(a)
_______________
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class="codemargin">
Q1: 5
Q2: False
Q3: 1
Q4: 4
Q5: None
Q6: 4
</pre>
</div>
<?php } ?>

<h3 class="section_title">Boolean operators</h3>
<p>1. What would Python print? Try to figure it out before you type it into the
interpreter!</p>

<pre class="codemargin">
# Q1
>>> a, b = 10, 6
>>> a > b and a == 0
_______________

# Q2
>>> a > b or a == 0
_______________

# Q3
>>> not a > 0
_______________

# Q4
>>> a != 0
_______________

# Q5
>>> True and False
_______________

# Q6
>>> True or False
_______________

# Q7
>>> not True and False
_______________

# Q8
>>> not (True and False)
_______________

# Q9
>>> False or False
_______________

# Q10
>>> True and True or True and False
_______________
</pre>
</br>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
Q1: False
Q2: True
Q3: False
Q4: True
Q5: False
Q6: True
Q7: False
Q8: True
Q9: False
Q10: True
</pre>
</div>
<?php } ?>

<p><b>Boolean order of operations:</b> just like with mathematical operators,
boolean operators (<span class="code">and</span>, <span class="code">or</span>,
and <span class="code">not</span>) have an order of operations, too:
</p>

<pre class="codemargin">
# highest priority
not
and
or
# lowest priority
</pre>

<p>For example, the following expression will evaluate to <span class="code">True</span>:</p>

<pre class="codemargin">
True and not False or not True and False
</pre>

<p>It might be easier to rewrite the expression like this:</p>

<pre class="codemargin">
(True and (not False)) or ((not True) and False)
</pre>

<p>If you find writing parentheses to be clearer, it is perfectly acceptable to do
so in your code.</p>

<p><b>Short-circuit operators:</b> in Python, <span class="code">and</span> and 
<span class="code">or</span> are examples of <i>short-circuit operators</i>. 
Consider the following line of code:
</p>

<pre class="codemargin">
10 > 3 or 1 / 0 != 1
</pre>

<p>Generally, operands are evaluated from left to right in Python. The expression
<span class="code">10 > 3</span> will be evaluated first, then
<span class="code">1 / 0 != 1</span> will be evaluated. The problem is, evaluating 
<span class="code">1 / 0</span> will cause Python to raise an error, stopping function evaluation altogether! (You can try
dividing by 0 in the interpreter)</p>

<p>However, the original line of code will not cause any errors -- in fact, it will
evaluate to <span class="code">True</span>. This is made possible due to short-circuiting, 
which works in the following ways:</p>

<ul>
<li><span class="code">and</span> will evaluate to <span class="code">True</span> only if 
<i>all</i> the operands are <span class="code">True</span>. For multiple 
<span class="code">and</span> statements, Python will go left to right until it runs 
into the first <span class="code">False</span> value -- then it will just immediately 
evaluate to <span class="code">False</span>.
<li><span class="code">or</span> will evaluate to <span class="code">True</span> if <i>at 
least one</i> of the operands is <span class="code">True</span>. For multiple 
<span class="code">or</span> statements, Python will go left to right until it runs into 
the first <span class="code">True</span> value -- then it will immediately evaluate
to <span class="code">True</span>.</li>
</ul>

<p>Some examples:</p>

<pre class="codemargin">
>>> True and False and 1 / 0 == 1     # stops at the False
False
>>> True and 1 / 0 == 1 and False     # hits the division by zero
Traceback (most recent call last):
...
ZeroDivisionError: division by zero

>>> True or 1 / 0 == 1                # stops at the True
True
>>> False or 1 / 0 == 1 or True       # hits the division by zero
Traceback (most recent call last):
...
ZeroDivisionError: division by zero
</pre>

<p>Short-circuiting allows you to write boolean expressions while avoiding errors.
Using division by zero as an example:</p>

<pre class="codemargin">
x != 0 and 3 / x > 3
</pre>

<p>In the line above, the first operand is used to guard against a 
<span class="code">ZeroDivisionError</span> that could be caused by the second 
operand.</p>

<h3 class="section_title"><span class="code">if</span> statements</h3>
<p>2. What would the Python interpreter display?</p>

<pre class="codemargin">
>>> a, b = 10, 6

# Q1
>>> if a == b:
...     a
... else:
...     b
...
_______________

# Q2
>>> if a == 4:
...     6
... elif b >= 4:
...     6 + 7 + a
... else: 
...     25
...
________________

# Q3
# ';' lets you type multiple commands on one line
>>> if b != a: a; b  
_________________
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
Q1: 6
Q2: 23
Q3: 10
6
</pre>
</div>
<?php } ?>

<p>The following are some <b>common mistakes</b> when using <span class="code">if</span> statements:</p>

<p>1. Using '<span class="code">=</span>' instead of '<span class="code">==</span>': 
remember, <span class="code">=</span> (single equals) is used for <i>assignment</i>,
while <span class="code">==</span> (double equals) is used for <i>comparison</i>.</p>

<pre class="codemargin">
# bad
>>> if a = b:
...     print("uh oh!")
...

# good!
>>> if a == b:
...     print("yay!")
...
</pre>

<p>2. Multiple comparisons: for example, trying to check if both <span class="code">x</span>
and <span class="code">y</span> are greater than 0.</p>

<pre class="codemargin">
# bad
>>> if x and y > 0:
...     print("uh oh!")
...

# good!
>>> if x > 0 and y > 0:
...     print("yay!")
...
</pre>

<b>Guarded commands</b>
<p>Consider the following function:</p>

<pre class="codemargin">
>>> def abs(x):
...     if x >= 0:
...         return x
...     else:
...         return -x
...
</pre>

<p>It is syntactically correct to rewrite <span class="code">abs</span> in the
following way:</p>

<pre class="codemargin">
>>> def abs(x):
...     if x >= 0:
...         return x
...     return -x       # missing else statement!
...
</pre>

<p>This is possible as a direct consequence of how <span class="code">return</span>
works -- when Python sees a <span class="code">return</span> statement, it will 
<i>immediately terminate</i> the function, and the rest of the function will not be evaluated. 
In the above example, if <span class="code">x >= 0</span>,
Python will never reach the final line. Try to convince yourself that this is indeed the
case before moving on.</p>

<p>Keep in mind that <b>guarded commands only work if the function is terminated</b>!
For example, the following function will <i>always</i> print "less than zero", because
the function is not terminated in the body of the <span class="code">if</span> suite:</p>

<pre class="codemargin">
>>> def foo(x):
...     if x > 0:
...         print("greater than zero")
...     print("less than zero")
...
>>> foo(-3)
less than zero
>>> foo(4)
greater than zero
less than zero
</pre>

<p>In general, using guarded commands will make your code more concise -- however, if you find
that it makes your code harder to read, by all means use an <span class="code">else</span>
statement.
</p>

<h3 class="section_title"><span class="code">while</span> loops</h3>

<p>3. What would Python print?</p>

<pre class="codemargin">
>>> n = 2
>>> def exp_decay(n):
...     if n % 2 != 0:
...         return
...     while n > 0:
...         print(n)
...         n = n // 2 # See exercise 3 for an explanation of what '//' stands for
...
>>> exp_decay(1024)
__________________
>>> exp_decay(5)
__________________

>>> def funky(k):
...     while k < 50:
...         if k % 2 == 0:
...             k += 13
...         else:
...             k += 1
...         print(k)
...     return k
>>> funky(25)
__________________

>>> n, i = 7, 0
>>> while i < n:
...     i += 2
...     print(i)
__________________

>>> n = 3
>>> while n > 0:
...     n -= 1
...     print(n)
__________________

>>> n = 3
>>> while n >= 0:
...     n -= 1
...     print(n)
__________________

>>> n = 4
>>> while True:
...     n -= 1
...     print(n)
__________________

>>> n = 10
>>> while n > 0:
...     if n % 2 == 0:
...         n -= 1
...     elif n % 2 != 0:
...         n -= 3
...     print(n)
__________________

</pre>

</br>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
1024
512
256

128
64
32
16
8
4
2
1

Nothing shows up

26
39
40
53
53

2
4
6
8

2
1
0

2
1
0
-1

3
2
1
0
-1
-2
...
Goes on forever!

9
6
5
2
1
-2
</pre>
</div>
<?php } ?>

<p>4. Write a function divide(num, divisor) without using the '/' or '//'. (Hint: use a while loop)</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def divide(num, divisor):
    count = 0
    while num > 0:
        num -= divisor
        count += 1
    return count
</pre>
</div>
<?php } ?>

<p>Before we write our next function, let's look at the idea of floor division 
(rounds down to the nearest integer) versus true division (decimal division).</p>

<table border="0">
<tr>
<th>True Division</th>
<th>Floor Division</th>
</tr>
<tr>
<td> >>> 1 / 4</td>
<td> >>> 1 // 4</td>
</tr>
<tr>
<td>0.25</td>
<td>0</td>
</tr>
<tr>
<td> >>> 4 / 2</td>
<td> >>> 4 // 2</td>
</tr>
<tr>
<td>2.0</td>
<td>2</td>
</tr>
<tr>
<td> >>> 5 / 3</td>
<td> >>> 5 // 3</td>
</td>
<tr>
<td>1.666666666667</td>
<td>1</td>
</tr>
</table>

<!--
<pre>
<b>Normal Division          Integer Division</b></pre>
<pre>
# <span class="code">a / b</span> → returns a float!        # <span class="code">a // b</span> → rounds down to the nearest integer
>>> 1/4                 >>> 1//4 
0.25                    0
>>> 4/2                 >>> 4//2 
2.0                 2
>>> 5/3                 >>> 5//3 
1.666666666667              1
</pre>
-->

<p>Thus, if we have an operator "%" that gives us the remainder of dividing two numbers, 
we can see that the following rule applies: </p>
<pre class="codemargin">
b * (a // b) + (a % b) = a
</pre>


<p>Now, define a function <span class="code">factors(n)</span> which takes in a number, 
n, and prints out all of the numbers that divide n evenly. For example, a call with n=20 
should result as follows (order doesn’t matter):</p>

<pre class="codemargin">
>>> factors(20)
20
10
5
4
2
1 
</pre>

<p>
Helpful Tip: You can use the % to find if something divides evenly into a number. % gives you a remainder, as follows:
</p>

<pre class="codemargin">
>>> 10 % 5
0
>>> 10 % 4
2
>>> 10 % 7
3
>>> 10 % 2
0
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def factors(n):
  x = n
  while x > 0:
    if (n % x == 0):
        print(x)
    x -= 1
</pre>
</div>
<?php } ?>

<h3 class="section_title">Error messages</h3>

<p>By now, you've probably seen a couple of error messages. Even though they might
look intimidating, error messages are actually very helpful in debugging code. The
following are some common error messages (found at the bottom of a traceback):</p>

<ul>
<li><b>SyntaxError</b>: Indicates that your code contains improper syntax (e.g. 
missing a colon after an <span class="code">if</span> statement).
<li><b>IndentationError</b>: Indicates that your code contains improper indentation
(e.g. inconsistent indentation of a function body)
<li><b>TypeError</b>: Indicates an attempted operation on incompatible types (e.g. 
trying to add a function and an int)
<li><b>ZeroDivisionError</b>: Indicates an attempted division by zero.
</ul>

<p>Using these descriptions of error messages, you should be able to get a better idea of what
went wrong with your code. <b>If you run into error messages, try to identify the problem
before asking for help.</b> You can often Google unknown error messages to see what similar mistakes
others have made to help you debug your own code.

<h3 class="section_title">Higher Order Functions</h3>

<p>Higher order functions are functions that take a function as an input, and/or
output a function. We will be exploring many applications of higher order functions.
For each question, try to determine what Python
would print. Then check in the interactive interpreter to see if you got the
right answer.</p>

<pre class="codemargin">
&gt;&gt;&gt; def square(x):
...     return x*x

&gt;&gt;&gt; def neg(f, x):
...     return -f(x)

# Q1
&gt;&gt;&gt; neg(square, 4)
_______________
&gt;&gt;&gt; def first(x):
...     x += 8
...     def second(y):
...         print('second')
...         return x + y
...     print('first')
...     return second
...
# Q2
&gt;&gt;&gt; f = first(15)
_______________
# Q3
&gt;&gt;&gt; f(16)
_______________

&gt;&gt;&gt; def foo(x):
...     def bar(y):
...         return x + y
...     return bar

&gt;&gt;&gt; boom = foo(23)
# Q4
&gt;&gt;&gt; boom(42)
_______________
# Q5
&gt;&gt;&gt; foo(6)(7)
_______________

&gt;&gt;&gt; func = boom
# Q6
&gt;&gt;&gt; func is boom
_______________
&gt;&gt;&gt; func = foo(23)
# Q7
&gt;&gt;&gt; func is boom
_______________
&gt;&gt;&gt; def troy():
...     abed = 0
...     while abed &lt; 10:
...         def britta():
...             return abed
...         abed += 1
...     abed = 20
...     return britta
...
&gt;&gt;&gt; annie = troy()
&gt;&gt;&gt; def shirley():
...     return annie
&gt;&gt;&gt; pierce = shirley()
# Q8
&gt;&gt;&gt; pierce()
________________
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>
<pre class="codemargin">
We recommend you try typing these statements into the interpreter.

1) -16
2) first
3) second
39
4) 65
5) 13
6) True
7) False
8) 20
</pre>
</p>
</div>
<?php } ?>

<h3 class="section_title">Environment Diagrams</h3>

<p>If you haven't found this gem already, tutor.composingprograms.com has a great visualization tool
for environment diagrams. Post in your python code and it will generate an environment diagram you can 
walk through step-by-step! Use it to help you check your answers!</p>

<p>Try drawing environment diagrams for the following examples and predicting
what Python will output: </p>

<pre class="codemargin">
# Q1
def square(x):
    return x * x

def double(x):
    return x + x

a = square(double(4))


# Q2
x, y = 4, 3

def reassign(arg1, arg2):
    x = arg1
    y = arg2

reassign(5, 6)


# Q3
def f(x):
  f(x)

print, f = f, print
a = f(4)
b = print(4)

# Q4
def adder_maker(x):
  def adder(y):
    return x + y
  return adder

add3 = adder_maker(3)
add3(4)
sub5 = adder_maker(-5)
sub5(6)
sub5(10) == add3(2)
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
  <?php for ($i = 0; $i < $q_num; $i++) { ?>
    $("#toggleButton<?php echo $i; ?>").click(function () {
      $("#toggleText<?php echo $i; ?>").toggle();
  });
  <?php } ?>
</script>
<?php } ?>

<h3 class="section_title">I Heard You Liked Functions So I Put Functions In Your Functions </h3>
<p>Define a function <span class='code'>cycle</span> which takes in
three functions as arguments: <span class='code'>f1</span>, <span
class='code'>f2</span>, <span class='code'>f3</span>. <span
class='code'>cycle</span> will then return another function. The
returned function should take in an integer argument <span
class='code'>n</span> and do the following:

<ol>
<li>Return a function that takes in an argument <span class='code'>x</span> and does the following:
<ol>
<li>if <span class='code'>n</span> is 0, just return <span class='code'>x</span></li>
<li>if <span class='code'>n</span> is 1, apply the first function that is passed to <span class='code'>cycle</span> to <span class='code'>x</span>
<li>if <span class='code'>n</span> is 2, the first function passed to <span class='code'>cycle</span> is applied to <span class='code'>x</span>, and then the second function passed to <span class='code'>cycle</span> is applied to the result of that (i.e. <span class='code'>f2(f1(x))</span>)
<li>if <span class='code'>n</span> is 3, apply the first, then the second, then the third function (i.e. <span class='code'>f3(f2(f1(x)))</span>)
<li>if <span class='code'>n</span> is 4, apply the first, then the second, then the third, then the first function (i.e. <span class='code'>f1(f3(f2(f1(x))))</span>)
    <li>And so forth</li>
</ol>
</ol>
<i>Hint</i>: most of the work goes inside the most nested function.

<pre class="codemargin">
def cycle(f1, f2, f3):
""" Returns a function that is itself a higher order function
&gt;&gt;&gt; def add1(x):
...     return x + 1
...
&gt;&gt;&gt; def times2(x):
...     return x * 2
...
&gt;&gt;&gt; def add3(x):
...     return x + 3
...
&gt;&gt;&gt; my_cycle = cycle(add1, times2, add3)
&gt;&gt;&gt; identity = my_cycle(0)
&gt;&gt;&gt; identity(5)
5
&gt;&gt;&gt; add_one_then_double = my_cycle(2)
&gt;&gt;&gt; add_one_then_double(1)
4
&gt;&gt;&gt; do_all_functions = my_cycle(3)
&gt;&gt;&gt; do_all_functions(2)
9
&gt;&gt;&gt; do_more_than_a_cycle = my_cycle(4)
&gt;&gt;&gt; do_more_than_a_cycle(2)
10
&gt;&gt;&gt; do_two_cycles = my_cycle(6)
&gt;&gt;&gt; do_two_cycles(1)
19
"""

"*** YOUR CODE HERE ***"
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def cycle(f1, f2, f3):
  def ret_fn(n):
    def ret(x):
      i = 0
      while i &lt; n:
        if i % 3 == 0:
          x = f1(x)
        elif i % 3 == 1:
          x = f2(x)
        else:
          x = f3(x)
        i += 1
      return x
    return ret
  return ret_fn
</pre>
</div>
<?php } ?>


</body>
</html>
