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

    <title>CS 61A Fall 2013: Lab 4</title> 

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
    $RELEASE_DATE = new DateTime("10/02/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 4</h1>
<h2>Lists and dictionaries</h2>
<p>We've provided a starter file with skeleton code for the exercises in the lab. You can get it through the following link
<a href="./shakespeare.py">shakespeare.py</a></p>

<h3>List Comprehensions</h3>

<p>So far, we've covered lists, a powerful, mutable data structure that
supports various operations including indexing and slicing. Similar
to the generator expressions you've seen previously, lists can be
created using a syntax called "list comprehension." Using a list
comprehension is very similar to using the map or filter functions,
but will return a list as opposed to a filter or map object.</p>

<pre><code>&gt;&gt;&gt; a = [x+1 for x in range(10) if x % 2 == 0]
&gt;&gt;&gt; a
[1, 3, 5, 7, 9]
</code></pre>

<p><strong>Problem 1</strong>: To practice, write a function that adds two matrices
together using generator expression(s). The function should take in
two 2D lists of the same dimensions.</p>

<pre><code>&gt;&gt;&gt; add_matrices([[1, 3], [2, 0]], [[-3, 0], [1, 2]])
[[-2, 3], [3, 2]]
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>def add_matrices(x, y):
    return [[x[i][j] + y[i][j] for j in range(len(x[0]))] for i in range(len(x))]
</code></pre>

  </div>
<?php } ?>
<p><strong>Problem 2</strong>: Now write a list comprehension that will create a deck
of cards. Each element in the list will be a card, which is
represented by a tuple containing the suit as a string and the value
as an int.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
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

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>def sort_deck(deck):
    deck.sort(key=lambda card: card[1])
    deck.sort(key=lambda card: card[0])
</code></pre>

  </div>
<?php } ?>
<h3>Shakespeare and Dictionaries</h3>

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
the following syntax. Adding a new key follows the identical syntax!</p>

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

<p>The object that we'll be looking things up in is called a 'successor
table', although really it's just a dictionary. The keys in this
dictionary are words, and the values are lists of successors to those
words. </p>

<p>A copy of the framework code is located in <code>~cs61a/lib/shakespeare.py</code>
-- you should copy it to your directory</p>

<p>Here's an incomplete definition of the <code>build_successors_table</code>
function. The input is a list of words (corresponding to a
Shakespearean text), and the output is a successors table. (By
default, the first word is a successor to '.'). See the example below: </p>

<pre><code>&gt;&gt;&gt; def build_successors_table(tokens):
        table = {}
        prev = '.'
        for word in tokens:
            if prev in table:
                "***FILL THIS IN***"

            else:
                "***FILL THIS IN***"

            prev = word
        return table

&gt;&gt;&gt; text = ['We', 'came', 'to', 'investigate', ',', 'catch', 'bad', 'guys', 'and', 'to', 'eat', 'pie', '.']

&gt;&gt;&gt; table = build_successors_table(text)

&gt;&gt;&gt; table
{'and': ['to'], 'We': ['came'], 'bad': ['guys'], 'pie': ['.'], ',': ['catch'], '.': ['We'], 'to': ['investigate', 'eat'], 'investigate': [','], 'catch': ['bad'], 'guys': ['and'], 'eat': ['pie'], 'came': ['to']}
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
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
<p>Let's generate some sentences! Suppose we're given a starting word. We
can look up this word in our table to find its list of successors, and
then randomly select a word from this list to be the next word in the
sentence. Then we just repeat until we reach some ending punctuation.
(Note: to randomly select from a list, first make sure you import the
Python random library with <code>import random</code> and then use the expression
<code>random.choice(my_list)</code>) This might not be a bad time to play around
with adding strings together as well. Let's fill in the
<code>construct_sent</code> function!</p>

<pre><code>def construct_sent(word, table):
    import random
    result = ''
    while word not in ['.', '!', '?']:
        "**FILL THIS IN**"

    return result + word
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>def construct_sent(word, table):
    """Prints a random sentence starting with word, sampling from
    table"""
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
a list containing the words in all of the works of Shakespeare.
(warning: do not try to print the return result of this function):</p>

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
    <?php for ($i = 0; $i < 5; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
