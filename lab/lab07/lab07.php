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

    <title>CS 61A Fall 2013: Lab 7</title> 

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
    $RELEASE_DATE = new DateTime("10/24/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 7</h1>
<h2>Sets & Orders of Growth</h2>
<p>We've provided a starter file with skeleton code for the exercises in the
lab. You can get it at the following link:</p>

<ul>
<li><a href="./lab7.py">lab7.py</a></li>
</ul>

<h3>Sets</h3>

<p>A set is an unordered collection of distinct objects that supports membership
testing, union, intersection, and adjunction.</p>

<p>Construction</p>

<pre><code>&gt;&gt;&gt; s = {3, 2, 1, 4, 4}
&gt;&gt;&gt; s
{1, 2, 3, 4}
</code></pre>

<p>Adjunction</p>

<pre><code>&gt;&gt;&gt; s.add(5)
&gt;&gt;&gt; s
{1, 2, 3, 4, 5}
</code></pre>

<p>Operations</p>

<pre><code>&gt;&gt;&gt; 3 in s
True
&gt;&gt;&gt; 7 not in s
True
&gt;&gt;&gt; len(s)
5
&gt;&gt;&gt; s.union({1, 5})
{1, 2, 3, 4, 5}
&gt;&gt;&gt; s.intersection({6, 5, 4, 3})
{3, 4, 5}
</code></pre>

<p>For more detail on Sets you can go to the following link:
<a href="http://docs.python.org/py3k/library/stdtypes.html#set">PythonSets</a></p>

<p><strong>Problem 1</strong>: Implement the union function for sets. Union takes in two sets,
and returns a new set with elements from the first set, and all other elements
that have not already have been seen in the second set.</p>

<pre><code>def union(s1, s2):
    """Returns the union of two sets.

    &gt;&gt;&gt; r = {0, 6, 6}
    &gt;&gt;&gt; s = {1, 2, 3, 4}
    &gt;&gt;&gt; t = union(s, {1, 6})
    &gt;&gt;&gt; t
    {1, 2, 3, 4, 6}
    &gt;&gt;&gt; union(r, t)
    {0, 1, 2, 3, 4, 6}
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>def union(s1,s2):
    union_set = set()
    for elem in s1:
        union_set.add(elem)
    for elem in s2:
        union_set.add(elem)
    return union_set
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 2</strong>: Implement the intersection function for two sets. Intersection
takes in two sets and returns a new set of only the elements in both sets.</p>

<pre><code>def intersection(s1, s2):
    """Returns the intersection of two sets.

    &gt;&gt;&gt; r = {0, 1, 4, 0}
    &gt;&gt;&gt; s = {1, 2, 3, 4}
    &gt;&gt;&gt; t = intersection(s, {3, 4, 2})
    &gt;&gt;&gt; t
    {2, 3, 4}
    &gt;&gt;&gt; intersection(r, t)
    {4}
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>def intersection(s1, s2):
    intersection_set = set()
    for elem in s1:
        if elem in s2:
            intersection_set.add(elem)
    return intersection_set
</code></pre>

  </div>
<?php } ?>
<h3>Orders of Growth</h3>

<p>One really convenient thing about sets is that many operations on sets (adding
elements, removing elements, checking membership) run in O(1) (constant)
time. If you are interested on how, look up HashSets or look at the third
challenge problem <a href="http://inst.eecs.berkeley.edu/~cs61a-td/">here</a>.</p>

<p><strong>Problem 3</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def extra_elem(a,b):
    """B contains every element in A, and has one additional member, find
    the additional member.

    &gt;&gt;&gt; extra_elem(['dog', 'cat', 'monkey'], ['dog', 'cat', 'monkey', 'giraffe'])
    'giraffe'
    &gt;&gt;&gt; extra_elem([1, 2, 3, 4, 5], [1, 2, 3, 4, 5, 6])
    6
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>def extra_elem(a,b):
    """B contains every element in A, and has one additional member, find
    the additional member.

    &gt;&gt;&gt; extra_elem(['dog', 'cat', 'monkey'], ['dog', 'cat', 'monkey', 'giraffe'])
    'giraffe'
    &gt;&gt;&gt; extra_elem([1, 2, 3, 4, 5], [1, 2, 3, 4, 5, 6])
    6
    """
    return list(set(b) - set(a))[0]
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 4</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def add_up(n, lst):
    """Returns True if any two non identical elements in lst add up to any n.

    &gt;&gt;&gt; add_up(100, [1, 2, 3, 4, 5])
    False
    &gt;&gt;&gt; add_up(7, [1, 2, 3, 4, 2])
    True
    &gt;&gt;&gt; add_up(10, [5, 5])
    False
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>def add_up(n, lst):
    """Returns True if any two non identical elements in lst add up to any n.

    &gt;&gt;&gt; add_up(100, [1, 2, 3, 4, 5])
    False
    &gt;&gt;&gt; add_up(7, [1, 2, 3, 4, 2])
    True
    &gt;&gt;&gt; add_up(10, [5, 5])
    False
    """
    check_set = set()
    for elem in lst:
        check_set.add(n - elem)
    return bool(intersection(check_set, set(lst)))
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 5</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def find_duplicates(lst):
    """Returns True if lst has any duplicates and False if it does not.

    &gt;&gt;&gt; find_duplicates([1, 2, 3, 4, 5])
    False
    &gt;&gt;&gt; find_duplicates([1, 2, 3, 4, 2])
    True
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def find_duplicates(lst):
    """Returns True if lst has any duplicates and False if it does not.

    &gt;&gt;&gt; find_duplicates([1, 2, 3, 4, 5])
    False
    &gt;&gt;&gt; find_duplicates([1, 2, 3, 4, 2])
    True
    """
    return len(set(lst)) != len(lst)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 6</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def find_duplicates_k(k, lst):
    """Returns True if there are any duplicates in lst that are within k
    indices apart.

    &gt;&gt;&gt; find_duplicates_k(3, [1, 2, 3, 4, 1])
    False
    &gt;&gt;&gt; find_duplicates_k(4, [1, 2, 3, 4, 1])
    True
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def find_duplicates_k(k, lst):
    """Returns True if there are any duplicates in lst that are within k
    indices apart.

    &gt;&gt;&gt; find_duplicates_k(3, [1, 2, 3, 4, 1])
    False
    &gt;&gt;&gt; find_duplicates_k(4, [1, 2, 3, 4, 1])
    True
    """
    prev_set = set()
    for i, elem in enumerate(lst):
        if elem in prev_set:
            return True
        prev_set.add(elem)
        if i - k &gt;= 0:
            prev_set.remove(lst[i - k])
    return False
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 7</strong>: Write the following function so it runs in O(log n) time.</p>

<pre><code>def pow(n,k):
    """Computes n^k.

    &gt;&gt;&gt; pow(2, 3)
    8
    &gt;&gt;&gt; pow(4, 2)
    16
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>def pow(n,k):
    """Computes n^k.

    &gt;&gt;&gt; pow(2, 3)
    8
    &gt;&gt;&gt; pow(4, 2)
    16
    """
    if k == 1:
        return n
    if k % 2 == 0:
        return pow(n*n,k//2)
    else:
        return n * pow(n*n, k//2)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 8</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def missing_no(lst):
    """lst contains all the numbers from 0 to n for some n except some
    number k. Find k.

    &gt;&gt;&gt; missing_no([1, 0, 4, 5, 7, 9, 2, 6, 3])
    8
    &gt;&gt;&gt; missing_no(list(filter(lambda x: x != 293, list(range(2000)))))
    293
    """
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>def missing_no(lst):
    """lst contains all the numbers from 0 to n for some n except some
    number k. Find k.

    &gt;&gt;&gt; missing_no([1, 0, 4, 5, 7, 9, 2, 6, 3])
    8
    &gt;&gt;&gt; missing_no(list(filter(lambda x: x != 293, list(range(2000)))))
    293
    """
    return sum(range(max(lst) + 1)) - sum(lst)
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 9</strong>: Write the following function so it runs in O(n) time.</p>

<pre><code>def find_duplicates_k_l(k, l, lst):
    """Returns True if there are any two values who in lst that are within k
    indices apart AND if the absolute value of their difference is less than
    or equal to l.

    &gt;&gt;&gt; find_duplicates_k_l(4, 0, [1, 2, 3, 4, 5])
    False
    &gt;&gt;&gt; find_duplicates_k_l(4, 1, [1, 2, 3, 4, 5])
    True
    &gt;&gt;&gt; find_duplicates_k_l(4, 0, [1, 2, 3, 4, 1])
    True
    &gt;&gt;&gt; find_duplicates_k_l(2, 0, [1, 2, 3, 4, 1])
    False
    &gt;&gt;&gt; find_duplicates_k_l(1, 100, [100, 275, 320, 988, 27])
    False
    &gt;&gt;&gt; find_duplicates_k_l(1, 100, [100, 199, 275, 320,988,27])
    True
    &gt;&gt;&gt; find_duplicates_k_l(1, 100, [100, 23, 199, 275,320,988,27])
    False
    &gt;&gt;&gt; find_duplicates_k_l(2, 100, [100, 23, 199, 275,320,988,27])
    True
    """
    "*** YOUR CODE HERE ***"
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
