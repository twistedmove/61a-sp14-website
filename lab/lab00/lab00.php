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

    <title>CS 61A Fall 2013: UNIX/Emacs Tutorial</title>

  </head>

  <body style="font-family: Georgia,serif;">
  <h1><a href="http://www-inst.eecs.berkeley.edu/~cs61a/fa13/">CS 61A</a>: Lab 0</h1>
  <h3> Introduction to UNIX/Emacs </h3>

  <ul class="toc">
    <h3> Table of Contents </h3>
    <li> <a href="#Introduction"> 0. Introduction </a> </li>
      <ul>
        <li> <a href="#0.1"> 0.1. Logging in from Home </a> </li>
      </ul>
    <li> <a href="#1"> 1. Meet the Terminal </a>
    <li> <a href="#2"> 2. Getting used to the Filesystem </a>
      <ul>
        <li> <a href="#2.1"> 2.1. Directories </a> </li>
        <ul>
          <li> <a href="#2.1.1"> 2.1.1. Making Directories </a> </li>
          <li> <a href="#2.1.2"> 2.1.2. Changing Directories </a> </li>
          <li> <a href="#2.1.3"> 2.1.3. Removing Directories </a> </li>
        </ul>
        <li> <a href="#2.2"> 2.2. Files </a> </li>
        <ul>
          <li> <a href="#2.2.1"> 2.2.1. Making a File – redirecting output </a> </li>
          <li> <a href="#2.2.2"> 2.2.2. Copying Files </a> </li>
          <li> <a href="#2.2.3"> 2.2.3. Moving a File </a> </li>
          <li> <a href="#2.2.4"> 2.2.4. Renaming a File </a> </li>
        </ul>
        <li> <a href="#2.3"> 2.3. The Most Useful Unix Command: man </a> </li>
        <li> <a href="#2.4"> 2.4. Summary of Unix Commands </a> </li>
      </ul>
    </li>
    <li> <a href="#3"> 3. Running Programs: firefox </a> </li>
    <li> <a href="#4"> 4. A Recap </a> </li>
    <li> <a href="#5"> 5. Our Text Editor: Emacs </a>
      <ul>
        <li> <a href="#5.1"> 5.1. Creating a file in Emacs </a> </li>
        <li> <a href="#5.2"> 5.2. Editing a file in Emacs </a> </li>
      </ul>
    </li>
    <li> <a href="#6"> 6. The Python Interpreter </a> </li>
    <li> <a href="#7"> 7. Emacs, Python, and the Terminal</a> </li>

    <li> <a href="#A"> Appendix A: Hotkeys in Emacs </a>
      <ul>
        <li> <a href="#A.1"> A.1. The Meta key </a> </li>
        <li> <a href="#A.2"> A.2. Some Useful Hotkeys </a> </li>
      </ul>
    </li>
    <li> <a href="#B"> Appendix B: Unix Commands Summary </a> </li>
  </ul>

  <h2 class="section_title"> <a name="Introduction"> 0. Introduction </a> </h2>

  <p>
    Hello! The first thing you might have noticed about these
    computers is that they don't have Windows or MacOS installed. And
    you're right - they're running UNIX (Ubuntu to be exact). But fear not! We'll get you
    familiar with this new system in no time - by the end of the
    semester, this stuff will feel like old hat.
  </p>

  <p>
    By now, you should already have logged in, registered
    (make sure you use your <i>berkeley.edu</i> email address)
    and changed your password by running <span class="tt">ssh update</span>.
    If you made a typo (e.g. misspelled your name), don't
    worry; you can restart the registration program, first by completing
    the registration process, and then typing
    <span class="tt">re-register</span> at the prompt and hitting enter.
  </p>

  <p class="note">
    <u>Note</u>: <b>Please</b> do not forget your login
    information - especially your log-in name (e.g.
    cs61a-ba). Memorize your log-in name, e-mail your log-in name to
    yourself, etc. If you forget, you'll need to get another log-in form
    from your TA and start again. If you forget your password, you can
    either e-mail INST at inst@eecs.berkeley.edu, or go to 333 Soda.
  </p>

  <h3 class="section_title"><a name="0.1">0.1. Logging in from Home</a></h3>

  <p>
    If you don't have access to a school computer for this lab, you can still
    try it out: refer to <a href="../lab01/lab01.php">Lab 1</a> for more details about
    setting up your home computer.
  </p>

  <h2 class="section_title"><a name="1">1. Meet the Terminal</a></h2>

  <p>
    The first thing we're going to do is open the Terminal. To do this, click
    on the launcher in the top left corner. Start typing in "Terminal" and it should autocomplete.
    You should see something like this:
  </p>

  <img src="imgs/pick_terminal.png" class="figure" width="50%"></img>
  <p class="figure_caption">Figure 1: Opening the Terminal</p>

  <p>
    Press "Enter" or click on the Terminal icon and finally, you'll see a window that looks something like this:
  </p>

  <img src="imgs/terminal.png" alt="Terminal" class="figure"/>
  <p class="figure_caption">Figure 2: The terminal window.</p>

  <p>
    This window is called the terminal - this is where you'll be
    talking to the computer. You talk to the computer by entering in
    commands. Here's a neat command - need to look up a date for this
    month? Try the <span class="tt">cal</span> command by typing
    <span class="tt">cal</span> into the terminal, then hitting enter:
  </p>

  <img src="imgs/cal_cmd.png" alt="Calender output" class="figure"/>
  <p class="figure_caption"> Figure 3: Your first command,
  <span class="tt">cal!</tt> </p>

  <p> Neat, right? Turns out, these computers can do more than
  displaying the current calendar - crazy, right? </p>

  <h2 class="section_title"> <a name="2"> 2. Getting used to the Filesystem </a> </h2>

  <p>
    The most important thing to learn first is how to use the
    filesystem. Unlike in Windows/MacOS, there aren't folders you can
    click/drag/double-click. There's not even a 'My Computer' icon in
    sight!
  </p>

  <p>
    That's okay - we're going to learn how to do everything via the
    command line (the command line is the terminal). Everything you did
    on a visual-based filesystem (i.e. like those found on a
    Windows/MacOS system), you can also do via the terminal.
  </p>

  <h3 class="section_title"> <a name="2.1"> 2.1. Directories </a> </h3>

  <p> First, I'll introduce you to our good friend,
  <span class="tt">ls</tt>. </p>

  <p> <span class="tt">ls</span> is a command that lists all the files
  in the current directory. Oh yes, and what's a directory?
  A directory is just like a folder, e.g. the "My Documents" folder.
  When you log in, you are automatically started off in the home
  directory, so if we run the <span class="tt">ls</span>
  command right now, it'll display all the files in our home
  directory: </p>

  <p> Try the <span class="tt">ls</span> command now! </p>

  <p class="codemargin"> star [121] ~ # ls <br/>
                   star [122] ~ #  </p>

  <p> Hm - nothing really happened. That's because there's nothing in
  our home directory - we just made our account after all! Let's make
  some stuff! </p>

  <h3 class="section_title"> <a name="2.1.1"> 2.1.1. Making Directories </a> </h3>

  <p> This leads to another good command: the
  <span class="tt">mkdir</span> command. </p>

  <p> <span class="tt">mkdir</span> is a command that makes a new
  directory (hey now, the command names make sense!). Unlike
  <span class="tt">cal</span> and <span class="tt">ls</span>, we
  don't just type <span class="tt">mkdir</span> and press enter - we
  need to specify the name of the folder we want to create! Since
  we're well-organized people, let's create a new directory for this
  lab, and call it lab0: </p>

  <p class="codemargin"> star [123] ~ # mkdir lab0 <br/>
                   star [124] ~ # </p>

  <p> When we supply extra 'stuff' to a command (like a folder name,
  for instance), we say that we're calling the mkdir command with
  parameter(s). Not all commands take arguments (recall
  <span class="tt">cal</span>). Some commands even have optional
  parameters (<span class="tt">ls</span>, for instance, has a
  bunch of different optional parameters). </p>

  <p> Okay, now that we've made our directory, let's make sure it's
  actually there - use the <span class="tt">ls</span> command to make
  sure that the lab0 directory exists. </p>

  <p class="codemargin"> star [125] ~ # ls <br/>
                   lab0 <br/>
                   star [126] ~ # </p>

  <p> Hey, there's our new directory! Awesome. </p>

  <h3 class="section_title"> <a name="2.1.2"> 2.1.2. Changing Directories </a> </h3>

  <p> To get 'inside' the directory, we have a handy command called
  <span class="tt">cd</span>. </p>

  <p><span class="tt">cd</span> (short for change-directory) is a
  command that, when given a directory name as a parameter, takes you
  into that directory. Enter the lab0 directory by typing:
  <span class="tt">cd lab0</span> </p>

  <p class="codemargin"> star [126] ~ # cd lab0 <br/>
                   star [126] ~/lab0 # </p>

  <p> Note that the <span class="tt">~</span> turned into a
  <span class="tt">~/lab0</span>. This tells you that you're
  currently in the lab0 directory - the <span class="tt">~</span>
  stands for the home directory. </p>

  <p> So we're inside the lab0 directory, but there's not much here.
  You can <span class="tt">ls</span> to make sure that it's empty.
  Let's say we want to go back to the home directory: there are two
  ways to go back from here. </p>

  <p> One way is to enter in the following:
  <span class="tt">cd .. </span> </p>

  <p class="codemargin"> star [126] ~/lab0 # cd .. <br/>
                   star [127] ~ # </p>

  <p> The <span class="tt">..</span> is shorthand in UNIX for
  "the parent directory". The home directory is the parent directory
  of the lab0 directory (since the lab0 directory lives in the home
  directory). </p>

  <p> Alternately, you can type in just: <span class="tt">cd</span> </p>

  <p class="codemargin"> star [127] ~/lab0 # cd <br/>
                   star [128] ~ # </p>

  <p> Running the <span class="tt">cd</span> command with no
  parameters is equivalent to returning to the home directory. This
  is handy when you're many directories deep, and you don't want to
  keep repeating <span class="tt">cd ..</span> to get back home. </p>

  <h3 class="section_title"> <a name="2.1.3"> 2.1.3. Removing Directories </a> </h3>

  <p> We've created them - now, we can destroy them! Er, remove them,
  rather. Often, you'll find yourself wanting to delete directories
  (say, to organize things). To delete a directory, we use
  <span class="tt">rm -r</span> command, short for remove recursively.
  This tells Unix to recursively go through a folder, deleting the folder
  and all of its contents (including empty folders). </p>

  <p> Like <span class="tt">mkdir</span>, <span class="tt">rm -r</span>
  takes a directory name as a parameter. Try the following steps: </p>

  <ol>
    <li> Create a directory called my_folder </li>
    <li> Run <span class="tt">ls</span> to see that it's really there </li>
    <li> Remove the directory using <span class="tt">rm -r my_folder</span> </li>
    <li> Run <span class="tt">ls</span> again to see that it's not
    there anymore. </li>
  </ol>

  <p> Summary: We've learned about the following commands: </p>

  <table class="txt_table">
    <col width="250px" align="justify" />
    <col align="right" />
    <tr>
      <th> Command </th>
      <th> Description </th>
    </tr>
    <tr>
      <td> <span class="tt">cal</span> </td>
      <td> Displays the current month </td>
    </tr>
    <tr>
      <td> <span class="tt">ls</span> </td>
      <td> Lists the current directory contents </td>
    </tr>
    <tr>
      <td> <span class="tt">mkdir</span> </td>
      <td> Creates a new directory with a specified name </td>
    </tr>
    <tr>
      <td> <span class="tt">cd</span> </td>
      <td> Moves into/out of directories </td>
    </tr>
    <tr>
      <td> <span class="tt">rm -r</span> </td>
      <td> Removes the given directory </td>
    </tr>
  </table>

  <h3 class="section_title"> <a name="2.2"> 2.2. Files </a> </h3>

  <p> We've done a lot of things so far, but only with directories -
  we probably want to be able to actually have stuff in our
  directories. So, let's make some files, and learn the commands to
  manipulate them. </p>

  <p> Our first step is to create a file. Notice the distinction
  between files and directories. In UNIX, we tend to treat files and
  directories separately - for instance, it makes sense to
  <span class="tt">cd</span> into a directory, but it doesn't quite
  make sense to <span class="tt">cd</span> into a text file! </p>

  <p> Let's create a simple file that has the sentence: 'This semester
  will be awesome!' </p>

  <p> The command we'll use is called <span class="tt">echo</span>. <br/>
  <span class="tt">echo</span> is a command that simply displays
  anything you type after the word 'echo': </p>

  <p class="codemargin"> star [136] ~ # echo hello <br/>
                   hello <br/>
                   star [137] ~ # echo Stop repeating me! <br/>
                   Stop repeating me! <br/>
                   star [138] ~ # echo No, you stop! <br/>
                   No, you stop! </p>

  <p> Some terminology - the words that the computer displays after
  we hit the enter button is the output of the echo command. It's
  sort of like this picture: </p>

  <img src="imgs/echo_visual.png" alt="Echo visual" class="figure"/>
  <p class="figure_caption"> Figure 4: Visualization of input/output
  of the echo command </p>

  <h3 class="section_title"> <a name="2.2.1"> 2.2.1. Making a file
  - redirecting output </a> </h3>

  <p> UNIX has a very nice way to redirect output - with the
  <span class="tt">></span> symbol.
  Let's say we want to redirect the output of
  <span class="tt">echo</span> into a new file called my_file . We
  can do this by doing: </p>

  <p class="codemargin"> star [139] ~ # echo This semester will be awesome! > my_file <br/>
                   star [140] ~ # ls <br/>
                   lab0 my_file <br/> </p>

  <p> That was easy! We created a new file - to get a glimpse into
  what's inside, we can use another command, called
  <span class="tt">cat</span>. <br/>
  <span class="tt">cat</span> is a command that displays the contents
  of a given file: </p>

  <p class="codemargin"> star [141] ~ # cat my_file <br/>
                   This semester will be awesome! </p>

  <p> To remove files, we use the <span class="tt">rm</span> command
  - this time without the <span class="tt">-r</span> option.
  Use the <span class="tt">rm</span> command to delete the
  my_file file: </p>

  <p class="codemargin"> star [142] ~ # ls <br/>
                   lab0 my_file <br/>
                   star [143] ~ # rm my_file <br/>
                   star [144] ~ # ls <br/>
                   lab0 <br/> </p>

  <p class="note"> <u>Warning</u>: Use <span class="tt">rm</span>
  with utmost care! Unlike in
  Windows/MacOS, there is no friendly 'Recycle Bin' or 'Trash' where
  you can restore a deleted file. In UNIX (at least on these systems),
  when you <span class="tt">rm</span> a file, it's gone. Vanished.
  Caput. There's no 'undo-ing' a <span class="tt">rm</span> - so,
  think twice (and thrice!) before using the <span class="tt">rm</span>
  command! </p>

  <p> With directories, we were able to make and remove them. However,
  for files, we can do even more! </p>

  <p> Let’s go ahead and make a new file, because we have removed the
  one we made in the previous section. </p>

  <p class="codemargin"> star [139] ~ # echo This semester will be awesome! > my_file <br/>
                   star [140] ~ # ls <br/>
                   lab0 my_file <br/> </p>

  <h4 class="section_title">Touch</h4>
  <p>
    Another way you can create a simple blank file is by using the touch command. Say I wanted to
    create a file called 'my_other_file', I could simply type:
  </p>

  <p class="codemargin">
    star [150] ~ # touch my_other_file
  </p>

  <h3 class="section_title"> <a name="2.2.2"> 2.2.2. Copying a file </a> </h3>

  <p> Let’s say we wanted to make a copy of this file. Well we can use
  the <span class="tt">cp</span> command. <br/>
  <span class="tt">cp</span> takes two parameters, the first is the
  name of the file you want to make a copy of, and the second is the
  name of the new file you want to copy the first file into. For
  example, if we wanted to copy my_file into a new and different file
  called new_file, then we could do so as follows: </p>

  <p class="codemargin"> star [272] ~ # cp my_file new_file <br/>
                   star [273] ~ # ls <br/>
                   lab0 my_file  new_file <br/> </p>

  <p> If we were then to look at each file separately using the
  <span class="tt">cat</span> command, we can see that new_file is
  simply a copy of my_file. Exactly what we wanted. </p>

  <p class="codemargin"> star [275] ~ # cat new_file <br/>
                   This semester will be awesome! </p>

  <p> Now a lot of times we will want you to copy a file from our
  cs61a account into your own. We can use the
  <span class="tt">cp</span> command to do so by specifying the
  filepath, which will almost always be given to you. (For example,
  something like “~cs61a/lib/shakespeare.txt” is the filepath for the
  text file from our 61a account which contains a Shakespearean
  sonnet). </p>

  <p What we could do is something like this: </p>

  <p class="codemargin"> star [276] ~ # cp ~cs61a/lib/shakespeare.txt shakespeare.txt <br/>
                   star [277] ~ # ls <br/>
                   lab0 my_file new_file shakespeare.txt <br/> </p>

  <p> But here's a handy tip: if we put a period
  '<span class="tt">.</span>' as the second argument to
  <span class="tt">cp</span>, we get the same effect: </p>

  <p class="codemargin"> star [278] ~ # cp ~cs61a/lib/shakespeare.txt . <br/>
                   star [279] ~ # ls <br/>
                   lab0 my_file new_file shakespeare.txt <br/> </p>

  <p> The '<span class="tt">.</span>' is a UNIX shorthand for
  'current directory'. So,
  <span class="tt">cp ~cs61a/lib/shakespeare.txt .</span> means: <br/>
  &nbsp&nbsp&nbsp&nbsp Create a new copy of ~cs61a/lib/shakespeare.txt,
  and put it in the current directory. </p>

  <p> Similarly, if we wanted to, we could copy shakespeare.txt to
  our lab0 directory by doing: </p>

  <p class="codemargin"> star [280] ~ # cp ~cs61a/lib/shakespeare.txt lab0 <br/>
                   star [281] ~ # ls lab0 <br/>
                   shakespeare.txt </p>

  <h3 class="section_title"> <a name="2.2.3"> 2.2.3. Moving a File </a> </h3>

  <p> We can also move a file to a different directory by using the
  <span class="tt">mv</span> command. <br/>
  <span class="tt">mv</span> takes in two parameters as well: the
  first is the filename that we want to move, and the second is the
  name of the directory that we want to move that file into. </p>

  <p class="codemargin"> star [275] ~ # mv new_file lab0 <br/>
                   star [275] ~ # ls <br/>
                   lab0 my_file <br/>
                   star [276] ~ # cd lab0 <br/>
                   star [277] ~/lab0 # ls <br/>
                   new_file <br/> </p>

  <p> We just moved new_file into the lab0 directory. As you can see,
  the lab0 directory is in the home directory, which is where the
  new_file originally was.  The name of the directory we are moving
  the file into needs to be in the current directory, or else the
  computer will not know what directory you are referring to, and
  will instead rename the file (more on that later). </p>

  <p> However, what if we wanted to move the file back into the home
  directory; the home directory is not inside of lab0, so there is no
  way to reach it right? No! Just like we could change into a parent
  directory by calling cd with
  “<span class="tt">..</span>” we can also move a file into
  the parent directory by calling <span class="tt">mv</span> with a
  filename and “<span class="tt">..</span>” as follows: </p>

  <p class="codemargin"> star [276] ~/lab0 # ls <br/>
                   new_file <br/>
                   star [278] ~/lab0 # mv new_file .. <br/>
                   star [279] ~/lab0 # ls <br/>
                   star [279] ~/lab0 # cd <br/>
                   star [278] ~ # ls <br/>
                   new_file <br/> </p>

  <p> We have just moved new_file back into our home directory,
  which was a parent directory of the lab0 directory. <br/>

  <h3 class="section_title"> <a name="2.2.4"> 2.2.4. Renaming a File </a> </h3>

  <p> Lastly, we can rename a file. To rename a file, we can
  actually also use the <span class="tt">mv</span> command. In this
  case, the <span class="tt">mv</span> command still takes in two
  parameters: the first being the name of the file we want to rename;
  however, the second is the new name for the file. </p>

  <p class="codemargin"> star [277] ~/lab0 # mv new_file best_name_ever <br/>
                   star [278] ~/lab0 # ls <br/>
                   best_name_ever <br/> </p>

  <p> We have just successfully renamed new_file to be the filename:
  “best_name_ever.” </p>

  <h3 class="section_title"> <a name="2.3"> 2.3. The Most Useful Unix Command: man </a> </h3>

  <p> We've shown you a lot of commands and it might become a little
  hard to remember what everything does. If you ever forget (and can't
  be bothered to come back to this page), there is one useful that'll
  help: <span class="tt">man</span> (short for manual). </p>

  <p> Just run <span class="tt">man</span> with some other Unix command
  to find out what it does (e.g. <span class="tt"> man cp</span>).
  <span class="tt">man</span> will bring up a
  page inside of the terminal. The NAME field will give a brief description
  of what the command does, and the DESCRIPTION will have a host of extra
  options you can run the command with. </p>

  <p> You can navigate forward through the man page with the <span class="tt">Enter/
  Return</span> key and you can quit with <span class="tt">q</span> key. </p>


  <h3 class="section_title"> <a name="2.4"> 2.4. Summary of Unix Commands </a> </h3>

  <table class="txt_table">
    <col width="250px" align="justify" />
    <col align="right" />
    <tr>
      <th> Command </th>
      <th> Description </th>
    </tr>
    <tr>
      <td> <span class="tt">cal</span> </td>
      <td> Displays the current month </td>
    </tr>
    <tr>
      <td> <span class="tt">ls</span> </td>
      <td> Lists the current directory contents </td>
    </tr>
    <tr>
      <td> <span class="tt">mkdir</span> </td>
      <td> Creates a new directory with a specified name </td>
    </tr>
    <tr>
      <td> <span class="tt">cd</span> </td>
      <td> Moves into/out of directories </td>
    </tr>
    <tr>
      <td> <span class="tt">rm -r</span> </td>
      <td> Removes the given directory </td>
    </tr>
    <tr>
      <td> <span class="tt">echo</span> </td>
      <td> Outputs user input. </td>
    </tr>
    <tr>
      <td> <span class="tt">cat</span> </td>
      <td> Displays the contents of a specified file. </td>
    </tr>
    <tr>
      <td> <span class="tt">rm</span> </td>
      <td> Removes the specified file. </td>
    </tr>
    <tr>
      <td> <span class="tt">mv</span> </td>
      <td> Move a file to a new destination (can also be used to rename) </td>
    </tr>
    <tr>
      <td> <span class="tt">cp</span> </td>
      <td> Copy a file to a new destination </td>
    </tr>
    <tr>
      <td> <span class="tt">man<span> </td>
      <td> Brings up the manual page for a given command </td>
    </tr>
  </table>

  <h2 class="section_title"> <a name="3"> 3. Running programs: Firefox </a> </h2>

  <p> These machines come pre-installed with a variety of programs.
  If you continue to use the lab machines, two programs that you'll be
  frequently using over the semester are Firefox and Emacs. </p>

  <p> Firefox is a free web browser (like Internet Explorer, Safari,
  Google Chrome, etc.). <strong>To open it, you can simply click on the icon on the left
  hand side of your screen.</strong> Another way of starting the program is to type the
  name at the terminal and hit enter: </p>

  <p class="codemargin"> star [145] ~ # firefox </p>

  <p> After a few moments, Firefox will open up in its own window.
  Don't worry if it takes awhile - during the first week of school,
  the servers are usually very busy, so programs like Firefox may be
  slow at first. </p>

  <p> One unfortunate side-effect of opening up Firefox like this is
  that our terminal is now unresponsive to new commands: </p>

  <p class="codemargin"> star [145] ~ # firefox <br/>
                   ls <br/>
                   cd <br/>
                   helloooo <br/>
                   you're not working anymore :( <br/> </p>

  <p> The terminal will only be responsive once you exit Firefox. To
  avoid this situation, if you add an ampersand
  '<span class="tt">&</span>' after <span class="tt">firefox</span>,
  the terminal will still be responsive (adding a & runs the program in the background): </p>

  <p class="codemargin"> star [145] ~ # firefox & <br/>
                   star [146] ~ # ls <br/>
                   lab0 <br/>
                   star [147] ~ # echo "Hooray, you're listening to me! " <br/>
                   Hooray, you're listening to me! <br/> </p>

  <h2 class="section_title"> <a name="4"> 4. A Recap </a> </h2>

  <p> Whew! We've covered a lot so far, so let's recap what we've done
  so far. </p>

  <ul>
    <li> How to use commands to navigate the filesystem
      <ul>
        <li> ls, cd</li>
      </ul>
    </li>
    <li> How to create/remove directories
      <ul>
        <li> mkdir, rm -r</li>
      </ul>
    </li>
    <li> How to create/remove/display files
      <ul>
        <li> echo, rm, cat </li>
      </ul>
    </li>
    <li> How to move/rename/copy files
      <ul>
        <li> mv, cp</li>
      </ul>
    </li>
    <li> How to redirect output from one command to another
      <ul>
        <li> i.e. <span class="tt">echo This is my file > new_file </span></li>
      </ul>
    </li>
    <li> How to run programs, and access the Internet with firefox
      <ul>
        <li><!-- To retain control of the terminal, insert an
        '<span class="tt">&</span>' after the program name, as in: <br/>-->
        <span class="tt"> firefox<!-- & --></span></li>
      </ul>
    </li>
    <li> If you ever forget what a command does
      <ul>
        <li> <span class="tt">man</span> </li>
      </ul>
    </li>
  </ul>

  <p> This is fantastic - definitely all of the commands you'll need
  for the semester. However, we have yet to really create/edit/save
  text files. And no, Microsoft Word is not installed on these
  machines. But we have something better! </p>

  <div class="announcement">
    If you plan to use your own computer for most of your work in this course, there are many editors to choose from depending on your operating system.
    Instead of reading this section on Emacs, start reading <a href="../lab01/lab01.php">Lab 1</a> on selecting an editor.
  </div>

  <h2 class="section_title"> <a name="5"> 5. Our Text Editor: Emacs </a> </h2>

  <p> Emacs is a very popular free text editor, with quite a bit of
  history behind it (it was created in 1976!). This is the text editor
  we'll primarily be using this semester. However, it's definitely not
  required - some other text editors include:
    <ul>
        <li> Notepad++ </li>
        <li> Vim </li>
        <li> Nano </li>
        <li> Sublime Text 2 </li>
        <li> TextMate </li>
    </ul>

  However, we'll only be talking
  about Emacs here. Now, Emacs may seem very intimidating and
  difficult at first, but don't worry, we'll get you situated in no
  time. </p>

  <p> To help us keep track of what we're doing, I'm going to
  explicitly state the goals for this section: </p>

  <ol>
    <li> Using Emacs, create a new text file called 'my_epiphany' in
    the home directory, and type the sentence: <br/>
    &nbsp&nbsp&nbsp&nbsp "This is going to be a pretty good semester." </li>
    <li> Then, using Emacs, re-open 'my_epiphany', and edit it to
    instead say: <br/>
    &nbsp&nbsp&nbsp&nbsp "This semester is going to be a fantastic semester!" </li>
  </ol>

  <p> So, let's start with opening up Emacs. It's important where you
  open Emacs, because the directory in which you open Emacs determines
  the directory that Emacs 'starts off' in. For instance, if I open up
  Emacs in the home directory, and I saved a file called
  'my_file.txt', then my_file.txt will appear in the home directory.
  But more on that later!  </p>

<!--moved ampersand discussion from firefox-->
<p>Let's try opening Emacs with the following: </p>
  <p class="codemargin"> star [145] ~ # emacs</p>

<p> One unfortunate side-effect of opening up Emacs like this is
  that our terminal is now unresponsive to new commands: </p>

  <p class="codemargin"> star [145] ~ # emacs <br/>
                   ls <br/>
                   cd <br/>
                   helloooo <br/>
                   you're not working anymore :( <br/> </p>

  <p> The terminal will only be responsive once you exit Emacs. To
  avoid this situation, if you add an ampersand
  '<span class="tt">&</span>' after <span class="tt">Emacs</span>,
  the terminal will still be responsive: </p>

  <p class="codemargin"> star [145] ~ # emacs & <br/>
                   star [146] ~ # ls <br/>
                   lab0 <br/>
                   star [147] ~ # echo "Hooray, you're listening to me" <br/>
                   Hooray, you're listening to me <br/> </p>
<!--end ampersand discussion-->

  <p>A window something like this should open up:</p>

  <img src="imgs/emacs_splash.png" alt="Emacs Splash" class="figure"/>
  <p class="figure_caption"> Figure 5: The Emacs splash page. <b>Note:</b> you
  might not have the icons below the menu bar when you run Emacs.</p>

  <p> This is sort of the 'splash page' for Emacs - later, if you're
  interested, you can check out the Emacs Tutorial, but let's not do
  that right now. (It is a valuable resource for learning to use
  Emacs, but it might take more time than you have during lab! :p) </p>

  <h3 class="section_title"> <a name="5.1"> 5.1. Creating a file in Emacs </a> </h3>

  <p> Now, let's create our new file - to do that, you can do any of
  the following 2 options: </p>

  <ul>
    <li> Option 1: Go to File menu, and click on Visit New File... <br/>

      <img src="imgs/emacs_new2.png" alt="Emacs new file 2" class="figure"/>
      <p class="figure_caption"> Figure 6: One way to create a new file in
      Emacs.</p>

      <p> Once you've done that, a prompt will appear on the bottom
      area (this is called the mini-buffer), asking for the name of
      the file you wish to create. Type in 'my_epiphany' as the file
      name, and hit enter. (See Figure 7 to see what the mini-buffer looks
      like). </p>

      <img src="imgs/emacs_minibuffer.png" alt="Emacs minibuffer" class="figure"/>
      <p class="figure_caption"> Figure 7: The mini-buffer </p>

    <li> Option 2: Use the hot-key <span class="tt">C-x C-f</span>,
    then type in 'my_epiphany' in the mini-buffer. If you're not sure
    what <span class="tt">C-x C-f</span> means, then check out the
    "Emacs Hotkeys" section. But for now:
    <span class="tt">C-x C-f</span> is a two-step process: <br/>
        <ul>
          <li> i) First, while holding down
          <span class="tt">Control</span> (Ctrl), hit the
          '<span class="tt">x</span>' key. </li>
          <li> ii) Release the '<span class="tt">x</span>' key. </li>
          <li> iii) Then, while continuing to hold down
          <span class="tt">Control</span> (Ctrl), hit the
          '<span class="tt">f</span>' key. </li>
        </ul>
    </li>
  </ul>

  <p> Now, the Emacs window should turn into a blank page - this is
  the newly created my_epiphany file. Go ahead and type the sentence:
  "This is going to be a pretty good semester." </p>

  <img src="imgs/emacs_saving.png" alt="Emacs saving" class="figure"/>
  <p class="figure_caption"> Figure 8: Our new file. </p>

  <p> Now that we've added our sentence, let's save the file (either doing <span
  class="tt">File -> Save</span> or doing the hotkey <span class="tt">C-x
  C-s</span>). You'll know it's saved when the two stars after the file-name go
  away (see Figure 8 to see what I mean). </p>

  <p> Now, exit Emacs (by doing <span class="tt">File -> Quit</span>
  , or <span class="tt">C-x C-c</span>).
  Congratulations! You've just created your first file in Emacs. We
  can confirm that it does in fact exist by
  <span class="tt">cat</span>-ing the file: </p>

  <p class="codemargin"> star [149] ~ # ls <br/>
                   lab_0 my_epiphany <br/>
                   star [150] ~ # cat my_epiphany <br/>
                   This is going to be a pretty good semester. <br/> </p>

  <h3 class="section_title"> <a name="5.2"> 5.2. Editing a file in Emacs </a> </h3>

  <p> But wait! We want to edit that file - we want to instead say: <br/>
      “This semester is going to be a fantastic semester!” </p>

  <p> So, let's edit the file to say this instead. One way we could
  do this is open up Emacs using <span class="tt">emacs &</span>, and
  use the <span class="tt">File -> Open</span> (hotkey:
  <span class="tt">C-x C-f</span>) to open up the file (typing in
  my_epiphany in the mini-buffer): </p>

  <img src="imgs/emacs_open.png" alt="Emacs open" class="figure"/>
  <p class="figure_caption"> Figure 9: Opening a file in Emacs </p>

  <p> Or, we can provide the name of the file as a parameter while
  opening up Emacs: </p>

  <p class="codemargin"> star [151] ~ # emacs my_epiphany & </p>

  <p> This does two things at once: </p>
    <ul>
      <li> i) Start Emacs </li>
      <li> ii) Open up the my_epiphany file </li>
    </ul>

  <p> Now, modify the file to instead say "This semester is going to
  be a fantastic semester!", save it, and exit Emacs.
  <span class="tt">cat</span> the file to make sure that it worked. </p>

  <p class="codemargin"> star [152] ~ # cat my_epiphany <br/>
                   This semester is going to be a fantastic semester! </p>

  <p class="note"> <u>Helpful Tip</u>: If the mini-buffer ever has a prompt
  that you don't understand (say, you accidentally hit a command),
  and you're not sure what to do, click the mini-buffer and do the
  hotkey <span class="tt">C-g</span>. This will cancel the mini-buffer
  prompt, and also cancel the command that was expecting the prompt. </p>

  <h2 class="section_title"> <a name="6"> 6. The Python Interpreter </a> </h2>

  <p> In Computer Science parlance, an interpreter is a program that
  lets you interactively 'talk' to a programming language. A Python
  Interpreter is thus a program that lets you interactively talk to
  Python. The best way to see what I mean is to try it out yourself! </p>

  <p> Just like Firefox and Emacs, we can enter the Python interpreter
  from the terminal. To do this, simply type
  <span class="tt">python</span> at the terminal: </p>

  <p class="codemargin"> star [153] ~ # python <br/>
  Python 3.2.3 (default, Apr 10 2013, 06:11:55) <br/>
  [GCC 4.6.3] on linux2 <br/>
  Type "help", "copyright", "credits" or "license" for more information. <br/>
  >>> </p>

  <p> Now, you're talking to Python! The
  "<span class="tt">>>></span>" signifies that the interpreter is
  waiting for user input. So, when you type something in and hit
  enter, Python will try to evaluate it. It's similar in spirit to
  the UNIX terminal prompt, but instead of talking to UNIX, you're
  talking to Python. Try typing in a few simple arithmetic
  expressions. </p>

  <p class="codemargin">
    >>> 1 + 2 <br/>
    3         <br/>
    >>> 7 * 8 - 9 <br/>
    47 <br/>
    >>> (1 + 2) * (3 - 4) <br/>
    -3 </p>

  <p> Notice that you're actively talking to Python - hence, why it's
  an interactive program. </p>

  <p> We'll play around in Python more a little later in lab, so
  let's get back to more Emacs fun - you can exit the Python
  interpreter by doing either of the following: </p>
    <ul>
      <li> - Typing <span class="tt">exit()</span>, and hitting enter </li>
      <li> - Or, doing <span class="tt">C-d</span> </li>
    </ul>

  <h2 class = "section_title"> <a name="7"> 7. Emacs, Python, and the Terminal </a> </h2>

  <p> The Python interpreter is definitely neat, and allows you to
  try and test out little bits of code relatively easily and quickly.
  But as our code gets more complex, typing everything into the
  interpreter again and again gets tedious. Emacs comes in handy here,
  as it allows our code some permanence. </p>

  <p> Emacs does allow us to edit a file and then immediately run it
  in a built-in interpreter, but that can get a little messy on our
  instructional machines. To save Emacs (and ourselves) some trouble,
  let's couple it with the powerful Unix terminal. You'll hopefully be
  spending a lot of time in the terminal anyways, so using a text editor
  and a terminal simultaneously becomes an obvious combination. </p>

  <p> Let's start by creating a Python source file, so navigate to the lab0
  directory, either </p>
    <ul>
      <li> i) from within the terminal, and running a new Emacs
      instance from within the lab0 folder.</li>
      <li>OR</li>
      <li> ii) from within Emacs by typing in “lab0/” before you write
      the filename </li>
    </ul>

  <p> Now, create a new file called greet.py - the .py file extension
  is important, because: <p>
      <ul>
        <li> It's convention for Python source files to end in a .py
        extension </li>
        <li> Emacs needs the .py at the end to activate the
        Python mode </li>
      </ul>

  <p> Let's write a very simple, sort-of-silly program that greets
  you by name. Don't worry if you don't understand the program
  (we'll learn what each of these pieces mean in more depth over
  the next few weeks): </p>

  <pre class="codemargin">print("Hello world!")
my_name = "Eric"

def greet():
    print("Greetings ", my_name, ", how are you today?")
    print("  - Python")</pre>

  <p> Now, your Emacs screen should look something like this: </p>

  <img src="imgs/greet.png" alt="greet.py" class="figure"/>
  <p class="figure_caption"> Figure 10: Our simple greet.py program. </p>

  <p> Let's go back to the terminal and run our little program. </p>

  <p class="codemargin"> star [154] ~/lab0 # python3 -i greet.py <br/> </p>

  <p> You'll know you did it right if "Hello World" pops up and you're thrown
  into a Python interpreter: “<span class="tt">>>></span>” </p>

  <p> When you run Python with the -i flag, Python acts as if you had typed
  every line in greet.py into the interpreter, line by line. That's why
  "<span class="tt">Hello world!</span>" appears, since the Python
  interpreter is evaluating the first line in greet.py:
  <span class="tt">print("Hello world!")</span> </p>

  <p> greet.py also defines two things: a
  <span class="tt">my_name</span> variable (bound to the value
  "<span class="tt">Eric</span>"), and a function
  <span class="tt">greet</span> that, when called, greets a person
  (signed by Python, nonetheless!). To make sure it works, do
  the following in the Python interpreter: </p>
    <ul>
      <li> 1.) Get the value of <span class="tt">my_name</span>
      by typing <span class="tt">my_name</span>, then hitting enter </li>
      <li> 2.) Call the <span class="tt">greet</span> function by
      typing <span class="tt">greet()</span>, then hitting enter </li>
    </ul>

  <p> If you did it right, your terminal should look something like this: </p>

  <p class="codemargin"> star [155] ~/lab0 # python3 -i greet.py<br/>
  Hello World!
  <p class="codemargin">
    >>> my_name <br/>
    'Eric'         <br/>
    >>> greet() <br/>
    Greetings Eric, how are you today?  <br/>
    &nbsp&nbsp -Python </p>

  <p> Great, it works! However, right now it's currently greeting me
  - we probably want it to greet you! Go edit the greet.py file, and
  change the value of the <span class="tt">my_name</span>
  variable to instead be your name. </p>

  <p> For example, if your name is Stephanie, greet.py should look
  like: </p>

  <pre class="codemargin">print("Hello World!")
my_name = "Stephanie"

def greet():
    print("Greetings ", my_name, ", how are you today?")
    print("  - Python")</pre>

  <p> Save greet.py in Emacs, then go back to the terminal, kill the
  current interpreter session with <span class="tt">Ctrl-D</span>,
  and run <span class="tt">python3 -i greet.py</span>. Then, call the
  <span class="tt">greet</span> function again at the Python prompt
  "<span class="tt">>>></span>" to make sure the name was changed.

  <p> Congrats! You've completed your first typical work-cycle: edit
  a file, run it, edit it again, run it again, etc. This will start
  feeling natural as the course progresses (and as you get further in
  your CS career!). </p>

  <br/>

  <h2 class="section_title"> <a name="A"> Appendix A: Hotkeys in Emacs </a> </h2>

  <p> If you watch a pro Emacs user work in Emacs, you'll notice that
  he/she never uses the mouse to do anything - everything he/she does
  is via hotkeys. </p>

  <p> A hotkey is just a combination/sequence of keys that, when
  performed, does some action. For instance, you're all probably
  familiar with the copy and paste hotkeys:
  <span class="tt">Ctrl-c</span>, and <span class="tt">Ctrl-v</span>
  respectively. </p>

  <p> Emacs has a wide variety of hotkeys - pretty much any action can
  be done with some sort of hotkey. For instance, the hotkey
  <span class="tt">C-x C-s</span> will save the current buffer/file. </p>

  <p> But let's see how to actually perform these hotkeys: </p>
    <ul>
      <li> <span class="tt">C-x</span> means: while holding down the
      <span class="tt">Control</span> (Ctrl) key, press the
      <span class="tt">x</span> key. </li>
      <li> <span class="tt">C-s</span> means: while holding down the
      <span class="tt">Control</span> (Ctrl) key, press the
      <span class="tt">s</span> key. </li>
    </ul>

  <p> <span class="tt">C-x C-s</span> is two actions, one after
  another: </p>
    <ul>
      <li> i.) First, do <span class="tt">C-x</span> </li>
      <li> ii.) Then, release both keys. </li>
      <li> iii.) Finally, do <span class="tt">C-s</span> </li>
    </ul>

  <p>To learn more about Emacs, go through the Emacs tutorial. You can access it
  from the splash screen or by typing <span class="tt">C-h t</span>. (First,
  do <span class="tt">C-h</span>, then just type <span class="tt">t</span>.)</p>

  <h3 class="section_title"> <a name="A.1"> A.1. The Meta key </a> </h3>

  <p> Some hotkeys involve the Meta key, such as this hotkey that
  opens up a Scheme interpreter: <span class="tt">M-s</span> </p>

  <p>
    The lab keyboards do not have a dedicated Meta key (and most laptops don't either).
    Instead, on most computers, you can use the <span class="tt">Alt</span> key.
    Hold down the <span class="tt">Alt</span> key while pressing the next key
    in the command.
  </p>

  <p> You can
  use <span class="tt">Esc</span> as a "sort of" Meta key. The
  difference is, you first press the <span class="tt">Esc</span> key,
  then you hit the next key: for instance, to do
  <span class="tt">M-s</span>, you don't hold
  <span class="tt">Esc</span> while pressing
  <span class="tt">s</span> - you can just do: <br/>
  &nbsp&nbsp&nbsp&nbsp - First press the
  <span class="tt">Esc</span> key <br/>
  &nbsp&nbsp&nbsp&nbsp - Then press the
  <span class="tt">s</span> key </p>

  <h3 class="section_title"> <a name="A.2"> A.2. Some Useful Hotkeys </a> </h3>

  <table class="txt_table">
    <col width="250px" align="justify" />
    <col align="right" />
    <tr>
      <th> Hotkey </th>
      <th> Description of what it does </th>
    </tr>
    <tr>
      <td> <span class="tt">C-x C-s</span> </td>
      <td> Save your file. </td>
    </tr>
    <tr>
      <td> <span class="tt">C-x C-f</span> </td>
      <td> Open a file. If the filename you provide in the minibuffer
      doesn't exist, then Emacs will create a new file for you. </td>
    </tr>
    <tr>
      <td> <span class="tt">C-/</span></td>
      <td> Undo. </td>
    </tr>
    <tr>
      <td> <span class="tt">C-w</span> </td>
      <td> Cut the highlighted region of text. </td>
    </tr>
    <tr>
      <td> <span class="tt">C-y</span> </td>
      <td> Paste text. </td>
    </tr>
    <tr>
      <td> <span class="tt">M-w</span> </td>
      <td> Copy the highlighted region of text. </td>
    </tr>
    <tr></tr>
    <tr>
      <td> <span class="tt">C-g</span> </td>
      <td> Cancel a command (useful if you accidentally did a command,
      and the mini-buffer is prompting you for something). </td>
    </tr>
    <tr>
      <td> <span class="tt">C-x C-c</span> </td>
      <td> Exit Emacs </td>
    </tr>
  </table>

  <h2 class="section_title"> <a name="B"> Appendix B: Unix Commands
  Summary (incomplete list) </a> </h2>

  <table class="txt_table">
    <col width="250px" align="justify" />
    <col align="right" />
    <tr>
      <th> Command </th>
      <th> Description </th>
    </tr>
    <tr>
      <td> <span class="tt">cal</span> </td>
      <td> Displays the current month </td>
    </tr>
    <tr>
      <td> <span class="tt">ls</span> </td>
      <td> Lists the current directory contents </td>
    </tr>
    <tr>
      <td> <span class="tt">mkdir</span> </td>
      <td> Creates a new directory with a specified name </td>
    </tr>
    <tr>
      <td> <span class="tt">cd</span> </td>
      <td> Moves into/out of directories </td>
    </tr>
    <tr>
      <td> <span class="tt">rm -r</span> </td>
      <td> Removes the given directory </td>
    </tr>
    <tr>
      <td> <span class="tt">echo</span> </td>
      <td> Outputs user input. </td>
    </tr>
    <tr>
      <td> <span class="tt">cat</span> </td>
      <td> Displays the contents of a specified file. </td>
    </tr>
    <tr>
      <td> <span class="tt">rm</span> </td>
      <td> Removes the specified file. </td>
    </tr>
    <tr>
      <td> <span class="tt">mv</span> </td>
      <td> Move a file to a new destination (can also be used to rename) </td>
    </tr>
    <tr>
      <td> <span class="tt">cp</span> </td>
      <td> Copy a file to a new destination </td>
    </tr>
    <tr>
      <td> <span class="tt">man<span> </td>
      <td> Brings up the manual page for a given command </td>
    </tr>
  </table>

  </body>

</html>
