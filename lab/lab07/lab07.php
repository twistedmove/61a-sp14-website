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

    <title>CS 61A Fall 2013: Lab 6</title> 

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
    $RELEASE_DATE = new DateTime("10/21/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 6</h1>
<h2>Sets & Orders of Growth</h2>
<h2>Sets</h2>

<p>A set is an unordered collection of distinct objects that supports membership testing, union, intersection, and adjunction.</p>

<p>Construction</p>

<pre>
>>> s = {3, 2, 1, 4, 4}
>>> s
{1, 2, 3, 4}</pre>

Adjunction

<pre>>>> s.add(5)
>>> s
{1, 2, 3, 4, 5}
</pre>

<p>Operations</p>

<pre>
>>> 3 in s
True
>>> 7 not in s
True
>>> len(s)
4
>>> s.union({1, 5})
{1, 2, 3, 4, 5}
>>> s.intersection({6, 5, 4, 3})
{3, 4}
</pre>

<p>For more detail on Sets you can go to the following link: <a href="http://docs.python.org/py3k/library/stdtypes.html#set">PythonSets</a></p>

<h3>Question 1:</h3>

<p>Implement the union function for sets. Union takes in two sets, and returns a new set with elements from the first set, and all other elements that have not already have been seen in the second set.</p>

<pre>
>>> r = {0, 6, 6}
>>> s = {1, 2, 3, 4}
>>> t = union(s, {1, 6})
{1, 2, 3, 4, 6}
>>> union(r, t)
{0, 1, 2, 3, 4, 6}
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <p>def union(s1,s2):
    union<em>set = set() 
    for elem in s1:
        union</em>set.add(elem)
    for elem in s2:
        union<em>set.add(elem)
    return union</em>set</p>

  </div>
<?php } ?>
<h3>Question 2:</h3>

<p>Implement the intersection function for two sets, intersection takes in two sets and returns a new set of only the elements in both sets</p>

<pre>
>>> r = {0, 1, 4,0}
>>> s = {1, 2, 3, 4}
>>> t = intersection(s, {3,4,2})
{2,3,4}
>>> intersection(r, t)
{4}
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <p>def intersection(s1,s2):
    intersection<em>set = set() 
    for elem in s1:
        if elem in s2:
            intersection</em>set.add(elem)
    return intersection_set</p>

  </div>
<?php } ?>
<p>##Orders of Growth 
One really convinient thing about sets is that many operations on sets (adding elements, removing elements, checking membership) run in O(1) constant time. If you are interested on how, look up HashSets or look at the third challenge problem <a href="http://inst.eecs.berkeley.edu/~cs61a-td/">here</a>.</p>

<p>###Question 3 
Write the following function so it runs in O(n) time.</p>

<pre> 
def extra_elem(a,b):
    '''B contains every element in A, and has one additional member, find the additional member'''
    >>> extra_elem(["dog","cat","monkey"], ["dog", "cat", "monkey", "giraffe"])
    "giraffe"
    >>> extra_elem([1,2,3,4,5],[1,2,3,4,5,6])
    6
    *** your code here ***

</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre>
def extra_elem(a,b):
    '''B contains every element in A, and has one additional member, find the additional member'''
    >>> extra_elem(["dog","cat","monkey"], ["dog", "cat", "monkey", "giraffe"])
    "giraffe"
    >>> extra_elem([1,2,3,4,5],[1,2,3,4,5,6])
    6
    return list(set(b) - set(a))[0]
</pre>

<p></html></p>

  </div>
<?php } ?>
<p>###Question 4
Write the following function so it runs in O(n) time.</p>

<pre>
def add_up(n, lst):
    ''' Returns true if any two non identical elements in lst add up to any n 
    >>> add_up(100,[1,2,3,4,5])
    False 
    >>> add_up(7,[1,2,3,4,2])
    True
    >>> add_up(10,[5,5])
    False
    '''
    *** your code here *** 
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre>
def add_up(n, lst):
    ''' Returns true if any two nonidentical elements in lst add up to n 
    >>> add_up(100,[1,2,3,4,5])
    False 
    >>> add_up(7,[1,2,3,4,2])
    True
    >>> add_up(10,[5,5])
    False
    '''
    check_set = set()
    for elem in lst:
        check_set.add(n - elem)
    return bool(intersection(check_set, set(lst)))
</pre>

<p></html></p>

  </div>
<?php } ?>
<h3>Question 5</h3>

<p>Write the following function so it runs in O(n) time.</p>

<pre>
def find_duplicates(lst):
    ''' Returns true if lst has any duplicates and false if it does not 
    >>> find_duplicates([1,2,3,4,5])
    False 
    >>> find_duplicates([1,2,3,4,2])
    True
    '''
    *** your code here *** 
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre>
def find_duplicates(lst):
    ''' Returns true if lst has any duplicates and false if it does not 
    >>> find_duplicates([1,2,3,4,5])
    False 
    >>> find_duplicates([1,2,3,4,2])
    True
    '''
    return list(set(lst)) == lst
</pre>

<p></html></p>

  </div>
<?php } ?>
<p>###Question 6
Write the following function so it runs in O(n) time.</p>

<pre>
def find_duplicates_k(k, lst):
    ''' Returns true if there are any duplicates in lst that are within k indices apart 
    >>> find_duplicates_k(3,[1,2,3,4,1])
    False 
    >>> find_duplicates_k(4,[1,2,3,4,1])
    True
    '''
    *** your code here *** 
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre>
def find_duplicates_k(k, lst):
    ''' Returns true if there are any duplicates in lst that are within k indices apart '''
    >>> find_duplicates(3,[1,2,3,4,1])
    False 
    >>> find_duplicates(4,[1,2,3,4,1])
    True

    prev_set = set() 
    for i, elem in enumerate(lst):
        if elem in prev_set:
            return True 
        prev_set.add(elem)
        if i - k >= 0:
            prev_set.remove(lst[i - k])
    return False
    '''
</pre>

<p></html></p>

  </div>
<?php } ?>
<p>###Question 7
Write the following function so it runs in O(log n) time.</p>

<pre>
def pow(n,k)
    ''' Computes n^k '''
    >>> pow(2,3)
    8
    >>> pow(4,2)
    16
    *** your code here *** 
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre>
def pow(n,k)
    ''' Computes n^k 
    >>> pow(2,3)
    8
    >>> pow(4,2)
    16
    '''
    if k == 1:
        return n
    if k % 2 == 0:
        return pow(n*n,k//2)
    else:
        return n * pow(n*n, k//2)
</pre>

<p></html></p>

  </div>
<?php } ?>
<p>###Question 8
Write the following function so it runs in O(n) time </p>

<pre>
def missing_no(lst)
    ''' lst contains all the numbers from 1 to n for some n except some number k, find k
    >>> missing_no([1, 0, 4, 5, 7, 9, 2, 6, 3])
    8
    >>> missing_no(list(filter(lambda x: x != 293, list(range(2000)))))
    293
    '''
    *** your code here *** 
</pre>

<p></html></p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre>
def missing_no(lst)
    ''' lst contains all the numbers from 1 to n for some n except some number k, find k
    >>> missing_no([1, 0, 4, 5, 7, 9, 2, 6, 3])
    8
    >>> missing_no(list(filter(lambda x: x != 293, list(range(2000)))))
    293
    '''
    return sum(range(max(lst)+1)) - sum(lst) 
</pre>

<p></html>
~solution</p>

<p>###Question 9
Write the following function so it runs in O(n) time.</p>

<pre>
def find_duplicates_k_l(k,l, lst):
    ''' Returns true if there are any two values who in lst that are within k indices apart AND if the absolute value of their difference is less than or equal to l.
    >>> find_duplicates_k_l(4,0,[1,2,3,4,5])
    False
    >>> find_duplicates_k_l(4,1,[1,2,3,4,5])
    True
    >>> find_duplicates_k_l(4,0,[1,2,3,4,1])
    True
    >>> find_duplicates_k_l(2,0[1,2,3,4,1])
    False
    >>> find_duplicates_k_l(1,100[100,275,320,988,27])
    False
    >>> find_duplicates_k_l(1,100[100,199,275,320,988,27])
    True
    >>> find_duplicates_k_l(1,100[100,23,199,275,320,988,27])
    False
    >>> find_duplicates_k_l(2,100[100,23,199,275,320,988,27])
    True
    '''
    *** your code here *** 
</pre>

  </div>
<?php } ?>

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
