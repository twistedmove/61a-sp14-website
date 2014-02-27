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

    <title>CS 61A Spring 2014: Lab 4</title> 

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
    $RELEASE_DATE = new DateTime("2/27/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 4</h1>
<h2 id="title-sub">Lists and dictionaries</h2>
<h2>Starter Files</h2>

<p>We've provided a set of starter files with skeleton code for the
exercises in the lab. You can get them in the following places:</p>

<ul>
<li><a href="starter/lists.py">lists.py</a></li>
<li><a href="starter/shakespeare.txt">shakespeare.txt</a></li>
<li><a href="starter/shakespeare.py">shakespeare.py</a></li>
</ul>

<h2>Lists</h2>

<p>Previously, we had dealt with tuples, which are immutable sequences.
Python has built-in <em>lists</em>, which are mutable. This means you can modify
lists without creating entirely new ones. Lists have <em>state</em>, unlike
tuples.</p>

<p>Just like with tuples, you can use slicing notation with lists. In
addition, not only can retrieve a slice from a list, you can also
<em>assign</em> to a slice of a list. This is possible because lists are
mutable.</p>

<h3 class='question'>Question 1</h3>

<p>What does Python print? Think about these before typing it into an
interpreter!</p>

<pre><code>&gt;&gt;&gt; lst = [1, 2, 3, 4, 5, 6]
&gt;&gt;&gt; lst[4] = 1
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[2:4] = [9, 8]
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[3] = ['hi', 'bye']
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[3:] = ['jom', 'magrotker']
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[1:3] = [2, 3, 4, 5, 6, 7, 8]
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst == lst[:]
_________
&gt;&gt;&gt; lst is lst[:]
_________
&gt;&gt;&gt; a = lst[:]
&gt;&gt;&gt; a[0] = 'oogly'
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst = [1, 2, 3, 4]
&gt;&gt;&gt; b = ['foo', 'bar']
&gt;&gt;&gt; lst[0] = b
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; b[1] = 'ply'
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; b = ['farply', 'garply']
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[0] = lst
&gt;&gt;&gt; lst
_________
&gt;&gt;&gt; lst[0][0][0][0][0]
_________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <ol>
<li><code>[1, 2, 3, 4, 1, 6]</code></li>
<li><code>[1, 2, 9, 8, 1, 6]</code></li>
<li><code>[1, 2, 9, ['hi', 'bye'], 1, 6]</code></li>
<li><code>[1, 2, 9, 'jom', 'magrotker']</code></li>
<li><code>[1, 2, 3, 4, 5, 6, 7, 8, 'jom', 'magrotker']</code></li>
<li><code>True</code></li>
<li><code>False</code></li>
<li><code>[1, 2, 3, 4, 5, 6, 7, 8, 'jom', 'magrotker']</code></li>
<li><code>[['foo', 'bar'], 2, 3, 4]</code></li>
<li><code>[['foo', 'ply'], 2, 3, 4]</code></li>
<li><code>[['foo', 'ply'], 2, 3, 4]</code></li>
<li><code>[[...], 2, 3, 4]</code></li>
<li><code>[[...], 2, 3, 4]</code></li>
</ol>

  </div>
<?php } ?>
<h3>List Methods</h3>

<p>Python has a <code>list</code> class that contains many useful methods.  Using the
builtin <code>dir()</code> function will show you all of them, like so:</p>

<pre><code>dir(list)
</code></pre>

<p>Some of the most common methods include <code>append()</code>, <code>extend()</code>, and
<code>pop()</code>.</p>

<pre><code>&gt;&gt;&gt; l = [3, 5, 6]
&gt;&gt;&gt; l.append(10) # adds an element to the end
&gt;&gt;&gt; l
[3, 5, 6, 10]
&gt;&gt;&gt; l.extend([-1, -6]) # concatenates another list to the end
&gt;&gt;&gt; l
[3, 5, 6, 10, -1, -6]
&gt;&gt;&gt; l.pop() # removes and returns the last element
-6
&gt;&gt;&gt; l
[3, 5, 6, 10, -1]
&gt;&gt;&gt; l.pop(2) # removes and returns the element at the index given
6
&gt;&gt;&gt; l
[3, 5, 10, -1]
</code></pre>

<p>Try to solve the following list problems with mutation. This means that
each function should mutate the original list. In other words:</p>

<pre><code>&gt;&gt;&gt; original_list = [5, -1, 29, 0]
&gt;&gt;&gt; function(original_list) # doesn't return anything
&gt;&gt;&gt; original_list
# mutated list here
</code></pre>

<p>Prioritize solving these problems with iteration, but for extra
practice, also solve them using recursion. Remember: these functions
should NOT return anything. This is to emphasize that these functions
should utilize mutability.</p>

<h3 class='question'>Question 2</h3>

<p>Write a function that reverses the given list.</p>

<pre><code>def reverse(lst):
    """Reverses lst using mutation.
    &gt;&gt;&gt; original_list = [5, -1, 29, 0]
    &gt;&gt;&gt; reverse(original_list)
    &gt;&gt;&gt; original_list
    [0, 29, -1, 5]
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code># Iterative
def reverse(lst):
    midpoint = len(lst) // 2
    last = len(lst) - 1
    for i in range(midpoint):
        lst[i], lst[last - i] = lst[last - i], lst[i]

# Recursive1
def reverse(lst):
    if len(lst) &gt; 1:
        temp = lst.pop()
        reverse(lst)
        lst.insert(0, temp)

# Recursive2
def reverse(lst):
    midpoint = len(lst) // 2
    last = len(lst) - 1
    def helper(i):
        if i == midpoint:
            return
        lst[i], lst[last - i] = lst[last - i], lst[i]
        helper(i + 1)
    helper(0)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 3</h3>

<p>Write a function that maps a function on the given list.</p>

<pre><code>def map(fn, lst):
    """Maps fn onto lst using mutation.
    &gt;&gt;&gt; original_list = [5, -1, 2, 0]
    &gt;&gt;&gt; map(lambda x: x * x, original_list)
    &gt;&gt;&gt; original_list
    [25, 1, 4, 0]
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code># Iterative
def map(fn, lst):
    for i in range(len(lst)):
        lst[i] = fn(lst[i])

# Recursive
def map(fn, lst):
    if lst: # True when lst != []
        temp = lst.pop(0)
        map(fn, lst)
        lst.insert(0, fn(temp))
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 4</h3>

<p>Write a function that filters a list, only keeping elements that
satisfy the predicate.</p>

<pre><code>def filter(pred, lst):
    """Filters lst with pred using mutation.
    &gt;&gt;&gt; original_list = [5, -1, 2, 0]
    &gt;&gt;&gt; filter(lambda x: x % 2 == 0, original_list)
    &gt;&gt;&gt; original_list
    [2, 0]
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code># Iterative
def filter(pred, lst):
    i = len(lst) - 1
    while i &gt;= 0:
        if not pred(lst[i]):
            lst.pop(i)
        i -= 1

# Recursive
def filter(pred, lst):
    if lst: 
        temp = lst.pop(0)
        filter(pred, lst)
        if pred(temp):
            lst.insert(0, temp)
</code></pre>

  </div>
<?php } ?>
<h3>List Comprehensions</h3>

<p>So far, we've covered lists, a powerful, mutable data structure that
supports various operations including indexing and slicing. Similar
to the generator expressions you've seen previously, lists can be
created using a syntax called "list comprehension." Using a list
comprehension is very similar to using the map or filter functions,
but will return a list as opposed to a filter or map object.</p>

<pre><code>&gt;&gt;&gt; [i**2 for i in (1, 2, 3, 4) if i%2 == 0]
[4, 16]
</code></pre>

<p>is equivalent to</p>

<pre><code>&gt;&gt;&gt; lst = []
&gt;&gt;&gt; for i in (1, 2, 3, 4):
...     if i % 2 == 0:
...         lst.append(i**2)
&gt;&gt;&gt; lst
[4, 16]
</code></pre>

<p>List comprehensions allow you to apply <strong>map</strong> and <strong>filter</strong> at the
same time, in very compact syntax. The general syntax for a list
comprehension is</p>

<pre><code>[&lt;expression&gt; for &lt;element&gt; in &lt;sequence&gt; if &lt;conditional&gt;]
</code></pre>

<p>The syntax is designed to read like English: "Compute the expression
for each element in the sequence if the conditional is true."</p>

<h3 class='question'>Question 5</h3>

<p>Implement a function <code>coords</code>, which takes a funciton, a sequence, and
an upper and lower bound on output of the function. <code>coords</code> then
returns a list of x, y coordinate pairs (tuples) such that:</p>

<ul>
<li>Each pair contains (x, fn(x))</li>
<li>The x coordinates can only be elements in the sequence</li>
<li>Only pairs whose y coordinate is within the upper and lower bounds
are included</li>
</ul>

<p>See the doctest if you are still confused.</p>

<p>One other thing: your answer can only be <em>one line long</em>. You should
make use of list comprehensions!</p>

<pre><code>def coords(fn, seq, lower, upper):
    """
    &gt;&gt;&gt; seq = (-4, -2, 0, 1, 3)
    &gt;&gt;&gt; fn = lambda x: x**2
    &gt;&gt;&gt; coords(fn, seq, 1, 9)
    [(-2, 4), (1, 1), (3, 9)]
    """ 
    return _______________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def coords(fn, seq, lower, upper):
    return [(x, fn(x)) for x in seq if lower &lt;= fn(x) &lt;= upper]
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 6</h3>

<p>To practice, write a function that adds two matrices together using
generator expression(s). The function should take in two 2D lists of
the same dimensions.</p>

<pre><code>def add_matrices(x, y):
    """
    &gt;&gt;&gt; add_matrices([[1, 3], [2, 0]], [[-3, 0], [1, 2]])
    [[-2, 3], [3, 2]]
    """
    return ________________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def add_matrices(x, y):
    return [[x[i][j] + y[i][j] for j in range(len(x[0]))] for i in range(len(x))]
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 7</h3>

<p>Now write a list comprehension that will create a deck of cards. Each
element in the list will be a card, which is represented by a tuple
containing the suit as a string and the value as an int.</p>

<pre><code>def deck():
    return ________________
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>def deck():
    return [(suit, value) for suit in ("spades", "clubs", "diamonds", "hearts") for value in range(1, 14)]
</code></pre>

  </div>
<?php } ?>
<p>Python also includes a powerful <code>sort</code> method. It can also take a
<code>key</code> function that tells <code>sort</code> how to actually sort the objects. For
more information, look at
<a href="http://docs.python.org/3/library/stdtypes.html?highlight=list#list.sort">Python's documentation for the sort method</a>
Note that <code>sort</code> is a <em>stable sort</em>. Now, use the <code>sort</code> method to
sort a shuffled deck. It should put cards of the same suit together,
and also sort each card in each suit in increasing value.</p>

<pre><code>def sort_deck(deck):
    "*** YOUR CODE HERE ***"
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>def sort_deck(deck):
    deck.sort(key=lambda card: card[1])
    deck.sort(key=lambda card: card[0])
</code></pre>

  </div>
<?php } ?>
<h2>Dictionaries and Shakespeare</h2>

<p>First, let's talk about dictionaries. Dictionaries are simple an
unordered set of key-value pairs. To create a dictionary, use the
following syntax:</p>

<pre><code>&gt;&gt;&gt; webster = {'Shawn': 'pineapple', 'Kim': 'blueberry'}
</code></pre>

<p>The curly braces denote the key-value pairs in your dictionary. Each
key-value pair is separated by a coma, and for each pair the key
appears to the left of the colon and the value appears to the right of
the colon. You can retrieve values from your dictionary by 'indexing'
using the key: </p>

<pre><code>&gt;&gt;&gt; webster['Shawn']
'pineapple'
&gt;&gt;&gt; webster['Kim']
'blueberry'
</code></pre>

<p>You can modify an entry for an existing key in the dictionary using
the following syntax. Adding a new key follows identical syntax!</p>

<pre><code>&gt;&gt;&gt; webster['Shawn'] = 'strawberry'
&gt;&gt;&gt; webster['Shawn']
'strawberry'
&gt;&gt;&gt; webster['Carlton'] = 'donut' # new entry!
&gt;&gt;&gt; webster['Carlton']
'donut
</code></pre>

<p>Now that you know how dictionaries work, we can move on to our next
step -- approximating the entire works of Shakespeare! We're going to
use a bigram language model. Here's the idea: We start with some word
-- we'll use "The" as an example. Then we look through all of the
texts of Shakespeare and for every instance of "The" we record the
word that follows "The" and add it to a list, known as the
<em>successors</em> of "The". Now suppose we've done this for every word
Shakespeare has used, ever.</p>

<p>Let's go back to "The". Now, we randomly choose a word from this list,
say "cat". Then we look up the successors of "cat" and randomly choose
a word from that list, and we continue this process. This eventually
will terminate in a period (".") and we will have generated a
Shakespearean sentence!</p>

<p>The object that we'll be looking things up in is called a "successor
table", although really it's just a dictionary. The keys in this
dictionary are words, and the values are lists of successors to those
words.</p>

<h3 class='question'>Question 8</h3>

<p>Here's an incomplete definition of the <code>build_successors_table</code>
function. The input is a list of words (corresponding to a
Shakespearean text), and the output is a successors table. (By
default, the first word is a successor to "."). See the example below:</p>

<pre><code>def build_successors_table(tokens):
    """Return a dictionary: keys are words; values are lists of
    successors.

    &gt;&gt;&gt; text = ['We', 'came', 'to', 'investigate', ',', 'catch', 'bad', 'guys', 'and', 'to', 'eat', 'pie', '.']
    &gt;&gt;&gt; table = build_successors_table(text)
    &gt;&gt;&gt; table
    {'and': ['to'], 'We': ['came'], 'bad': ['guys'], 'pie': ['.'], ',': ['catch'], '.': ['We'], 'to': ['investigate', 'eat'], 'investigate': [','], 'catch': ['bad'], 'guys': ['and'], 'eat': ['pie'], 'came': ['to']}
    """
    table = {}
    prev = '.'
    for word in tokens:
        if prev in table:
            "***YOUR CODE HERE ***"
        else:
            "***YOUR CODE HERE ***"
        prev = word
    return table
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <pre><code>def build_successors_table(tokens):
    table = {}
    prev = '.'
    for word in tokens:
        if prev in table:
            table[prev].append(word)
        else:
            table[prev] = [word]
        prev = word
    return table
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 9</h3>

<p>Let's generate some sentences! Suppose we're given a starting word. We
can look up this word in our table to find its list of successors, and
then randomly select a word from this list to be the next word in the
sentence. Then we just repeat until we reach some ending punctuation.</p>

<p><em>Hint</em>: to randomly select from a list, first make sure you import the
Python random library with <code>import random</code> and then use the expression
<code>random.choice(my_list)</code>)</p>

<p>This might not be a bad time to play around with adding strings
together as well. Let's fill in the <code>construct_sent</code> function!</p>

<pre><code>def construct_sent(word, table):
    """Prints a random sentence starting with word, sampling from
    table.
    """
    import random
    result = ''
    while word not in ['.', '!', '?']:
        "***YOUR CODE HERE ***"
    return result + word
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
    <pre><code>def construct_sent(word, table):
    import random
    result = ''
    while word not in ['.', '!', '?']:
        result += word + ' '
        word = random.choice(table[word])
    return result + word
</code></pre>

  </div>
<?php } ?>
<p>Great! Now all that's left is to run our functions with some actual
code. The following snippet included in the skeleton code will return
a list containing the words in all of the works of Shakespeare.</p>

<p><em>Warning</em>: do <strong>NOT</strong> try to print the return result of this function):</p>

<pre><code>def shakespeare_tokens(path = 'shakespeare.txt', url = 'http://goo.gl/SztLfX'):
    """Return the words of Shakespeare's plays as a list"""
    import os
    from urllib.request import urlopen
    if os.path.exists(path):
        return open('shakespeare.txt', encoding='ascii').read().split()
    else:
        shakespeare = urlopen(url)
        return shakespeare.read().decode(encoding='ascii').split()
</code></pre>

<p>Next, we probably want an easy way to refer to our list of tokens and
our successors table.  Let's make the following assignments: </p>

<pre><code>&gt;&gt;&gt; tokens = shakespeare_tokens()
&gt;&gt;&gt; table = build_successors_table(tokens)
</code></pre>

<p>Finally, let's define an easy to call utility function: </p>

<pre><code>&gt;&gt;&gt; def sent():
        return construct_sent('The', table)

&gt;&gt;&gt; sent()
' The plebeians have done us must be news-cramm'd '

&gt;&gt;&gt; sent()
' The ravish'd thee , with the mercy of beauty '

&gt;&gt;&gt; sent()
' The bird of Tunis , or two white and plucker down with better ; that's God's sake '
</code></pre>

<p>Now, if we want to start the sentence with a random word, we can use
the folowing:</p>

<pre><code>&gt;&gt;&gt; def random_sent():
        import random
        return construct_sent(random.choice(table['.']), table)

&gt;&gt;&gt; random_sent()
' You have our thoughts to blame his next to be praised and think ?'

&gt;&gt;&gt; random_sent()
' Long live by thy name , then , Dost thou more angel , good Master Deep-vow , And tak'st more ado but following her , my sight Of speaking false !'

&gt;&gt;&gt; random_sent()
' Yes , why blame him , as is as I shall find a case , That plays at the public weal or the ghost .'
</code></pre>

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 10; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
