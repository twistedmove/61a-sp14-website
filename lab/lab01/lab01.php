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

    <title>CS 61A Fall 2013: Lab 1</title> 

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
    $RELEASE_DATE = new DateTime("01/30/2014", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1 id="title-main">CS 61A Lab 1</h1>
<h2 id="title-sub">Creating a productive workflow on your own machine</h2>
<h2>Using Your Own Machine</h2>

<p>Hopefully by now you're more comfortable using the command line on the
lab machines in Soda. This lab is designed to help you set up a
productive workflow on your own machine so you can complete homeworks
and projects!</p>

<h3>Finding A Good Text Editor</h3>

<p>For starters, we need to find a good text editor that we can rely on
for the rest of the semester. In the first lab, we introduced you to
Emacs, a popular text editor among Unix users. If you like Emacs, you
can install Emacs on your own computer. You're also more than welcome
to install any other text editor that you want. Here's what we look for
in a good text editor:</p>

<ul>
<li>Has an easy way to open and edit new files.</li>
<li>Works well with Python files and plain text in general.</li>
<li>Line numbers are a must.</li>
<li>Syntax highlighting is a bonus but is not required.</li>
<li>Keyboard shortcuts are a plus, but also not required.</li>
</ul>

<p>Here's a list of recommended text editors:</p>

<ul>
<li>For Windows users:
<ul>
<li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
<li><a href="http://notepad-plus-plus.org/download/v6.4.5.html">Notepad++</a></li>
<li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
</ul></li>
<li>For Mac users:
<ul>
<li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
<li><a href="http://macromates.com/download">TextMate 2</a></li>
<li><a href="http://ash.barebones.com/TextWrangler_4.5.3.dmg">TextWrangler</a></li>
<li>Vim comes preinstalled on Mac OS X. Another great alternative is
MacVim which can be found
<a href="https://code.google.com/p/macvim/downloads/list">here</a>.</li>
<li><a href="http://aquamacs.org/">AquaMacs</a>, a Mac adaptation of Emacs</li>
<li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
</ul></li>
<li>For Linux users:
<ul>
<li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
<li>Vim - to install vim on Ubuntu, you can type <code>sudo apt-get
install vim</code> at your terminal prompt. vim-gnome, an alternative
on Ubuntu (which has a graphical interface) can be installed
using <code>sudo apt-get install vim-gnome</code></li>
<li>Emacs - the easiest way to install this on Ubuntu is to open a
terminal prompt and type <code>sudo apt-get install emacs</code></li>
<li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
</ul></li>
</ul>

<div class="announcement">
Note: a standard download of Python will come with a text editor called
Idle. We <b>do not</b> recommend it at all. The reason is that you won't
gain as much experience using the command line to run your Python
programs. This will hurt you a lot once you start working on the
projects for this class so we highly recommend that you use the command
line to run your files from day 1!
</div>

<h2>Downloading and manipulating files</h2>

<p>Now that we have a text editor, let's start editing some files!
For each homework assignment, we'll provide you with some starter code.
We <strong>highly</strong> recommend that you download this template; you can simply
fill in the parts that you need to complete. This lab is also going to
teach you how to submit your first assignment.</p>

<p>Go ahead and download the template file
<a href="http://inst.eecs.berkeley.edu/~cs61a/sp14/hw/hw0.py">here</a>! You
should now have a file called <code>hw0.py</code>.  For more specific instructions
about Homework 0, check out the Homework 0 page
<a href="http://inst.eecs.berkeley.edu/~cs61a/sp14/hw/hw0.html">here</a>.</p>

<p>For the screenshots that you'll see below, we're using Sublime Text 2
on Mac OS X; keep in mind that this particular setup might look
different from yours. That's okay! Open that file up in your shiny new
text editor and you should see the following text:</p>

<p><img src="assets/hw0.png" alt="hw0.py in a text editor" /></p>

<p>Next, we're going to edit our file to complete the implementation of
the four functions. The first thing that you should notice is the green
text that is wrapped within three quotation marks <code>"""</code>. That text is
called a docstring, which is a description of what the function is
intended to do.</p>

<div class='announcement'>
Note: the colors on your text editor will most likely
be different. For the curious, this screenshot is of the Solarized
color scheme which you can find for your text editor if you are
interested.
</div>

<p>Docstrings are useful for giving other programmers a concise description
of what the function is supposed to do. Within the
docstring, you might notice some other funky characters such as <code>&gt;&gt;&gt;</code>.
That's the start of what we call <em>doctests</em>. Doctests are another great
way to also describe our function by detailing the expected outputs your
function should return for given inputs. An example might make a lot
more sense here so let's look specifically at the <code>my_last_name()</code>
function.</p>

<p><img src="assets/my_name.png" alt="&lt;code&gt;my_name&lt;/code&gt; function" /></p>

<p>The two tests in our docstring check two things:</p>

<ol>
<li>That you changed the return value from the default 'PUT YOUR LAST
NAME HERE'.</li>
<li>That the return value is a string and not something else (like a
number).</li>
</ol>

<p>How do we use these tests? Glad you asked! For this part, we're going
to open a terminal prompt. This process varies from computer to
computer. If you're on a Mac or are using a form of Linux (such as
Ubuntu), you already have a program called 'Terminal' on your computer.
Open that up and you should be good to go.</p>

<p>For Windows users, you have
several options. Windows has a built-in terminal called 
<code>cmd</code>, which
 behaves slightly differently than Unix (for example, <code>ls</code>
is instead called <code>dir</code>). Another option is a program called
<a href="http://cygwin.com/install.html">Cygwin</a>, which behaves
more like Unix (follow the link to install Cygwin).</p>

<p>Once you have your terminal open, we'll use what we learned from lab
0...our handy Unix commands!</p>

<p><img src="assets/terminal.png" alt="starting the terminal" /></p>

<p>Right now, I'm in my home directory. Remember the home directory is
represented by the <code>~</code> symbol (outlined in green above). Don't worry if
your terminal window doesn't look exactly the same; the important part
is that the text on the left hand side is relatively the same (with a
different name) and you should definitely see a <code>~</code>.</p>

<p>We can run commands like <code>cd</code> and <code>ls</code> just like before. <strong>Tip</strong>: It's
a good idea to have a folder that's dedicated to containing all of your
material for this course.  Within that folder, you should keep a
<code>projects</code> folder, a <code>hw</code> folder, etc. We can make this folder in our
home directory by typing</p>

<pre><code>mkdir ~/cs61a
</code></pre>

<p>Magically, a folder called <code>cs61a</code> will appear in our home directory!
We can now <code>cd</code> into this folder and add more for organization.  Let's
add a <code>projects</code>, <code>hw</code>, and a <code>hw0</code> folder inside of our <code>hw</code> folder.</p>

<pre><code>cd ~/cs61a
mkdir projects
mkdir hw
mkdir hw/hw0
</code></pre>

<p>Now if we list the contents of the directory (using <code>ls</code>), we can see
that we have two folders, <code>projects</code> and <code>hw</code>.</p>

<p><img src="assets/cs61a_directory.png" alt="cs61a directory" /></p>

<p>The next thing we're going to do is find our downloaded file. If you
didn't move the file at all, it's probably in <code>~/Downloads</code> on
Mac/Linux/Windows (Cygwin) or
<code>C:\Users\NAMEOFUSER\Downloads</code> if you're using the Windows Command
Line (cmd.exe). If your downloads all go to your Desktop, on
Mac/Linux/Windows (Cygwin), that would be <code>~/Desktop</code> and on
the Windows Command Prompt, that would be
<code>C:\Users\NAMEOFUSER\Desktop</code>. Let's <code>cd</code> into that directory.</p>

<p><img src="assets/cd_to_downloads.png" alt="cd to downloads" /></p>

<p>If we were to type <code>ls</code>, we'd see our file sitting there in our
downloads folder. Let's move that file to our new homework directory.</p>

<pre><code>mv ~/Downloads/hw0.py ~/cs61a/hw/hw0
</code></pre>

<p>This command says move the file located at <code>~/Downloads/hw0.py</code> to the
directory <code>~/cs61a/hw/hw0</code></p>

<p>And then we should change back into our hw0 folder that we made earlier.</p>

<pre><code>cd ~/cs61a/hw/hw0
</code></pre>

<p>Okay, we're just about ready to start editing a file. Don't worry, if
this seems complicated at first, it will get much easier over time.
Just keep practicing!</p>

<h2>Editing files using a Productive Workflow</h2>

<p>Open up your file which is now located in <code>~/cs61a/hw/hw0</code> in your text
editor of choice. Let's begin editing!</p>

<p>In our productive workflow, we suggest having at least two windows open
at all times.</p>

<ol>
<li>Your text editor with the files that you're editing.</li>
<li>Your terminal window so you can easily run doctests and later on,
unit tests.</li>
</ol>

<p>Here's a screenshot of a typical workspace. We've got our text editor
on the left, and our terminal on the right!</p>

<p><img src="assets/productive_workflow.png" alt="productive workflow" /></p>

<h2>Doctests</h2>

<p>Let's get back to those doctests we were talking about earlier. Again,
doctests are a way for us to write simple tests for our code.  We're
basically asking ourselves, "What is the expected output of this
function if I put in this specific input?"</p>

<p>To run our doctests, we switch over to our terminal and type in the
following command:</p>

<pre><code>python3 -m doctest hw0.py
</code></pre>

<p>This will give us a lot of output that shows which tests we are
currently failing. Go ahead and try running it now on the file that you
just downloaded.  You should see something like this:</p>

<p><img src="assets/doctest_output.png" alt="doctest output" /></p>

<p>Oh man, we had 6 failures! :( Let's fix those so that we have 0
failures. Before we can do that, we should analyze this output. In
particular, let's look at the <code>my_last_name</code> test that we failed,
highlighted here:</p>

<p><img src="assets/my_name_test_failure.png" alt="my name test failure" /></p>

<p>The output gives us some pretty good debugging info. If you haven't
already, take a look at
<a href="http://albertwu.org/cs61a/notes/debugging">Albert's debugging guide</a>.</p>

<p>Looking at this particular test, notice it's saying that we had an
error in our <code>hw0.py</code> file on line 12, in the function <code>my_last_name</code>.
Now we know exactly where to look for the bug (this is why line numbers
are a must for text editors).</p>

<p>After we find the correct line, let's try to understand what the test
is saying: the function <code>my_last_name</code>, when called with zero inputs,
should <strong>not</strong> return the string <code>'PUT YOUR LAST NAME HERE'</code>. The
problem is, ours is returning that string! Change that to your last
name, to something like this.</p>

<pre><code>def my_last_name():
    """Return your last name as a string.
    &gt;&gt;&gt; my_last_name() != 'PUT YOUR LAST NAME HERE'
    True
    """
    return 'Smith'
</code></pre>

<div class='announcement'>
Make sure you enter this information in carefully because this is how
we will associate all homework, projects, and exams with you and your
account.
</div>

<p>Once you've changed the return value of the function <code>my_last_name</code>
(make sure that you're returning a string, which has quotes around it),
you should be able to run the doctests again and your test for
<code>my_last_name</code> should pass! Now you only have 5 failures to fix!</p>

<p><strong>Some other things to note about doctests:</strong> You might run your
doctests and see that there is no output. This is actually good.
Doctests will only print output when you have <strong>failures</strong>
in your tests. However, if you want to be super sure that you're
passing all of the tests and not just messing up the command, you can
add a command line flag <code>-v</code> to see <em>all</em> the output (i.e. 'verbose'
mode):</p>

<pre><code>python3 -m doctest -v hw0.py
</code></pre>

<p>For the section number, <strong>please put down your lab section number</strong>.
This number will be between 11 and 32. You can find a complete list of
all the sections on the class calendar which is located
<a href="http://www-inst.eecs.berkeley.edu/~cs61a/sp14/#schedule">here</a>.</p>

<p>Once you have successfully completed the homework and you have 0 tests
failing, the verbose output of the doctests should look something like
this:</p>

<p><img src="assets/successful_doctests.png" alt="successful" /></p>

<h2>Copying files to the server</h2>

<p>Now that you have finished your first assignment of CS61A, it's time to
copy the file to the server. The server is where your instructional
account lives and it's how you will submit all of your homeworks and
projects.</p>

<p>You'll need a method for copying your files to the server. For Windows,
you'll want to download a program called
<a href="http://winscp.net/eng/download.php">WinSCP</a>. Mac and Linux users can
use the built in terminals that you've been using to run your doctests.</p>

<h3>Windows</h3>

<p>After you've installed WinSCP, you'll have to configure it so that you
can log in to the server. Here's a screenshot of a typical log in:</p>

<p><img src="assets/WinSCP.png" alt="WinSCIP" /></p>

<p>Once you're logged in, all you have to do is navigate to your
<code>cs61a/hw</code> folder on the left and drag your file over to the server on
the right.</p>

<h3>Mac / Linux</h3>

<p>On Mac OS X and Linux, all you need is your terminal. Navigate to your
finished homework. If you were following the tutorial from above,
you'll want to type something like <code>cd ~/cs61a/hw/hw0</code> to get to your
homework 0 folder.  Then you'll want to type the following command:</p>

<pre><code>scp hw0.py cs61a-??@star.cs.berkeley.edu:~/
</code></pre>

<p>where <code>??</code> is replaced with your two (or three) letter login.</p>

<p>Let's break this command down into three parts.
1. The first part, <code>scp</code> is just the name of the command.
2. The second part, <code>hw0.py</code> is the path to the file(s) that you want
   to copy to the server. If you wanted, you could specify the whole
   path to the file such as <code>~/cs61a/hw/hw0/hw0.py</code> instead of just the
   filename. The reason why we can just specify the filename is because
   we're already in the folder that contains it.
3. The last part of the command is the destination. For this, we're
   logging into the server using your login (<code>cs61a-??</code>). The server
   that we're logging into will be <code>star</code>. A complete list of servers
   can be found
   <a href="http://inst.eecs.berkeley.edu/cgi-bin/clients.cgi?choice=servers">here</a>.</p>

<p>The text that comes after the server and colon is important. We're
   specifying <em>where</em> on the server we want the file to go. In this
   case, we're placing it in our home directory, which is represented
   by the <code>~</code> symbol.</p>

<p>After typing this command, you'll be asked for your password and then
the file will transfer over! Now, we can move on to submitting!</p>

<h2>Submitting your homework and projects</h2>

<p>Great, so now you have all of your files related to your assignment on
the instructional servers. <strong>You're not done quite yet!</strong> We have to
actually submit our files.</p>

<p>To log onto our instructional accounts, follow these tutorials:</p>

<ul>
<li><a href="http://www.youtube.com/watch?v=gDDaz6Sb8jo">Windows</a></li>
<li><a href="http://www.youtube.com/watch?v=irwlU7esODA">Mac / Linux</a></li>
</ul>

<p>To summarize, you'll be using a program called
<a href="http://www.putty.org/">PuTTY</a> for Windows and using a command called
<code>ssh</code> on Mac / Linux.  The full command for <code>ssh</code> is (don't forget to
replace the ?? with your login):</p>

<pre><code>ssh cs61a-??@star.cs.berkeley.edu
</code></pre>

<p>Once logged in, you'll see something like this:</p>

<p><img src="assets/inst_login.png" alt="inst login" /></p>

<p>If you copied your files over correctly, you should be able to type
<code>ls</code> and see your <code>hw0.py</code> file. If not, try to figure out what
happened in the above steps. If you're really stuck, try posting on
Piazza first. If that still doesn't help, come talk to one of the TAs
in office hours.</p>

<p>We're going to first create a new folder to hold our homework 0 file.
In the future, you'll be submitting projects with multiple files so
it's good to get in a habit of creating a new folder for each
assignment.  Let's make the hw0 directory, move our <code>hw0.py</code> file into
it, and then <code>cd</code> into our <code>hw0</code> folder:</p>

<pre><code>mkdir hw0
mv hw0.py hw0
cd hw0
</code></pre>

<p>We're all ready to submit our homework. But wait, we first need to
check to make sure that we entered in the correct information into the
sign up form. <strong>This is important because we'll use this information to
send you automated emails with the scores of your projects.</strong> To check
what you entered, type in:</p>

<pre><code>check-register
</code></pre>

<p>If you find errors (e.g. you typed your last name as <code>ssh update</code>), fix
them immediately by running the command:</p>

<pre><code>re-register
</code></pre>

<p>Okay, now we're ready to submit. To do so, simply type:</p>

<pre><code>submit hw0
</code></pre>

<p>Answer the questions that come up by typing <code>yes</code> or <code>no</code>. To check
that you successfully submitted, you can type:</p>

<pre><code>glookup -t
</code></pre>

<p><code>glookup</code> is the name of the command that you will use this semester to
check your grades. At any time, you can simply enter <code>glookup</code> to check
your grades. Adding a <code>-t</code> to the <code>glookup</code> command allows you to
see all the times that you have successfully submitted a homework or
project. You should see a successful submission of about 1 minute ago.</p>

<h2>The Autograder</h2>

<p>The autograder is a program that runs your projects after you submit
them. When the autograder finishes running on your project, you'll
receive an email with an automated response that lets you know how your
project is doing (in terms of which tests you're passing and which ones
you're failing).</p>

<p>The public autograder is a subset of the tests and is only meant to be
a sanity check -- it will run occasionally before the project deadline
and does <strong>not</strong> tell you your actual score. After the project
deadline, we will add more tests to determine your final project score.
This means you should always take additional care to double-check your
code, even if the public autograder does not report any errors.</p>

<p>To get you used to how the autograder works, we're going to be running
a sample autograder on your hw0 submission. You should receive an
email within 30 minutes. This email will be similar to the one that
you will receive for a project. If you don't get this email within an
hour or so, make sure that you have a valid email address entered under
your account info. To check, run <code>check-register</code> to see which email
you have registered with and <code>re-register</code> to change it.</p>

<p>Once you have received the autograder email from us and it says that
you have passed all of the tests, you're good to go!
<strong>Congratulations</strong>, you just submitted your first CS61A assignment!</p>

  </body>
  <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 0; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
<?php } ?>
</html>
