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
    $RELEASE_DATE = new DateTime("09/19/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 3</h1>
<h2>Recursion and Midterm Review</h2>
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

<h3>Exercise 1: In summation...</h3>

<p><strong>Problem 1</strong>: Write a function <code>sum</code> that takes a single argument <code>n</code>
and computes the sum of all integers between 0 and <code>n</code>. Assume <code>n</code> is
non-negative.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>def sum(n):
    if n == 0:
        return 0
    return n + sum(n-1)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 2</strong>: Implement <code>ab_plus_c</code>, a function that takes arguments
<code>a</code>, <code>b</code>, and <code>c</code> and computes <code>a*b + c</code>.  You can assume a and b are
both positive integers. However, you can't use the <code>*</code> operator. Try
recursion!</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>def ab_plus_c(a, b, c):
    if b == 0:
        return c
    return a + ab_plus_c(a, b-1, c)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 3</strong>: Now write the recursive version of <code>summation</code>. Recall
that <code>summation</code> takes two arguments, a number <code>n</code> and a function
<code>term</code>, and returns the result of applying <code>term</code> to every number
between 0 and <code>n</code> and taking the sum.</p>

<pre><code>def summation(n, term):
    if n == 0:
        return term(0)
    return term(n) + summation(n-1, term)
</code></pre>

<h3>Exercise 2: Hailstone 2, Recursive Boogaloo</h3>

<p>Recall the <code>hailstone</code> function from homework 1. You
pick a positive integer <code>n</code> as the start. If <code>n</code> is even, divide it
by 2. If <code>n</code> is odd, multiply it by 3 and add 1. Repeat this process
until <code>n</code> is 1. Write a recursive version of hailstone that prints out
the values of the sequence and returns the number of steps.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
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
<h3>Exercise 3: <code>repeated</code>, repeated</h3>

<p>In Homework 2 you encountered the <code>repeated</code> function, which takes
arguments <code>f</code> and <code>n</code> and returns a function equivalent to the nth
repeated application of <code>f</code>. This time, we want to write <code>repeated</code>
recursively. You'll want to use <code>compose1</code>, given below for your
convenience:</p>

<pre><code>def compose1(f, g):
    """"Return a function h, such that h(x) = f(g(x))."""
    def h(x):
        return f(g(x))
    return h
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>def repeated(f, n):
    if n == 0:
        return lambda x: x #Identity 
    return compose1(f, repeated(f, n-1))
</code></pre>

  </div>
<?php } ?>
<p>This concludes the recursion portion of this lab. As a parting
thought, keep in mind that recursion follows the same rules of
evaluation that we've seen throughout the class. Try taking one of the
above exercises and typing it into the online tutor! The remainder of
the exercises will be various review problems.</p>

<h3>Exercise 4: A Fistful of Functions</h3>

<p>For each of the following expressions, what must <code>f</code> be in order for
the evaluation of the expression to succeed, without causing an error?
Give a definition of <code>f</code> for each expression such that evaluating the
expression will not cause an error.</p>

<pre><code>f
f()
f(3)
f()()
f()(3)()
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>f = 3
f = lambda: 3
f = lambda x: x
f = lambda: lambda: 3
f = lambda: lambda x: lambda: x
</code></pre>

  </div>
<?php } ?>
<h3>Exercise 5: For A Few Lambdas More</h3>

<p>Find the value of the following three expressions, using the given
values of <code>t</code> and <code>s</code>.</p>

<pre><code>t = lambda f: lambda x: f(f(f(x)))
s = lambda x: x + 1

t(s)(0) # 1

t(t(s))(0) # 2

t(t)(s)(0) # 3
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>#1: 3

#2: 9

#3: 27
</code></pre>

  </div>
<?php } ?>
<h3>The <code>while</code> Bunch</h3>

<p>In lecture, you saw that it was possible to compute factorial
iteratively. Let's introduce a new function, a "falling" factorial
that takes two arguments, <code>n</code> and <code>k</code> and returns the product of <code>k</code>
consecutive numbers, starting from <code>n</code> and working downwards. We're
going to write this iteratively - use a <code>while</code> loop, instead of
recursion. </p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>def falling(n, k):
    total, stop = 1, n-k
    while n &gt; stop:
        total, n = total*n, n-1
    return total
</code></pre>

  </div>
<?php } ?>
<h3>Exercise 7: Calculus... approximately.</h3>

<p>You hae seen continuous calculus in mathematics. However, there's
another definition of the derivative. Call the discrete derivative of
a function <code>f</code> the quantity: <code>&amp;Delta;f(n) = f(n+1) - f(n)</code>. Write a
higher order function <code>make_deriv</code> that takes as input <code>f</code> and
returns another function that calculates the discrete derivative.</p>

<p>Now, this type of calculus actually mirrors what you already know.
For example, the product rule actually holds as well in some form: <code>
&amp;Delta;f(n)g(n) = &amp;Delta;f(n) g(n+1) + &amp;Delta;g(n) f(n)</code> Write
another higher order function called <code>make_product</code> that takes two
functions <code>f</code> and <code>g</code> and returns a function that computes the
discrete derivative of the product. You can use the <code>make_deriv</code>
function that you defined above.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>def make_deriv(f):
    def deriv(n):
        return f(n+1) - f(n)
    return deriv

def make_product(f,g):
    deriv_f = make_deriv(f)
    deriv_g = make_deriv(g)
    def product(n):
        return deriv_f(n)*g(n+1) + deriv_g(n)*f(n)
    return product
</code></pre>

  </div>
<?php } ?>
<h3>Exercise 8: Butch Cassidy and the Environment Diagram</h3>

<p>Draw the environment diagram for the following code:</p>

<pre><code>def blondie(f):
    return lambda x: f(x + 1)

tuco = blondie(lambda x: x * x)
angel_eyes = tuco(2)
</code></pre>

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
