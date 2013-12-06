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

    <title>CS 61A Fall 2013: Lab 10</title> 

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
    $RELEASE_DATE = new DateTime("11/21/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 10</h1>
<h2>Iterators, Generators, Streams, and Tail-Calls</h2>
<h3>Iterators</h3>

<p>Remember the <code>for</code> loop?  (We really hope so.)  The object that
the <code>for</code> loop iterates over is required to be an iterable!</p>

<pre><code>for elem in iterable:
    # do something
</code></pre>

<p><code>for</code> loops only work with iterables, and that means that the object you want to
use a <code>for</code> loop on must implement the <b>iterable interface</b>.  In particular,
a <code>for</code> loop makes use of two methods: <code>__iter__</code> and <code>__next__</code>.  In other words,
an object that implements the iterable interface must implement an <code>__iter__</code> method
that returns an object that implements the <code>__next__</code>
method.</p>

<p>This object that implements the <code>__next__</code> method is
called an iterator.  While the iterator interface also requires that the object implement
the <code>__next__</code> and <code>__iter__</code>
methods, it does not require the <code>__iter__</code> method to
return a new object.</p>

<p>Here is an example of a class definition for an object that implements the
iterator interface:</p>

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

<h4>Q1</h4>

<p>Try running each of the given iterators in a <code>for</code> loop.  Why does each work or not work?</p>

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

<button id="toggleButton0">Explanation</button>
<div id="toggleText0" style="display: none">
  <p>No problem, this is a beautiful iterator.</p>

</div>
<pre><code>class IteratorB(object):
    def __init__(self):
        self.start = 5

    def __iter__(self):
        return self
</code></pre>

<button id="toggleButton1">Explanation</button>
<div id="toggleText1" style="display: none">
  <p>Oh no!  Where is <code>__next__</code>?  This fails to implement the iterator interface because 
calling <code>__iter__</code> doesn't return something that has a <code>__next__</code> method.</p>

</div>
<pre><code>class IteratorC(object):
    def __init__(self):
        self.start = 5

    def __next__(self):
        if self.start == 10:
            raise StopIteration
        self.start += 1
        return self.start
</code></pre>

<button id="toggleButton2">Explanation</button>
<div id="toggleText2" style="display: none">
  <p>This also fails to implement the iterator interface.  Without the <code>__iter__</code>
method, the <code>for</code> loop will error.  The <code>for</code> loop needs to call
<code>__iter__</code> first because some objects might not implement the <code>__next__</code> method
themselves, but calling <code>__iter__</code> will return an object that does.</p>

</div>
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

<button id="toggleButton3">Explanation</button>
<div id="toggleText3" style="display: none">
  <p>This is an infinite sequence!  Sequences like these are the reason iterators are useful.
Because iterators delay computation, we can use a finite amount of memory to
represent an infinitely long sequence.</p>

</div>
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
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>class IteratorRestart(object):
    def __init__(self, start, end):
        self.start = start
        self.end = end
        self.current = start
    def __next__(self):
        if self.current &gt; self.end:
            raise StopIteration
        temp = self.current
        self.current += 1
        return temp
    def __iter__(self):
        self.current = self.start
        return self
</code></pre>

  </div>
<?php } ?>
<h4>Q2</h4>

<p>Write an iterator that takes a string as input:</p>

<pre><code>&gt;&gt;&gt; s = Str("hello")
&gt;&gt;&gt; for char in s:
...     print(char)
...
h
e
l
l
o
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>class Str:
    def __init__(self, str):
        self.str = str
    def __iter__(self):
        return self.str.__iter__()
</code></pre>

<p>That works (why?), but just kidding.</p>

<pre><code>class Str:
    def __init__(self, str):
        self.str = str
        self.i = -1

    def __next__(self):
        if self.i &gt;= len(self.str):
            raise StopIteration
        self.i += 1
        return self.str[self.i]

    def __iter__(self):
        return self
</code></pre>

  </div>
<?php } ?>
<h3>Generators</h3>

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

<p>Trace through the code and make sure you know where and why each statement
is printed.</p>

<p>You might have noticed from the Iterators section that the Iterator defined without
a <code>__next__</code> method failed to run in the <code>for</code> loop.  However, this is not always the case.</p>

<pre><code>class IterGen(object):
    def __init__(self):
        self.start = 5

    def __iter__(self):
        while self.start &lt; 10:
            self.start += 1
            yield self.start

for i in IterGen():
    print(i)
</code></pre>

<p>Think for a moment about why that works.</p>

<p>Think more.</p>

<p>Longer.</p>

<p>Okay, I'll tell you.</p>

<p>The <code>for</code> loop only expects the object returned by <code>__iter__</code> to have a <code>__next__</code> method,
and the <code>__iter__</code> method is a generator function in this case.  Therefore, when <code>__iter__</code> is called,
it returns a generator object, which you can call <code>__next__</code> on.</p>

<h4>Q3</h4>

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
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <pre><code>    while n &gt;= 0:
        yield n
        n = n - 1
</code></pre>

  </div>
<?php } ?>
<pre><code>class Countdown(object):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton7">Toggle Solution</button>
  <div id="toggleText7" style="display: none">
    <pre><code>    def __init__(self, cur):
        self.cur = cur

    def __iter__(self):
        while self.cur &gt; 0:
            yield self.cur
            self.cur -= 1
</code></pre>

  </div>
<?php } ?>
<h4>Q4</h4>

<p>Like in the iterator section, write a generator that outputs
each character of a string.</p>

<pre><code>def char_gen(str):
    """
    &gt;&gt;&gt; for char in char_gen("hello"):
    ...     print(char)
    ...
    h
    e
    l
    l
    o
    """
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton8">Toggle Solution</button>
  <div id="toggleText8" style="display: none">
    <pre><code>    i = 0
    while i &lt; len(str):
        yield str[i]
        i += 1
</code></pre>

  </div>
<?php } ?>
<h4>Q5</h4>

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
  <button id="toggleButton9">Toggle Solution</button>
  <div id="toggleText9" style="display: none">
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

<h3>Streams</h3>

<p>A stream is our third example of a lazy sequence. A stream is a lazily evaluated RList.
In other words, the stream's elements (except for the first element) are only evaluated when the values are needed.</p>

<p>Take a look at the following code:</p>

<pre><code>class Stream:
    class empty:
        def __repr__(self):
            return 'Stream.empty'
    empty = empty()

    def __init__(self, first, compute_rest=lambda: Stream.empty):
        assert callable(compute_rest), 'compute_rest must be callable.'
        self.first = first
        self._compute_rest = compute_rest

    @property
    def rest(self):
        if self._compute_rest is not None:
            self._rest = self._compute_rest()
            self._compute_rest = None
        return self._rest

    def __repr__(self):
        return 'Stream({0}, &lt;...&gt;)'.format(repr(self.first))
</code></pre>

<p>We represent Streams using Python objects, similar to the way we defined RLists.
We nest streams inside one another, and compute one element of the sequence at a time.</p>

<p>Note that instead of specifying all of the elements in <code>__init__</code>,
we provide a function, <code>compute_rest</code>, that encapsulates the algorithm used
to calculate the remaining elements of the stream. Remember that the code
in the function body is not evaluated until it is called, which lets us implement
the desired evaluation behavior.</p>

<p>This implementation of streams also uses <em>memoization</em>.
The first time a program asks a <code>Stream</code> for its <code>rest</code> field, the <code>Stream</code>
code computes the required value using <code>compute_rest</code>, saves the resulting value,
and then returns it. After that, every time the <code>rest</code> field is referenced,
the stored value is simply returned and it is not computed again.</p>

<p>Here is an example:</p>

<pre><code>def make_integer_stream(first=1):
    def compute_rest():
        return make_integer_stream(first+1)
    return Stream(first, compute_rest)
</code></pre>

<p>Notice what is happening here. We start out with a stream whose first element is 1,
and whose <code>compute_rest</code> function creates another stream. So when we do compute
the <code>rest</code>, we get another stream whose first element is one greater than the previous element,
and whose <code>compute_rest</code> creates another stream. Hence, we effectively get an
infinite stream of integers, computed one at a time. This is almost like an infinite recursion,
but one which can be viewed one step at a time, and so does not crash.</p>

<h4>Q1</h4>

<p>Write a procedure <code>make_fib_stream()</code> that creates an infinite stream of Fibonacci Numbers.
Make the first two elements of the stream 0 and 1.</p>

<p>Hint: Consider using a helper procedure that can take two arguments, then think about how to start calling that procedure.</p>

<pre><code>def make_fib_stream():
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton10">Toggle Solution</button>
  <div id="toggleText10" style="display: none">
    <pre><code>    return fib_stream_generator(0, 1)

def fib_stream_generator(a, b):
    def compute_rest():
        return fib_stream_generator(b, a+b)
    return Stream(a, compute_rest)
</code></pre>

  </div>
<?php } ?>
<h4>Q2</h4>

<p>Write a procedure <code>sub_streams</code> that takes in two
streams <code>s1</code>, <code>s2</code>, and returns a new stream
that is the result of subtracting elements from <code>s1</code>
by elements from <code>s2</code>.
For instance, if <code>s1</code> was <code>(1, 2, 3, ...)</code>
and <code>s2</code> was <code>(2, 4, 6, ...)</code>, then the output would be
the stream <code>(-1, -2, -3, ...)</code>.
You can assume that both Streams are infinite.</p>

<pre><code>def sub_streams(s1, s2):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton11">Toggle Solution</button>
  <div id="toggleText11" style="display: none">
    <pre><code>    def compute_rest():
        return sub_streams(s1.rest, s2.rest)
    return Stream(s1.first - s2.first, compute_rest)
</code></pre>

  </div>
<?php } ?>
<h4>Q3</h4>

<p>Define a procedure that inputs an infinite Stream, <code>s</code>,
and a target value and returns <code>True</code> if the stream converges
to the target within a certain number of values.
For this example we will say the stream converges if the
difference between two consecutive values and the difference
between the value and the target drop below <code>max_diff</code> for 10 consecutive values.
(Hint: create the stream of differences between consecutive elements using <code>sub_streams</code>)</p>

<pre><code>def converges_to(s, target, max_diff=0.00001, num_values=100):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton12">Toggle Solution</button>
  <div id="toggleText12" style="display: none">
    <pre><code>    count = 0
    deriv = sub_streams(s.rest, s)
    for i in range(num_values):
        if abs(s.first - target) &lt;= max_diff and \
           abs(deriv.first) &lt;= max_diff:
            count += 1
        else:
            count = 0
        if count == 10:
            return True
        deriv = deriv.rest
        s = s.rest
    return False
</code></pre>

  </div>
<?php } ?>
<h3>Higher Order Functions on Streams</h3>

<p>Naturally, as the theme has always been in this class,
we can abstract our stream procedures to be higher order. Take a look at <code>filter_stream</code>:</p>

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

<p>You can see how this function might be useful. Notice how the Stream we create has as its
<code>compute_rest</code> function a procedure that <em>promises</em> to filter out the rest of the Stream when asked.
So at any one point, the entire stream has not been filtered.
Instead, only the part of the stream that has been referenced has been filtered,
but the rest will be filtered when asked. We can model other higher order Stream
procedures after this one, and we can combine our higher order Stream procedures to do incredible things!</p>

<h4>Q4</h4>

<p>In a similar model to <code>filter_stream</code>, let's recreate the
procedure <code>map_stream</code> from lecture, that given a stream <code>stream</code> and
a one-argument function <code>func</code>, returns a new stream that is the result of
applying <code>func</code> on every element in <code>stream</code>.</p>

<pre><code>def stream_map(func, stream):
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton13">Toggle Solution</button>
  <div id="toggleText13" style="display: none">
    <pre><code>    def compute_rest():
        return stream_map(func, stream.rest)
    if stream.empty:
        return stream
    else:
        return Stream(func(stream.first), compute_rest)
</code></pre>

  </div>
<?php } ?>
<h4>Q5</h4>

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
  <button id="toggleButton14">Toggle Solution</button>
  <div id="toggleText14" style="display: none">
    <p>Powers of 3: 1, 3, 9, 27, 81, ...</p>

  </div>
<?php } ?>
<h3>Tail Calls</h3>

<p>Recall from lecture that Scheme supports tail-call optimization.
The example we used was factorial (shown in both Python and Scheme):</p>

<pre><code>def fact(n):
    if n == 0:
        return 1
    return n * fact(n - 1)

(define (fact n)
    (if (= n 0)
        1
        (* n (fact (- n 1)))))
</code></pre>

<p>Notice that in this version of factorial,
the return expressions both use recursive calls, and then use the values
for more "work." In other words, the current frame needs to sit around,
waiting for the recursive call to return with a value. Then the current frame
can use that value to calculate the final answer.</p>

<p>As an example, consider a call to <code>fact(5)</code> (Shown with Scheme below).
We make a new frame for the call, and in carrying out the body of the function,
we hit the recursive case, where we want to multiply 5 by the return value of the
call to <code>fact(4)</code>.  Then we want to return this product
as the answer to <code>fact(5)</code>.  However, before calculating
this product, we must wait for the call to <code>fact(4)</code>.
The current frame stays while it waits.  This is true for every successive recursive
call, so by calling <code>fact(5)</code>, at one point we will have the frame of <code>fact(5)</code>
as well as the frames of <code>fact(4)</code>, <code>fact(3)</code>, <code>fact(2)</code>, and <code>fact(1)</code>, all waiting for <code>fact(0)</code>.</p>

<pre><code>(fact 5)
(* 5 (fact 4))
(* 5 (* 4 (fact 3)))
(* 5 (* 4 (* 3 (fact 2))))
(* 5 (* 4 (* 3 (* 2 (fact 1)))))
(* 5 (* 4 (* 3 (* 2 (* 1 (fact 0))))))
(* 5 (* 4 (* 3 (* 2 (* 1 1)))))
(* 5 (* 4 (* 3 (* 2 1))))
(* 5 (* 4 (* 3 2)))
(* 5 (* 4 6))
(* 5 24)
120
</code></pre>

<p>Keeping all these frames around wastes a lot of space, so our goal is
to come up with an implementation of factorial that uses a constant
amount of space. We notice that in Python we can do this with a while
loop:</p>

<pre><code>def fact_while(n):
    total = 1
    while n &gt; 0:
        total = total * n
        n = n - 1
    return total
</code></pre>

<p>However, Scheme doesn't have <code>for</code> and
<code>while</code> constructs. No problem! Everything
that can be written with while and <code>for</code> loops and also be written recursively.
Instead of a variable, we introduce a new parameter to keep track of the total.</p>

<pre><code>def fact(n):
    def fact_optimized(n, total):
        if n == 0:
            return total
        return fact_optimized(n - 1, total * n)
    return fact_optimized(n, 1)

(define (fact n)
    (define (fact-optimized n total)
        (if (= n 0)
            total
            (fact-optimized (- n 1) (* total n))))
    (fact-optimized n 1))
</code></pre>

<p>Why is this better?</p>

<p>Because Scheme supports tail-call optimization (note that Python <strong>does not</strong>), it knows when it no
longer needs to keep around frames because there is no further calculation
to do.  Looking at the last line in <code>fact_optimized</code>,
we notice that it returns the same thing that the recursive call does,
no more work required.  Scheme realizes that there is no reason to keep
around a frame that has no work left to do, so it just has the return of
the recursive call return directly to whatever called the current frame.</p>

<p>Therefore the last line in <code>fact_optimized</code> is a <strong>tail-call</strong>.</p>

<h4>Q1</h4>

<p>To sum it up (with vocabulary!), here is the quote from lecture:
"A procedure call that has not yet returned is <strong>active</strong>. Some procedure calls are
<strong>tail calls</strong>. A Scheme interpreter should support an unbounded number of
active tail calls."</p>

<p>A tail call is a call expression in a <strong>tail context</strong>:</p>

<ul>
<li>The last body sub-expression in a <code>lambda</code> expression</li>
<li>Sub-expressions 2 and 3 in a tail context <code>if</code> expression</li>
<li>All non-predicate sub-expressions in a tail context <code>cond</code></li>
<li>The last sub-expression in a tail context <code>and</code> or <code>or</code></li>
<li>The last sub-expression in a tail context <code>begin</code></li>
</ul>

<p>Call expressions in "tail contexts" are tail calls, because there is no reason to
keep the current frame "active."</p>

<p>For the following procedures, decide whether each is tail-call optimized.
Do not run the procedures (they may not work)!</p>

<p>Check the recursive calls in tail positions (there might be multiple).
Is it in a tail context?  In other words, does the last recursive call
need to return to the caller because there is still more work to be
done with it?</p>

<p>List what each of the tail-calls are to help decide if they are optimized.</p>

<pre><code>(define (question-a x)
    (if (= x 0)
        0
        (+ x (question-a (- x 1)))))
</code></pre>

<button id="toggleButton15">Explanation</button>
<div id="toggleText15" style="display: none">
  <p>The tail call is a "+."  This is not optimized, because a recursive call is an
argument to the call to "+."</p>

</div>
<pre><code>(define (question-b x y)
    (if (= x 0)
        y
        (question-b (- x 1) (+ y x))))
</code></pre>

<button id="toggleButton16">Explanation</button>
<div id="toggleText16" style="display: none">
  <p>Tail-call to question-b.  It is in sub-expression 3 in a tail context if expression.</p>

</div>
<pre><code>(define (question-c x y)
    (if (= x y)
        #t
        (if (&lt; x y)
            #f
            (or (question-c (- x 1) (- y 2)) #f))))
</code></pre>

<button id="toggleButton17">Explanation</button>
<div id="toggleText17" style="display: none">
  <p>Does not have a tail-call. (question-c would need to be called outside of the or statement or in the last sub-expression)</p>

</div>
<pre><code>(define (question-d x y)
    (cond ((= x y) #t)
            ((&lt; x y) #f)
            (else (or #f (question-d (- x 1) (- y 2))))))
</code></pre>

<button id="toggleButton18">Explanation</button>
<div id="toggleText18" style="display: none">
  <p>There is a tail-call to question-d because it is the last sub-expression in a tail context or statement.</p>

</div>
<pre><code>(define (question-e x y)
    (if (&gt; x y)
        (question-e (- y 1) x)
        (question-e (+ x 10) y)))
</code></pre>

<button id="toggleButton19">Explanation</button>
<div id="toggleText19" style="display: none">
  <p>Both recursive calls are tail-calls.  But infinite loop!  So please don't do this.</p>

</div>
<pre><code>(define (question-f n)
    (if (question-f n)
        (question-f (- n 1))
        (question-f (+ n 10))))
</code></pre>

<button id="toggleButton20">Explanation</button>
<div id="toggleText20" style="display: none">
  <p>The 2 recursive calls in the non-predicate sub-expressions are tail-calls.</p>

</div>
<h4>Q2</h4>

<p>Write a function last, which takes in a Scheme list and returns the last element
of the list. Make sure it is tail recursive!</p>

<pre><code>(define (last s)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton21">Toggle Solution</button>
  <div id="toggleText21" style="display: none">
    <pre><code>    (if (null? (cdr s))
        (car s)
        (last (cdr s))))
</code></pre>

  </div>
<?php } ?>
<h4>Q3</h4>

<p>Write the tail recursive version of a function that returns the nth fibonacci number.
It might be beneficial to try writing a normal recursive solution and/or a iterative
Python version first.</p>

<pre><code>(define (fib n)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton22">Toggle Solution</button>
  <div id="toggleText22" style="display: none">
    <pre><code>    (define (fib-iter k prev curr)
        (if (= k n) curr
            (fib-iter (+ k 1) curr (+ curr prev))))
    (if (= n 1) 0
        (fib-iter 2 0 1)))
</code></pre>

  </div>
<?php } ?>
<h4>Q4</h4>

<p>Write a tail-recursive function reverse that takes in a Scheme list a returns 
a reversed copy.  Hint: use a helper function!</p>

<pre><code>(define (reverse-iter lst)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton23">Toggle Solution</button>
  <div id="toggleText23" style="display: none">
    <pre><code>    (reverse-iter nil lst))

(define (reverse-iter sofar rest)
    (if (null? rest)
          sofar
          (reverse-iter (cons (car rest) sofar) (cdr rest))))
</code></pre>

  </div>
<?php } ?>
<h4>Q5</h4>

<p>Write a tail-recursive function that inserts number n into a sorted list
of numbers, s. Hint: Use the built-in scheme function append.</p>

<pre><code>(define (insert n s)
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton24">Toggle Solution</button>
  <div id="toggleText24" style="display: none">
    <pre><code>    (define (insert-help s so-far)
        (cond ((null? s) so-far)
                 ((&lt; n (car s)) (append so-far (cons n s)))
                 (else (insert-help (cdr s) (append so-far (list (car s))))))
    (insert-help s nil))
</code></pre>

  </div>
<?php } ?>
<p></p>

  </body>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 25; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
</html>
