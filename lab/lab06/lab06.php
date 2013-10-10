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
    $RELEASE_DATE = new DateTime("10/17/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 5</h1>
<h2>Recursive Data Structures</h2>
<p>We've provided a starter file with skeleton code for the exercises in
the lab. You can get it at the following link:</p>

<ul>
<li><a href="./lab6.py">lab6.py</a></li>
</ul>

<h3>Recursive Lists</h3>

<p>In lecture, we introduced the OOP version of an <code>Rlist</code>:</p>

<pre><code>class Rlist():
    class EmptyList():
        def __repr__(self):
            return "Rlist.empty"

    empty = EmptyList()

    def __init__(self, first, rest=empty):
        self.first = first
        self.rest = rest

    def __repr__(self):
        args = repr(self.first)
        if self.rest is not Rlist.empty:
            args += ", " + repr(self.rest)
        return "Rlist({})".format(args)
</code></pre>

<p>Just like before, these <code>Rlists</code> have a first and a rest. The difference is
that, now, the <code>Rlists</code> are mutable.</p>

<p>To check if an <code>Rlist</code> is empty, compare it against the class variable
<code>Rlist.empty</code>:</p>

<pre><code>if rlist is Rlist.empty:
    return 'This rlist is empty!'
</code></pre>

<p>Don't construct another <code>EmptyList</code>!</p>

<p>Also note that this definition of <code>Rlist</code> also has a <code>__repr__</code> function that
returns a string representation of the list.</p>

<p><strong>Problem 1</strong>: Predict what Python will display when the following lines are
typed into the interpreter:</p>

<pre><code>&gt;&gt;&gt; Rlist(1, Rlist(2))
_____
&gt;&gt;&gt; Rlist()
_____
&gt;&gt;&gt; rlist = Rlist(1, Rlist(2, Rlist(3)))
&gt;&gt;&gt; rlist.first
_____
&gt;&gt;&gt; rlist.rest.first
_____
&gt;&gt;&gt; rlist.rest.rest.rest is Rlist.empty
_____
&gt;&gt;&gt; rlist.first = 9001
&gt;&gt;&gt; rlist.first
_____
&gt;&gt;&gt; rlist.rest = rlist.rest.rest
&gt;&gt;&gt; rlist.rest.first
_____
&gt;&gt;&gt; rlist = Rlist(1)
&gt;&gt;&gt; rlist.rest = rlist
&gt;&gt;&gt; rlist.rest.rest.rest.rest.first
_____
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <ol>
<li>Rlist(1, Rlist(2))</li>
<li>TypeError</li>
<li>1</li>
<li>2</li>
<li>True</li>
<li>9001</li>
<li>3</li>
<li>1</li>
</ol>

  </div>
<?php } ?>
<h3>List folding</h3>

<p>A recursive list can be represented as a series of <code>Rlist</code> constructors, where
<code>Rlist.rest</code> is either another recursive list or the empty list.</p>

<p>We represent such a list in the diagram below:</p>

<p><img src="./rightfold.png" alt="Right fold" /></p>

<p>In this diagram, the recursive list</p>

<pre><code>Rlist(1, Rlist(2, Rlist(3, Rlist(4,Rlist(5)))))
</code></pre>

<p>is represented with <code>:</code> as the constructor and <code>[]</code> as the empty list.</p>

<p>We define a function <code>foldr</code> that takes in a function <code>f</code> which takes two
arguments, and a value <code>z</code>. <code>foldr</code> essentially replaces the <code>Rlist</code> constructor
with f, and the empty list with <code>z</code>. It then evaluates the expression and
returns the result. This is equivalent to:</p>

<pre><code>f(1, f(2, f(3, f(4, f(4, z)))))
</code></pre>

<p>We call this operation a right fold.</p>

<p>Similarily we can define a left fold <code>foldl</code> that folds a list starting from the
beginning, such that the function <code>f</code> will be applied this way:</p>

<pre><code>f(f(f(f(f(z, 1), 2), 3), 4), 5)
</code></pre>

<p><img src="./leftfold.png" alt="Left fold" /></p>

<p>Also notice that a left fold is equivilant to python's <code>reduce</code> with 3 arguments.</p>

<p><strong>Problem 2</strong>: Write the left fold function by filling in the blanks.</p>

<pre><code>def foldl(rlist, fn, z):
    """ Left fold
    &gt;&gt;&gt; lst = Rlist(3, Rlist(2, Rlist(1)))
    &gt;&gt;&gt; foldl(lst, sub, 0) # (((0 - 3) - 2) - 1)
    -6
    &gt;&gt;&gt; foldl(lst, add, 0) # (((0 + 3) + 2) + 1)
    6
    &gt;&gt;&gt; foldl(lst, mul, 1) # (((1 * 3) * 2) * 1)
    6
    """
    if rlist == Rlist.empty:
        return z
    return foldl(______, ______, ______)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>foldl(rlist.rest, fn, fn(z, rlist.first))
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 3</strong>: Now write the right fold function.</p>

<pre><code>def foldr(rlist, fn, z):
    """ Right fold
    &gt;&gt;&gt; lst = Rlist(3, Rlist(2, Rlist(1)))
    &gt;&gt;&gt; foldr(lst, sub, 0) # (3 - (2 - (1 - 0)))
    2
    &gt;&gt;&gt; foldr(lst, add, 0) # (3 + (2 + (1 + 0)))
    6
    &gt;&gt;&gt; foldr(lst, mul, 1) # (3 * (2 * (1 * 1)))
    6
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>def foldr(rlist, fn, z):
    if rlist == Rlist.empty:
        return z
    return fn(rlist.first, foldr(rlist.rest, fn, z))
</code></pre>

  </div>
<?php } ?>
<p>Now that we've written the fold functions, let's write some useful functions
  using list folding!</p>

<p><strong>Problem 4</strong>: Write the <code>mapl</code> function, which takes in a Rlist <code>list</code> and a
function <code>fn</code>, and returns a new Rlist where every element is the function
applied to every element of the original list. Use either <code>foldl</code> or
<code>foldr</code>. Hint: it is much easier to write with one of them than the other!</p>

<pre><code>def mapl(lst, fn):
    """ Maps FN on LST
    &gt;&gt;&gt; list = Rlist(3, Rlist(2, Rlist(1)))
    &gt;&gt;&gt; mapl(list, lambda x: x*x)
    Rlist(9, Rlist(4, Rlist(1)))
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>def map(lst, fn):
    return foldr(lst, lambda x, xs: Rlist(fn(x), xs), Rlist.empty)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 5</strong>: Write the <code>filterl</code> function, using either <code>foldl</code> or <code>foldr</code>.</p>

<pre><code>def filterl(lst, pred):
    """ Filters LST based on PRED
    &gt;&gt;&gt; list = Rlist(4, Rlist(3, Rlist(2, Rlist(1))))
    &gt;&gt;&gt; filterl(list, lambda x: x % 2 == 0)
    Rlist(4, Rlist(2))
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def filterl(lst, pred):
    def filtered(x, xs):
        if pred(x):
            return Rlist(x, xs)
        return xs
    return foldr(lst, filtered, Rlist.empty)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 6</strong>: Use foldl to write <code>reverse</code>, which takes in a recursive list and
  reverses it. Hint: It only takes one line!</p>

<pre><code>def reverse(lst):
    """ Reverses LST with foldl
    &gt;&gt;&gt; reverse(Rlist(3, Rlist(2, Rlist(1))))
    Rlist(1, Rlist(2, Rlist(3)))
    &gt;&gt;&gt; reverse(Rlist(1))
    Rlist(1)
    &gt;&gt;&gt; reverse(Rlist.empty)
    Rlist.empty
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def reverse(lst):
    return foldl(lst, lambda x, y: Rlist(y, x), Rlist.empty)

def reverse2(lst):
    if lst is Rlist.empty:
        return lst
    elif lst.rest is not Rlist.empty:
        second, last = lst.rest, lst
        lst = reverse2(second)
        second.rest, last.rest = last, Rlist.empty
    return lst
</code></pre>

  </div>
<?php } ?>
<p>Extra for experts: Write a version of reverse that do not use the <code>Rlist</code>
constructor. You do not have to use <code>foldl</code> or <code>foldr</code>.</p>

<p><strong>Problem 7 Extra for Experts</strong>: Write foldl using foldr! You only need to fill
  in the <code>step</code> function.</p>

<pre><code>def foldl2(rlist, fn, z):
    """ Extra for Experts
    &gt;&gt;&gt; list = Rlist(3, Rlist(2, Rlist(1)))
    &gt;&gt;&gt; foldl2(list, sub, 0) # (((0 - 3) - 2) - 1)
    -6
    &gt;&gt;&gt; foldl2(list, add, 0) # (((0 + 3) + 2) + 1)
    6
    &gt;&gt;&gt; foldl2(list, mul, 1) # (((1 * 3) * 2) * 1)
    6
    """
    def step(x, g):
        "*** YOUR CODE HERE ***"
    return foldr(rlist, step, identity)(z)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>def foldl2(rlist, fn, z):
    def step(x, g):
        return lambda a: g(fn(a, x))
    return foldr(rlist, step, identity)(z)
</code></pre>

  </div>
<?php } ?>
<h3>Trees</h3>

<p>Trees are a way we have of representing a hierarchy of information. A family
tree is a good example of something with a tree structure. You have a matriarch
and a patriarch followed by all the descendants. Alternately, we may want to
organize a series of information geographically. At the very top, we have the
world, but below that we have countries, then states, then cities. We can also
decompose arithmetic operations into something much the same way.</p>

<p><img src="./firstTrees.png" alt="Trees" /></p>

<p>The name "tree" comes from the branching structure of the pictures, like real
trees in nature except that they're drawn with the root at the top and the
leaves at the bottom.</p>

<p>Terminology</p>

<pre><code>node     - a point in the tree. In these pictures, each node includes a label (value at each node)
root     - the node at the top. Every tree has one root node
children - the nodes directly beneath it. Arity is the number of children that
           node has.
leaf     - a node that has no children. (Arity of 0!)
</code></pre>

<h3>Binary Trees</h3>

<p>In this course, we will only be working with binary trees, where each node as at
most two children. For a general binary tree, order does not matter.
Additionally, the tree does not have to be balanced. It can be as lopsided as
one long chain.</p>

<p>Take a moment to study our implementation of binary trees. The implementation of
trees is in <code>lab6.py</code>.</p>

<p><strong>Problem 8</strong>: Define the function <code>size_of_tree</code> which takes in a tree as an
argument and returns the number of non-empty nodes in the tree.</p>

<pre><code>def size_of_tree(tree):
    """ Return the number of non-empty nodes in TREE
    &gt;&gt;&gt; t
    Tree(4, Tree(2, Tree(8, Tree(7), None), Tree(3, Tree(1), Tree(6))), Tree(1, Tree(5), Tree(3, Tree(2), Tree(9))))
    &gt;&gt;&gt; size_of_tree(t)
    12
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>def size_of_tree(tree):
    if not tree:
        return 0
    return 1 + size_of_tree(tree.left) + size_of_tree(tree.right)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 9</strong>: Define the function <code>deep_tree_reverse</code>, which takes a tree and
reverses the given order.</p>

<pre><code>def deep_tree_reverse(tree):
    """ Reverses the order of a tree
    &gt;&gt;&gt; a = t.copy()
    &gt;&gt;&gt; deep_tree_reverse(a)
    &gt;&gt;&gt; a
    Tree(4, Tree(1, Tree(3, Tree(9), Tree(2)), Tree(5)), Tree(2, Tree(3, Tree(6), Tree(1)), Tree(8, None, Tree(7))))
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <pre><code>def deep_tree_reverse(tree):
    if tree:
        tree.left, tree.right = tree.right, tree.left
        deep_tree_reverse(tree.left)
        deep_tree_reverse(tree.right)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 10</strong>: Define the function filter_tree which takes in a tree as an
  argument and returns the same tree, but with items included or excluded based
  on the pred argument.</p>

<p>Note that there is ambiguity about what excluding a tree means. For this
function, when you exclude a subtree, you exclude all of its children as well.</p>

<pre><code>def filter_tree(tree, pred):
    """ Removes TREE if entry of TREE satisfies PRED
    &gt;&gt;&gt; a = t.copy()
    &gt;&gt;&gt; filter_tree(a, lambda x: x % 2 == 0)
    Tree(4, Tree(2, Tree(8), None), None)
    &gt;&gt;&gt; a = t.copy()
    &gt;&gt;&gt; filter_tree(a, lambda x : x &gt; 2)
    Tree(4)
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
    <pre><code>def filter_tree(tree, pred):
    if tree and pred(tree.entry):
        return Tree(tree.entry,
                    filter_tree(tree.left, pred),
                    filter_tree(tree.right, pred))
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 11</strong>: Define the function <code>max_of_tree</code> which takes in a <code>tree</code> as an
  argument and returns the max of all of the values of each node in the tree.</p>

<pre><code>def max_of_tree(tree):
    """ Returns the max of all the values of each node in TREE
    &gt;&gt;&gt; t
    Tree(4, Tree(2, Tree(8, Tree(7), None), Tree(3, Tree(1), Tree(6))), Tree(1, Tree(5), Tree(3, Tree(2), Tree(9))))
    &gt;&gt;&gt; max_of_tree(t)
    9
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton10">Toggle Solution</button>
  <div id="toggleText10" style="display: none">
    <pre><code>def max_of_tree(tree):
    if not tree:
        return None
    return max(filter(lambda t: t is not None, (
        tree.entry,
        max_of_tree(tree.left),
        max_of_tree(tree.right)
        )))
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
