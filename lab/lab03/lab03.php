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

    <title>CS 61A Spring 2014: Lab 3</title> 

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
    $RELEASE_DATE = new DateTime("02/13/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 3</h1>
<h2 id="title-sub">Lambdas, Recursion, and Sequences</h2>
<h2>Starter Files</h2>

<p>We've provided a set of starter files with skeleton code for the
exercises in the lab. You can get them in the following places:</p>

<ul>
<li><a href="starter/recursion.py">recursion.py</a></li>
<li><a href="starter/tuples.py">tuples.py</a></li>
</ul>

<h2>Lambda Expressions</h2>

<p><em>Lambda expressions</em> are one-line functions that specify two things:
the parameters; and the return value.</p>

<pre><code>lambda [parameters]: [return value]
</code></pre>

<p>One difference between using the <code>def</code> keyword and <code>lambda</code>
expressions is that <code>def</code> is a <em>statement</em>, while lambda is an
<em>expression</em>. Evaluating a <code>def</code> statement will have a side effect;
namely, it creates a new function binding in the current environment.
On the other hand, evaluating a <code>lambda</code> expression will not change the
environment unless we do something with this expression. For instance,
we could assign it to a variable or pass it in as a function argument.</p>

<h3 class='question'>Question 1</h3>

<p>For each of the following expressions, what must <code>f</code> be in order for
the evaluation of the expression to succeed, without causing an error?
Give a definition of <code>f</code> for each expression such that evaluating the
expression will not cause an error.</p>

<pre><code>&gt;&gt;&gt; f = ______
&gt;&gt;&gt; f
3
&gt;&gt;&gt; f = ______
&gt;&gt;&gt; f()
3
&gt;&gt;&gt; f = ______
&gt;&gt;&gt; f(3)
3
&gt;&gt;&gt; f = ______
&gt;&gt;&gt; f()()
3
&gt;&gt;&gt; f = ______
&gt;&gt;&gt; f()(3)()
3
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>f = 3
f = lambda: 3
f = lambda x: x
f = lambda: lambda: 3
f = lambda: lambda x: lambda: x
</code></pre>

  </div>
<?php } ?>
<h3>Environment Diagrams</h3>

<p>Try drawing environment diagrams for the following code and predicting
what Python will output:</p>

<pre><code># Q1
a = lambda x : x * 2 + 1

def b(x):
    return x * y

y = 3
b(y)
_________

def c(x):
    y = a(x)
    return b(x) + a(x+y)
c(y)
_________


# Q2: This one is pretty tough. A carefully drawn environment
# diagram will be really useful.
g = lambda x: x + 3

def wow(f):
    def boom(g):
      return f(g)
    return boom

f = wow(g)
f(2)
_________
g = lambda x: x * x
f(3)
_________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <p>Please use the online environment diagram drawer, linked at the bottom
of the class webpage.</p>

<ol>
<li>9 (for the first blank), 30 (for the second blank).</li>
<li>5 (for the first blank), 6 (for the second blank). Notice that the
line g = lambda x: x * x doesn't change what f(3) does!</li>
</ol>

  </div>
<?php } ?>
<h2>Recursion</h2>

<h3>Warm Up: Recursion Basics</h3>

<p>A recursive function is a function that calls itself in its body,
either directly or indirectly. Recursive functions have two important
components:</p>

<ol>
<li>Base case(s), where the function directly computes an answer
without calling itself. Usually the base case deals with the
simplest possible form of the problem you're trying to solve.</li>
<li>Recursive case(s), where the function calls itself as part of the
computation.</li>
</ol>

<p>Let's look at the canonical example, factorial:</p>

<pre><code>def factorial(n):
    if n == 0:
        return 1
    return n * factorial(n - 1)
</code></pre>

<p>We know by its definition that 0! is 1. So we choose n = 0 as our
base case. The recursive step also follows from the definition of
factorial, i.e.  n! = n * (n-1)!.</p>

<p>The next few questions in lab will have you writing recursive
functions.  Here are some general tips:</p>

<ol>
<li>Always start with the base case. The base case handles the simplest
argument your function would have to handle. The answer is
extremely simple, and often follows from the definition of the
problem.</li>
<li><p>Make a recursive call with a slightly simpler argument. This is
called the "leap of faith" - your simpler argument should simplify
the problem, and you should assume that the recursive call for this
simpler problem will just work.  As you do more problems, you'll
get better at this step.</p></li>
<li><p>Use the recursive call. Remember that the recursive call solves a
simpler version of the problem. Now ask yourself how you can use
this result to solve the original problem.</p></li>
</ol>

<h3 class='question'>Question 2: In summation...</h3>

<p>Write the recursive version of <code>summation</code>, which
takes two arguments, a number <code>n</code> and a function
<code>term</code>, applies <code>term</code> to every number
between 0 and <code>n</code>, and returns the sum of those results.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>def summation(n, term):
    if n == 0:
        return term(0)
    return term(n) + summation(n-1, term)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 3</h3>

<p>The greatest common divisor of two positive integers <code>a</code> and <code>b</code> is the
largest integer which evenly divides both numbers (with no remainder).
Euclid, a Greek mathematician in 300 B.C., realized that the greatest
common divisor of <code>a</code> and <code>b</code> is one of the following:</p>

<ul>
<li>the smaller value if it evenly divides the larger value, OR</li>
<li>the greatest common divisor of the smaller value and the remainder of
the larger value divided by the smaller value</li>
</ul>

<p>In other words, if <code>a</code> is greater than <code>b</code> and <code>a</code> is not divisible by
<code>b</code>, then</p>

<pre><code>gcd(a, b) == gcd(b, a % b)
</code></pre>

<p>Write the <code>gcd</code> function using Euclid's algorithm.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>def gcd_rec(a, b):
    a, b = max(a, b), min(a, b)
    if a % b == 0:
        return b
    else:
        return gcd_rec(b, a % b

def gcd_iter(a, b):
    if a &lt; b:
        return gcd_iter(b, a)
    while a &gt; b and not a % b == 0:
        a, b = b, a % b
    return b
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 4: Recursive Boogaloo</h3>

<p>For the <code>hailstone</code> function from homework 1,  you
pick a positive integer <code>n</code> as the start. If <code>n</code> is even, divide it
by 2. If <code>n</code> is odd, multiply it by 3 and add 1. Repeat this process
until <code>n</code> is 1. Write a recursive version of hailstone that prints out
the values of the sequence and returns the number of steps.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def hailstone(n):
    print(n)
    if n == 1:
        return 1
    elif n % 2 == 0:
        return 1 + hailstone(n / 2)
    else:
        return 1 + hailstone(3*n + 1)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 5</h3>

<p>Consider an insect in an <em>M</em> by <em>N</em> grid. The insect starts at the top
left corner, <em>(0, 0)</em>, and wants to end up at the bottom right corner,
<em>(M-1, N-1)</em>. The insect is only capable of moving right or down. Write
a function <code>count_paths</code> that takes a grid length and width and returns
the number of different paths the insect can take from the start to the
goal. (There is a closed-form solution to this problem, but try to
answer it procedurally using recursion.)</p>

<p><img src="assets/grid.jpg" alt="grid" /></p>

<p>For example, the 2 by 2 brid has a total of two ways for the insect to
move from the start to the goal. For the 3 by 3 grid, the insect has 6
diferent paths (only 3 are shown above).</p>

<pre><code>def paths(m, n):
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def paths(m, n):
    if m == 1 or n == 1:
        return 1
    return paths(m - 1, n) + paths(m, n - 1)
</code></pre>

  </div>
<?php } ?>
<h2>Tuples</h2>

<h3>What would Python print?</h3>

<p>Predict what Python will display when you type the following into the
interpreter. Then try it to check your answers.</p>

<h3 class='question'>Question 6</h3>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3)
&gt;&gt;&gt; x[0]     # Q1
______
&gt;&gt;&gt; x[3]     # Q2
______

&gt;&gt;&gt; x[-1]    # Q3
______
&gt;&gt;&gt; x[-3]    # Q4
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <ol>
<li>1</li>
<li>IndexError</li>
<li>3</li>
<li>1</li>
</ol>

  </div>
<?php } ?>
<h3 class='question'>Question 7</h3>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3, 4)
&gt;&gt;&gt; x[1:3]       # Q1
______
&gt;&gt;&gt; x[:2]        # Q2
______
&gt;&gt;&gt; x[1:]        # Q3
______
&gt;&gt;&gt; x[-2:3]      # Q4
______
&gt;&gt;&gt; x[::2]       # Q5
______
&gt;&gt;&gt; x[::-1]      # Q6
______
&gt;&gt;&gt; x[-1:0:-1]   # Q7
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <ol>
<li>(2, 3)</li>
<li>(1, 2)</li>
<li>(2, 3, 4)</li>
<li>(3,)</li>
<li>(1, 3)</li>
<li>(4, 3, 2, 1)</li>
<li>(4, 3, 2)</li>
</ol>

  </div>
<?php } ?>
<h3 class='question'>Question 8</h3>

<pre><code>&gt;&gt;&gt; y = (1,)
&gt;&gt;&gt; len(y)       # Q1
______
&gt;&gt;&gt; 1 in y       # Q2
______

&gt;&gt;&gt; y + (2, 3)   # Q3
______
&gt;&gt;&gt; (0,) + y     # Q4
______
&gt;&gt;&gt; y * 3        # Q5
______

&gt;&gt;&gt; z = ((1, 2), (3, 4, 5))
&gt;&gt;&gt; len(z)       # Q6
______
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <ol>
<li>1</li>
<li>True</li>
<li>(1, 2, 3)</li>
<li>(0, 1)</li>
<li>(1, 1, 1)</li>
<li>2</li>
</ol>

  </div>
<?php } ?>
<h3 class='question'>Question 9</h3>

<p>For each of the following, give the correct expression to get 7.</p>

<pre><code>&gt;&gt;&gt; x = (1, 3, 5, 7)
&gt;&gt;&gt; x[-1]    # example
7

&gt;&gt;&gt; x = (1, 3, (5, 7), 9)
&gt;&gt;&gt; # YOUR EXPRESSION INVOLVING x HERE
7

&gt;&gt;&gt; x = ((7,),)
&gt;&gt;&gt; # YOUR EXPRESSION INVOLVING x HERE
7

&gt;&gt;&gt; x = (1, (2, (3, (4, (5, (6, (7,)))))))
&gt;&gt;&gt; # YOUR EXPRESSION INVOLVING x HERE
7
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
    <ol>
<li><code>x[2][1]</code></li>
<li><code>x[0][0]</code></li>
<li><code>x[1][1][1][1][1][1][0]</code></li>
</ol>

  </div>
<?php } ?>
<h3 class='question'>Question 10</h3>

<p>Write a function <code>reverse</code> that takes a tuple and returns the reverse.
Write both an iterative and a recursive version. You may use slicing
notation, but don't use <code>tup[::-1]</code>.</p>

<pre><code>def reverse_iter(tup):
    """Returns the reverse of the given tuple.

    &gt;&gt;&gt; reverse_iter((1, 2, 3, 4))
    (4, 3, 2, 1)
    """
    "*** YOUR CODE HERE ***"

def reverse_recursive(tup):
    """Returns the reverse of the given tuple.

    &gt;&gt;&gt; reverse_revursive((1, 2, 3, 4))
    (4, 3, 2, 1)
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton10">Toggle Solution</button>
  <div id="toggleText10" style="display: none">
    <pre><code>def reverse_iter(tup):
    new, i = (), 0
    while i &lt; len(tup):
        new = (tup[i],) + new
        i += 1
    return new

def reverse_recursive(tup):
    if not tup:
        return ()
    return reverse_recursive(tup[1:]) + (tup[0],)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 11</h3>

<p>Write a recursive function <code>merge</code> that takes 2 <em>sorted</em> tuples <code>tup1</code> and
<code>tup2</code>, and returns a new tuple that contains all the elements in the
two tuples in sorted order. </p>

<pre><code>def merge(tup1, tup2):
    """Merges two sorted tuples.

    &gt;&gt;&gt; merge((1, 3, 5), (2, 4, 6))
    (1, 2, 3, 4, 5, 6)
    &gt;&gt;&gt; merge((), (2, 4, 6))
    (2, 4, 6)
    &gt;&gt;&gt; merge((1, 2, 3), ())
    (1, 2, 3)
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton11">Toggle Solution</button>
  <div id="toggleText11" style="display: none">
    <pre><code>def merge(tup1, tup2):
    if not tup1 or not tup2:
        return tup1 + tup2
    elif tup1[0] &lt; tup2[0]:
        return (tup1[0],) + merge(tup1[1:], tup2)
    else:
        return (tup2[0],) + merge(tup1, tup2[1:])
</code></pre>

  </div>
<?php } ?>
<h3>Immutability</h3>

<p>One last thing about tuples: they're <em>immutable</em> data structures. This
means that once they are created, they can't be changed. For example,
try this:</p>

<pre><code>&gt;&gt;&gt; x = (1, 2, 3)
&gt;&gt;&gt; x[0] = 4
</code></pre>

<p>This will cause TypeError complaining that tuples don't "support item
assignment." In other words, you can't change the elements in a tuple
because tuples are immutable. Later in the course, we'll see the
opposite -- <em>mutable</em> data structures.</p>

<!-- Not included this year.
    ~ include: rlists ~
-->

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 12; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
