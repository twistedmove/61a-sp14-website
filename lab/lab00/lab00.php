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

    <title>CS 61A Fall 2013: Lab 0</title> 

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
    <h1 id="title-main">CS 61A Lab 0</h1>
<h2 id="title-sub">Introduction to UNIX/Emacs</h2>
<h2>Introduction to Unix</h2>

<p>Hello! The first thing you might have noticed about these computers is
that they don't have Windows or MacOS installed. And you're right -
they're running UNIX (Ubuntu to be exact). But fear not! We'll get you
familiar with this new system in no time - by the end of the semester,
this stuff will feel like old hat.</p>

<p>By now, you should already have logged in, registered (make sure you
use your <em>berkeley.edu</em> email address) and changed your password by
running <code>ssh update</code>.  If you made a typo (e.g. misspelled your name),
don't worry; you can restart the registration program, first by
completing the registration process, and then typing <code>re-register</code> at
the prompt and hitting enter.</p>

<p><em>Note</em>: <strong>Please</strong> do not forget your login information - especially
your log-in name (e.g.  cs61a-ba). Memorize your log-in name, e-mail
your log-in name to yourself, etc. If you forget, you'll need to get
another log-in form from your TA and start again. If you forget your
password, you can either e-mail INST at inst@eecs.berkeley.edu, or go
to 333 Soda.</p>

<h3>Logging in from Home</h3>

<p>If you don't have access to a school computer for this lab, you can
still try it out: refer to <a href="../lab01/lab01.php">Lab 1</a> for more
details about setting up your home computer.</p>

<h2>Meet the Terminal</h2>

<p>The first thing we're going to do is open the Terminal. To do this,
click on the launcher in the top left corner. Start typing in
"Terminal" and it should autocomplete.  You should see something like
this:</p>

<p><img src="assets/pick_terminal.png" alt="Opening the Terminal" title="Figure 1: Opening the
Terminal" /></p>

<p>Press "Enter" or click on the Terminal icon and finally, you'll see a
window that looks something like this:</p>

<p><img src="assets/terminal.png" alt="Terminal" title="Figure 2: The terminal windw" /></p>

<p>This window is called the terminal - this is where you'll be talking
to the computer. You talk to the computer by entering in commands.
Here's a neat command - need to look up a date for this month? Try the
<code>cal</code> command by typing <code>cal</code> into the terminal, then hitting enter:</p>

<p><img src="assets/cal_cmd.png" alt="Calendar output" title="Figure 3: Your first command" /></p>

<p>Neat, right? Turns out, these computers can do more than displaying
the current calendar - crazy, right? </p>

<h2>Directories</h2>

<p>The most important thing to learn first is how to use the filesystem.
Unlike in Windows/MacOS, there aren't folders you can
click/drag/double-click. There's not even a 'My Computer' icon in
sight!</p>

<p>That's okay - we're going to learn how to do everything via the
command line (the command line is the terminal). Everything you did on
a visual-based filesystem (i.e. like those found on a Windows/MacOS
system), you can also do via the terminal.</p>

<h3>Directories</h3>

<p>First, I'll introduce you to our good friend, <code>ls</code>.</p>

<p><code>ls</code> is a command that lists all the files in the current directory.
Oh yes, and what's a directory?  A directory is just like a folder,
e.g. the "My Documents" folder.  When you log in, you are
automatically started off in the home directory, so if we run the <code>ls</code>
command right now, it'll display all the files in our home directory:</p>

<p>Try the <code>ls</code> command now! </p>

<pre><code>star [121] ~ # ls
star [122] ~ #
</code></pre>

<p>Hm - nothing really happened. That's because there's nothing in our
home directory - we just made our account after all! Let's make some
stuff! </p>

<h3>Making Directories</h3>

<p>This leads to another good command: the <code>mkdir</code> command.</p>

<p><code>mkdir</code> is a command that makes a new directory (hey now, the command
names make sense!). Unlike <code>cal</code> and <code>ls</code>, we don't just type <code>mkdir</code>
and press enter - we need to specify the name of the folder we want to
create! Since we're well-organized people, let's create a new
directory for this lab, and call it lab0:</p>

<pre><code>star [122] ~ # mkdir lab0
star [123] ~ #
</code></pre>

<p>When we supply extra 'stuff' to a command (like a folder name, for
instance), we say that we're calling the mkdir command with
parameter(s). Not all commands take arguments (recall <code>cal</code>). Some
commands even have optional parameters (<code>ls</code>, for instance, has a
bunch of different optional parameters).</p>

<p>Okay, now that we've made our directory, let's make sure it's actually
there - use the <code>ls</code> command to make sure that the lab0 directory
exists.</p>

<pre><code>star [123] ~ # ls
lab0
star [124] ~ #
</code></pre>

<p>Hey, there's our new directory! Awesome.</p>

<h3>Changing Directories</h3>

<p>To get 'inside' the directory, we have a handy command called <code>cd</code>.</p>

<p><code>cd</code> (short for change-directory) is a command that, when given a
directory name as a parameter, takes you into that directory. Enter
the lab0 directory by typing: <code>cd lab0</code></p>

<pre><code>star [124] ~ # cd lab0
star [125] ~/lab0 #
</code></pre>

<p>Note that the <code>~</code> turned into a <code>~/lab0</code>. This tells you that you're
currently in the lab0 directory - the <code>~</code> stands for the home
directory.</p>

<p>So we're inside the lab0 directory, but there's not much here.  You
can <code>ls</code> to make sure that it's empty.  Let's say we want to go back
to the home directory: there are two ways to go back from here.</p>

<p>One way is to enter in the following: <code>cd ..</code></p>

<pre><code>star [125] ~/lab0 # cd ..
star [126] ~ #
</code></pre>

<p>The <code>..</code> is shorthand in UNIX for "the parent directory". The home
directory is the parent directory of the lab0 directory (since the
lab0 directory lives in the home directory).</p>

<p>Alternately, you can type in just: <code>cd</code></p>

<pre><code>star [125] ~/lab0 # cd
star [126] ~ #
</code></pre>

<p>Running the <code>cd</code> command with no parameters is equivalent to returning
to the home directory. This is handy when you're many directories
deep, and you don't want to keep repeating <code>cd ..</code> to get back home.</p>

<h3>Removing Directories</h3>

<p>We've created them - now, we can destroy them! Er, remove them,
rather. Often, you'll find yourself wanting to delete directories
(say, to organize things). To delete a directory, we use <code>rm -r</code>
command, short for remove recursively.  This tells Unix to recursively
go through a folder, deleting the folder and all of its contents
(including empty folders).</p>

<p>Like <code>mkdir</code>, <code>rm -r</code> takes a directory name as a parameter. Try the
following steps:</p>

<ol>
<li>Create a directory called <code>my_folder</code></li>
<li>Run <code>ls</code> to see that it's really there</li>
<li>Remove the directory using <code>rm -r my_folder</code></li>
<li>Run <code>ls</code> again to see that it's not there anymore.</li>
</ol>

<p>Summary: We've learned about the following commands:</p>

<ul>
<li><code>cal</code>: displays the current month</li>
<li><code>ls</code>: lists the current directory contents</li>
<li><code>mkdir</code>: creates a new directory with a specified name</li>
<li><code>cd</code> moves into/out of directories</li>
<li><code>rm -r</code>: removes the given directory</li>
</ul>

<h2>Files</h2>

<p>We've done a lot of things so far, but only with directories - we
probably want to be able to actually have stuff in our directories.
So, let's make some files, and learn the commands to manipulate them.</p>

<p>Our first step is to create a file. Notice the distinction between
files and directories. In UNIX, we tend to treat files and directories
separately - for instance, it makes sense to <code>cd</code> into a directory,
but it doesn't quite make sense to <code>cd</code> into a text file!</p>

<p>Let's create a simple file that has the sentence: 'This semester will
be awesome!'</p>

<p>The command we'll use is called <code>echo</code>.  <code>echo</code> is a command that
simply displays anything you type after the word 'echo':</p>

<pre><code>star [136] ~ # echo hello
hello
star [137] ~ # echo Stop repeating me!
Stop repeating me!
star [138] ~ # echo No, you stop!
No, you stop!
</code></pre>

<p>Some terminology - the words that the computer displays after we hit
the enter button is the output of the echo command. It's sort of like
this picture:</p>

<p><img src="assets/echo_visual.png" alt="Echo visual" title="Figure 4: Visualization of
input/output of he echo command" /></p>

<h3>Making a file</h3>

<p>UNIX has a very nice way of creating files using the command <code>touch</code>.
Let's say we want to create a file called <code>my_file</code>, we can do this by
doing:</p>

<pre><code>star [139] ~ # touch my_file
star [140] ~ # ls
lab0 my_file
</code></pre>

<p>That was easy! We created a new file - to get a glimpse into what's
inside, we can use another command, called <code>cat</code>. <code>cat</code> is a command
that displays the contents of a given file: </p>

<pre><code>star [141] ~ # cat my_file
star [142] ~ #
</code></pre>

<p>The reason why we didn't see anything happen is because <code>touch</code>
creates an empty file!</p>

<p>To remove files, we use the <code>rm</code> command - this time without the <code>-r</code>
option.  Use the <code>rm</code> command to delete the <code>my_file</code> file:</p>

<pre><code>star [142] ~ # ls
lab0 my_file
star [143] ~ # rm my_file
star [144] ~ # ls
lab0
</code></pre>

<p><em>Warning</em>: Use <code>rm</code> with utmost care! Unlike in Windows/MacOS, there
is no friendly 'Recycle Bin' or 'Trash' where you can restore a
deleted file. In UNIX (at least on these systems), when you <code>rm</code> a
file, it's gone. Vanished.  Caput. There's no 'undo-ing' a <code>rm</code> - so,
think twice (and thrice!) before using the <code>rm</code> command! </p>

<p>With directories, we were able to make and remove them. However, for
files, we can do even more! </p>

<p>Let's go ahead and make a new file, because we have removed the one we
made in the previous section. </p>

<pre><code>star [139] ~ # touch my_file
star [140] ~ # ls
lab0 my_file
</code></pre>

<p>Let's add some text to our file. Using the <code>echo</code> command from before,
we can add text to our file!</p>

<pre><code>star [141] ~ # echo "This semester will be awesome!" &gt; my_file
</code></pre>

<p>For those interested, the <code>&gt;</code> symbol means redirect what is usually
shown onto the screen into the file that you specified after the <code>&gt;</code>
symbol.  In this case, we're adding the text "This semester will be
awesome!" to the file, <code>my_file</code>. Be careful though, <code>&gt;</code> <em>overrides</em>
whatever was originally in the file (ours was originally blank). To
add text to an existing file, use <code>&gt;&gt;</code></p>

<h3>Copying a file</h3>

<p>Let's say we wanted to make a copy of this file. Well we can use the
<code>cp</code> command.  <code>cp</code> takes two parameters, the first is the name of the
file you want to make a copy of, and the second is the name of the new
file you want to copy the first file into. For example, if we wanted
to copy <code>my_file</code> into a new and different file called <code>new_file</code>,
then we could do so as follows: </p>

<pre><code>star [272] ~ # cp my_file new_file
star [273] ~ # ls
lab0 my_file  new_file
</code></pre>

<p>If we were then to look at each file separately using the <code>cat</code>
command, we can see that <code>new_file</code> is simply a copy of <code>my_file</code>.
Exactly what we wanted. </p>

<pre><code>star [275] ~ # cat new_file
This semester will be awesome!
</code></pre>

<p>Now a lot of times we will want you to copy a file from our cs61a
account into your own. We can use the <code>cp</code> command to do so by
specifying the filepath, which will almost always be given to you.
(For example, something like <code>~cs61a/lib/shakespeare.txt</code> is the
filepath for the text file from our 61a account which contains a
Shakespearean sonnet).</p>

<p>What we could do is something like this:</p>

<pre><code>star [276] ~ # cp ~cs61a/lib/shakespeare.txt shakespeare.txt
star [277] ~ # ls
lab0 my_file new_file shakespeare.txt
</code></pre>

<p>But here's a handy tip: if we put a period '<code>.</code>' as the second
argument to <code>cp</code>, we get the same effect: </p>

<pre><code>star [278] ~ # cp ~cs61a/lib/shakespeare.txt .
star [279] ~ # ls
lab0 my_file new_file shakespeare.txt
</code></pre>

<p>The '<code>.</code>' is a UNIX shorthand for 'current directory'. So, <code>cp
~cs61a/lib/shakespeare.txt .</code> means: Create a new copy of
~cs61a/lib/shakespeare.txt, and put it in the current directory. </p>

<p>Similarly, if we wanted to, we could copy shakespeare.txt to our lab0
directory by doing: </p>

<pre><code>star [280] ~ # cp ~cs61a/lib/shakespeare.txt lab0
star [281] ~ # ls lab0
shakespeare.txt
</code></pre>

<h3>Moving a File</h3>

<p>We can also move a file to a different directory by using the <code>mv</code>
command.  <code>mv</code> takes in two parameters as well: the first is the
filename that we want to move, and the second is the name of the
directory that we want to move that file into.</p>

<pre><code>star [275] ~ # mv new_file lab0
star [275] ~ # ls
lab0 my_file
star [276] ~ # cd lab0
star [277] ~/lab0 # ls
new_file
</code></pre>

<p>We just moved <code>new_file</code> into the lab0 directory. As you can see, the
lab0 directory is in the home directory, which is where the <code>new_file</code>
originally was.  The name of the directory we are moving the file into
needs to be in the current directory, or else the computer will not
know what directory you are referring to, and will instead rename the
file (more on that later).</p>

<p>However, what if we wanted to move the file back into the home
directory; the home directory is not inside of lab0, so there is no
way to reach it right? No! Just like we could change into a parent
directory by calling cd with '<code>..</code>' we can also move a file into the
parent directory by calling <code>mv</code> with a filename and '<code>..</code>' as
follows:</p>

<pre><code>star [276] ~/lab0 # ls
new_file
star [278] ~/lab0 # mv new_file ..
star [279] ~/lab0 # ls
star [279] ~/lab0 # cd
star [278] ~ # ls
new_file
</code></pre>

<p>We have just moved <code>new_file</code> back into our home directory,
which was a parent directory of the lab0 directory.</p>

<h3>Renaming a File</h3>

<p>Lastly, we can rename a file. To rename a file, we can actually also
use the <code>mv</code> command. In this case, the <code>mv</code> command still takes in
two parameters: the first being the name of the file we want to
rename; however, the second is the new name for the file. </p>

<pre><code>star [277] ~/lab0 # mv new_file best_name_ever
star [278] ~/lab0 # ls
best_name_ever
</code></pre>

<p>We have just successfully renamed <code>new_file</code> to be the filename:
<code>best_name_ever.</code> </p>

<h3>The most useful UNIX command: man</h3>

<p>We've shown you a lot of commands and it might become a little
hard to remember what everything does. If you ever forget (and can't
be bothered to come back to this page), there is one useful that'll
help: <code>man</code> (short for manual). </p>

<p>Just run <code>man</code> with some other Unix command to find out what it does
(e.g. <code>man cp</code>).  <code>man</code> will bring up a page inside of the terminal.
The NAME field will give a brief description of what the command does,
and the DESCRIPTION will have a host of extra options you can run the
command with. </p>

<p>You can navigate forward through the man page with the <code>Enter/ Return</code>
key and you can quit with <code>q</code> key. </p>

<h2>Running programs: Firefox</h2>

<p>These machines come pre-installed with a variety of programs.  If you
continue to use the lab machines, two programs that you'll be
frequently using over the semester are Firefox and Emacs. </p>

<p>Firefox is a free web browser (like Internet Explorer, Safari, Google
Chrome, etc.). <strong>To open it, you can simply click on the icon on the
left hand side of your screen.</strong></p>

<h2>A recap</h2>

<p>Whew! We've covered a lot so far, so let's recap what we've done so
far. </p>

<ul>
<li>How to use commands to navigate the filesystem
<ul>
<li><code>ls</code>, <code>cd</code></li>
</ul></li>
<li>How to create/remove directories
<ul>
<li><code>mkdir</code>, <code>rm -r</code></li>
</ul></li>
<li>How to create/remove/display files
<ul>
<li><code>echo</code>, <code>rm</code>, <code>cat</code></li>
</ul></li>
<li>How to move/rename/copy files
<ul>
<li><code>mv</code>, <code>cp</code></li>
</ul></li>
<li>How to redirect output from one command to another
<ul>
<li>i.e. <code>echo This is my file &gt; new_file</code></li>
</ul></li>
<li>How to run programs, and access the Internet with firefox
<ul>
<li><code>firefox</code></li>
</ul></li>
<li>If you ever forget what a command does
<ul>
<li><code>man</code></li>
</ul></li>
</ul>

<p>This is fantastic -- definitely all of the commands you'll need for the
semester. However, we have yet to really create/edit/save text files.
And no, Microsoft Word is not installed on these machines. But we have
something better! </p>

<div class="announcement">
If you plan to use your own computer for most of your work in this
course, there are many editors to choose from depending on your
operating system.  Instead of reading this section on Emacs, start
reading <a href='../lab01/lab01.php'>lab 1</a> on selecting an editor.
</div>

<h2>Our Text Editor: Emacs</h2>

<p>Emacs is a very popular free text editor, with quite a bit of history
behind it (it was created in 1976!). This is the text editor we'll
primarily be using this semester. However, it's definitely not
required -- some other text editors include:</p>

<ul>
<li>Notepad++</li>
<li>Vim</li>
<li>Nano</li>
<li>Sublime Text 2</li>
<li>TextMate</li>
</ul>

<p>However, we'll only be talking about Emacs here. Now, Emacs may seem
very intimidating and difficult at first, but don't worry, we'll get
you situated in no time. </p>

<p>To help us keep track of what we're doing, I'm going to explicitly
state the goals for this section: </p>

<ol>
<li><p>Using Emacs, create a new text file called <code>my_epiphany</code> in the
home directory, and type the sentence:</p>

<p>"This is going to be a pretty good semester."</p></li>
<li><p>Then, using Emacs, re-open <code>my_epiphany</code>, and edit it to instead
say:</p>

<p>"This semester is going to be a fantastic semester!"</p></li>
</ol>

<p>So, let's start with opening up Emacs. It's important where you open
Emacs, because the directory in which you open Emacs determines the
directory that Emacs 'starts off' in. For instance, if I open up Emacs
in the home directory, and I saved a file called <code>my_file.txt</code>, then
<code>my_file.txt</code> will appear in the home directory.  But more on that
later!</p>

<p>Let's try opening Emacs with the following: </p>

<pre><code>star [145] ~ # emacs
</code></pre>

<p>One unfortunate side-effect of opening up Emacs like this is
that our terminal is now unresponsive to new commands: </p>

<pre><code>star [145] ~ # emacs
ls
cd
helloooo
you're not working anymore :(
</code></pre>

<p>The terminal will only be responsive once you exit Emacs. To avoid
this situation, if you add an ampersand '<code>&amp;</code>' after <code>Emacs</code>, the
terminal will still be responsive: </p>

<pre><code>star [145] ~ # emacs &amp;
star [146] ~ # ls
lab0
star [147] ~ # echo "Hooray, you're listening to me"
Hooray, you're listening to me
</code></pre>

<p>A window something like this should open up:</p>

<p><img src="assets/emacs_splash.png" alt="Emacs Splash" title="Figure 5: The Emacs splash
page." /></p>

<p>This is the 'splash page' for Emacs - later, if you're interested, you
can check out the Emacs Tutorial, but let's not do that right now. (It
is a valuable resource for learning to use Emacs, but it might take
more time than you have during lab! :p) </p>

<h3>Creating a file in Emacs</h3>

<p>Now, let's create our new file - to do that, you can do any of the
following 2 options: </p>

<ul>
<li><p>Option 1: Go to File menu, and click on Visit New File...</p>

<p><img src="assets/emacs_new2.png" alt="Emacs new file 2" title="Figure 6: One way to create
a new file in Emacs" /></p>

<p>Once you've done that, a prompt will appear on the bottom area (this
is called the mini-buffer), asking for the name of the file you wish
to create. Type in <code>my_epiphany</code> as the file name, and hit enter.
(See Figure 7 to see what the mini-buffer looks like). </p>

<p><img src="assets/emacs_minibuffer.png" alt="Emacs minibuffer" title="Figure 7: The
mini-buffer" /></p></li>
<li>Option 2: Use the hot-key <code>C-x C-f</code>, then type in <code>my_epiphany</code> in
the mini-buffer. If you're not sure what <code>C-x C-f</code> means, then check
out the "Emacs Hotkeys" section. But for now: <code>C-x C-f</code> is a
two-step process:
<ol>
<li>First, while holding down <code>Control</code> (Ctrl), hit the '<code>x</code>' key.</li>
<li>Release the '<code>x</code>' key.</li>
<li>Then, while continuing to hold down <code>Control</code> (Ctrl), hit the
'<code>f</code>' key.</li>
</ol></li>
</ul>

<p>Now, the Emacs window should turn into a blank page - this is
the newly created <code>my_epiphany</code> file. Go ahead and type the sentence:
"This is going to be a pretty good semester." </p>

<p><img src="assets/emacs_saving.png" alt="Emacs saving" title="Figure 8: Our new file." /></p>

<p>Now that we've added our sentence, let's save the file (either doing
<code>File -&gt; Save</code> or doing the hotkey <code>C-x C-s</code>. You'll know it's saved
when the two stars after the file-name go away (see Figure 8 to see
what I mean). </p>

<p>Now, exit Emacs (by doing <code>File -&gt; Quit</code> , or <code>C-x C-c</code>).
Congratulations! You've just created your first file in Emacs. We can
confirm that it does in fact exist by <code>cat</code>-ing the file: </p>

<pre><code>star [149] ~ # ls
lab_0 my_epiphany
star [150] ~ # cat my_epiphany
This is going to be a pretty good semester.
</code></pre>

<h3>Editing a file in Emacs</h3>

<p>But wait! We want to edit that file - we want to instead say: "This
semester is going to be a fantastic semester!" </p>

<p>So, let's edit the file to say this instead. One way we could do this
is open up Emacs using <code>emacs &amp;</code>, and use the <code>File -&gt; Open</code> (hotkey:
<code>C-x C-f</code>) to open up the file (typing in <code>my_epiphany</code> in the
mini-buffer): </p>

<p><img src="assets/emacs_open.png" alt="Emacs open" title="Figure 9: Opening a file in Emacs" /></p>

<p>Or, we can provide the name of the file as a parameter while opening
up Emacs: </p>

<pre><code>star [151] ~ # emacs my_epiphany &amp;
</code></pre>

<p>This does two things at once: 
1. Start Emacs
2. Open up the <code>my_epiphany</code> file</p>

<p>Now, modify the file to instead say "This semester is going to be a
fantastic semester!", save it, and exit Emacs.  <code>cat</code> the file to make
sure that it worked. </p>

<pre><code>star [152] ~ # cat my_epiphany
This semester is going to be a fantastic semester!
</code></pre>

<p><em>Helpful Tip</em>: If the mini-buffer ever has a prompt that you don't
understand (say, you accidentally hit a command), and you're not sure
what to do, click the mini-buffer and do the hotkey <code>C-g</code>. This will
cancel the mini-buffer prompt, and also cancel the command that was
expecting the prompt. </p>

<h2>The Python Interpreter</h2>

<p>In Computer Science parlance, an interpreter is a program that lets
you interactively 'talk' to a programming language. A Python
Interpreter is thus a program that lets you interactively talk to
Python. The best way to see what I mean is to try it out yourself! </p>

<p>Just like Firefox and Emacs, we can enter the Python interpreter from
the terminal. To do this, simply type <code>python</code> at the terminal: </p>

<pre><code>star [153] ~ # python
Python 3.2.3 (default, Apr 10 2013, 06:11:55)
[GCC 4.6.3] on linux2
Type "help", "copyright", "credits" or "license" for more information.
&gt;&gt;&gt;
</code></pre>

<p>Now, you're talking to Python! The "<code>&gt;&gt;&gt;</code>" signifies that the
interpreter is waiting for user input. So, when you type something in
and hit enter, Python will try to evaluate it. It's similar in spirit
to the UNIX terminal prompt, but instead of talking to UNIX, you're
talking to Python. Try typing in a few simple arithmetic expressions. </p>

<pre><code>&gt;&gt;&gt; 1 + 2
3
&gt;&gt;&gt; 7 * 8 - 9
47
&gt;&gt;&gt; (1 + 2) * (3 - 4)
-3
</code></pre>

<p>Notice that you're actively talking to Python - hence, why it's an
interactive program. </p>

<p>We'll play around in Python more a little later in lab, so let's get
back to more Emacs fun - you can exit the Python interpreter by doing
either of the following: </p>

<ul>
<li>Typing <code>exit()</code>, and hitting enter</li>
<li>Or, doing <code>C-d</code></li>
</ul>

<h2>Emacs, Python, and the Terminal</h2>

<p>The Python interpreter is definitely neat, and allows you to try and
test out little bits of code relatively easily and quickly.  But as
our code gets more complex, typing everything into the interpreter
again and again gets tedious. Emacs comes in handy here, as it allows
our code some permanence. </p>

<p>Emacs does allow us to edit a file and then immediately run it in a
built-in interpreter, but that can get a little messy on our
instructional machines. To save Emacs (and ourselves) some trouble,
let's couple it with the powerful Unix terminal. You'll hopefully be
spending a lot of time in the terminal anyways, so using a text editor
and a terminal simultaneously becomes an obvious combination. </p>

<p>Let's start by creating a Python source file, so navigate to the lab0
directory, either </p>

<ol>
<li>from within the terminal, and running a new Emacs instance from
within the lab0 folder, OR</li>
<li>from within Emacs by typing in "lab0/" before you write the
filename</li>
</ol>

<p>Now, create a new file called greet.py - the .py file extension is
important, because: </p>

<ul>
<li>It's convention for Python source files to end in a .py
extension</li>
<li>Emacs needs the .py at the end to activate the
Python mode</li>
</ul>

<p>Let's write a very simple, sort-of-silly program that greets you by
name. Don't worry if you don't understand the program (we'll learn
what each of these pieces mean in more depth over the next few weeks): </p>

<pre><code>print("Hello world!")
my_name = "Eric"

def greet():
    print("Greetings ", my_name, ", how are you today?")
    print("  - Python")
</code></pre>

<p>Now, your Emacs screen should look something like this: </p>

<p><img src="assets/greet.png" alt="greet.py" title="Figure 10: Our simple greet.py program" /></p>

<p>Let's go back to the terminal and run our little program. </p>

<pre><code>star [154] ~/lab0 # python3 -i greet.py
</code></pre>

<p>You'll know you did it right if "Hello World" pops up and you're
thrown into a Python interpreter: <code>&gt;&gt;&gt;</code></p>

<p>When you run Python with the -i flag, Python acts as if you had typed
every line in greet.py into the interpreter, line by line. That's why
<code>Hello world!</code> appears, since the Python interpreter is evaluating
the first line in greet.py: <code>print("Hello world!")</code></p>

<p>greet.py also defines two things: a <code>my_name</code> variable (bound to the
value "<code>Eric</code>"), and a function <code>greet</code> that, when called, greets a
person (signed by Python, nonetheless!). To make sure it works, do the
following in the Python interpreter: </p>

<ol>
<li>Get the value of <code>my_name</code> by typing <code>my_name</code>, then hitting enter</li>
<li>Call the <code>greet</code> function by typing <code>greet()</code>, then hitting enter</li>
</ol>

<p>If you did it right, your terminal should look something like this: </p>

<pre><code>star [155] ~/lab0 # python3 -i greet.py
Hello World!

&gt;&gt;&gt; my_name
'Eric'
&gt;&gt;&gt; greet()
Greetings Eric, how are you today? 
    -Python
</code></pre>

<p>Great, it works! However, right now it's currently greeting me - we
probably want it to greet you! Go edit the greet.py file, and change
the value of the <code>my_name</code> variable to instead be your name. </p>

<p>For example, if your name is Stephanie, greet.py should look like: </p>

<pre><code>print("Hello World!")
my_name = "Stephanie"

def greet():
    print("Greetings ", my_name, ", how are you today?")
    print("  - Python")
</code></pre>

<p>Save greet.py in Emacs, then go back to the terminal, kill the current
interpreter session with <code>Ctrl-D</code>, and run <code>python3 -i greet.py</code>.
Then, call the <code>greet</code> function again at the Python prompt <code>&gt;&gt;&gt;</code> to
make sure the name was changed.</p>

<p>Congrats! You've completed your first typical work-cycle: edit a file,
run it, edit it again, run it again, etc. This will start feeling
natural as the course progresses (and as you get further in your CS
career!). </p>

<h2>Appendix A: Hotkeys in Emacs</h2>

<p>If you watch a pro Emacs user work in Emacs, you'll notice that he/she
never uses the mouse to do anything - everything he/she does is via
hotkeys. </p>

<p>A hotkey is just a combination/sequence of keys that, when performed,
does some action. For instance, you're all probably familiar with the
copy and paste hotkeys: <code>Ctrl-c</code>, and <code>Ctrl-v</code> respectively. </p>

<p>Emacs has a wide variety of hotkeys - pretty much any action can be
done with some sort of hotkey. For instance, the hotkey <code>C-x C-s</code> will
save the current buffer/file. </p>

<p>But let's see how to actually perform these hotkeys: 
* <code>C-x</code> means: while holding down the <code>Control</code> (Ctrl) key, press the
  <code>x</code> key.
* <code>C-s</code> means: while holding down the <code>Control</code> (Ctrl) key, press the
  <code>s</code> key.</p>

<p><code>C-x C-s</code> is two actions, one after another: </p>

<ol>
<li>First, do <code>C-x</code></li>
<li>Then, release both keys.</li>
<li>Finally, do <code>C-s</code></li>
</ol>

<p>To learn more about Emacs, go through the Emacs tutorial. You can
access it from the splash screen or by typing <code>C-h t</code>. (First, do
<code>C-h</code>, then just type <code>t</code>.)</p>

<h3>The Meta Key</h3>

<p>Some hotkeys involve the Meta key, such as this hotkey that opens up a
Scheme interpreter: <code>M-s</code> </p>

<p>The lab keyboards do not have a dedicated Meta key (and most laptops
don't either).  Instead, on most computers, you can use the <code>Alt</code> key.
Hold down the <code>Alt</code> key while pressing the next key in the command.</p>

<p>You can use <code>Esc</code> as a "sort of" Meta key. The difference is, you
first press the <code>Esc</code> key, then you hit the next key: for instance, to
do <code>M-s</code>, you don't hold <code>Esc</code> while pressing <code>s</code> - you can just do:</p>

<ol>
<li>First press the <code>Esc</code> key</li>
<li>Then press the <code>s</code> key </li>
</ol>

<h3>Some useful hotkeys</h3>

<table class="txt_table">
  <col width="250px" align="justify" />
  <col align="right" />
  <tr>
    <th> Hotkey </th>
    <th> Description of what it does </th>
  </tr>
  <tr>
    <td> `C-x C-s` </td>
    <td> Save your file. </td>
  </tr>
  <tr>
    <td> `C-x C-f` </td>
    <td> Open a file. If the filename you provide in the minibuffer
    doesn't exist, then Emacs will create a new file for you. </td>
  </tr>
  <tr>
    <td> `C-/`</td>
    <td> Undo. </td>
  </tr>
  <tr>
    <td> `C-w` </td>
    <td> Cut the highlighted region of text. </td>
  </tr>
  <tr>
    <td> `C-y` </td>
    <td> Paste text. </td>
  </tr>
  <tr>
    <td> `M-w` </td>
    <td> Copy the highlighted region of text. </td>
  </tr>
  <tr></tr>
  <tr>
    <td> `C-g` </td>
    <td> Cancel a command (useful if you accidentally did a command,
    and the mini-buffer is prompting you for something). </td>
  </tr>
  <tr>
    <td> `C-x C-c` </td>
    <td> Exit Emacs </td>
  </tr>
</table>

<h2>Appendix B: Unix Commands Summary (incomplete list)</h2>

<table class="txt_table">
  <col width="250px" align="justify" />
  <col align="right" />
  <tr>
    <th> Command </th>
    <th> Description </th>
  </tr>
  <tr>
    <td> `cal` </td>
    <td> Displays the current month </td>
  </tr>
  <tr>
    <td> `ls` </td>
    <td> Lists the current directory contents </td>
  </tr>
  <tr>
    <td> `mkdir` </td>
    <td> Creates a new directory with a specified name </td>
  </tr>
  <tr>
    <td> `cd` </td>
    <td> Moves into/out of directories </td>
  </tr>
  <tr>
    <td> `rm -r` </td>
    <td> Removes the given directory </td>
  </tr>
  <tr>
    <td> `echo` </td>
    <td> Outputs user input. </td>
  </tr>
  <tr>
    <td> `cat` </td>
    <td> Displays the contents of a specified file. </td>
  </tr>
  <tr>
    <td> `rm` </td>
    <td> Removes the specified file. </td>
  </tr>
  <tr>
    <td> `mv` </td>
    <td> Move a file to a new destination (can also be used to rename) </td>
  </tr>
  <tr>
    <td> `cp` </td>
    <td> Copy a file to a new destination </td>
  </tr>
  <tr>
    <td> man </td>
    <td> Brings up the manual page for a given command </td>
  </tr>
</table>

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
