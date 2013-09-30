<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta name="description" content ="CS61A: Structure and Interpretation of Computer Programs"/>
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, Berkeley, EECS"/>
    <meta name="author" content ="Amir Kamil, Hamilton Nguyen, Joy Jeng, Keegan Mann, Stephen Martinis, Albert Wu, Julia Oh, Robert Huang, Mark Miyashita, Sharad Vikram, Soumya Basu, Richard Hwang"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">@import url("https://inst.eecs.berkeley.edu/~cs61a/su12/lab/lab_style.css");</style>

    <title>CS 61A Spring 2013: Lab 4</title>

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
    $RELEASE_DATE = new DateTime("09/25/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head>

  <body style="font-family: Georgia,serif;">

<h1>CS61A Lab 6: Lists, Dictionaries, and Nonlocal</h1>
<h3>September 23-24, 2013</h3>

<p>We've provided a starter file with skeleton code for the exercises in the lab. You can get it by typing this into your terminal:</p>

<pre class='codemargin'>
cp ~cs61a/lib/shakespeare.py .
</pre>

<p>Don't forget the dot at the end!</p>

<h3 class="section_title">List Comprehensions</h3>
<p>
  So far, we've covered lists, a powerful, mutable data structure that supports
  various operations including indexing and slicing. Similar to the generator
  expressions you've seen previously, lists can be created using a syntax called
  "list comprehension." Using a list comprehension is very similar to using the
  map or filter functions, but will return a list as opposed to a filter or map
  object.
</p>

<pre class="codemargin">
&gt;&gt;&gt; a = [x+1 for x in range(10) if x % 2 == 0]
&gt;&gt;&gt; a
[1, 3, 5, 7, 9]
</pre>

<p>
To practice, write a function that adds two matrices together using generator expression(s). The function should take in two 2D lists of the same dimensions.
</p>

<pre class="codemargin">
&gt;&gt;&gt; add_matrices([[1, 3], [2, 0]], [[-3, 0], [1, 2]])
[[-2, 3], [3, 2]]
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
  <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
  <p>
    <pre class="codemargin">
def add_matrices(x, y):
    return [[x[i][j] + y[i][j] for j in range(len(x[0]))] for i in range(len(x))]
    </pre>
  </p>
  </div>
<?php } ?>
<p>
Now write a list comprehension that will create a deck of cards. Each element in the list will be a card, which is represented by a tuple containing the suit as a string and the value as an int.
</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
  <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
  <p>
    <pre class="codemargin">
def deck():
    return [(suit, value) for suit in ("spades", "clubs", "diamonds", "hearts") for value in range(1, 14)]
    </pre>
  </p>
  </div>
<?php } ?>

<p>
Python also includes a powerful <span class="code">sort</span> method. It can also take a <span class="code">key</span> function that tells <span class="code">sort</span> how to actually sort the objects. For more information, look at <a href='http://docs.python.org/3/library/stdtypes.html?highlight=list#list.sort'>Python's documentation for the sort method</a>. Note that <span class="code">sort</span> is a <i>stable sort</i>. Now, use the <span class="code">sort</span> method to sort a shuffled deck. It should put cards of the same suit together, and also sort each card in each suit in increasing value.
</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
  <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
  <p>
    <pre class="codemargin">
def sort_deck(deck):
    deck.sort(key=lambda card: card[1])
    deck.sort(key=lambda card: card[0])
    </pre>
  </p>
  </div>
<?php } ?>

<h3 class="section_title">Shakespeare and Dictionaries</h3>

<p>First, let's talk about dictionaries. Dictionaries are simple an unordered set of key-value pairs. To create a dictionary, use the following syntax: <p>

<pre class="codemargin">
&gt;&gt;&gt; webster = {'Shawn': 'pineapple', 'Kim': 'blueberry'}
</pre>

<p> The curly braces denote the key-value pairs in your dictionary. Each key-value pair is separated by a coma, and for each pair the key appears to the left of the colon and the value appears to the right of the colon. You can retrieve values from your dictionary by 'indexing' using the key: </p>

<pre class="codemargin">
&gt;&gt;&gt; webster['Shawn']
'pineapple'

&gt;&gt;&gt; webster['Kim']
'blueberry'
</pre>

<p> You can modify an entry for an existing key in the dictionary using the following syntax. Adding a new key follows the identical syntax!</p>

<pre class="codemargin">
&gt;&gt;&gt; webster['Shawn'] = 'strawberry'

&gt;&gt;&gt; webster['Shawn']
'strawberry'

&gt;&gt;&gt; webster['Carlton'] = 'donut' # new entry!

&gt;&gt;&gt; webster['Carlton']
'donut
</pre>

<p>Now that you know how dictionaries work, we can move on to our next step - approximating the entire works of Shakespeare! We're going to use a bigram language model. Here's the idea: We start with some word - we'll use "The" as an example. Then we look through all of the texts of Shakespeare and for every instance of "The" we record the word that follows "The" and add it to a list, known as the <i>successors</i> of "The". Now suppose we've done this for every word Shakespeare has used, ever.</p>

<p>Let's go back to "The". Now, we randomly choose a word from this list, say "cat". Then we look up the successors of "cat" and randomly choose a word from that list, and we continue this process. This eventually will terminate in a period (".") and we will have generated a Shakespearean sentence!</p>

<p> The object that we'll be looking things up in is called a 'successor table', although really it's just a dictionary. The keys in this dictionary are words, and the values are lists of successors to those words. </p>

<p> A copy of the framework code is located in ~cs61a/lib/shakespeare.py - you should copy it to your directory</p>

<p> Here's an incomplete definition of the build_successors_table function. The input is a list of words (corresponding to a Shakespearean text), and the output is a successors table. (By default, the first word is a successor to '.'). See the example below: </p>

<pre class="codemargin">
&gt;&gt;&gt; def build_successors_table(tokens):
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

</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
      <p>
      <pre class="codemargin">
def build_successors_table(tokens):
    table = {}
    prev = '.'
    for word in tokens:
        if prev in table:
            table[prev].append(word)
        else:
            table[prev] = [word]
        prev = word
    return table
    </pre>
      </p>
    </div>
<?php } ?>

<p>Let's generate some sentences! Suppose we're given a starting word. We can look up this word in our table to find its list of successors, and then randomly select a word from this list to be the next word in the sentence. Then we just repeat until we reach some ending punctuation. (Note: to randomly select from a list, first make sure you import the Python random library with <span class="code">import random</span> and then use the expression <span class="code">random.choice(my_list)</span>) This might not be a bad time to play around with adding strings together as well. Let's fill in the construct_sent function!</p>


<pre class="codemargin">
&gt;&gt;&gt; def construct_sent(word, table):
     import random
     result = ''
     while word not in ['.', '!', '?']:
                "**FILL THIS IN**"




    return result + word
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
      <p>
      <pre class="codemargin">
def construct_sent(word, table):
    """Prints a random sentence starting with word, sampling from table"""
    import random
    result = ''
    while word not in ['.', '!', '?']:
        result += word + ' '
        word = random.choice(table[word])
    return result + word


    </pre>
      </p>
    </div>
    <?php } ?>

<p>Great! Now all that's left is to run our functions with some actual code. The following snippet included in the skeleton code will return a list containing the words in all of the works of Shakespeare.
(warning: do not try to print the return result of this function):</p>

<pre class="codemargin">
def shakespeare_tokens(path = 'shakespeare.txt', url = 'http://inst.eecs.berkeley.edu/~cs61a/fa11/shakespeare.txt'):
    """Return the words of Shakespeare's plays as a list"""
    import os
    from urllib.request import urlopen
    if os.path.exists(path):
        return open('shakespeare.txt', encoding='ascii').read().split()
    else:
        shakespeare = urlopen(url)
        return shakespeare.read().decode(encoding='ascii').split()
</pre>

<p>Next, we probably want an easy way to refer to our list of tokens and our successors table.
Let's make the following assignments: </p>

<pre class="codemargin">
&gt;&gt;&gt; tokens = shakespeare_tokens()

&gt;&gt;&gt; table = build_successors_table(tokens)

</pre>

<p>Finally, let's define an easy to call utility function: </p>

<pre class="codemargin">
&gt;&gt;&gt; def sent():
        return construct_sent('The', table)

&gt;&gt;&gt; sent()
' The plebeians have done us must be news-cramm'd '

&gt;&gt;&gt; sent()
' The ravish'd thee , with the mercy of beauty '

&gt;&gt;&gt; sent()
' The bird of Tunis , or two white and plucker down with better ; that's God's sake '
</pre>

<p>Now, if we want to start the sentence with a random word, we can use the folowing:</p>

<pre class="codemargin">
&gt;&gt;&gt; def random_sent():
        import random
        return construct_sent(random.choice(table['.']), table)

&gt;&gt;&gt; random_sent()
' You have our thoughts to blame his next to be praised and think ?'

&gt;&gt;&gt; random_sent()
' Long live by thy name , then , Dost thou more angel , good Master Deep-vow , And tak'st more ado but following her , my sight Of speaking false !'

&gt;&gt;&gt; random_sent()
' Yes , why blame him , as is as I shall find a case , That plays at the public weal or the ghost .'
</pre>

<h3 class="section_title">Nonlocal</h3>
<p>Sometimes, we want to update a variable that is in a parent frame. However, that would normally create a new variable in our local frame, leaving the parent one untouched. Luckily, Python includes the nonlocal keyword, which tells Python that the designated variable exists in some parent frame and that we want to assign to that variable. Python will then use the previously bound variable in the closest parent frame that isn't the global frame. Predict the result of evaluating the following calls in the interpreter. Then try them out yourself!</p>

<pre class="codemargin">
&gt;&gt;&gt; def make_funny_adder(n):
        def adder(x):
            if x == 'new':
                nonlocal n
                n = n + 1
            else:
                return x + n
        return adder

&gt;&gt;&gt; h = make_funny_adder(3)
&gt;&gt;&gt; h(5)
...

&gt;&gt;&gt; j = make_funny_adder(7)
&gt;&gt;&gt; j(5)
...

&gt;&gt;&gt; h('new')
&gt;&gt;&gt; h(5)
...

&gt;&gt;&gt; j(5)
...
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class="codemargin">
&gt;&gt;&gt; def make_funny_adder(n):
        def adder(x):
            if x == 'new':
                nonlocal n
                n = n + 1
            else:
                return x + n
        return adder

&gt;&gt;&gt; h = make_funny_adder(3)
&gt;&gt;&gt; h(5)
<b>8</b>

&gt;&gt;&gt; j = make_funny_adder(7)
&gt;&gt;&gt; j(5)
<b>12</b>

&gt;&gt;&gt; h('new')
&gt;&gt;&gt; h(5)
<b>9</b>

&gt;&gt;&gt; j(5)
<b>12</b>
</pre>
</div>
<?php } ?>

<p>Write a function <span class="code">make_fib</span> that returns a function that returns the next Fibonacci number each time it is called. Examples:</p>

<pre class="codemargin">
&gt;&gt;&gt; fib = make_fib()

&gt;&gt;&gt; fib()
1

&gt;&gt;&gt; fib()
1

&gt;&gt;&gt; fib()
2

&gt;&gt;&gt; fib()
3

</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
      <p>
    <pre class="codemargin">
def make_fib():
    n = 0
    first, second = 1, 1
    def fib():
        nonlocal n, first, second
        if n == 0:
            n += 1
            return first
        elif n == 1:
            n += 1
            return second
        else:
            first, second = second, first + second
            return second
    return fib
    </pre>
      </p>
    </div>
    <?php } ?>

<!--

<h3 class="section_title">List Implementation</h3>
<p>Although Python does not allow us to view the actual implementation of lists, we can create our own list data structure using rlists! We will use a dispatch function to carrying out operations that we want, including returning the length, getting an item, adding an item, removing an item, and also converting the items into a string. The implementation is given below. Extend the <span class='code'>mutable_rlist</span> implementation so that it can also reverse the contents. A starter file is available. It includes a <span class='code'>reverse_rlist</span> function that you might find helpful.</p>

<pre class="codemargin">
&gt;&gt;&gt; s = to_mutable_rlist([1, 5, 3, 0])
&gt;&gt;&gt; s('reverse')
&gt;&gt;&gt; s('str')
'(0, (3, (5, (1, None))))'
</pre>
<pre class="codemargin">
def mutable_rlist():
      """Return a functional implementation of a mutable recursive list."""
      contents = empty_rlist
      def dispatch(message, value=None):
          nonlocal contents
          if message == 'len':
              return len_rlist(contents)
          elif message == 'getitem':
              return getitem_rlist(contents, value)
          elif message == 'push_first':
              contents = rlist(value, contents)
          elif message == 'pop_first':
              f = first(contents)
              contents = rest(contents)
              return f
          elif message == 'str':
              return str(contents)
          "*** YOUR CODE GOES HERE ***"

      return dispatch
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class="codemargin">
def mutable_rlist():
    """Return a functional implementation of a mutable recursive list."""
    contents = empty_rlist
    def dispatch(message, value=None):
        nonlocal contents
        if message == 'len':
            return len_rlist(contents)
        elif message == 'getitem':
            return getitem_rlist(contents, value)
        elif message == 'push_first':
            contents = rlist(value, contents)
        elif message == 'pop_first':
            f = first(contents)
            contents = rest(contents)
            return f
        elif message == 'str':
            return str(contents)
        elif message == 'reverse':
            contents = reverse_rlist(contents)
</pre>
</div>
<?php } ?>

<h3 class="section_title">Dictionary Implementation</h3>
<p>Similarly, we can also implement dictionaries using a list and a dispatch function. Our version is given below. Add a <span class='code'>sort</span> option that will sort the key-value pairs in increasing order of their keys. Hint: use the <span class='code'>sort</span> method for <span class='code'>list</span>s, which can take a <span class='code'>key</span> function. The <span class='code'>key</span> tells the <span class='code'>sort</span> method how to sort the <span class='code'>list</span>. For more information, look at <a href='http://docs.python.org/3/library/stdtypes.html?highlight=list#list.sort'>Python's documentation for the sort method</a>.</p>

<pre class="codemargin">
d = dictionary()
d('setitem', 'b', 80)
d('setitem', 'a', 90)
d('setitem', 'c', 70)
d('sort')
d('keys')
('a', 'b', 'c')
</pre>
<pre class="codemargin">
def dictionary():
    """Return a functional implementation of a dictionary."""
    records = []
    def getitem(key):
        for k, v in records:
            if k == key:
                return v
    def setitem(key, value):
        for item in records:
            if item[0] == key:
                item[1] = value
                return
        records.append([key, value])
    def dispatch(message, key=None, value=None):
        if message == 'getitem':
            return getitem(key)
        elif message == 'setitem':
            setitem(key, value)
        elif message == 'keys':
            return tuple(k for k, _ in records)
        elif message == 'values':
            return tuple(v for _, v in records)
        "*** YOUR CODE GOES HERE ***"

    return dispatch
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class="codemargin">
def dictionary():
    """Return a functional implementation of a dictionary."""
    records = []
    def getitem(key):
        for k, v in records:
            if k == key:
                return v
    def setitem(key, value):
        for item in records:
            if item[0] == key:
                item[1] = value
                return
        records.append([key, value])
    def dispatch(message, key=None, value=None):
        if message == 'getitem':
            return getitem(key)
        elif message == 'setitem':
            setitem(key, value)
        elif message == 'keys':
            return tuple(k for k, _ in records)
        elif message == 'values':
            return tuple(v for _, v in records)
        elif message == 'sort':
            records.sort(key=lambda elem: elem[0])
    return dispatch
</pre>
</div>
<?php } ?>
-->


</pre>
    <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
<?php for ($i = 0; $i < $q_num; $i++) { ?>
$("#toggleButton<?php echo $i; ?>").click(function () {
  $("#toggleText<?php echo $i; ?>").toggle();
});
<?php } ?>
</script>
    <?php } ?>
  </body>
</html>
