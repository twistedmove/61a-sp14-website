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

    
    <link rel="stylesheet" type="text/css"
          href="../../interpreter/deps/codemirror/lib/codemirror.css" />
    <link rel="stylesheet" type="text/css" href="../../interpreter/coding.css" />
    <script src="../../interpreter/deps/codemirror/lib/codemirror.js"></script>
    <script src="../../interpreter/deps/codemirror/mode/scheme/scheme.js"></script>
    <script src="../../interpreter/deps/jquery.min.js"></script>
    <script src="../../interpreter/deps/lib-xj.js"></script>
    <script src="../../interpreter/coding.js"> </script>
    <script>
      set_interpreter_path("/~cs61a/sp14/interpreter/");
      //set_interpreter_path("/interpreter/");
      set_language("logic");
    </script>


    <title>CS 61A Spring 2014: Lab 10</title>

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
    $RELEASE_DATE = new DateTime("04/24/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head>
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 10</h1>
<h2 id="title-sub">Logic</h2>
<h2>Declarative Programming</h2>

<p>In Declarative Programming, we aim to define facts about our universe.
With these in place, we can make queries in the form of assertions. The
system will then check if the query is true, based on a database of
facts. It will inform us of what replacements for the variables will
make the query true.</p>

<p>The language we will use is called Logic. An
<a href="http://inst.eecs.berkeley.edu/~cs61a/sp14/logic/logic.html">online Logic interpreter</a>
is provided for this lab, which you can use to evaluate logic
expressions on this page.
You can also use this online Logic interpreter for subsequent
homeworks.</p>

<p>Let's review the basics. In Logic, the primitive data types are called
symbols: these include numbers and strings. Unlike other languages we
have seen in this course, numbers are not evaluated: they are still
symbols, but they do not have their regular numerical meaning.
Variables in Logic are denoted with a <code>?</code> mark preceding the name. So
for example, <code>?x</code> represents the variable <code>x</code>. A relation is a named
tuple with a truth value.</p>

<p>The next thing we need to do is begin to define facts about our
universe. Facts are defined using a combination that starts with the
fact keyword. The first relation that follows is the conclusion, and
any remaining relations are hypotheses. All hypotheses must be
satisfied for the conclusion to be valid.</p>

<div id="a1">
(fact (food-chain ?creature1 ?creature2)
      (eats ?creature1 ?creature3)
      (eats ?creature3 ?creature2))
</div>

<p>Here we have defined the fact for a food chain: If <code>creature1</code> eats
<code>creature3</code>, and <code>creature3</code> eats <code>creature2</code>, then <code>creature1</code> is
higher on the food chain than <code>creature2</code>.</p>

<p>Simple facts contain only a conclusion relation, which is always true.</p>

<div id="a2">
(fact (eats shark big-fish))
(fact (eats big-fish small-fish))
(fact (eats domo kittens))
(fact (eats kittens small-fish))
(fact (eats zombie brains))
(fact (append (1 2) (3 4) (1 2 3 4)))
</div>

<p>Here we have defined a few simple facts: that in our universe, <code>sharks</code>
eat <code>big-fish</code>, <code>big-fish</code> eat <code>small-fish</code>, <code>Domos</code> eat <code>kittens</code>,
<code>kittens</code> eat <code>small-fish</code>, <code>zombies</code> eat <code>brains</code>, and that the list
<code>(1 2)</code> appended to <code>(3 4)</code> is equivalent to the list <code>(1 2 3 4)</code>. Poor
kittens.</p>

<p>Queries are combinations that start with the query keyword. The
interpreter prints the truth value (either <code>Success!</code> or <code>Failed.</code>). If
there are variables inside of the query, the interpreter will print all
possible mappings that satisfy the query.</p>

<div id="a3">
(query (eats zombie brains))
</div>

<div id="a4">
(query (eats domo zombie))
</div>

<div id="a5">
(query (eats zombie ?what))
</div>

<p>We're first asking Logic whether a zombie eats brains (the answer is
<code>Success!</code>) and if a domo eats zombies (the answer is <code>Failed</code>). Then
we ask whether a zombie can eat something (the answer is <code>Success!</code>),
and Logic will figure out for us, based on predefined facts in our
universe, what a zombie eats. If there are more possible values for
what a zombie can eat, then Logic will print out all of the possible
values.</p>

<h3 class='question'>Question 1</h3>

<p>Within your Logic interactive session, type in the <code>food-chain</code> fact,
and enter in the facts mentioned from above. Issue a Logic query that
answers the following questions:</p>

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
    <pre><code>logic&gt; (query (eats shark big-fish))
logic&gt; (query (food-chain ?what small-fish))
logic&gt; (query (eats ?what small-fish))
logic&gt; (query (eats ?what sharks))
logic&gt; (query (eats ?what zombie))
</code></pre>

  </div>
<?php } ?>
<h3>Complex facts</h3>

<p>Currently, the <code>food-chain</code> fact is a little lacking. A query <code>(query
(food-chain A B))</code> will only output <code>Success!</code> if <code>A</code> and <code>B</code> are
separated by only one animal. For instance, if I added the following
facts:</p>

<div id="a6">
(fact (eats shark big-fish))
(fact (eats big-fish small-fish))
(fact (eats small-fish shrimp))
</div>

<p>I'd like the <code>food-chain</code> to output that shark is higher on the food
chain than shrimp. Currently, the <code>food-chain</code> fact doesn't do this:</p>

<div id="a7">
(query (food-chain shark shrimp))
</div>

<p>We will define the <code>food-chain-v2</code> fact that correctly handles
arbitrary length hierarchies. We'll use the following logic:</p>

<ul>
<li>Given animals <code>A</code> and <code>B</code>, <code>A</code> is on top of the food chain of <code>B</code> if:
<ul>
<li><code>A</code> eats <code>B</code>, OR</li>
<li>There exists an animal <code>C</code> such that <code>A</code> eats <code>C</code>, and <code>C</code>
dominates <code>B</code>.</li>
</ul></li>
</ul>

<p>Notice we have two different cases for the <code>food-chain-v2</code> fact. We can
express different cases of a fact simply by entering in each case one
at a time:</p>

<div id="a8">
(fact (food-chain-v2 ?a ?b) (eats ?a ?b))
(fact (food-chain-v2 ?a ?b) (eats ?a ?c) (food-chain-v2 ?c ?b))
(query (food-chain-v2 shark shrimp))
</div>

<p>Take a few moments and read through how the above facts work, and how
it implements the approach we outlined. In particular, make a few
queries to <code>food-chain-v2</code> -- for instance, try retrieving all animals
that dominate shrimp!</p>

<p><em>Note</em>: In the Logic system, multiple 'definitions' of a fact can exist
at the same time (as in <code>food-chain-v2</code>) - definitions don't overwrite
each other. Instead, they are all checked when you execute a query
against that particular fact.</p>

<h3>Recursively-Defined Rules</h3>

<p>Next, we will define append in the logic style.</p>

<p>As we've done in the past, let's try to explain how <code>append</code>
recursively. For instance, given two lists <code>[1, 2, 3], [5, 7</code>], the
result of <code>append([1, 2, 3], [5, 7])</code> is:</p>

<pre><code>[1] + append([2, 3], [5, 7]) =&gt; [1, 2, 3, 5, 7]
</code></pre>

<p>In Scheme, this would look like:</p>

<pre><code>(define (append a b) (if (null? a) b (cons (car a) (append (cdr a) b))))
</code></pre>

<p>Thus, we've broken up append into two different cases. Let's start
translating this idea into Logic! The first base case is relatively
straightforward:</p>

<pre><code>logic&gt; (fact (append () ?b ?b))
logic&gt; (query (append () (1 2 3) ?what))
Success!
what: (1 2 3)
</code></pre>

<p>So far so good! Now, we have to handle the general (recursive) case:</p>

<pre><code>;;                A        B       C
logic&gt; (fact (append (?car . ?cdr) ?b (?car . ?partial)) (append ?cdr ?b ?partial))
</code></pre>

<p>This translates to: the list <code>A</code> appended to <code>B</code> is <code>C</code> if <code>C</code> is the
result of sticking the CAR of <code>A</code> to the result of appending the CDR of
<code>A</code> to <code>B</code>. Do you see how the Logic code corresponds to the recursive
case of the Scheme function definition? As a summary, here is the
complete definition for append:</p>

<div id="a9">
(fact (append () ?b ?b ))
(fact (append (?a . ?r) ?y (?a . ?z)) (append ?r ?y ?z))
</div>

<p>If it helps you, here's an alternate solution that might be a little
easier to read:</p>

<div id="a10">
(fact (car (?car . ?cdr) ?car))
(fact (cdr (?car . ?cdr) ?cdr))
(fact (append () ?b ?b))
(fact (append ?a ?b (?car-a . ?partial)) (car ?a ?car-a) (cdr ?a ?cdr-a) (append ?cdr-a ?b ?partial))
</div>

<p>Meditate on why this more-verbose solution is equivalent to the first
definition for the append fact.</p>

<h3 class='question'>Question 2</h3>

<p>Using the append fact, issue the following queries, and ruminate on the
outputs. Note that some of these queries might result in multiple
possible outputs.</p>

<pre><code>logic&gt; (query (append (1 2 3) (4 5) (1 2 3 4 5)))
logic&gt; (query (append (1 2) (5 8) ?what))
logic&gt; (query (append (a b c) ?what (a b c oh mai gawd)))
logic&gt; (query (append ?what (so cool) (this is so cool)))
logic&gt; (query (append ?what1 ?what2 (will this really work)))
</code></pre>

<div id="a11">
(fact (append () ?b ?b ))
(fact (append (?a . ?r) ?y (?a . ?z)) (append ?r ?y ?z))
; Try out the queries here! Type ctrl-Enter once you're done typing
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <p>Try it out, type it in the interpreter!</p>

  </div>
<?php } ?>
<h3 class='question'>Question 3</h3>

<p>Define a fact <code>(fact (last-element ?lst ?x))</code> that outputs <code>Success</code> if
<code>?x</code> is the last element of the input list <code>?lst</code>.</p>

<div id="a12">
; YOUR CODE HERE; type ctrl-enter once you're done typing

(query (last-element (a b c) c))
(query (last-element (3) ?x))
(query (last-element (1 2 3) ?x))
(query (last-element (2 ?x) (3)))
</div>

<p>Does your solution work correctly on queries such as <code>(query
(last-element ?x (3)))</code>? Why or why not?</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>(fact (last-element (?x) ?x))
(fact (last-element (?car . ?cdr) ?x) (last-element ?cdr ?x))
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 4</h3>

<p>Write a fact "firsts" that, when input with a list of lists, gives us the first element of each list.</p>

<p>When you finish, the following queries should succeed:</p>

<div id="a13">
; YOUR CODE HERE

(query (firsts ((1 2 3 4) (2 3 4 5) (1 2 3 4) (1 2 3 2)) ?x))
; ?x should be (1 2 1 1)

(query (firsts (2 3 4) (3 4 5) (2 3 4) (2 3 2)) ?y))
; ?y should be (1 2 1 1)
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>(fact (firsts () ()))
(fact (firsts ((?x . ?_) . ?ls) (?x . ?xs))
      (firsts ?ls ?xs))
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 5</h3>

<p>Now, instead of getting us the firsts, let's gather the rests!</p>

<p>When you finish, the following queries should succeed:</p>

<div id="a14">
; YOUR CODE HERE

(query (rests ((1 2 3 4) (2 3 4 5) (1 2 3 4) (1 2 3 2)) ?x))
; ?x should be ((2 3 4) (3 4 5) (2 3 4) (2 3 2))

(query (rests (2 3 4) (3 4 5) (2 3 4) (2 3 2)) ?y))
; ?y should be ((3 4) (4 5) (3 4) (3 2))
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>(fact (rests () ()))
(fact (rests ((?_ . ?r) . ?ls) (?r . ?xs))
      (rests ?ls ?xs))
</code></pre>

  </div>
<?php } ?>
<h3>Sudoku</h3>

<p>Assume we have the two facts insert and anagram as follows</p>

<div id="sudoku">
(fact (insert ?a ?r (?a . ?r)))
(fact (insert ?a (?b . ?r) (?b . ?s)) (insert ?a ?r ?s))
(fact (anagram () ()))
(fact (anagram (?a . ?r) ?b) (insert ?a ?s ?b) (anagram ?r ?s))
</div>

<p>With our anagram fact, we can write a few more facts to help us solve a 4 by 4 Sudoku puzzle!
In our version of Sudoku, our objective is to fill a 4x4 grid such that each column and each row of our simple grid contain all of the digits from 1 to 4.</p>

<h3 class='question'>Question 6</h3>

<p>Let's start by defining our grid using our fact dubbed boxes. Fill in the remainder of the fact.</p>

<div id="boxes">
(fact (boxes ((?a ?b ?c ?d)
              (?e ?f ?g ?h)
              (?i ?j ?k ?l)
              (?m ?n ?o ?p)))
      (anagram (?a ?b ?e ?f) (1 2 3 4))
      ; YOUR CODE HERE
                                      )
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>(fact (boxes ((?a ?b ?c ?d)
              (?e ?f ?g ?h)
              (?i ?j ?k ?l)
              (?m ?n ?o ?p)))
      (anagram (?a ?b ?e ?f) (1 2 3 4))
      (anagram (?c ?d ?g ?h) (1 2 3 4))
      (anagram (?i ?j ?m ?n) (1 2 3 4))
      (anagram (?k ?l ?o ?p) (1 2 3 4)))
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 7</h3>

<p>Next, let's define a fact of specifying the rules for each row in our grid.
The input to rows will be the entire 4x4 grid. Fill in rest of the facts in the prompt below:</p>

<div id="rows">
(fact (rows ()))
; YOUR CODE HERE
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>(fact (rows ()))
(fact (rows (?x . ?xs))
      (anagram ?x (1 2 3 4))
      (rows ?xs))
</code></pre>

  </div>
<?php } ?>
<p>When you finish, the following queries should return the correct values:</p>

<div id="rows-doc">
(query (rows ((1 ?b  4 ?d)
              (?e  3 2  1) 
              (?i  4 3  2) 
              ( 2 4 3 ?p))))
</div> 

<h3 class='question'>Question 8</h3>

<p>Next, let's define the fact specifying the rules for each column in our grid.
Again, remember the the entire grid will be the input to our column query.</p>

<div id="cols">
(fact (cols (() () () ())))
; YOUR CODE HERE
</div>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>(fact (cols (() () () ())))
(fact (cols ((?a . ?as) (?b . ?bs) (?c . ?cs) (?d . ?ds)))
      (anagram (?a ?b ?c ?d) (1 2 3 4))
      (cols (?as ?bs ?cs ?ds)))
</code></pre>

  </div>
<?php } ?>
<p>When you finish, the following queries should return the correct values:</p>

<div id="cols-doc">
(query (cols ((1 ?b  4 ?d)
              (?e  3 2  1) 
              (?i  4 3  2) 
              ( 2 4 3 ?p))))
</div>

<h3 class='question'>Question 9</h3>

<p>Now, let's put all of this together to solve our any 4x4 Sudoku grid. Fill in the fact below to do so.</p>

<p><div id="solve">
(fact (solve ?grid)
; YOUR CODE HERE
~ prompt ~ </p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <p>(fact (solve ?grid)
      (boxes ?grid)
      (rows ?grid)
      (cols ?grid))</p>

  </div>
<?php } ?>
<p>When you finish, check your solution with the following queries:
<div id="solve-doc">
(query (solve ((?a ?b ?c ?d)
               (?e ?f ?g ?h)
               (?i ?j ?k ?l)
               (?m ?n ?o ?p))))</p>

<p>(query (solve (( 1 ?b  4 ?d)
               (?e  3 ?g  1)
               (?i  4 ?k  2)
               ( 2 ?n  3 ?p))))
~ prompt ~</p>
<script>
prompt("a1", []);
prompt("a2", []);
prompt("a3", ["a2"]);
prompt("a4", ["a2"]);
prompt("a5", ["a2"]);
prompt("a6", []);
prompt("a7", ["a6"]);
prompt("a8", ["a6"]);
prompt("a9", []);
prompt("a10", []);
prompt("a11", []);
prompt("a12", ["a9"]);
prompt("a13", ["a9"]);
prompt("a14", ["a9"]);
prompt("sudoku", []);
prompt("boxes", ["sudoku"]);
prompt("rows", ["boxes"]);
prompt("rows-doc", ["rows"]);
prompt("cols", ["rows"]);
prompt("cols-doc", ["cols"]);
prompt("solve", ["cols"]);
prompt("solve-doc", ["solve"]);
</script>

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 9; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
