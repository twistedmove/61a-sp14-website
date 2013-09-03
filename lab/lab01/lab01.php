<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head><script src="/A2EB891D63C8/avg_ls_dom.js" type="text/javascript"></script>
    <meta name="description" content ="CS61A Computer Science 61A: Structure and Interpretation of Computer Programs" />
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, John DeNero, Berkeley, EECS" />
    <meta name="author" content ="John DeNero, Soumya Basu, Jeff Chang, Brian Hou, Andrew Huang, Robert Huang, Michelle Hwang,
                                  Richard Hwang, Joy Jeng, Keegan Mann, Stephen Martinis, Mark Miyashita, Allen Nguyen,
                                  Julia Oh, Vaishaal Shankar, Steven Tang, Sharad Vikram, Albert Wu, Chenyang Yuan, Richie Zeng" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style type="text/css">@import url("../lab_style.css");</style>
    <style type="text/css">@import url("../61a_style.css");</style>

    <title>CS61A Fall 2013 - Creating a Productive Workflow on Your Own Machine</title>

  </head>

  <body style="font-family: Georgia,serif;">
    <h1><a href="http://www-inst.eecs.berkeley.edu/~cs61a/fa13/">CS 61A</a>: Lab 1</h1>
    <h3>Creating a Productive Workflow on Your Own Machine</h3>

    <p>
      Hopefully by now you're a little more comfortable using the command line on the lab machines in Soda. This lab is
      designed to help you get a feel for how to set up a productive workflow on your own machine so you can complete
      homeworks and projects!
    </p>

    <h2 class="section_title">Finding a Good Text Editor</h2>
    <p>
      For starters, we need to find a good text editor that we can rely on for the rest of the semester. In the first lab,
      we introduced you to Emacs, a popular text editor among Unix users. You're more than welcome to download and install Emacs
      on your own computer. You're also more than welcome to download and install any other text editor that you want. Some are better
      than others. Here's what we look for in a good text editor:

      <ul class="with_bullets">
        <li>An easy way to open and edit new files.</li>
        <li>The text editor should work well with Python files and plain text in general.</li>
        <li>Syntax highlighting is a bonus but is not required.</li>
        <li>Line numbers are a must.</li>
        <li>Keyboard shortcuts are a plus but also, not required.</li>
      </ul>

      When looking at these requirements, we compiled a list of recommended text editors:

      <ul class="with_bullets">
        <li>
          For Windows users:
          <ul class="with_bullets">
            <li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
            <li><a href="http://notepad-plus-plus.org/download/v6.4.5.html">Notepad++</a></li>
            <li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
          </ul>
        </li>
        <li>
          For Mac users:
          <ul class="with_bullets">
            <li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
            <li><a href="http://macromates.com/download">TextMate 2</a></li>
            <li><a href="http://ash.barebones.com/TextWrangler_4.5.3.dmg">TextWrangler</a></li>
            <li>Vim comes preinstalled on Mac OS X. Another great alternative is MacVim which can be
            found <a href="https://code.google.com/p/macvim/downloads/list">here</a>.</li>
            <li><a href="http://aquamacs.org/">AquaMacs</a>, a Mac adaptation of Emacs</li>
            <li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
          </ul>
        </li>
        <li>
          For Linux users:
          <ul class="with_bullets">
            <li><a href="http://www.sublimetext.com/2">Sublime Text 2</a></li>
            <li>Vim - to install vim on Ubuntu, you can type <code>sudo apt-get install vim</code> at your terminal prompt. vim-gnome, an alternative on
            Ubuntu (which has a graphical interface) can be installed using <code>sudo apt-get install vim-gnome</code></li>
            <li>Emacs - the easiest way to install this on Ubuntu is to open a terminal prompt and type <code>sudo apt-get install emacs</code></li>
            <li><a href="https://projects.gnome.org/gedit/">Gedit</a></li>
          </ul>
        </li>
      </ul>

      <div class="announcement">
        One thing to note: even though a standard download of Python will come with a text editor called Idle, we <strong>do not</strong>
        recommend it at all. The reason is that you won't gain as much experience using the command line to run your Python programs. This
        will hurt you a lot once you start working on the projects for this class so we highly recommend that you use the command line to run
        your files from day 1!
      </div>
    </p>

    <h2 class="section_title">Downloading and manipulating files</h2>
    <p>
      Great, so now we have a text editor, let's start editing some files! With each homework assignment, we'll provide you with a template
      with a lot of starter code already filled in for you. We <strong>highly</strong> recommend that you download this template and fill
      in the parts that you need to complete. This will make your life (and ours) a lot easier! Along with being a guide, this lab is also
      going to teach you how to submit your first assignment.
    </p>

    <p>
      Go ahead and download the template file <a href="http://inst.eecs.berkeley.edu/~cs61a/fa13/hw/hw0.py">here</a>!
    </p>

    <p>
      You should now have a file called <strong>hw0.py</strong> somewhere on your computer. For more specific instructions about homework 0,
      check out the homework 0 page <a href="http://inst.eecs.berkeley.edu/~cs61a/fa13/hw/hw0.html">here</a>. For the screenshots that you'll see below,
      we're using Sublime Text 2 on Mac OS X; however, Sublime Text 2 runs the same on any computer that you have so it should function
      the same as ours. Open that file up in your shiny new text editor and you should see the following text:
    </p>

    <img alt="hw0.py in a text editor" src="./imgs/hw0.png" class="screenshot"></img>

    <p>
      Next, we're going to edit our file to include the four required values, one in each of the functions. The first thing that you should notice is
      the green text that is wrapped within three quotation marks <code>"""<!--"--></code>. (Note: the colors on your text editor will most likely be
      different. For the curious, this screenshot is of the Solarized color scheme which you can find for your text editor if you are interested.)  That
      text is called a docstring which is a description of what the function is intended to do. Docstrings are very useful because that means other
      programmers can read your docstrings and have a nice description of what the function is supposed to do, without having to read any of your
      code. Within the docstring, you might notice some other funky characters such as <code>>>></code>. That's the start of what we
      call <em>doctests</em>. Doctests are a good way to also describe our function because they provide controlled input and expected output for our
      functions. What that means is that we call our function having some expected value (which we write out explicitly) and expect that it does have
      that value. An example might make a lot more sense here so let's take a look specifically at the <code>my_last_name()</code> function.
    </p>

    <img alt="my_name function" src="./imgs/my_name.png" class="screenshot"></img>

    <p>
      The two tests in our docstring basically check two things:

      <ol>
        <li>That you changed the return value from the default 'PUT YOUR LAST NAME HERE'.</li>
        <li>That the return value is a string and not something else (like a number).</li>
      </ol>

      Well how do we use these tests? Glad you asked! For this, we're going to have to open a terminal prompt. This process varies from computer
      to computer. If you're on a Mac or are using a form of Linux (such as Ubuntu), you already have a program called 'Terminal' on your computer.
      Open that up and you should be good to go. For Windows users, you have several options:

      <ol>
        <li>We recommend that you download a program called <a href="https://openhatch.org/missions/windows-setup/install-git-bash">GitBash</a> which
        allows you to run a Unix like terminal on your Windows machine.</li>
        <li>Another option is <a href="http://cygwin.com/install.html">Cygwin</a> which is a more advanced version of GitBash with an even more
        Unix-like environment.</li>
      </ol>

      Once you have your terminal window set up, we're going to have to use what we learned from lab 0...our handy Unix commands!
    </p>

    <img alt="starting the terminal" src="./imgs/terminal.png" class="screenshot"></img>

    <p>
      Right now, I'm in my home directory. Remember the home directory is represented by the <code>~</code> symbol (outlined in green above). Don't worry if your
      terminal window doesn't look exactly the same, the important part is that the text on the left hand side is relatively the same (with a different name) and
      you should definitely see a <code>~</code>.
    </p>

    <p>
      We can run commands like <code>cd</code> and <code>ls</code> just like before. <strong>Tip</strong>: It's generally a good idea to have a folder on your computer
      that's dedicated to containing all of your material in from this course. Within that folder, you should keep a <code>projects</code> folder, a <code>hw</code>
      folder, etc. We can make this folder in our home folder by typing <code>mkdir ~/cs61a</code> and magically, a folder will appear in our home directory! We can now <code>cd</code>
      into this folder and add more folders for organization. Let's add a <code>projects</code>, <code>hw</code>, and a <code>hw0</code> folder inside of our <code>hw</code> folder.
    </p>

    <p class="codemargin">
      cd ~/cs61a<br>
      mkdir projects<br>
      mkdir hw<br>
      mkdir hw/hw0
    </p>

    <p>
      Now if we list the contents of the directory (using <code>ls</code>), we can see that we have two folders, <code>projects</code> and <code>hw</code>.
    </p>

    <img src="./imgs/cs61a_directory.png" class="screenshot"></img>

    <p>
      The next thing we're going to do is find our downloaded file. If you didn't move the file at all, it's probably in <code>~/Downloads</code> on
      Mac/Linux/Windows (GitBash or Cygwin) or <code>C:\Users\NAMEOFUSER\Downloads</code> if you're using the Windows Command Line (cmd.exe). If your
      downloads all go to your Desktop, on Mac/Linux/Windows (GitBash or Cygwin), that would be <code>~/Desktop</code> and on the Windows Command
      Prompt, that would be <code>C:\Users\NAMEOFUSER\Desktop</code>. Let's <code>cd</code> into that directory.
    </p>

    <img src="./imgs/cd_to_downloads.png" class="screenshot"></img>

    <p>
      If we were to type <code>ls</code>, we'd see our file sitting there in our downloads folder. Let's move that file to our new homework directory.
    </p>

    <p class="codemargin">
      mv ~/Downloads/hw0.py ~/cs61a/hw/hw0
    </p>

    <p>
      This command says move the file located at <code>~/Downloads/hw0.py</code> to the directory <code>~/cs61a/hw/hw0</code>
    </p>

    <p>
      And then we should change back into our hw0 folder that we made earlier.
    </p>

    <p class="codemargin">
      cd ~/cs61a/hw/hw0
    </p>

    <p>
      Okay, we're just about ready to start editing a file. Don't worry, if this seems complicated at first, it will get way easier over time. Just keep practicing!
    </p>


    <h2 class="section_title">Editing files using a Productive Workflow</h2>
    <p>
      Open up your file which is now located in <code>~/cs61a/hw/hw0</code> in your text editor of choice and let's begin editing.
    </p>

    <p>
      In our productive workflow, we suggest having at least two windows open at all times.

      <ol>
        <li>Your text editor with the files that you're editing.</li>
        <li>Your terminal window so you can easily run doctests and later on, unit tests.</li>
      </ol>

      Here's a screenshot of a typical workspace. We've got our text editor on the left, and our terminal on the right!
    </p>

    <img src="./imgs/productive_workflow.png" class="screenshot"></img>


    <h2 class="section_title">Doctests</h2>
    <p>
      So, let's get back to that doctest thing that we were talking about before. Again, doctests are a way for us to write simple tests for our code.
      We're basically asking ourselves, "What is the expected output of this function if I put in this specific input?"
    </p>

    <p>
      To run our doctests, we switch over to our terminal and type in the following command:
    </p>

    <p class="codemargin">
      python3 -m doctest hw0.py
    </p>

    <p>
      This will give us a lot of output that shows which tests we are currently failing. Go ahead and try running it now on the file that you just downloaded.
      You should see something like this:
    </p>

    <img src="./imgs/doctest_output.png" class="screenshot"></img>

    <p>
      Oh man, we had 6 failures! :( Let's fix those up so that we have 0 failures. Before we can do that, we should analyze this output. In particular,
      let's look at the <code>my_last_name</code> test that we failed, highlighted here:
    </p>

    <img src="./imgs/my_name_test_failure.png" class="screenshot"></img>

    <p>
      The output gives us some pretty good debugging info. If you haven't already, take a look at Albert's debugging guide
      located <a href="http://inst.eecs.berkeley.edu/~cs61a/fa13/debugging.html">here</a>.  Looking at this particular test. It's saying that we had an
      error in our <code>hw0.py</code> file on line 12 in the function <code>my_last_name</code>. That's pretty useful because we know exactly where to
      look for it. This is why line numbers are a must for our text editors. After we find the correct line, let's try to understand what the test is
      saying. It's saying that the function <code>my_last_name</code>, when called with zero inputs, should <strong>not</strong> return the
      string <code>'PUT YOUR LAST NAME HERE'</code>. Except, ours is returning that string! Let's change that to your last name. Make sure you enter
      this information in carefully because this is how we will associate all homework, projects, and exams with you and your account.
    </p>

    <p>
      Once you have changed the return value of the function <code>my_last_name</code> (make sure that you're returning a string, which has quotes
      around it), you should be able to run the doctests again and your test for <code>my_last_name</code> should pass! Now you only have 5 failures to
      fix up!
    </p>

    <p>
      <strong>Some other things to note about doctests:</strong> You might run your doctests and see that there is no output. This is actually good. Doctests will only print out
      a bunch of output when you have failures in your tests. However, if you have to be super sure that you're passing all of the tests and not just messing up the command, you can
      add a command line flag <code>-v</code> to the command that we wrote up above to see the <code>verbose</code> output (which pretty much means see <em>all</em> output). This command looks
      like:
    </p>

    <p class="codemargin">
      python3 -m doctest -v hw0.py
    </p>

    <p>
      For the section number, <strong>please put down your lab section number</strong>. This number will be between 11 and 44. You can find a complete list of all the sections on the class
      calendar which is located <a href="http://www-inst.eecs.berkeley.edu/~cs61a/fa13/#schedule">here</a>.
    </p>

    <p>
      Once you have successfully completed the homework and you have 0 tests failing, the verbose output of the doctests should look something like this:
    </p>

    <img src="./imgs/successful_doctests.png" class="screenshot"></img>

    <h2 class="section_title">Copying files to the server</h2>
    <p>
      Now that you have finished your first assignment of CS61A, it's time to copy the file to the server. The server is where your instructional account lives and it's how you will
      submit all of your homeworks and projects.
    </p>

    <p>
      You'll need a method for copying your files to the server. For Windows, you'll want to download a program called <a href="http://winscp.net/eng/download.php">WinSCP</a>. Mac and Linux users can use the built in terminals
      that you've been using to run your doctests.
    </p>

    <h4 class="section_title">Windows</h4>
    <p>
      After you've installed WinSCP, you'll have to configure it so that you can log in to the server. Here's a screenshot of a typical log in:
    </p>

    <img src="./imgs/WinSCP.png" class="screenshot"></img>

    <p>
      Once you're logged in, all you have to do is navigate to your <code>cs61a/hw</code> folder on the left and drag your file over to the server on the right.
    </p>

    <h4 class="section_title">Mac / Linux</h4>
    <p>
      On Mac OS X and Linux, all you need is your terminal window that you were using before. Navigate to wherever you put your finished homework. If
      you were following the tutorial from above, you'll want to type something like <code>cd ~/cs61a/hw/hw0</code> to get to your homework 0
      folder. Then you'll want to type the following command:
    </p>

    <p class="codemargin">
      scp hw0.py cs61a-??@nova.cs.berkeley.edu:~/
    </p>

    <p>
      Let's break this command down into three parts. The first part, <code>scp</code> is just the name of the command. The second
      part, <code>hw0.py</code> is the path to the file(s) that you want to copy to the server. If you wanted, you could specify the whole path to the
      file such as <code>~/cs61a/hw/hw0/hw0.py</code> instead of just the filename. The reason why we can just specify the filename is because we're
      already in the folder that contains it. The last part of the command is the destination. For this, we're logging into the server using your login
      (the cs61a-??) part (make sure you change the question marks) and the server that we're logging into will be <code>nova</code>. A complete list of
      servers can be found <a href="http://inst.eecs.berkeley.edu/cgi-bin/clients.cgi?choice=servers">here</a>. We generally use <code>star</code>
      and <code>nova</code>.  The text that comes after the server and colon is important. We're specifying where on the server we want the file to
      go. In this case, we're placing it in our home directory which is represented by the <code>~</code> symbol. If we already had our homework folders
      created on the server, we could specify the whole path (with something like <code>scp hw0.py cs61a-??@nova.cs.berkeley.edu:~/hw/hw0</code>).
    </p>

    <p>
      After typing this command, you'll be asked for your password and then the file will transfer over! Now, we can move on to submitting!
    </p>

    <h2 class="section_title">Submitting your homework and projects</h2>
    <p>
      Great, so now you have all of your files related to your assignment on the instructional servers but you're not done quite yet! We have to actually submit our files!
    </p>

    <p>
      To log onto our instructional accounts, follow these tutorials:

      <ul>
        <li><a href="http://www.youtube.com/watch?v=gDDaz6Sb8jo">Windows</a></li>
        <li><a href="http://www.youtube.com/watch?v=irwlU7esODA">Mac / Linux</a></li>
      </ul>

      To summarize, you'll be using a program called <a href="http://www.putty.org/">PuTTY</a> for Windows and using a command called <code>ssh</code> on Mac / Linux.
      The full command for <code>ssh</code> is (don't forget to replace the ?? with your login):
    </p>

    <p class="codemargin">
      ssh cs61a-??@star.cs.berkeley.edu
    </p>

    <p>
      Once logged in, you'll see something like this:
    </p>

    <img src="./imgs/inst_login.png" class="screenshot"></img>

    <p>
      If you copied your files over correctly, you should be able to type <code>ls</code> and see your hw0.py file. If not, try to figure out what happened in the above steps. If
      you're really stuck, try posting on Piazza first and if that still doesn't help, come talk to one of the TAs in office hours.
    </p>

    <p>
      We're going to first create a new folder to hold our homework 0 file. In the future, you'll be submitting projects with multiple files so it's good to get in a habit of creating a new folder for each assignment.
      Let's make the hw0 directory, move our <code>hw0.py</code> file into it, and then <code>cd</code> into our <code>hw0</code> folder:
    </p>

    <p class="codemargin">
      mkdir hw0<br>
      mv hw0.py hw0<br>
      cd hw0
    </p>

    <p>
      We're all ready to submit our homework. But wait, we first need to check to make sure that we entered in the correct information into the sign up form.
      This is important because we'll use this information to send you automated emails with the scores of your projects. To check what you entered, type in:
    </p>

    <p class="codemargin">
      check-register
    </p>

    <p>
      If you find errors, fix them immediately by running the command:
    </p>

    <p class="codemargin">
      re-register
    </p>

    <p>
      Okay, now we're ready to submit. To do so, simply type:
    </p>

    <p class="codemargin">
      submit hw0
    </p>

    <p>
      Answer the questions that come up by typing <code>yes</code> or <code>no</code>. To check that you successfully submitted, you can type:
    </p>

    <p class="codemargin">
      glookup -t
    </p>

    <p>
      Glookup is the name of the command that you will use this semester to check your grades. At any time, you can simply enter <code>glookup</code>
      to check for the grades of your submitted assignments (the ones that have been graded so far). Adding a <code>-t</code> to the <code>glookup</code>
      command allows you to see all the times that you have successfully submitted a homework or project. You should see a successful submission of about 1 minute ago.
    </p>

    <h2 class="section_title">The Autograder</h2>
    <p>
      The autograder is a program that runs on our servers over your projects after you submit them. Once you submit your project, it will be added to
      the line of projects that we will then run the autograder over. When the autograder finishes running over your project, you'll receive an email
      with an automated response that lets you know how your project is doing (in terms of which tests you're passing and which ones you're
      failing). The autograder is a subset of the tests that we will run on your project to determine your grade meaning that it might catch some, but
      not all of your errors; however, it is a good indicator of how well you're doing on the project so far. This does mean that you should always
      write your own tests for your projects. We'll get into exactly what "good testing" is later on in this course, but the thing to realize right now
      is that you shouldn't rely on the autograder to determine the correctness of your project and that you should be using other methods to test your
      code!
    </p>

    <p>
      To get you used to how the autograder works, we're going to be running a sample autograder over your hw0 submission and you should receive an email within 30 minutes.
      This email will be similar to the one that you will receive for a project. If you don't get this email within an hour or so, make sure that you have a valid email address
      entered under your account info. To check, run <code>check-register</code> to see which email you have registered with and <code>re-register</code> to change it.
    </p>

    <p>
      Once you have received the autograder email from us and it says that you have passed all of the tests, you're good to go! <strong>Congrats</strong>, you just submitted your first CS61A assignment!
    </p>
  </body>
</html>
