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

    <title>CS 61A Spring 2014: Lab 9</title> 

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
    $RELEASE_DATE = new DateTime("04/17/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 9</h1>
<h2 id="title-sub">Iterators, Generators, and Streams</h2>
<h2>Starter Files</h2>

<p>We've provided a set of starter files with skeleton code for the
exercises in the lab. You can get them in the following places:</p>

<ul>
<li><a href="starter/iterators.py">iterators.py</a></li>
<li><a href="starter/streams.py">streams.py</a></li>
</ul>

<h2>Iterators</h2>

<p>Remember the <code>for</code> loop?  (We really hope so.)  The object that the
<code>for</code> loop iterates over is required to be an iterable!</p>

<pre><code>for elem in iterable:
    # do something
</code></pre>

<p><code>for</code> loops only work with iterables, and that means that the object
you want to use a <code>for</code> loop on must implement the <em>iterable
interface</em>.  In particular, a <code>for</code> loop makes use of two methods:
<code>__iter__</code> and <code>__next__</code>.  In other words, an object that implements
the iterable interface must implement an <code>__iter__</code> method that returns
an object that implements the <code>__next__</code> method.</p>

<p>This object that implements the <code>__next__</code> method is called an
iterator.  While the iterator interface also requires that the object
implement the <code>__next__</code> and <code>__iter__</code> methods, it does not require
the <code>__iter__</code> method to return a new object.</p>

<p>Here is an example of a class definition for an object that implements
the iterator interface:</p>

<pre><code>class AnIterator(object):
    def __init__(self):
        self.current = 0

    def __next__(self):
        if self.current &gt; 5:
            raise StopIteration
        self.current += 1
        return self.current

    def __iter__(self):
        return self
</code></pre>

<p>Let's go ahead and try out our new toy.</p>

<pre><code>&gt;&gt;&gt; for i in AnIterator():
...     print(i)
...
1
2
3
4
5
</code></pre>

<p>This is somewhat equivalent to running:</p>

<pre><code>t = AnIterator()
t = t.__iter__()
try:
    while True:
        print(t.__next__())
except StopIteration as e:
    pass
</code></pre>

<h3 class='question'>Question 1</h3>

<p>Try running each of the given iterators in a <code>for</code> loop. Why does each
work or not work?</p>

<pre><code>class IteratorA(object):
    def __init__(self):
        self.start = 5

    def __next__(self):
        if self.start == 100:
            raise StopIteration
        self.start += 5
        return self.start

    def __iter__(self):
        return self
</code></pre>

<p>~ explanation ~
No problem, this is a beautiful iterator.
~ explanation ~</p>

<pre><code>class IteratorB(object):
    def __init__(self):
        self.start = 5

    def __iter__(self):
        return self
</code></pre>

<p>~ explanation ~
Oh no!  Where is <code>__next__</code>?  This fails to implement the iterator
interface because calling <code>__iter__</code> doesn't return something that has
a <code>__next__</code> method.
~ explanation ~</p>

<pre><code>class IteratorC(object):
    def __init__(self):
        self.start = 5

    def __next__(self):
        if self.start == 10:
            raise StopIteration
        self.start += 1
        return self.start
</code></pre>

<p>~ explanation ~
This also fails to implement the iterator interface.  Without the
<code>__iter__</code> method, the <code>for</code> loop will error.  The <code>for</code> loop needs to
call <code>__iter__</code> first because some objects might not implement the
<code>__next__</code> method themselves, but calling <code>__iter__</code> will return an
object that does.
~ explanation ~</p>

<pre><code>class IteratorD(object):
    def __init__(self):
        self.start = 1

    def __next__(self):
        self.start += 1
        return self.start

    def __iter__(self):
        return self
</code></pre>

<p>Watch out on this one.  The amount of output might scare you.</p>

<p>~ explanation ~
This is an infinite sequence!  Sequences like these are the reason
iterators are useful.  Because iterators delay computation, we can use
a finite amount of memory to represent an infinitely long sequence.
~ explanation ~</p>

<h3 class='question'>Question 2</h3>

<p>For one of the above iterators that works, try this:</p>

<pre><code>&gt;&gt;&gt; i = IteratorA()
&gt;&gt;&gt; for item in i:
...     print(item)
</code></pre>

<p>Then again:</p>

<pre><code>&gt;&gt;&gt; for item in i:
...     print(item)
</code></pre>

<p>With that in mind, try writing an iterator that "restarts" every time
it is run through a <code>for</code> loop.</p>

<pre><code>&gt;&gt;&gt; i = IteratorRestart(2, 7)
&gt;&gt;&gt; for item in i:
...     print(item)
# should print 2 to 7
&gt;&gt;&gt; for item in i:
...     print(item)
# should still print 2 to 7
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>class IteratorRestart(object):
    def __init__(self, start, end):
        self.start = start
        self.end = end
        self.current = start
    def __next__(self):
        if self.current &gt; self.end:
            raise StopIteration
        self.current += 1
    def __iter__(self):
        self.current = self.start
        return self
</code></pre>

  </div>
<?php } ?>
<h2>Generators</h2>

<p>A generator is a special type of iterator that can be written using a <code>yield</code> statement:</p>

<pre><code>def &lt;generator_function&gt;():
    &lt;somevariable&gt; = &lt;something&gt;
    while &lt;predicate&gt;:
        yield &lt;something&gt;
        &lt;increment variable&gt;
</code></pre>

<p>A generator function can also be run through a <code>for</code> loop:</p>

<pre><code>def generator():
    i = 0
    while i &lt; 6:
        yield i
        i += 1

for i in generator():
    print(i)
</code></pre>

<p>To better figure out what is happening, try this:</p>

<pre><code>def generator():
    print("Starting here")
    i = 0
    while i &lt; 6:
        print("Before yield")
        yield i
        print("After yield")
        i += 1

&gt;&gt;&gt; g = generator()
&gt;&gt;&gt; g
___ # what is this thing?
&gt;&gt;&gt; g.__iter__()
___
&gt;&gt;&gt; g.__next__()
___
&gt;&gt;&gt; g.__next__()
____
</code></pre>

<p>Trace through the code and make sure you know where and why each
statement is printed.</p>

<p>You might have noticed from the Iterators section that the Iterator
defined without a <code>__next__</code> method failed to run in the <code>for</code> loop.
However, this is not always the case.</p>

<pre><code>class IterGen(object):
    def __init__(self):
        self.start = 5

    def __iter__(self):
        while self.start &amp;lt 10:
            self.start += 1
            yield self.start

for i in IterGen():
    print(i)
</code></pre>

<p>Think for a moment about why that works.</p>

<p>Think more.</p>

<p>Longer.</p>

<p>Okay, I'll tell you.</p>

<p>The <code>for</code> loop only expects the object returned by <code>__iter__</code> to have a
<code>__next__</code> method, and the <code>__iter__</code> method is a generator function in
this case.  Therefore, when <code>__iter__</code> is called, it returns a
generator object, which you can call <code>__next__</code> on.</p>

<h3 class='question'>Question 3</h3>

<p>Write a generator that counts down to 0.</p>

<p>Write it in both ways: using a generator function on its own, and
within the <code>__iter__</code> method of a class.</p>

<pre><code>def countdown(n):
    """
    &gt;&gt;&gt; for number in countdown(5):
    ...     print(number)
    ...
    5
    4
    3
    2
    1
    0
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>    while n &gt;= 0:
        yield n
        n = n - 1
</code></pre>

  </div>
<?php } ?>
<pre><code>class Countdown(object):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>    def __init__(self, cur):
        self.cur = cur

    def __iter__(self):
        while self.cur &gt; 0:
            yield self.cur
            self.cur -= 1
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 4</h3>

<p>Write a generator that outputs the hailstone sequence from homework 1.</p>

<pre><code>def hailstone(n):
    """
    &gt;&gt;&gt; for num in hailstone(10):
    ...     print(num)
    ...
    10
    5
    16
    8
    4
    2
    1
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>    i = n
    while i &gt; 1:
        yield i
        if i % 2 == 0:
            i //= 2
        else:
            i = i * 3 + 1
    yield i
</code></pre>

  </div>
<?php } ?>
<p>And now you know how <code>for</code> loops work!  Or more importantly, you have
become a better computer scientist.</p>

<h2>Streams</h2>

<p>A stream is another example of a lazy sequence. A stream is a lazily
evaluated RList.  In other words, the stream's elements (except for the
first element) are only evaluated when the values are needed.</p>

<p>Take a look at the following code:</p>

<pre><code>class Stream(object):
    class empty(object):
        def __repr__(self):
            return 'Stream.empty'

    empty = empty()

    def __init__(self, first, compute_rest, empty= False):
        self.first = first
        self._compute_rest = compute_rest
        self.empty = empty
        self._rest = None
        self._computed = False

    @property
    def rest(self):
        assert not self.empty, 'Empty streams have no rest.'
        if not self._computed:
            self._rest = self._compute_rest()
            self._computed = True
        return self._rest

    def __repr__(self):
        return 'Stream({0}, &lt;...&gt;)'.format(repr(self.first))
</code></pre>

<p>We represent Streams using Python objects, similar to the way we
defined RLists.  We nest streams inside one another, and compute one
element of the sequence at a time.</p>

<p>Note that instead of specifying all of the elements in <code>__init__</code>, we
provide a function, <code>compute_rest</code>, that encapsulates the algorithm
used to calculate the remaining elements of the stream. Remember that
the code in the function body is not evaluated until it is called,
which lets us implement the desired evaluation behavior.</p>

<p>This implementation of streams also uses <em>memoization</em>.  The first time
a program asks a <code>Stream</code> for its <code>rest</code> field, the <code>Stream</code> code
computes the required value using <code>compute_rest</code>, saves the resulting
value, and then returns it. After that, every time the <code>rest</code> field is
referenced, the stored value is simply returned and it is not computed
again.</p>

<p>Here is an example:</p>

<pre><code>def make_integer_stream(first=1):
    def compute_rest():
        return make_integer_stream(first+1)
    return Stream(first, compute_rest)
</code></pre>

<p>Notice what is happening here. We start out with a stream whose first
element is 1, and whose <code>compute_rest</code> function creates another stream.
So when we do compute the <code>rest</code>, we get another stream whose first
element is one greater than the previous element, and whose
<code>compute_rest</code> creates another stream. Hence, we effectively get an
infinite stream of integers, computed one at a time. This is almost
like an infinite recursion, but one which can be viewed one step at a
time, and so does not crash.</p>

<h3 class='question'>Question 5</h3>

<p>Write a procedure <code>add_streams</code> that takes in two streams <code>s1</code>, <code>s2</code>,
and returns a new stream that is the result of adding elements
from <code>s1</code> by elements from <code>s2</code>.  For instance, if <code>s1</code> was <code>(1, 2, 3,
...)</code> and <code>s2</code> was <code>(2, 4, 6, ...)</code>, then the output would be the
stream <code>(3, 6, 9, ...)</code>.  You can assume that both Streams are
infinite.</p>

<pre><code>def add_streams(s1, s2):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>    def compute_rest():
        return add_streams(s1.rest, s2.rest)
    return Stream(s1.first + s2.first, compute_rest)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 6</h3>

<p>Write a procedure <code>make_fib_stream()</code> that creates an infinite stream
of Fibonacci Numbers.  Make the first two elements of the stream 0 and
1.</p>

<p><em>Hint</em>: Consider using a helper procedure that can take two arguments,
then think about how to start calling that procedure.</p>

<pre><code>def make_fib_stream():
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>def make_fib_stream():
    return fib_stream_generator(0, 1)

def fib_stream_generator(a, b):
    def compute_rest():
        return fib_stream_generator(b, a+b)
    return Stream(a, compute_rest)
</code></pre>

<p>If the <code>add_stream</code> function has been defined, we can wrte
<code>make_fib_stream</code> this way instead:</p>

<pre><code>    def compute_rest():
        return add_stream(make_fib_stream(), make_fib_stream().rest)
    return Stream(0, lambda: Stream(1, compute_rest))

    def add_stream(s1, s2):
        return Stream(s1.first + s2.first, add_stream(s1.rest, s2.rest))
</code></pre>

  </div>
<?php } ?>
<h3>Higher Order Functions on Streams</h3>

<p>Naturally, as the theme has always been in this class, we can abstract
our stream procedures to be higher order. Take a look at
<code>filter_stream</code>:</p>

<pre><code>def filter_stream(filter_func, stream):
    def make_filtered_rest():
        return filter_stream(filter_func, stream.rest)
    if Stream.empty:
        return stream
    elif filter_func(stream.first):
        return Stream(stream.first, make_filtered_rest)
    else:
        return filter_stream(filter_funct, stream.rest)
</code></pre>

<p>You can see how this function might be useful. Notice how the Stream we
create has as its <code>compute_rest</code> function a procedure that <em>promises</em>
to filter out the rest of the Stream when asked.  So at any one point,
the entire stream has not been filtered.  Instead, only the part of the
stream that has been referenced has been filtered, but the rest will be
filtered when asked. We can model other higher order Stream procedures
after this one, and we can combine our higher order Stream procedures
to do incredible things!</p>

<h3 class='question'>Question 7</h3>

<p>In a similar model to <code>filter_stream</code>, let's recreate the
procedure <code>map_stream</code> from lecture, that given a stream <code>stream</code> and
a one-argument function <code>func</code>, returns a new stream that is the result of
applying <code>func</code> on every element in <code>stream</code>.</p>

<pre><code>def stream_map(func, stream):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>    def compute_rest():
        return stream_map(func, stream.rest)
    if stream.empty:
        return stream
    else:
        return Stream(func(stream.first), compute_rest)
</code></pre>

  </div>
<?php } ?>
<h3 class='question'>Question 8</h3>

<p>What does the following Stream output? Try writing out the
first few values of the stream to see the pattern.</p>

<pre><code>def my_stream():
    def compute_rest():
        return add_streams(map_stream(double, 
                                      my_stream()), 
                                      my_stream())
    return Stream(1, compute_rest)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <p>Powers of 3: 1, 3, 9, 27, 81, ...</p>

  </div>
<?php } ?>
<h3 class='question'>Question 9</h3>

<p>Define a function <code>interleave</code>, which takes in two streams:</p>

<ul>
<li><code>a1, a2, a3, ...</code></li>
<li><code>b1, b2, b3, ...</code></li>
</ul>

<p>and returns the new stream</p>

<pre><code>a1, b1, a2, b2, a3, b3, ...
</code></pre>

<p>If either of the inputs is finite, the output stream should be finite
as well, terminating just at the point where it would be impossible to
go on. If both of the inputs are infinite, the output stream should be
infinite as well.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <pre><code>def interleave(stream1, stream2):
    if stream1.empty:
        return Stream.the_empty_stream
    return Stream(stream1.first, lambda: interleave(stream2, stream1.rest))
</code></pre>

  </div>
<?php } ?>
<p></p>

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
