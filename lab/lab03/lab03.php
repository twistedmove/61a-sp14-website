<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
    <meta name="description" content ="CS61A: Structure and Interpretation of Computer Programs" /> 
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, Berkeley, EECS" /> 
    <meta name="author" content ="Amir Kamil, Hamilton Nguyen, Joy Jeng, Keegan Mann, Stephen Martinis, Albert Wu,
                                  Julia Oh, Robert Huang, Mark Miyashita, Sharad Vikram, Soumya Basu, Richard Hwang" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <style type="text/css">@import url("https://inst.eecs.berkeley.edu/~cs61a/su12/lab/lab_style.css");</style> 

    <title>CS 61A Fall 2013: Lab 3</title> 

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
    $RELEASE_DATE = new DateTime("02/12/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  
  <body style="font-family: Georgia,serif;"> 

<h1>CS61A Lab 3: Recursion and Midterm Review</h1>
<h3>Week 4, Spring 2013</h3>

<h3 class="section_title">Warm Up: Recursion Basics</h3>
<p> A recursive function is a function that calls itself in its body, either
directly or indirectly. Recursive functions have two important components:
<br>    1. Base case(s), where the function directly computes an answer without 
calling itself. Usually the base case deals with the simplest possible form
of the problem you're trying to solve.
<br>    2. Recursive case(s), where the function calls itself as part of the
computation.
<br>
<br> Let's look at the canonical example, factorial:</p>
<pre class="codemargin">
def factorial(n):
    if n == 0:
        return 1
    return n * factorial(n - 1)
</pre>

<p> We know by its definition that 0! is 1. So we choose n = 0 as our base
case. The recursive step also follows from the definition of factorial, i.e.
n! = n * (n-1)!.
<br> The next few questions in lab will have you writing recursive functions.
Here are some general tips:
<br>
<br> 1. Always start with the base case. The base case handles the simplest
argument your function would have to handle. The answer is extremely simple,
and often follows from the definition of the problem.
<br>
<br> 2. Make a recursive call with a slightly simpler argument. This is called
the "leap of faith" - your simpler argument should simplify the problem, and you
should assume that the recursive call for this simpler problem will just work.
As you do more problems, you'll get better at this step.
<br>
<br> 3. Use the recursive call. Remember that the recursive call solves a simpler
version of the problem. Now ask yourself how you can use this result to solve the
original problem.</p>

<h3 class="section_title">Exercise 1: In summation...</h3>
<p>1. Write a function <tt>sum</tt> that takes a single argument <tt>n</tt> and
computes the sum of all integers between 0 and <tt>n</tt>. Assume <tt>n</tt>
is non-negative.</p>

</br>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def sum(n):
    if n == 0:
        return 0
    return n + sum(n-1)
</pre>
</div>
<?php } ?>

<p>2. Implement <tt>ab_plus_c</tt>, a function that takes arguments
<tt>a</tt>,<tt>b</tt>, and <tt>c</tt> and computes <tt>a*b + c</tt>.
You can assume a and b are both positive integers. However, you can't 
use the <tt>*</tt> operator. Try recursion!</p>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def ab_plus_c(a, b, c):
    if b == 0:
        return c
    return a + ab_plus_c(a, b-1, c)
</pre>
</div>
<?php } ?>

<p>3. Now write the recursive version of <tt>summation</tt>. Recall that
<tt>summation</tt> takes two arguments, a number <tt>n</tt> and a function
<tt>term</tt>, and returns the result of applying <tt>term</tt> to every 
number between 0 and <tt>n</tt> and taking the sum.</p>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def summation(n, term):
    if n == 0:
        return term(0)
    return term(n) + summation(n-1, term)
</pre>
</div>
<?php } ?>

<h3 class="section_title">Exercise 2: Hailstone 2, Recursive Boogaloo</h3>

<p>1. Recall the <tt>hailstone</tt> function from homework 1. You pick a positive
integer <tt>n</tt> as the start. If <tt>n</tt> is even, divide it by 2. If <tt>n
</tt> is odd, multiply it by 3 and add 1. Repeat this process until <tt>n</tt> is
1. Write a recursive version of hailstone that prints out the values of the 
sequence and returns the number of steps.</p>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def hailstone(n):
    print(n)
    if n == 1:
        return 1
    elif n % 2 == 0:
        return 1 + hailstone(n / 2)
    else:
        return 1 + hailstone(3*n + 1)
</pre>
</div>
<?php } ?>


<h3 class="section_title">Exercise 3: <span class="code">repeated</span>, repeated</h3>

<p>In homework 2 you encountered the <tt>repeated</tt> function, which takes
arguments <tt>f</tt> and <tt>n</tt> and returns a function equivalent to the
nth repeated application of <tt>f</tt>. This time, we want to write <tt>
repeated</tt> recursively. You'll want to use <tt>compose1</tt>, given below
for your convenience:</p>

<pre class="codemargin">
def compose1(f, g):
    """"Return a function h, such that h(x) = f(g(x))."""
    def h(x):
        return f(g(x))
    return h
</pre>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def repeated(f, n):
    if n == 0:
        return lambda x: x #Identity 
    return compose1(f, repeated(f, n-1))
</pre>
</div>
<?php } ?>


<p>This concludes the recursion portion of this lab. As a parting thought,
keep in mind that recursion follows the same rules of evaluation that we've
seen throughout the class. Try taking one of the above exercises and 
typing it into the online tutor! The remainder of the exercises will be
various review problems.</p>

<h3 class="section_title">Exercise 4: A Fistful of Functions</h3>

<p>For each of the following expressions, what must <tt>f</tt> be in order
for the evaluation of the expression to succeed, without causing an error?
Give a definition of <tt>f</tt> for each expression such that evaluating
the expression will not cause an error.</p>

<pre class="codemargin">
f
f()
f(3)
f()()
f()(3)()
</pre>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
f = 3
f = lambda: 3
f = lambda x: x
f = lambda: lambda: 3
f = lambda: lambda x: lambda: x
</pre>
</div>
<?php } ?>

<h3 class="section_title">Exercise 5: For A Few Lambdas More</h3>

<p> Find the value of the following three expressions, using the given 
values of <tt>t</tt> and <tt>s</tt>.</p>

<pre class="codemargin">
t = lambda f: lambda x: f(f(f(x)))
s = lambda x: x + 1

t(s)(0) # 1

t(t(s))(0) # 2

t(t)(s)(0) # 3
</pre>

<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
#1: 3

#2: 9

#3: 27
</pre>
</div>
<?php } ?>

<h3 class="section_title">Exercise 6: The <span class="code">While</span> Bunch</h3>

<p>In lecture, you saw that it was possible to compute factorial iteratively. Let's
introduce a new function, a "falling" factorial that takes two arguments, <tt>n</tt>
and <tt>k</tt> and returns the product of <tt>k</tt> consecutive numbers, starting 
from <tt>n</tt> and working downwards. We're going to write this iteratively - use a 
<tt>while</tt> loop, instead of recursion. </p>


<br>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def falling(n, k):
    total, stop = 1, n-k
    while n > stop:
        total, n = total*n, n-1
    return total
</pre>
</div>
<?php } ?>

<h3 class="section_title">Exercise 7: Butch Cassidy and the Environment Diagram</h3>

<p>Draw the environment diagram for the following code:</p>

<pre class="codemargin">
def blondie(f):
    return lambda x: f(x + 1)

tuco = blondie(lambda x: x * x)
angel_eyes = tuco(2)
</pre>
  </body>
</html>
