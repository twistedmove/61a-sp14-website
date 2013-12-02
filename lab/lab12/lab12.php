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

    <title>CS 61A Fall 2013: Lab 12</title> 

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
    $RELEASE_DATE = new DateTime("12/5/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  <body style="font-family: Georgia,serif;">
    <h1>CS 61A Lab 12</h1>
<h2>MapReduce</h2>
<h2>Starter Files</h2>

<p>This lab makes extensive use of starter files that we provide
<a href="lab12.zip">here</a>, so make sure to download them! After downloading the
zip archive, don't forget to extract the files.</p>

<h3>Introduction: MapReduce</h3>

<p>In this lab, we'll be working with MapReduce, a programming paradigm
developed by Google, which allows a programmer to process large amounts
of data in parallel on many computers.</p>

<p>A computation in MapReduce consists two components: the <strong>mapper</strong> and
the <strong>reducer</strong>.</p>

<ul>
<li><p>The <strong>mapper</strong> takes an input file, and prints out a series of
key-value pairs:</p>

<p>age 29
  name cecilia
  job gradstudent
  salary 42</p>

<p>In the example above, the key-value pairs are:</p>

<ul>
<li>age: 29</li>
<li>name: cecilia</li>
<li>job: gradstudent</li>
<li>salary: 42</li>
</ul></li>
<li><p>The <strong>reducer</strong> takes the (sorted) output from the mapper, and
outputs a single value for each key. The mapper's output will be
sorted according to the key.</p></li>
</ul>

<p>The following diagram summarizes the entire MapReduce pipeline:</p>

<p><img src="mapreduce_diag.png" alt="Mapreduce Diagram" /></p>

<p>This lab is split up into two parts:
1. <strong>Serial MapReduce</strong>: to introduce our MapReduce framework,
   we will first use a <em>non-parallelized</em> version. Even with this
   limitation, we can still do quite a lot of data processing!
2. <strong>Parallelized MapReduce</strong>: the real power of MapReduce comes from
   parallelization. The same MapReduce jobs from Part 1 can be executed
   much faster by using multiple computers (i.e. a <em>cluster</em>) at the
   same time. For this lab, we will be using <em>Hadoop</em>, an open source
   implementation of the MapReduce paradignm.</p>

<h2>Part 1: Serial MapReduce</h2>

<p>In this section, we introduce the framework for mappers and
reducers. We will be running MapReduce jobs locally, so no
parallelization occurs during this section. However, observe that we
can still do an impressive amount of data processing just by defining
two simple modules: the mapper and the reducer!</p>

<h3>Example: Line-Counting</h3>

<p>Our first exercise will be counting the number of lines in one of
Shakespeare's plays.</p>

<p>To formulate this as a MapReduce problem, we need to define an
appropriate <code>mapper</code> and <code>reducer</code> function.</p>

<p>Recall what the <strong>mapper</strong> does: for each line in a text file, the
mapper outputs a key-value pair. What should our key-value pairs be for
our line counting example?</p>

<ul>
<li><strong>key</strong>: In our example, we don't care about the contents of each
line -- there's no need to classify each line. Thus, our key can just
be the string 'line'.</li>
<li><strong>value</strong>: We want to count each line exactly once. Thus, our value
can just be the number 1.</li>
</ul>

<p>For example, the mapper will take in an input file like
<a href="http://en.wikipedia.org/wiki/The_Red_Wheelbarrow">this</a>:</p>

<pre><code>so much depends
upon
a red wheel
barrow
glazed with rain
water
beside the white
chickens.
</code></pre>

<p>(notice there are 8 lines); it then outputs a sequence of key-value
pairs like this:</p>

<pre><code>'line'  1
'line'  1
'line'  1
'line'  1
'line'  1
'line'  1
'line'  1
'line'  1
</code></pre>

<p>The <strong>reducer</strong> takes this sequence and simply adds up all the values
that are associated with the key 'line':</p>

<pre><code>'line'  8
</code></pre>

<p>This is illustrated by the following diagram:</p>

<p><img src="mapreduce_linecount.png" alt="Linecount example" /></p>

<p>Let's examine the code mapper and reducer.</p>

<h4>The Mapper: <code>line_count.py</code></h4>

<p>In your current directory should be a file <code>line_count.py</code> with the
following body:</p>

<pre><code>#!/usr/bin/env python3

import sys
from ucb import main
from mr import emit

@main
def run():
    for line in sys.stdin:
        emit('line', 1)
</code></pre>

<p><code>line_count.py</code> is the mapper, which takes input from <code>stdin</code> (i.e.
'<em>standard in</em>') and outputs one key-value pair for each line to
<code>stdout</code> (i.e. '<em>standard out</em>', which is typically the terminal
output).</p>

<p>Let's run <code>line_count.py</code> by feeding it <code>the_tempest.txt</code>
(provided with the starter files). The question is, how do we give
<code>the_tempest.txt</code> to <code>line_count.py</code> via <code>stdin</code>?  We'll use the Unix
pipe '<code>|</code>' feature (<em>Note</em>: the 'pipe' key '<code>|</code>' isn't lowercase 'L',
it's (typically) Shift+Backslash):</p>

<p><strong>Note</strong>: You will probably have to tell Unix to treat <code>line_count.py</code>
as an executable by issuing the following command:</p>

<pre><code>chmod +x line_count.py
</code></pre>

<p>Once you've made <code>line_count.py</code> executable, type in the following
command:</p>

<pre><code>cat the_tempest.txt | ./line_count.py
</code></pre>

<p>Recall that the <code>cat</code> program will display the contents of a given file
to <code>stdout</code>.</p>

<p>If you've completed <code>line_count.py</code> correctly, your terminal output
should be full of key-value pairs, looking something like:</p>

<pre><code>'line' 1
'line' 1
'line' 1
...
'line' 1
</code></pre>

<p>Unix pipe-ing takes the output of one program (in this
case, the <code>cat</code> program), and 'pipes' it as the input to another
program (typically via <code>stdin</code>). This technique of piping programs
together is called "mudlar programming" and is ubiquitous in Unix-style
programming.  Modular programming allows us to write small, simple
programs and chain them together to accomplish complicated tasks.</p>

<h4>The Reducer: sum.py</h4>

<p>In your current directory should be the file <code>sum.py</code>. The body of this
file should be:</p>

<pre><code>#!/usr/bin/env python3

import sys
from ucb import main
from mr import values_by_key, emit

@main
def run():
    for key, value_iterator in values_by_key(sys.stdin):
        emit(key, sum(value_iterator))
</code></pre>

<p>Let's break down the process:
1. <code>values_by_key</code> is a function that reads input from <code>stdin</code>, and
   groups all key-value pairs that have the same key. For example,</p>

<pre><code>  'line'  1
  'line'  1
  'line'  1
</code></pre>

<p>will turn into the following pair:</p>

<pre><code>  ('line', [1, 1, 1])
</code></pre>

<p><em>Note</em>: the second element should actually be an iterator, not a
   Python list; it is represented with square brackets for visual
   clarity.
2. The variables <code>key</code> and <code>value_iterator</code> get bound to their
   respective values in the example above:</p>

<pre><code>  key: 'line'
  value_iterator: [1, 1, 1]
</code></pre>

<p>3. For each of these key-iterator pairs, <code>sum.py</code> will add up all the
   values in the iterator and output this new value with the same key:</p>

<pre><code>  'line'  3
</code></pre>

<p>The <code>emit</code> function prints out a key and a value in the format
   shown above. <code>emit</code> also handles logistics for parallelization,
   which becomes important in Part 2 of the lab.</p>

<p>You can think of the reducer as taking all the values of a key and
collapsing it into a single value.</p>

<h4>Putting it all together</h4>

<p>Now that we have the <strong>mapper</strong> and the <strong>reducer</strong> defined, let's put
it all together in the (simplified) MapReduce framework:</p>

<p><img src="map_sort_reduce.png" alt="map sort reduce" /></p>

<p><strong>Note</strong>: You will probably have to tell Unix to treat <code>sum.py</code> as an
executable by issuing the following command:</p>

<pre><code>chmod +x sum.py
</code></pre>

<p>Once you've done this, issue the following Unix command:</p>

<pre><code>cat the_tempest.txt | ./line_count.py | sort | ./sum.py
</code></pre>

<p>Notice that we're using the Unix program <code>sort</code>, which is a built-in
Unix program. As you'd expect, <code>sort</code> will, given a file, sort the
lines of the file - by default, it will sort it alphabetically.</p>

<p>Take a moment and make sure you understand how the above Unix command
is exactly the MapReduce framework (Map -> Sort -> Reduce).  What's
neat is that, in a very simple manner, we executed the MapReduce idea
of using mappers and reducers to solve a problem.  However, the main
benefit of using the MapReduce idea is to take advantage of distributed
computing - don't worry, we'll do that soon!</p>

<h3>Exercises</h3>

<p><strong>Question 1</strong>: Use the MapReduce framework (i.e. Map -> Sort ->
Reduce) to count the number of times the following common words
occur:</p>

<ul>
<li>the</li>
<li>he</li>
<li>she</li>
<li>it</li>
<li>thee</li>
</ul>

<p>A question to ponder is: will you need to create a new mapper, a new
reducer, or both?</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton0">Toggle Solution</button>
  <div id="toggleText0" style="display: none">
    <p>You should only need to create a new mapper -- this mapper will look
through each word of each line, and create a new key-value pair if the
word matches one of the words we're looking for. The key will be the
word itself, and the value will be 1.  Then, all that the reducer has
to do is add up all values - this is done via <code>sum.py</code>. Here's the Unix
command:</p>

<pre><code># cat the_tempest.txt | ./q1_mapper.py | sort | ./sum.py
'he'    81
'it'    133
'she'   30
'the'   484
'thee'  100
</code></pre>

<p><code>Q1_mapper</code></p>

<pre><code>#!/usr/bin/env python3

import sys
from ucb import main
from mr import emit

@main
def run():
    interesting_words = ('the', 'he', 'she', 'thee', 'it')
    for line in sys.stdin:
        for word in line.split():
            wd_clean = word.strip().lower()
            if wd_clean in interesting_words:
                emit(wd_clean, 1)
</code></pre>

  </div>
<?php } ?>
<h2>Part 2: Parallelized MapReduce</h2>

<p>Now that we are familiar with the MapReduce framework, it's time to
parallelize the process! Parallelization across multiple computers
allows programmers to process vast amounts of data (think Google or
Facebook) in a reasonable amount of time.</p>

<p>In this part of the lab, we will be using the <strong>Hadoop</strong> implementation
of MapReduce. The provided file <code>mr.py</code> will take care of the details
of communicating with Hadoop through Python. All you have to worry
about is writing the <strong>mapper</strong> and <strong>reducer</strong>, just like before!</p>

<h3>Getting started</h3>

<p>In order to use Hadoop, you need to connect to a special Berkeley
server called <code>icluster1</code>. This server is able to make connections to
a cluster of computers for distributed computing. You can connect just
like you normally would to a Berkeley server:</p>

<pre><code>ssh -X icluster1.eecs.berkeley.edu
</code></pre>

<p>You will be asked if you want to remember the RSA signature -- type
yes. You will then be asked to login to your class account.</p>

<p><em>Note</em>: you will not be able to do this part of the lab locally on your
own computer. The only way for Hadoop to work with our cluster is if
you connect to the icluster1 server.</p>

<p>Finally, some Unix environment variables need to be set. Go to the
directory containing the lab starter files. One of them should be a
file called <code>envvars</code>. Simply run the following command:</p>

<pre><code>source envvars
</code></pre>

<p>Now you're ready to start using Hadoop!</p>

<h3>Terminology and Commands</h3>

<p>For various reasons, the Hadoop framework uses its own filesystem
separate from the filesystems on your class account. To interact with
the Hadoop filesystem, we'll be using <code>mr.py</code>:</p>

<ul>
<li><p><code>cat</code></p>

<p>python3 mr.py cat OUTPUT_DIR</p>

<p>This command prints out the contents of all files in one of the
directories on the Hadoop FileSystem owned by you (given by
<code>OUTPUT_DIR</code>).</p></li>
<li><p><code>ls</code></p>

<p>python3 mr.py ls</p>

<p>This command lists the contents of all output directories on the
Hadoop FileSystem. </p></li>
<li><p><code>rm</code></p>

<p>python3 mr.py rm OUTPUT_DIR</p>

<p>This command will remove an output directory (and all files within
it) on the Hadoop FileSystem.  Use this with caution - remember,
there's no 'undo'!</p></li>
<li><p><code>run</code></p>

<p>python3 mr.py run MAPPER REDUCER INPUT<em>DIR OUTPUT</em>DIR</p>

<p>This command will run a MapReduce job of your choosing, where:</p>

<ul>
<li><code>MAPPER</code>: a Python file that contains the mapper function, e.g.
<code>line_count.py</code></li>
<li><code>REDUCER</code>: a Python file that contains the reducer function, e.g.
<code>sum.py</code></li>
<li><code>INPUT_DIR</code>: the input file, e.g. <code>../shakespeare.txt</code></li>
<li><code>OUTPUT_DIR</code>: the name of the directory where you would like the
results of the MapReduce job to be dumped into; e.g. <code>myjob1</code></li>
</ul></li>
</ul>

<h3>Example: Line-counting with Hadoop</h3>

<p>We are going to perform the same line counting example as we did in
Part 1, but with Hadoop. Make sure that your <code>line_count.py</code>, <code>sum.py</code>,
and <code>mr.py</code> are in the current directory, then issue the command:</p>

<pre><code>python3 mr.py run line_count.py sum.py ../shakespeare.txt mylinecount
</code></pre>

<p>Your terminal should then be flooded with the busy output of Hadoop
doing its thing. In particular, the output should contain lines that
look like this:</p>

<pre><code>map 0%  reduce 0%
map 100%  reduce 0%
map 100%  reduce 17%
map 100%  reduce 67%
map 100%  reduce 100%
Job complete: job_201311261343_0001
Output: output/mylinecount
</code></pre>

<p>This tells you the progress of your MapReduce job, specifically how
many mappers and reducers have completed.</p>

<p>Once it's finished, you'll want to examine the Hadoop results!  To do
this, first issue the following command to see the contents of your
Hadoop directory:</p>

<pre><code>python3 mr.py ls
</code></pre>

<p>You should see a directory listing for your <code>mylinecount</code> job. To view
the results of this job, we'll use <code>mr.py</code>'s <code>cat</code> command:</p>

<pre><code>python3 mr.py cat mylinecount/part-00000
</code></pre>

<p>As an interesting reference point, one TA ran this MapReduce job on a
lightly-loaded <code>icluster1</code>, but totally in serial, meaning that each
map job had to be done sequentially. The total <code>line_count</code> job took on
the order of 5-8 minutes. How much faster was it to run it with Hadoop
using distributed computing, where the work can be done in parallel?</p>

<h3>Exercises</h3>

<p><strong>Question 2</strong>: Take your solution from <strong>Question 1</strong> and run it
through the distributed MapReduce (i.e. by using <code>mr.py</code>) to discover
the number of occurrences of the following words in the entirety of
Shakespeare's works:</p>

<ul>
<li>the</li>
<li>he</li>
<li>she</li>
<li>it</li>
<li>thee</li>
</ul>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton1">Toggle Solution</button>
  <div id="toggleText1" style="display: none">
    <p>The Unix command is:</p>

<pre><code>python3 mr.py run q1_mapper.py sum.py ../shakespeare.txt q2
</code></pre>

<p>You can then view the output</p>

<pre><code>python3 mr.py cat q2
</code></pre>

<p>This should output something like</p>

<pre><code>'he'    6267
'it'    7737
'she'   2222
'the'   26805
'thee'  3103
</code></pre>

  </div>
<?php } ?>
<p><strong>Question 3</strong>: One common MapReduce application is a distributed word
count. Given a large body of text, such as the works of Shakespeare, we
want to find out which words are the most common.</p>

<p>Write a MapReduce program that returns each word in a body of text
paired with the number of times it is used. For example, calling your
solution with <code>../shakespeare.txt</code> should output something like: </p>

<pre><code>the 300
was 249
thee 132
...
</code></pre>

<p><em>Note</em>: These aren't the actual numbers.</p>

<p>You probably will need to write a mapper function. Will you have to
write a new reducer function, or can you re-use a previously-used
reducer? </p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton2">Toggle Solution</button>
  <div id="toggleText2" style="display: none">
    <h4>The Mapper:</h4>

<pre><code>#!/usr/bin/env python3

import sys
import string
from ucb import main
from mr import emit

def is_word(wd):
    if wd:
        for letter in string.ascii_lowercase:
            if letter in wd:
                return True
    return False

@main
def run():
    for line in sys.stdin:
        for word in line.split():
            wd_clean = word.strip().lower()
            if is_word(wd_clean):
                emit(wd_clean, 1)
</code></pre>

<h4>The Reducer:</h4>

<p>You can re-use <code>sum.py</code>.</p>

  </div>
<?php } ?>
<h3>Working with the Trends Project</h3>

<p><strong>Question 4a</strong>: We've included a portion of the trends project in the
file that you copied at the beginning of the lab in the files
"trends.py" and "data.py".  We're going to calculate the total
sentiment of each of Shakespeare's plays much the same way that we
calculated the total sentiment of a tweet in the trends project.</p>

<p>In order to do this, we need to create a new mapper. The skeleton for
this new mapper is in the file <code>sentiment_mapper.py</code>. Fill in the
function definition so that it emits the average sentiment of each line
fed to it.</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton3">Toggle Solution</button>
  <div id="toggleText3" style="display: none">
    <pre><code>#!/usr/bin/env python3

import sys
from ucb import main
from mr import emit

from trends import extract_words, get_word_sentiment, has_sentiment, sentiment_value
from mr import get_file

@main
def run():
    for line in sys.stdin:
        total = 0
        count = 0
        for word in extract_words(line):
            s = get_word_sentiment(word)
            if has_sentiment(s):
                total += sentiment_value(s)
                count += 1
        if count &gt; 0:
            emit(get_file(), total/count)
        else:
            emit(get_file(), 0)
</code></pre>

  </div>
<?php } ?>
<p>Note that we need to provide our code with the big sentiments.csv file.
We've already stored this for you on the distributed file system that
Hadoop uses. To make sure the file is available to our code, we use the
<code>run_with_cache</code> command instead of the "run" command which allows us
to provide one additional parameter: the path (on the virtual file
system) to the cache file which contains the sentiments. Don't worry
too much about this part -- it's just the specifics of our
implementation.</p>

<p>Long story short, we will use the following command to run this map
reduce task:</p>

<pre><code>python3 mr.py run_with_cache sentiment_mapper.py sum.py ../shakespeare.txt MY_OUTFILE ../sentiments.csv#sentiments.csv
</code></pre>

<h3>More Fun Exercises!</h3>

<p><strong>Question 4b</strong>: Now, we will determine the most commonly used word.
Write a Python script file <code>most_common_word.py</code> that, given the output
of the program you wrote in part 3 (via <code>stdin</code>), returns the most
commonly used word. The usage should look like (assuming you named the
Hadoop job output <code>q3</code>):</p>

<pre><code># python3 mr.py cat q3 | python3 most_common_word.py
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton4">Toggle Solution</button>
  <div id="toggleText4" style="display: none">
    <h4><code>most_common_word.py</code></h4>

<pre><code>#!/usr/bin/env python3

import sys
from ucb import main

"""
Usage:

# python3 mr.py cat q3 | python3 q3b.py
"""

def argmax(counter):
    return sorted(counter.items(), key=lambda pair: pair[1])[-1]

@main
def run():
    wd_counts = {}
    for line in sys.stdin:
        word, count = line.split()
        count = int(count)
        wd_counts[word] = count
    print("Most commonly used word:", argmax(wd_counts))
    return
</code></pre>

  </div>
<?php } ?>
<p><strong>Question 4c</strong>: Now, write a Python script file that, given the
MapReduce output from <strong>Q3</strong> (via <code>stdin</code>), outputs all words used
only once, in alphabetical order. Finally, output the results into a
text file <code>singles.txt</code>. The Unix command should look like this:</p>

<pre><code># python3 mr.py cat q3 | python3 get_singles.py | sort &gt; singles.txt
</code></pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton5">Toggle Solution</button>
  <div id="toggleText5" style="display: none">
    <h4><code>get_singles.py</code></h4>

<pre><code>#!/usr/bin/env python3

import sys
from ucb import main

"""
Usage:
# python3 mr.py cat q3 | python3 get_singles.py | sort &gt; singles.txt

"""

@main
def run():
    for line in sys.stdin:
        word, num = line.split()
        num = int(num)
        if int(num) == 1:
            print(word)
</code></pre>

  </div>
<?php } ?>
<p><strong>Question 5</strong>: In this question, you will write a MapReduce program
that, given a phrase, outputs which play the phrase came from.</p>

<p>Then, use your solution to figure out which play each of the following
famous Shakespeare phrases came from:</p>

<ul>
<li>pomp and circumstance</li>
<li>foregone conclusion</li>
<li>full circle</li>
<li>strange bedfellows</li>
<li>neither rime nor reason</li>
<li>spotless reputation</li>
<li>one fell swoop</li>
<li>seen better days</li>
<li>it smells to heaven</li>
<li>a sorry sight</li>
</ul>

<p><em>Hint</em>: In your mapper, you'll want to use the <code>get_file()</code> helper
function, which is defined in the <code>mr.py</code> file.  <code>get_file()</code> returns
the name of the file that the mapper is currently processing - for
<code>../shakespeare</code>, the filenames will be play names. To import
<code>get_file</code>, include the following line at the top of your Python
script:</p>

<pre><code>from mr import get_file
</code></pre>

<p>Also, you might want to look at the included <code>set.py</code> reducer which
reduces the values of each key into a <code>set</code> (i.e. removing duplicates).</p>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
  <button id="toggleButton6">Toggle Solution</button>
  <div id="toggleText6" style="display: none">
    <h4>The Mapper</h4>

<pre><code>#!/usr/bin/env python3

import sys
import string
from ucb import main
from mr import emit, get_file

phrases = ('pomp and circumstance', 'foregone conclusion', 'full circle',
           'the makings of', 'method in the madness', 'neither rhyme nor reason',
           'one fell swoop', 'seen better days', 'it smells to heaven',
           'a sorry sight', 'spotless reputation', 'strange bedfellows')

def strip_punctuation(s):
    exclude = set(string.punctuation)
    return ''.join(char for char in s if char not in exclude)

def remove_erroneous_spaces(s):
    return " ".join(s.split())

@main
def run():
    for line in sys.stdin:
        line_lower = remove_erroneous_spaces(strip_punctuation(line)).lower()
        for phrase in phrases:
            if phrase in line_lower:
                emit(phrase, get_file())
</code></pre>

<h4>The Reducer</h4>

<p>Use <code>set.py</code>.</p>

  </div>
<?php } ?>
<p></p>

  </body>
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script>
    <?php for ($i = 0; $i < 7; $i++) { ?>
      $("#toggleButton<?php echo $i; ?>").click(function () {
        $("#toggleText<?php echo $i; ?>").toggle();
    });
    <?php } ?>
  </script>
</html>
