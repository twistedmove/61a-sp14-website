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

    <title>CS 61A Fall 2013: Lab 8</title> 

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
    $RELEASE_DATE = new DateTime("11/7/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 8</h1>
<h2>Exceptions, Calculator, and Scheme</h2>
<p>You can get the starter files <a href="./starter.zip">here</a>.</p>

<h2>Exceptions!</h2>

<p>Exceptions allow us to try a chunk of code, and then catch any errors that might come
up. If we do catch an exception, we can run an alternative set of instructions. This
construct is very useful in many situations.</p>

<pre><code>    try:
        &lt;try suite&gt;
    except Exception as e:
        &lt;except suite&gt;
    else:
        &lt;else suite&gt;
    finally:
        &lt;finally suite&gt;
</code></pre>

<p>Notice that we can catch the exception as e. This assigns the name e to the exception object.
This can be helpful when we want to give extra information on what happened. For example,
we can print(e) inside the except clause.</p>

<p>Also, we have an optional else case. The else suite is executed if the try suite finishes
without any exceptions.</p>

<p>We also have an optional finally clause, which is always executed, whether or not an
exception is thrown. We generally don't need to use the else and finally controls in this class.</p>

<p>When we write exception statements, we generally don't just use the word Exception as
above. Rather, we figure out the specific type of exception that we want to handle,
such as TypeError or ZeroDivisionError. To figure out which type of exception you are
trying to handle, you can type purposely wrong things into the interpreter (such as
'hi' + 5 or 1 / 0) and see what kind of exception Python spits out.</p>

<h4>Problem 1:</h4>

<p>For practice, let's use exceptions to create a safe Bank (you can find it in your starter file),
which only stores numerical amounts of money. Fill in the deposit and withdraw methods.
These methods should only take non-negative numerical values. If someone tries to pass in an
amount that isn't a number, catch the appropriate exception and print a message informing them
that a numerical argument is required.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <pre><code>    def deposit(self, amount):
        try:
            if amount &lt; 0:
                print("Cannot deposit a negative amount.")
            else:
                self.__balance += amount
        except TypeError:
            print("Must deposit a numerical amount.")

    def withdraw(self, amount):
        try:
            if amount &lt; 0:
                print("Cannot withdraw a negative amount.")
            else:
                self.__balance -= amount
        except TypeError:
            print("Must withdraw a numerical amount.")
</code></pre>

  </div>
<?php } ?>
<p>Side note: we can also define our own exceptions! You will see an example of this
in project 4, where a SchemeError class has been defined for you.</p>

<h2>Calc: our second interpreter!</h2>

<p>We're continuing our journey through the world of interpreters! We have seen
interpreters before, such as minicalc. Also, that thing you've been running
all of your Python in? That's an interpreter too! In fact, the Python interpreter
we've been using all semester long is really nothing but a program, albeit a
very complex one. You can think of it as a program that takes strings as
input, evaluates them, and prints the result as output.</p>

<p>There's nothing magical about interpreters, though! They're programs, just
like the one's you've been writing throughout the entire semester. In fact,
it's possible to write a Python interpreter in Python; <a href="http://pypy.org">PyPy</a>
is proof of that.  However, because Python is a complex language, writing an
interpreter for it would be a very daunting project. Today, we'll play
around with an interpreter for a calculator language, similar to but more
complex than minicalc.</p>

<p>In lecture, you were introduced to calc, which acts as a simple calculator.
You should have already copied the starter files (scheme_reader.py, calc.py, etc.)
at the start of the lab.</p>

<p>You can also find the code in a zip file here. You can try running
calc by running this command in the terminal:</p>

<pre><code>    python3 calc.py
</code></pre>

<p>To exit the program, type Ctrl-D or Ctrl-C.</p>

<h4>Problem 2:</h4>

<p>Trace through the code in calc.py that would be evaluated when you type the following into calc.</p>

<pre><code>    &gt; 2
    &gt; (+ 2 3)
    &gt; (+ 2 3 4)
    &gt; (+ 2 3)
    &gt; (+ 2)
    &gt; (+ 2 (* 4 5))
</code></pre>

<h3>Infix notation</h3>

<p>While prefix notation (+ 2 3) is easy for computers to interpret, it's not
very natural for humans. We'd much prefer infix notation (2 + 3). Let's implement
this in our own version of calc!</p>

<p>To do this, you need to fill in the following functions, which are in the scheme_reader.py file.</p>

<h4>Problem 3:</h4>

<p>Implement read_infix. This function takes two arguments: first, the first expression
in the infix expression; and src, the Buffer of tokens that contains the rest of the
infix expression (and possibly more). For example, if we wanted to construct 3 + 4 5
(note: the 5 will be ignored, so it's really just 3 + 4), we would call</p>

<pre><code>    read_infix(3, Buffer(tokenize_lines('+ 4 5')))
</code></pre>

<p>The return value should be an expression which is mathematically the same as the
infix notation expression (e.g. + 3 4), but written using Scheme style Pairs. See the
doctests for simple examples. Follow these steps:</p>

<ol>
<li>First, check if there are more tokens left in the Buffer Hint: the Buffer class
in the buffer.py file has a more_on_line property method. If there aren't, we should
just return nil. Also, we would need to return nil if the Buffer's current value (there's
already a method that gives you the current value!) is equal to one of two things.
Think about what these two things would be.</li>
<li>Next, figure out what the operator and second half of the infix expression should be.</li>
<li>Finally, return a Scheme-style expression which represents the same thing as the infix
notation expression you parsed. Look at the doctests for specific examples</li>
</ol>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <pre><code>    def read_infix(first, src):
        if not src.more_on_line or src.current() is None or src.current() == ")":
            return nil
        op = src.pop()
        rest = scheme_read(src)
        return Pair(op, Pair(first, Pair(rest, nil)))
</code></pre>

  </div>
<?php } ?>
<h4>Problem 4:</h4>

<p>Implement next_is_op. This function returns True if the next token in the given
Buffer is an operator, and False otherwise.  </p>

<p><em>Hint</em>: don't forget to check if there are any tokens in the buffer first. Also,
don't remove any tokens from the Buffer (i.e. don't use pop; think of another method you can use).</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <pre><code>    def next_is_op(src):
        return src.more_on_line and src.current() in ['+', '-', '*', '/']
</code></pre>

  </div>
<?php } ?>
<h4>Problem 5:</h4>

<p>Modify scheme_read to parse infix expressions. This requires modifying two parts of the code:</p>

<ol>
<li><p>First, we need to determine if we're dealing with an expression like "2 + 3". To do
this, check if the first item in the Buffer is a float or a int (this part's already written).
If it is, then check that the next token is an operator. If it is, read it like an infix expression.
(Try to call methods you've already written!) Otherwise, just return the value (this part's already written).</p></li>
<li><p>Next, we have to deal with the case of infix notation inside parentheses. Without parentheses,
2 + 2 * 3 and 2 * 3 + 2 should produce the exact same result, but in calc, they don't! calc doesn't
implement order of operations, because prefix notation naturally takes care of operator precedence (why?).</p>

<p>Instead of solving the real problem, we'll implement a quick fix. If we allow expressions to be
surrounded by parentheses, we can write expressions like 2 + (2 * 3), which will evaluate to the
same thing as (2 * 3) + 2.</p>

<p>To do this, we need to change how we parse lists. This logic should be very similar to what you
did in the previous part of scheme_read. <em>Hint</em>: The code should be exactly like part 1, but
figure out why!</p></li>
</ol>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>    def scheme_read(src):
        if src.current() is None:
            raise EOFError
        val = src.pop()
        if val == 'nil':
            return nil
        elif type(val) is int: #infix notation. Let's check!
            if next_is_op(src):
                return read_infix(val, src)
            return val
        elif val not in DELIMITERS:  # ( ) ' .
            return val
        elif val == "(":
            val = read_tail(src)

            #Note that this isn't the best idea of what to do.
            #We have to add this semi-hack because we're modifying the language
            #in a strange way to get infix notation.
            if val.second == nil and val.first != nil:
                val = val.first

            if next_is_op(src):
                return read_infix(val, src)
            return val
        else:
            raise SyntaxError("unexpected token: {0}".format(val))
</code></pre>

  </div>
<?php } ?>
<p>And that's it! We have infix notation! The following inputs to calc should work.</p>

<pre><code>    &gt; (+ 2 2 * 3)
    8
    &gt; 2 + (- 5 2)
    5
    &gt; (+ 1 3 * 4 (* 7 4))
    41
    &gt; (2 * 3) + 6
    12
    &gt; 6 + (2 * 3)
    12
</code></pre>

<h3>Defining Variables</h3>

<p>Now we're going to add the ability to define variables. For example:</p>

<pre><code>    &gt; (define x 3)
    x
    &gt; (+ x 2)
    5
    &gt; (* x (+ 2 x))
    15
</code></pre>

<p>For this part, we will be modifying the calc.py file. Do we need to change calc_eval? calc_apply?
Is define a special form?</p>

<h4>Problem 6:</h4>

<p>Implement do_define_form. This function takes in a Pair that contains 2 items: the variable name,
and the expression to which it should be assigned. do_define_form should modify the global environment,
env (a dictionary, defined near the top of calc.py) to contain the name/value binding. It should also
return the name of the variable you're defining.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <pre><code>    def do_define_form(vals):
        env[vals.first] = calc_eval(vals.second.first)
        return vals.first
</code></pre>

  </div>
<?php } ?>
<h4>Problem 7:</h4>

<p>Finally, implement the lookup procedure in calc_eval. You should check if the given identifier exp is
in the environment. If it is, then simply return the value associated with it. If not, you should raise
an exception to signal that the user did something wrong.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <pre><code>    def calc_eval(exp):
        if type(exp) in (int, float):
            return simplify(exp)
        if type(exp) is str and is_identifier(exp):
            if exp in env:
                return env[exp]
            raise Error("Unbound variable " + exp)
        elif isinstance(exp, Pair):
            if exp.first == "define":
                return do_define_form(exp.second)
            arguments = exp.second.map(calc_eval)
            return simplify(calc_apply(exp.first, arguments))
        else:
            raise TypeError(exp + ' is not a number or call expression')
</code></pre>

  </div>
<?php } ?>
<p>And that's it! There you have basic variable declaration. Isn't that cool!?? By the way, this
was essentially one of the questions on Project 4!</p>

  </body>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 6; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
</html>
