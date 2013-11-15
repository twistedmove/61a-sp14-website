<head>
  <meta name="description" content ="CS61A: Structure and Interpretation of
  Computer Programs" />
  <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming,
  Berkeley, EECS" />
  <meta name="author" content ="Steven Tang, Eric Tzeng, Albert Wu,
  Mark Miyashita, Robert Huang, Andrew Huang, Brian Hou, Leonard Truong,
  Jeffrey Lu, Rohan Chitnis" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style type="text/css">@import url("../lab_style.css");</style>
  <style type="text/css">@import url("../61a_style.css");</style>
    <title>CS 61A Summer 2013: Lab 07a</title>

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
    $RELEASE_DATE = new DateTime("08/06/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head>

  <body style="font-family: Georgia,serif;">

<h1>CS61A Lab 07a: Tail-Calls, Iterators, Generators</h1>
<h3>Week 7, 2013</h3>

<h2 class="section_title">Tail Calls</h2>

<p>
Recall from lecture that Scheme supports tail-call optimization.  The
example we used was factorial (shown in both Python and Scheme):
</p>

<pre class='codemargin'>
def fact(n):
    if n == 0:
        return 1
    return n * fact(n - 1)
	
(define (fact n)
    (if (= n 0)
        1
        (* n (fact (- n 1)))))
</pre>

<p> Notice that in this version of factorial,
the return expressions both use recursive calls, and then use the values
for more "work."  In other words, the current frame needs to sit around,
waiting for the recursive call to return with a value.  Then the current frame
can use that value to calculate the final answer. </p>

<p> As an example, consider a call to <span class="code">fact(5)</span> (Shown with Scheme below).
We make a new frame for the call, and in carrying out the body of the function, 
we hit the recursive case, where we want to multiply 5 by the return value of the
call to <span class="code">fact(4)</span>.  Then we want to return this product
as the answer to <span class="code">fact(5)</span>.  However, before calculating
this product, we must wait for the call to <span class="code">fact(4)</span>.
The current frame stays while it waits.  This is true for every successive recursive
call, so by calling <span class="code">fact(5)</span>, at one point we will have the frame of <span class="code">fact(5)</span>
as well as the frames of <span class="code">fact(4)</span>, <span class="code">fact(3)</span>,
<span class="code">fact(2)</span>, and <span class="code">fact(1)</span>, all waiting for 
<span class="code">fact(0)</span>.
</p>

<pre class='codemargin'>
(fact 5)
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
</pre>

<p> Keeping all these frames around wastes a lot of space, so our goal is
to come up with an implementation of factorial that uses a constant
amount of space.  We notice that in Python we can do this with a while
loop: </p>

<pre class='codemargin'>
def fact_while(n):
    total = 1
    while n > 0:
        total = total * n
        n = n - 1
    return total
</pre>

<p> However, Scheme doesn't have <span class="code">for</span> and 
<span class="code">while</span> constructs.  No problem!  Everything
that can be written with while and <span class="code">for</span> loops and also be written recursively.
Instead of a variable, we introduce a new parameter to keep track of the total. </p>

<pre class='codemargin'>
def fact(n):
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
	
</pre>

<p> Why is this better? </p>

<p> Because Scheme supports tail-call optimization (note that Python <b>does not</b>), it knows when it no
longer needs to keep around frames because there is no further calculation
to do.  Looking at the last line in <span class="code">fact_optimized</span>,
we notice that it returns the same thing that the recursive call does,
no more work required.  Scheme realizes that there is no reason to keep
around a frame that has no work left to do, so it just has the return of
the recursive call return directly to whatever called the current frame. </p>

<p>Therefore the last line in <span class="code">fact_optimized</span> is a
<b>tail-call</b>.</p>

<h2 class="section_title">Q1</h2>
<p>
To sum it up (with vocabulary!), here is the quote from lecture: 
"A procedure call that has not yet returned is <b>active</b>. Some procedure calls are
<b>tail calls</b>. A Scheme interpreter should support an unbounded number of
active tail calls."</p>

<p>A tail call is a call expression in a <b>tail context</b>:
<ul>
	<li>The last body sub-expression in a <span class="code">lambda</span> expression</li>
	<li>Sub-expressions 2 and 3 in a tail context <span class="code">if</span> expression</li>
	<li>All non-predicate sub-expressions in a tail context <span class="code">cond</span></li>
	<li>The last sub-expression in a tail context <span class="code">and</span> or <span class="code">or</span></li>
	<li>The last sub-expression in a tail context <span class="code">begin</span></li>
</ul>
Call expressions in "tail contexts" are tail calls, because there is no reason to
keep the current frame "active."
</p>

<p>For the following procedures, decide whether each is tail-call optimized.
Do not run the procedures (they may not work)!</p>

<p>Check the recursive calls in tail positions (there might be multiple).
Is it in a tail context?  In other words, does the last recursive call
need to return to the caller because there is still more work to be
done with it?</p>

<p>List what each of the tail-calls are to help decide of they are optimized.</p>

<pre class='codemargin'>
(define (question-a x)
    (if (= x 0)
        0
        (+ x (question-a (- x 1)))))
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>The tail call is a "+."  This is not optimized, because a recursive call is an
argument to the call to "+."  
</p>
</div>

<pre class='codemargin'>
(define (question-b x y)
    (if (= x 0)
        y
        (question-b (- x 1) (+ y x))))
</pre>


<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>Tail-call to question-b.  It is in sub-expression 3 in a tail context if expression.
</p>
</div>

<pre class='codemargin'>
(define (question-c x y)
    (if (= x y)
        #t
        (if (&lt x y)
            #f
            (or (question-c (- x 1) (- y 2)) #f))))
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>Does not have a tail-call.  (question-c would need to be called outside of the or statement or in the last sub-expression.)
</p>
</div>

<pre class='codemargin'>
(define (question-d x y)
    (cond ((= x y) #t)
            ((&lt x y) #f)
            (else (or #f (question-d (- x 1) (- y 2))))))
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>There is a tail-call to question-d because it is the last sub-expression in a tail context or statement.
</p>
</div>

<pre class='codemargin'>
(define (question-e x y)
    (if (&gt x y)
        (question-e (- y 1) x)
        (question-e (+ x 10) y)))
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>Both recursive calls are tail-calls.  But infinite loop!  So please don't do this.
</p>
</div>

<pre class='codemargin'>
(define (question-f n)
    (if (question-f n)
        (question-f (- n 1))
        (question-f (+ n 10))))
</pre>

<?php?>
<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p> The 2 recursive calls in the non-predicate sub-expressions are tail-calls.
</p>
</div>
<?php?>

<h2 class="section_title">Q2</h2>

<p>Write a function last, which takes in a Scheme list and returns the last element
of the list. Make sure it is tail recursive!</p>
<pre class='codemargin'>
(define (last s)
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    (if (null? (cdr s))
        (car s)
        (last (cdr s))))
</pre>
</div>
<?php } ?>

<h2 class="section_title">Q3</h2>

<p>Write the tail recursive version of a function that returns the nth fibonacci number.
It might be beneficial to try writing a normal recursive solution and/or a iterative
Python version first.</p>
<pre class='codemargin'>
(define (fib n)
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    (define (fib-iter k prev curr)
        (if (= k n) curr
            (fib-iter (+ k 1) curr (+ curr prev))))
    (if (= n 1) 0
        (fib-iter 2 0 1)))
</pre>
</div>
<?php } ?>
<h2 class="section_title">Q4</h2>

<p>Write a tail-recursive function reverse that takes in a Scheme list a returns 
a reversed copy.  Hint: use a helper function!</p>
<pre class='codemargin'>
(define (reverse-iter lst)
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
        (reverse-iter nil lst))

    (define (reverse-iter sofar rest)
        (if (null? rest) 
              sofar
              (reverse-iter (cons (car rest) sofar) (cdr rest))))
</pre>
</div>
<?php } ?>

<h2 class="section_title">Q5</h2>

<p>Write a tail-recursive function that inserts number n into a sorted list 
of numbers, s. Hint: Use the built-in scheme function append</p>
<pre class='codemargin'>
(define (insert n s)
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    (define (insert-help s so-far)
        (cond ((null? s) so-far)
                 ((< n (car s)) (append so-far (cons n s)))
                 (else (insert-help (cdr s) (append so-far (list (car s))))))
    (insert-help s nil))
</pre>
</div>
<?php } ?>



<h2 class="section_title">Iterators :D</h2>

<p> Remember the <span class="code">for</span> loop?  (We really hope so.)  The object that
the <span class="code">for</span> loop iterates over is required to be an iterable!</p>

<pre class='codemargin'>
for elem in iterable:
    # do something
</pre>

<p><span class="code">for</span> loops only work with iterables, and that means that the object you want to
use a <span class="code">for</span> loop on must implement the <b>iterable interface</b>.  In particular,
a <span class="code">for</span> loop makes use of two methods: <span class="code">__iter__</span>
and <span class="code">__next__</span>.  In other words,
an object that implements the iterable interface must implement an <span class="code">__iter__</span> method
that returns an object that implements the <span class="code">__next__</span>
method.</p>

<p>This object that implements the <span class="code">__next__</span> method is
called an iterator.  While the iterator interface also requires that the object implement
the <span class="code">__next__</span> and <span class="code">__iter__</span>
methods, it does not require the <span class="code">__iter__</span> method to
return a new object.</p>

<p> Here is an example of a class definition for an object that implements the
iterator interface:</p>

<pre class='codemargin'>
class AnIterator(object):
    def __init__(self):
        self.current = 0
        
    def __next__(self):
        if self.current > 5:
            raise StopIteration
        self.current += 1
        return self.current
        
    def __iter__(self):
        return self
</pre>

<p> Let's go ahead and try out our new toy.</p>

<pre class='codemargin'>
>>> for i in AnIterator():
...     print(i)
...
1
2
3
4
5
</pre>

<p> This is somewhat equivalent to running:</p>

<pre class='codemargin'>
t = AnIterator()
t = t.__iter__()
try:
    while True:
        print(t.__next__())
except StopIteration as e:
    pass
</pre>

<h2 class="section_title">Q5</h2>

<p>Try running each of the given iterators in a <span class="code">for</span> loop.  Why does each work or not
work?</p>
<pre class='codemargin'>
class IteratorA(object):
    def __init__(self):
        self.start = 5
        
    def __next__(self):
        if self.start == 100:
            raise StopIteration
        self.start += 5
        return self.start
        
    def __iter__(self):
        return self
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>No problem, this is a beautiful iterator.
</p>
</div>

<pre class='codemargin'>
class IteratorB(object):
    def __init__(self):
        self.start = 5
        
    def __iter__(self):
        return self
</pre>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>Oh no!  Where is <span class="code">__next__</span>?  This fails to implement the iterator interface because 
calling <span class="code">__iter__</span> doesn't return something that has a <span class="code">__next__</span> method.
</p>
</div>

<pre class='codemargin'>
class IteratorC(object):
    def __init__(self):
        self.start = 5
        
    def __next__(self):
        if self.start == 10:
            raise StopIteration
        self.start += 1
        return self.start
</pre>


<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>This also fails to implement the iterator interface.  Without the __iter__
method, the <span class="code">for</span> loop will error.  The <span class="code">for</span> loop needs to call
<span class="code">__iter__</span> first because some objects might not implement the <span class="code">__next__</span> method
themselves, but calling <span class="code">__iter__</span> will return an object that does.
</p>
</div>

<pre class='codemargin'>
class IteratorD(object):
    def __init__(self):
        self.start = 1
        
    def __next__(self):
        self.start += 1
        return self.start
        
    def __iter__(self):
        return self
</pre>
<p> Watch out on this one.  The amount of output might scare you. </p>

<button id="toggleButton<?php echo $q_num; ?>">Explanation</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<p>This is an infinite sequence!  Sequences like these are the reason iterators are useful.
Because iterators delay computation, we can use a finite amount of memory to
represent an infinitely long sequence.
</p>
</div>

<p> For one of the above iterators that works, try this:</p>
<pre class='codemargin'>
>>> i = IteratorA()
>>> for item in i:  
...     print(item)
</pre>
<p>Then again:</p>
<pre class='codemargin'>
>>> for item in i:  
...     print(item)
</pre>

<p>With that in mind, try writing an iterator that "restarts" every time
it is run through a <span class="code">for</span> loop.</p>
<pre class='codemargin'>
>>> i = IteratorRestart(2, 7)
>>> for item in i:  
...     print(item)
# should print 2 to 7
>>> for item in i:  
...     print(item)
# should still print 2 to 7
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
class IteratorRestart(object):
    def __init__(self, start, end):
        self.start = start
        self.end = end
        self.current = start
    def __next__(self):
        if self.current > self.end:
            raise StopIteration
        self.current += 1
    def __iter__(self):
        self.current = self.start
        return self
</pre>
</div>
<?php } ?>

<h2 class="section_title">Q6</h2>

<p>Write an iterator that takes a string as input:</p>
<pre class='codemargin'>
>>> s = Str("hello")
>>> for char in s:
...     print(char)
...
h
e
l
l
o
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
class Str:
    def __init__(self, str):
        self.str = str
    def __iter__(self):
        return self.str.__iter__()
</pre>

<p> That works (why?), but just kidding. </p>

<pre class='codemargin'>
class Str:
    def __init__(self, str):
        self.str = str
        self.i = -1
        
    def __next__(self):
        if self.i >= len(self.str):
            raise StopIteration
        self.i += 1
        return self.str[self.i]
    
    def __iter__(self):
        return self
</pre>
</div>
<?php } ?>

<h2 class="section_title">Generators</h2>
<p>A generator is a special type of iterator that can be written using a yield statement:</p>

<pre class='codemargin'>
def &ltgenerator_function&gt():
    &ltsomevariable&gt = &ltsomething&gt
    while &ltpredicate&gt:
        yield &ltsomething&gt
        &ltincrement variable&gt
</pre>

<p>A generator function can also be run through a <span class="code">for</span> loop:</p>

<pre class='codemargin'>
def generator():
    i = 0
    while i &lt 6:
        yield i
        i += 1
        
for i in generator():
    print(i)
</pre>

<p> To better figure out what is happening, try this:</p>
<pre class='codemargin'>
def generator():
    print("Starting here")
    i = 0
    while i &lt 6:
        print("Before yield")
        yield i
        print("After yield")
        i += 1
        
>>> g = generator()
>>> g
___ # what is this thing?
>>> g.__iter__()
___
>>> g.__next__()
___
>>> g.__next__()
____
</pre>

<p> Trace through the code and make sure you know where and why each statement
is printed.</p>

<p>You might have noticed from the Iterators section that the Iterator defined without
a <span class="code">__next__</span> method failed to run in the <span class="code">for</span> loop.  However, this is not always the case.</p>

<pre class='codemargin'>
class IterGen(object):
    def __init__(self):
        self.start = 5
        
    def __iter__(self):
        while self.start &lt 10:
            self.start += 1
            yield self.start
            
for i in IterGen():
    print(i)
</pre>

<p> Think for a moment about why that works.</p>

<p> Think more. </p>

<p> Longer. </p>

<p> Okay, I'll tell you. <p>

<p> The <span class="code">for</span> loop only expects the object returned by <span class="code">__iter__</span> to have a <span class="code">__next__</span> method,
and the <span class="code">__iter__</span> method is a generator function in this case.  Therefore, when <span class="code">__iter__</span> is called,
it returns a generator object, which you can call <span class="code">__next__</span> on.<p>

<h2 class="section_title">Q7</h2>

<p>Write a generator that counts down to 0.</p>

<p>Write it in both ways: using a generator function on its own, and 
within the <span class="code">__iter__</span> method of a class.</p>
<pre class='codemargin'>
def countdown(n):
    """
    >>> for number in countdown(5):
    ...     print(number)
    ...
    5
    4
    3
    2
    1
    0
    """
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    while n >= 0:
        yield n
        n = n - 1
</pre>
</div>
<?php } ?>
<pre class='codemargin'>
class Countdown(object):
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    def __init__(self, cur):
        self.cur = cur
        
    def __iter__(self):
        while self.cur > 0:
            yield self.cur
            self.cur -= 1
</pre>
</div>
<?php } ?>

<h2 class="section_title">Q8</h2>

<p>Like in the iterator section, write a generator that outputs
each character of a string.</p>

<pre class='codemargin'>
def char_gen(str):
    """
    >>> for char in char_gen("hello"):
    ...     print(char)
    ...
    h
    e
    l
    l
    o
    """
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    i = 0
    while i &lt len(str):
        yield str[i]
        i += 1
</pre>
</div>
<?php } ?>

<h2 class="section_title">Q9</h2>

<p>Write a generator that outputs the hailstone sequence from homework 1.</p>

<pre class='codemargin'>
def hailstone(n):
    """
    >>> for num in hailstone(10):
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
</pre>
<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class='codemargin'>
    i = n
    while i > 1:
        yield i
        if i % 2 == 0:
            i //= 2
        else: 
            i = i*3 + 1
    yield i
</pre>
</div>
<?php } ?>


<p>And now you know how <span class="code">for</span> loops work!  Or more importantly, you have
become a better computer scientist.</p>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
<?php for ($i = 0; $i < $q_num; $i++) { ?>
$("#toggleButton<?php echo $i; ?>").click(function () {
$("#toggleText<?php echo $i; ?>").toggle();
});
<?php } ?>
</script>

</body>
</html>
