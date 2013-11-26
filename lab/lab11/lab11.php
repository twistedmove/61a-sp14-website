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

    <title>CS 61A Fall 2013: Lab 11</title>

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
    $RELEASE_DATE = new DateTime("11/28/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head>
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 11</h1>
<h2>Declarative Programming</h2>
<p>In Declarative Programming, we aim to define facts about our universe. With these in place, we can make queries in the form of assertions. The system will then check if the query is true, based on a database of facts. It will inform us of what replacements for the variables will make the query true.</p>

<p>The language we will use is called Logic, and an interpreter is already setup for us on the lab machines. To copy the folder to your current directory, run:</p>

<pre><code>    cp -r ~cs61a/lib/lab/lab11/logic .
</code></pre>

<p>Just run <code>python3 logic.py</code> after you move your Scheme project files into the folder. Please note that you must have finished up to at least problem 4 on your project in order to do this lab, as this lab depends on your implementation of the <code>Frame</code> class.</p>

<p>Let's review the basics. In Logic, the primitive data types are called symbols: these include numbers and strings. Unlike other languages we have seen in this course, numbers are not evaluated: they are still symbols, but they do not have their regular numerical meaning. Variables in Logic are denoted with a <code>?</code> mark preceding the name. So for example, <code>?x</code> represents the variable <code>x</code>. A relation is a named tuple with a truth value.</p>

<p>The next thing we need to do is begin to define facts about our universe. Facts are defined using a combination that starts with the fact keyword. The first relation that follows is the conclusion, and any remaining relations are hypotheses. All hypotheses must be satisfied for the conclusion to be valid.</p>

<pre><code>    logic&gt; (fact (food-chain ?creature1 ?creature2) (eats ?creature1 ?creature3) (eats ?creature3 ?creature2))
</code></pre>

<p>Here we have defined the fact for a food chain: If <code>creature1</code> eats <code>creature3</code>, and <code>creature3</code> eats <code>creature2</code>, then <code>creature1</code> is higher on the food chain than <code>creature2</code>.</p>

<p>Simple facts contain only a conclusion relation, which is always true.</p>

<pre><code>    logic&gt; (fact (eats shark big-fish))
    logic&gt; (fact (eats big-fish small-fish))
    logic&gt; (fact (eats domo kittens))
    logic&gt; (fact (eats kittens small-fish))
    logic&gt; (fact (eats zombie brains))
    logic&gt; (fact (append (1 2) (3 4) (1 2 3 4)))
</code></pre>

<p>Here we have defined a few simple facts: that in our universe, <code>sharks</code> eat <code>big-fish</code>, <code>big-fish</code> eat <code>small-fish</code>, <code>Domos</code> eat <code>kittens</code>, <code>kittens</code> eat <code>small-fish</code>, <code>zombies</code> eat <code>brains</code>, and that the list <code>(1 2)</code> appended to <code>(3 4)</code> is equivalent to the list <code>(1 2 3 4)</code>. Poor kittens.</p>

<p>Queries are combinations that start with the query keyword. The interpreter prints the truth value (either <code>Success!</code> or <code>Failed.</code>). If there are variables inside of the query, the interpreter will print all possible mappings that satisfy the query.</p>

<pre><code>    logic&gt; (query (eats zombie brains))
    Success!
    logic&gt; (query (eats domo zombie))
    Failed.
    logic&gt; (query (eats zombie ?what))
    Success!
    what: brains
</code></pre>

<p>We're first asking Logic whether a zombie eats brains (the answer is <code>Success!</code>) and if a domo eats zombies (the answer is <code>Failed</code>). Then we ask whether a zombie can eat something (the answer is <code>Success!</code>), and Logic will figure out for us, based on predefined facts in our universe, what a zombie eats. If there are more possible values for what a zombie can eat, then Logic will print out all of the possible values.</p>

<h4>Question</h4>

<p>Within your Logic interactive session, type in the <code>food-chain</code> fact, and enter in the facts mentioned from above. Issue a Logic query that answers the following questions:</p>

<ol>
<li>Do sharks eat big-fish?</li>
<li>What animal is higher on the food chain than small-fish?</li>
<li>What animals (if any, or multiple) eat small-fish?</li>
<li>What animals (if any, or multiple) eat sharks?</li>
<li>What animals (if any, or multiple) eat zombies?</li>
</ol>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>    logic&gt; (query (eats shark big-fish))
    logic&gt; (query (food-chain ?what small-fish))
    logic&gt; (query (eats ?what small-fish))
    logic&gt; (query (eats ?what sharks))
    logic&gt; (query (eats ?what zombie))
</code></pre>

  </div>
<?php } ?>
<h3>More complicated facts</h3>

<p>Currently, the <code>food-chain</code> fact is a little lacking. A query <code>(query (food-chain A B))</code> will only output <code>Success!</code> if <code>A</code> and <code>B</code> are separated by only one animal. For instance, if I added the following facts:</p>

<pre><code>    logic&gt; (fact (eats shark big-fish))
    logic&gt; (fact (eats big-fish small-fish))
    logic&gt; (fact (eats small-fish shrimp))
</code></pre>

<p>I'd like the <code>food-chain</code> to output that shark is higher on the food chain than shrimp. Currently, the <code>food-chain</code> fact doesn't do this:</p>

<pre><code>    logic&gt; (query (food-chain shark shrimp))
    Failed
</code></pre>

<p>We will define the <code>food-chain-v2</code> fact that correctly handles arbitrary length hierarchies. We'll use the following logic:</p>

<p>Given animals <code>A</code> and <code>B</code>, <code>A</code> is on top of the food chain of <code>B</code> if:</p>

<ul>
<li><code>A</code> eats <code>B</code></li>
</ul>

<p>or</p>

<ul>
<li>There exists an animal <code>C</code> such that <code>A</code> eats <code>C</code>, and <code>C</code> dominates <code>B</code>.</li>
</ul>

<p>Notice we have two different cases for the <code>food-chain-v2</code> fact. We can express different cases of a fact simply by entering in each case one at a time:</p>

<pre><code>    logic&gt; (fact (food-chain-v2 ?a ?b) (eats ?a ?b))
    logic&gt; (fact (food-chain-v2 ?a ?b) (eats ?a ?c) (food-chain-v2 ?c ?b))
    logic&gt; (query (food-chain-v2 shark shrimp))
    Success!
</code></pre>

<p>Take a few moments and read through how the above facts work, and how it implements the approach we outlined. In particular, make a few queries to <code>food-chain-v2</code> -- for instance, try retrieving all animals that dominate shrimp!</p>

<p>Note: In the Logic system, multiple 'definitions' of a fact can exist at the same time (as in <code>food-chain-v2</code>) - definitions don't overwrite each other. Instead, they are all checked when you execute a query against that particular fact.</p>

<h3>Recursively-Defined Rules</h3>

<p>Next, we will define append in the logic style.</p>

<p>As we've done in the past, let's try to explain how <code>append</code> recursively. For instance, given two lists <code>[1, 2, 3], [5, 7</code>], the result of <code>append([1, 2, 3], [5, 7])</code> is:</p>

<pre><code>    [1] + append([2, 3], [5, 7]) =&gt; [1, 2, 3, 5, 7]
</code></pre>

<p>In Scheme, this would look like:</p>

<pre><code>    (define (append a b) (if (null? a) b (cons (car a) (append (cdr a) b))))
</code></pre>

<p>Thus, we've broken up append into two different cases. Let's start translating this idea into Logic! The first base case is relatively straightforward:</p>

<pre><code>    logic&gt; (fact (append () ?b ?b))
    logic&gt; (query (append () (1 2 3) ?what))
    Success!
    what: (1 2 3)
</code></pre>

<p>So far so good! Now, we have to handle the general (recursive) case:</p>

<pre><code>    ;;                         A        B       C
    logic&gt; (fact (append (?car . ?cdr) ?b (?car . ?partial)) (append ?cdr ?b ?partial))
</code></pre>

<p>This translates to: the list <code>A</code> appended to <code>B</code> is <code>C</code> if <code>C</code> is the result of sticking the CAR of <code>A</code> to the result of appending the CDR of <code>A</code> to <code>B</code>. Do you see how the Logic code corresponds to the recursive case of the Scheme function definition? As a summary, here is the complete definition for append:</p>

<pre><code>    logic&gt; (fact (append () ?b ?b ))
    logic&gt; (fact (append (?a . ?r) ?y (?a . ?z)) (append ?r ?y ?z))
</code></pre>

<p>If it helps you, here's an alternate solution that might be a little easier to read:</p>

<pre><code>    logic&gt; (fact (car (?car . ?cdr) ?car))
    logic&gt; (fact (cdr (?car . ?cdr) ?cdr))
    logic&gt; (fact (append () ?b ?b))
    logic&gt; (fact (append ?a ?b (?car-a . ?partial)) (car ?a ?car-a) (cdr ?a ?cdr-a) (append ?cdr-a ?b ?partial))
</code></pre>

<p>Meditate on why this more-verbose solution is equivalent to the first definition for the append fact.</p>

<h3>Exercises</h3>

<p>1 . Using the append fact, issue the following queries, and ruminate on the outputs. Note that some of these queries might result in multiple possible outputs.</p>

<pre><code>    logic&gt; (query (append (1 2 3) (4 5) (1 2 3 4 5)))
    logic&gt; (query (append (1 2) (5 8) ?what))
    logic&gt; (query (append (a b c) ?what (a b c oh mai gawd)))
    logic&gt; (query (append ?what (so cool) (this is so cool)))
    logic&gt; (query (append ?what1 ?what2 (will this really work)))
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <p>Try it out, type it in the interpreter!</p>

  </div>
<?php } ?>
<p>2 . Define a fact <code>(fact (last-element ?lst ?x))</code> that outputs <code>Success</code> if <code>?x</code> is the last element of the input list <code>?lst</code>. Check your facts on queries such as:</p>

<pre><code>    logic&gt; (query (last-element (a b c) c))
    logic&gt; (query (last-element (3) ?x))
    logic&gt; (query (last-element (1 2 3) ?x))
    logic&gt; (query (last-element (2 ?x) (3)))
</code></pre>

<p>Does your solution work correctly on queries such as <code>(query (last-element ?x (3)))</code>? Why or why not?</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>    (fact (last-element (?x) ?x))
    (fact (last-element (?car . ?cdr) ?x) (last-element ?cdr ?x))
</code></pre>

  </div>
<?php } ?>
<p>3 . Define the fact <code>(fact (contains ?elem ?lst))</code> that outputs <code>Success</code> if the <code>?elem</code> is contained inside of the input <code>?lst</code>:</p>

<pre><code>    logic&gt; (query (contains 42 (1 2 42 5)))
    Success.
    logic&gt; (query (contains (1 2) (a b (1) (1 2) bye)))
    Success.
    logic&gt; (query (contains foo (bar baz garply)))
    Failed.
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>    (fact (contains ?elem (?elem . ?cdr)))
    (fact (contains ?elem (?car . ?cdr)) (contains ?elem ?cdr))
</code></pre>

  </div>
<?php } ?>
<h2>Challenge Problem!</h2>

<p>Implement basic math in logic. The following interactive transcript should work...</p>

<pre><code>    logic&gt; (query (2 + 2 = 4))
    Success!
    logic&gt; (query (2 + 1 = 4))
    Failed.
    logic&gt; (query (4 - 2 = 2))
    Success!
    logic&gt; (query (2 * 2 = 4))
    Success!
    logic&gt; (query (2 * ?x = 4))
    Success!
    x: 2
    logic&gt; (query (2 + ?x = 4))
    Success!
    x: 2
    logic&gt; (query (2 ?op 2 = 4))
    Success!
    op: +
    op: *
    logic&gt; (query (?a + ?b = 4))
    Success!
    a: 1    b: 3
    a: 2    b: 2
    a: 3    b: 1
    a: 4    b: 0
    logic&gt; (query (?a ?op ?b = 4))
    Success!
    a: 1    op: +   b: 3
    a: 2    op: +   b: 2
    a: 3    op: +   b: 1
    a: 4    op: +   b: 0
    a: 4    op: -   b: 0
    a: 5    op: -   b: 1
    a: 6    op: -   b: 2
    a: 7    op: -   b: 3
    a: 8    op: -   b: 4
    a: 9    op: -   b: 5
    a: 4    op: *   b: 1
    a: 1    op: *   b: 4
    a: 2    op: *   b: 2
</code></pre>

<p>Here is a skeleton to get you started. Note that we define all the possible numbers in our given universe by a successive sequence; the only numbers Logic knows about are 0 through 9.</p>

<pre><code>    (fact (succ 0 1))
    (fact (succ 1 2))
    (fact (succ 2 3))
    (fact (succ 3 4))
    (fact (succ 4 5))
    (fact (succ 5 6))
    (fact (succ 6 7))
    (fact (succ 7 8))
    (fact (succ 8 9))
    (fact (succ 9 10))

    (fact (1 + ?x = ?y) YOUR CODE HERE)
    (fact (?x + ?y = ?z) YOUR CODE HERE)

    (fact (?x - ?y = ?z) YOUR CODE HERE)

    (fact (?x * 0 = 0) YOUR CODE HERE)
    (fact (1 * ?x = ?x) YOUR CODE HERE)
    (fact (?x * 1 = ?x) YOUR CODE HERE)
    (fact (?x * ?y = ?z) YOUR CODE HERE)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>
    (fact (1 + ?x = ?y) (succ ?x ?y))
    (fact (?x + ?y = ?z) (1 + ?x-1 = ?x) (1 + ?z-1 = ?z) (?x-1 + ?y = ?z-1))

    (fact (?x - ?y = ?z) (?y + ?z = ?x))

    (fact (?x * 0 = 0) (succ ?x ?y))
    (fact (1 * ?x = ?x) (succ ?x ?y))
    (fact (?x * 1 = ?x) (succ ?x ?y))
    (fact (?x * ?y = ?z) (?x * ?y-1 = ?zz) (?zz + ?x = ?z))
</code></pre>

  </div>
<?php } ?>

  </body>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 5; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
</html>
