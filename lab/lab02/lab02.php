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
    $RELEASE_DATE = new DateTime("02/06/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 2</h1>
<h2 id="title-sub">Control Flow and Higher Order Functions</h2>
<h3>Python flags</h3>

<p>Sometimes, you can append certain "flags" on the command line to
inspect your code further. Here are a few useful ones that'll come in
handy this semester. If you want to learn more about other python
flags, you can type <code>man python</code></p>

<ul>
<li><p><strong>no flags:</strong> Adding no flags will directly run your Python script,
meaning that Python will run the code in the file you provide and
return you to the command line.</p>

<pre><code>python3 FILE_NAME
</code></pre></li>
<li><p><strong>-i</strong>: The <em>-i</em> option runs your Python script, and throws you into
an interactive session.  If you omit the -i option, Python will only
run your script. See the next section regarding interactive sessions
to learn more!</p>

<pre><code>python3 -i FILE_NAME
</code></pre></li>
<li><p><strong>-m doctest</strong>: Using <em>-m doctest</em> option will be useful on your
homeworks and projects to help you test your code by showing you
whether your code is working as you intend it to. Doctests are
marked by triple quotations (""") and are usually located within the
function.</p>

<pre><code>python3 -m doctest FILE_NAME
</code></pre></li>
<li><p><strong>-v</strong>: The <em>-v</em> option signifies a verbose option. You can append
this flag to the <em>-m doctest</em> flag to show both passing and failing
tests. With the <em>-v</em> flag, you will be notified of all results (both
failing and passing tests).</p>

<pre><code>python3 -m doctest -v FILE_NAME
</code></pre></li>
</ul>

<h3>Interactive sessions</h3>

<p>Sometimes, you just want to try some things out in the python
interpreter. If you want to test out functions in a file, you'll need
the <code>-i</code> flag as we specified above.</p>

<p>However, if you just need to try something out in the interpreter,
without any user defined functions this is how you start an
interactive session:</p>

<pre><code>python3
</code></pre>

<p>On Cygwin:</p>

<pre><code>python3 -i
</code></pre>

<h2>Control Structures</h2>

<h3 class='question'>Question 1: What would Python print?</h3>

<p>Predict what Python will print in response to each of these
expressions.  Then try it and make sure your answer was correct, or if
not, that you understand why! Remember, to start Python, type <code>python3</code>
into the command line.</p>

<pre><code># Q1
&gt;&gt;&gt; a = 1
&gt;&gt;&gt; b = a + 1
&gt;&gt;&gt; a + b + a * b 
______________

# Q2
&gt;&gt;&gt; a == b
______________

# Q3
&gt;&gt;&gt; z, y = 1, 2
&gt;&gt;&gt; print(z)
______________

# Q4
&gt;&gt;&gt; def square(x):
...     print(x * x)        # Hit enter twice
...
&gt;&gt;&gt; a = square(b)
______________

# Q5
&gt;&gt;&gt; print(a)
______________

# Q6
&gt;&gt;&gt; def square(y):
...     return y * y        # Hit enter twice
...
&gt;&gt;&gt; a = square(b)
&gt;&gt;&gt; print(a)
_______________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <ol>
<li><code>5</code></li>
<li><code>False</code></li>
<li><code>1</code></li>
<li><code>4</code></li>
<li><code>None</code></li>
<li><code>4</code></li>
</ol>

  </div>
<?php } ?>
<h2>Boolean operators</h2>

<h3 class='question'>Question 2</h3>

<p>What would Python print? Try to figure it out before
you type it into the interpreter!</p>

<pre><code># Q1
&gt;&gt;&gt; a, b = 10, 6
&gt;&gt;&gt; a &gt; b and a == 0
_______________

# Q2
&gt;&gt;&gt; a &gt; b or a == 0
_______________

# Q3
&gt;&gt;&gt; not a &gt; 0
_______________

# Q4
&gt;&gt;&gt; a != 0
_______________

# Q5
&gt;&gt;&gt; True and False
_______________

# Q6
&gt;&gt;&gt; True or False
_______________

# Q7
&gt;&gt;&gt; not True and False
_______________

# Q8
&gt;&gt;&gt; not (True and False)
_______________

# Q9
&gt;&gt;&gt; False or False
_______________

# Q10
&gt;&gt;&gt; True and True or True and False
_______________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <ol>
<li><code>False</code></li>
<li><code>True</code></li>
<li><code>False</code></li>
<li><code>True</code></li>
<li><code>False</code></li>
<li><code>True</code></li>
<li><code>False</code></li>
<li><code>True</code></li>
<li><code>False</code></li>
<li><code>True</code></li>
</ol>

  </div>
<?php } ?>
<h3>Boolean order of operations</h3>

<p>Just like with mathematical operators, boolean operators (<code>and</code>, <code>or</code>,
and <code>not</code>) have an order of operations, too:</p>

<ul>
<li><code>not</code> (highest priority)</li>
<li><code>and</code></li>
<li><code>or</code> (lowest priority)</li>
</ul>

<p>For example, the following expression will evaluate to <code>True</code>:</p>

<pre><code>True and not False or not True and False
</code></pre>

<p>It might be easier to rewrite the expression like this:</p>

<pre><code>(True and (not False)) or ((not True) and False)
</code></pre>

<p>If you find writing parentheses to be clearer, it is perfectly
acceptable to do so in your code.</p>

<h3>Short-circuit operators</h3>

<p>In Python, <code>and</code> and <code>or</code> are examples of <em>short-circuit operators</em>.
Consider the following line of code:</p>

<pre><code>10 &gt; 3 or 1 / 0 != 1
</code></pre>

<p>Generally, operands are evaluated from left to right in Python. The
expression <code>10 &gt; 3</code> will be evaluated first, then <code>1 / 0 != 1</code> will be
evaluated. The problem is, evaluating <code>1 / 0</code> will cause Python to
raise an error, stopping function evaluation altogether! (You can try
dividing by 0 in the interpreter).</p>

<p>However, the original line of code will not cause any errors -- in
fact, it will evaluate to <code>True</code>. This is made possible due to
short-circuiting, which works in the following ways:</p>

<ul>
<li><code>and</code> will evaluate to <code>True</code> only if <em>all</em> the operands are <code>True</code>.
For multiple <code>and</code> statements, Python will go left to right until it
runs into the first <code>False</code> value -- then it will just immediately
evaluate to <code>False</code>.</li>
<li><code>or</code> will evaluate to <code>True</code> if <em>at least one</em> of the operands is
<code>True</code>. For multiple <code>or</code> statements, Python will go left to right
until it runs into the first <code>True</code> value -- then it will
immediately evaluate to <code>True</code>.</li>
</ul>

<p>Some examples:</p>

<pre><code>&gt;&gt;&gt; True and False and 1 / 0 == 1     # stops at the False
False
&gt;&gt;&gt; True and 1 / 0 == 1 and False     # hits the division by zero
Traceback (most recent call last):
...
ZeroDivisionError: division by zero

&gt;&gt;&gt; True or 1 / 0 == 1                # stops at the True
True
&gt;&gt;&gt; False or 1 / 0 == 1 or True       # hits the division by zero
Traceback (most recent call last):
...
ZeroDivisionError: division by zero
</code></pre>

<h2>if statements</h2>

<h3 class='question'>Question 3</h3>

<p>What would the Python interpreter display?</p>

<pre><code>&gt;&gt;&gt; a, b = 10, 6

# Q1
&gt;&gt;&gt; if a == b:
...     a
... else:
...     b
...
_______________

# Q2
&gt;&gt;&gt; if a == 4:
...     6
... elif b &gt;= 4:
...     6 + 7 + a
... else: 
...     25
...
________________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <ol>
<li><code>6</code></li>
<li><code>23</code></li>
<li><p>This output contains two lines:</p>

<pre><code>10
6
</code></pre></li>
</ol>

  </div>
<?php } ?>
<h3>Common Mistakes with if statments</h3>

<ol>
<li><p>Using <code>=</code> instead of <code>==</code>: remember, <code>=</code> (single equals) is used
for <em>assignment</em>, while <code>==</code> (double equals) is used for
<em>comparison</em>.</p>

<pre><code># bad
&gt;&gt;&gt; if a = b:
...     print("uh oh!")
...

# good!
&gt;&gt;&gt; if a == b:
...     print("yay!")
...
</code></pre></li>
<li><p>Multiple comparisons: for example, trying to check if both <code>x</code> and
<code>y</code> are greater than 0.</p>

<pre><code># bad
&gt;&gt;&gt; if x and y &gt; 0:
...     print("uh oh!")
...

# good!
&gt;&gt;&gt; if x &gt; 0 and y &gt; 0:
...     print("yay!")
...
</code></pre></li>
</ol>

<h3>Omitting the <code>else</code></h3>

<p>Consider the following function:</p>

<pre><code>&gt;&gt;&gt; def abs(x):
...     if x &gt;= 0:
...         return x
...     else:
...         return -x
...
</code></pre>

<p>It is syntactically correct to rewrite <code>abs</code> in the following way:</p>

<pre><code>&gt;&gt;&gt; def abs(x):
...     if x &gt;= 0:
...         return x
...     return -x       # missing else statement!
...
</code></pre>

<p>This is possible as a direct consequence of how <code>return</code> works -- when
Python sees a <code>return</code> statement, it will <em>immediately terminate</em> the
function, and the rest of the function will not be evaluated.  In the
above example, if <code>x &gt;= 0</code>, Python will never reach the final line.
Try to convince yourself that this is indeed the case before moving
on.</p>

<p>Keep in mind that <strong>omitting the <code>else</code> only work if the function is
terminated</strong>!  For example, the following function will <em>always</em> print
"less than zero", because the function is not terminated in the body
of the <code>if</code> suite:</p>

<pre><code>&gt;&gt;&gt; def foo(x):
...     if x &gt; 0:
...         print("greater than zero")
...     print("less than zero")
...
&gt;&gt;&gt; foo(-3)
less than zero
&gt;&gt;&gt; foo(4)
greater than zero
less than zero
</code></pre>

<p>In general, omitting the <code>else</code> will make your code more concise --
however, if you find that it makes your code harder to read, by all
means use an <code>else</code> statement.</p>

<h2>while loops</h2>

<h3 class='question'>Question 4</h3>

<p>What would Python print?</p>

<pre><code>&gt;&gt;&gt; n = 2
&gt;&gt;&gt; def exp_decay(n):
...     if n % 2 != 0:
...         return
...     while n &gt; 0:
...         print(n)
...         n = n // 2 # See exercise 3 for an explanation of what '//' stands for
...
&gt;&gt;&gt; exp_decay(1024)
__________________
&gt;&gt;&gt; exp_decay(5)
__________________

&gt;&gt;&gt; def funky(k):
...     while k &lt; 50:
...         if k % 2 == 0:
...             k += 13
...         else:
...             k += 1
...         print(k)
...     return k
&gt;&gt;&gt; funky(25)
__________________

&gt;&gt;&gt; n, i = 7, 0
&gt;&gt;&gt; while i &lt; n:
...     i += 2
...     print(i)
__________________

&gt;&gt;&gt; n = 3
&gt;&gt;&gt; while n &gt; 0:
...     n -= 1
...     print(n)
__________________

&gt;&gt;&gt; n = 3
&gt;&gt;&gt; while n &gt;= 0:
...     n -= 1
...     print(n)
__________________

&gt;&gt;&gt; n = 4
&gt;&gt;&gt; while True:
...     n -= 1
...     print(n)
__________________

&gt;&gt;&gt; n = 10
&gt;&gt;&gt; while n &gt; 0:
...     if n % 2 == 0:
...         n -= 1
...     elif n % 2 != 0:
...         n -= 3
...     print(n)
__________________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <ol>
<li><p>This output contains 3 lines:</p>

<pre><code>1024
512
256
</code></pre></li>
<li><p>This output contains 8 lines:</p>

<pre><code>128
64
32
16
8
4
2
1
</code></pre></li>
<li>Nothing shows up</li>
<li><p>This output contains 5 lines:</p>

<pre><code>26
39
40
53
53
</code></pre></li>
<li>This output contains 4 lines:
    2
    4
    6
    8</li>
<li>This output contains 3 lines:
    2
    1
    0</li>
<li>This output contains 3 lines:
    2
    1
    0
    -1</li>
<li>This output goes on forever!
    3
    2
    1
    0
    -1
    -2
    ...</li>
<li>This output contains 6 lines:
    9
    6
    5
    2
    1
    -2</li>
</ol>

  </div>
<?php } ?>
<h3>Division</h3>

<p>Before we write our next function, let's compare the ideas of true
division (single slash <code>/</code> in Python; does decimal division), floor
division (double slash <code>//</code> in Python; rounds down to the nearest
integer), and modulo (percent sign <code>%</code> in Python; similar to a
remainder):</p>

<ul>
<li>True Division (decimal division):
    &gt;&gt;&gt; 1 / 4
    0.25
    &gt;&gt;&gt; 4 / 2
    2.0
    &gt;&gt;&gt; 5/3
    1.666666666667</li>
<li>Floor Division (integer division):
    &gt;&gt;&gt; 1 // 4
    0
    &gt;&gt;&gt; 4 // 2
    2
    &gt;&gt;&gt; 5 // 3
    1</li>
<li>Modulo (similar to a remainder):
    &gt;&gt;&gt; 1 % 4
    1
    &gt;&gt;&gt; 4 % 2
    0
    &gt;&gt;&gt; 5 % 3
    2</li>
</ul>

<p>Given the operators above, the following relationship holds:</p>

<pre><code>b * (a // b) + (a % b) = a
</code></pre>

<p>Now, define a function <code>factors(n)</code> which takes in a number, n, and
prints out all of the numbers that divide <code>n</code> evenly. For example, a
call with <code>n = 20</code> should result as follows (order doesn’t matter):</p>

<pre><code>&gt;&gt;&gt; factors(20)
20
10
5
4
2
1
</code></pre>

<p><em>Hint</em>: One common use of the <code>%</code> operator is to find if something
divides evenly into a number. For example:</p>

<pre><code>&gt;&gt;&gt; 10 % 5
0
&gt;&gt;&gt; 10 % 4
2
&gt;&gt;&gt; 10 % 7
3
&gt;&gt;&gt; 10 % 2
0
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def factors(n):
    x = n
    while x &gt; 0:
        if (n % x == 0):
            print(x)
        x -= 1
</code></pre>

  </div>
<?php } ?>
<p>Next, write a function <code>divide(num, divisor)</code> without using the '/' or
'//'. </p>

<pre><code>def divide(num, divisor):
    """
    &gt;&gt;&gt; divide(8, 2)
    4
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<p><em>Hint</em>: Use a <code>while</code> loop.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def divide(num, divisor):
    count = 0
    while num &gt; 0:
        num -= divisor
        count += 1
    return count
</code></pre>

  </div>
<?php } ?>
<h3>Error messages</h3>

<p>By now, you've probably seen a couple of error messages. Even though
they might look intimidating, error messages are actually very helpful
in debugging code. The following are some common error messages (found
at the bottom of a traceback):</p>

<ul>
<li><strong>SyntaxError</strong>: Indicates that your code contains improper syntax
(e.g.  missing a colon after an <code>if</code> statement).</li>
<li><strong>IndentationError</strong>: Indicates that your code contains improper
indentation (e.g. inconsistent indentation of a function body)</li>
<li><strong>TypeError</strong>: Indicates an attempted operation on incompatible
types (e.g.  trying to add a function and an int)</li>
<li><strong>ZeroDivisionError</strong>: Indicates an attempted division by zero.</li>
</ul>

<p>Using these descriptions of error messages, you should be able to get
a better idea of what went wrong with your code. <strong>If you run into
error messages, try to identify the problem before asking for
help.</strong> You can often Google unknown error messages to see what
similar mistakes others have made to help you debug your own code.</p>

<p>Here's a link to a helpful <a href="http://inst.eecs.berkeley.edu/~cs61a-te/notes/debugging.html">Debugging Guide</a>
written by Albert Wu.</p>

<h2>Higher Order Functions</h2>

<p>Higher order functions are functions that take a function as an input,
and/or output a function. We will be exploring many applications of
higher order functions. </p>

<h3 class='question'>Question 5</h3>

<p>For each question, try to determine what Python would print. Then
check in the interactive interpreter to see if you got the right
answer.</p>

<pre><code>&gt;&gt;&gt; def square(x):
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
...     while abed &amp;lt; 10:
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
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <p>We recommend you try typing these statements into the interpreter.</p>

<ol>
<li>-16</li>
<li>first</li>
<li>This output has two lines:
    second
    3</li>
<li>65</li>
<li>13</li>
<li>True</li>
<li>False</li>
<li>20</li>
</ol>

  </div>
<?php } ?>
<h3>Environment Diagrams</h3>

<p>If you haven't found this gem already,
<a href="http://tutor.composingprograms.com">tutor.composingprograms.com</a>
has a great visualization tool for environment diagrams. Post in your
python code and it will generate an environment diagram you can walk
through step-by-step! Use it to help you check your answers!</p>

<p>Try drawing environment diagrams for the following examples and
predicting what Python will output: </p>

<pre><code># Q1
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
</code></pre>

<h3 class='question'>Question 6: I heard you liked functions so I put functions in your functions</h3>

<p>Define a function <code>cycle</code> which takes in three functions as arguments:
<code>f1</code>, <code>f2</code>, <code>f3</code>. <code>cycle</code> will then return another function. The
returned function should take in an integer argument <code>n</code> and do the
following:</p>

<ol>
<li>Return a function that takes in an argument <code>x</code> and does the following:
<ol>
<li>if <code>n</code> is 0, just return <code>x</code></li>
<li>if <code>n</code> is 1, apply the first function that is passed to <code>cycle</code>
to <code>x</code></li>
<li>if <code>n</code> is 2, the first function passed to <code>cycle</code> is applied to
<code>x</code>, and then the second function passed to cycle is applied to
the result of that (i.e. <code>f2(f1(x))</code>)</li>
<li>if <code>n</code> is 3, apply the first, then the second, then the third
function (i.e. <code>3(f2(f1(x)))</code>)</li>
<li>if <code>n</code> is 4, apply the first, then the second, then the third,
then the first function (i.e. <code>f1(f3(f2(f1(x))))</code>)</li>
<li>And so forth.</li>
</ol></li>
</ol>

<p><em>Hint</em>: most of the work goes inside the most nested function.</p>

<pre><code>def cycle(f1, f2, f3):
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
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>def cycle(f1, f2, f3):
    def ret_fn(n):
        def ret(x):
            i = 0
            while i &amp;lt; n:
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
</code></pre>

  </div>
<?php } ?>
<p></p>

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 8; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
