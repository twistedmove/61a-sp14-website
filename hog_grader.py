"""Automatic grading script for the Hog project.

Expects the following files in the current directory.

hog.py  --  student submission
dice.py  --  our staff dice.py
ucb.py  --  our staff ucb.py
grading.py  --  generic grading utilities
"""

__version__ = '1'

from grading import worth, grade_all_and_exit, check_func, check_doctest, test_eval, Grades, questions

try:
    import hog      # Student submission
except (SyntaxError, IndentationError) as e:
    import traceback
    print('Unfortunately, the autograder cannot run because ' +
          'your program contains a syntax error:')
    traceback.print_exc(limit=1)
    exit(1)

from dice import make_test_dice, four_sided, six_sided
from ucb import main
import argparse


import urllib.request, urllib.error
import re
# TODO change the url
url = 'http://inst.eecs.berkeley.edu/~cs61a/fa13/hog_grader.py'
try:
    latest = urllib.request.urlopen(url)
    latest_grader = latest.read().decode('utf-8')
    remote_version = re.search("__version__\s*=\s*'(.*)'", latest_grader)
    if remote_version and remote_version.group(1) != __version__:
        print('You are running hog_grader.py version', __version__)
        print('Version', remote_version.group(1), 'is available with new tests.')
        print('You can download the new autograder here:')
        print('\t' + url)
except (urllib.error.URLError, IOError):
    pass
finally:
    local.close()

# url = 'http://inst.eecs.berkeley.edu/~cs61a-te/hog_grader.py'
# try:
#     local = open('hog_grader.py', 'r')
#     local_grader = local.read()
#     latest = urllib.request.urlopen(url)
#     latest_grader = latest.read().decode('utf-8')
#     if latest_grader != local_grader:
#         print('Your local hog_grader.py differs from our official release.')
#         print('Check', url, 'for updates to the autograder\n')
# except (urllib.error.URLError, IOError):
#     pass
# finally:
#     local.close()


@worth
def problem_1(grades):
    """Test roll_dice."""
    counted_dice = make_test_dice(4, 1, 2)
    test_suite1 = [((2, make_test_dice(4, 6, 1)), 10),
                    ((3, make_test_dice(4, 6, 1)),  1),
                    ((3, make_test_dice(1, 2, 3)),  1),
                    ((3, counted_dice), 1),
                    ((1, counted_dice), 4)]
    test_suite2 = [((5, make_test_dice(4, 2, 3, 3, 4, 1)),  16),
                    ((2, make_test_dice(1)), 1)]

    if check_func(hog.roll_dice, test_suite1, file=grades.saneout):
        grades.fail('Failed test(s) in roll_dice.')
        return
    if check_func(hog.roll_dice, test_suite2, file=grades.saneout):
        grades.add_message('Failed test(s).')
        return


@worth
def problem_2(grades):
    """Test take_turn."""
    test_suite1 = [((2, 0, make_test_dice(4, 6, 1)), 10),
                    ((3, 20, make_test_dice(4, 6, 1)), 1),
                    ((2, 0, make_test_dice(6)), 12),
                    ((2, 0, make_test_dice(3, 2)), 10), # Holiday ham
                    ((0, 34), 8),   # Free bacon
                    ((0, 71), 9),
                    ((0,  7), 8)]
    test_suite2 = [((0, 99), 19),
                    ((0,  0), 1),
                    ((0,  50), 6)]

    if check_func(hog.take_turn, test_suite1, file=grades.saneout):
        grades.fail('Failed test(s) in take_turn_test.')
        return
    if check_func(hog.take_turn, test_suite2, file=grades.saneout):
        grades.add_message('Failed test(s).')
        return


@worth
def problem_3(grades):
    """Test draw_number."""
    if check_doctest('draw_number', hog, file=grades.saneout):
        grades.fail()
        return
    test_suite2 = [
        (1, ' -------\n|       |\n|   *   |\n|       |\n -------'),
        (2, ' -------\n|     * |\n|       |\n| *     |\n -------'),
        (3, ' -------\n|     * |\n|   *   |\n| *     |\n -------'),
        (4, ' -------\n| *   * |\n|       |\n| *   * |\n -------'),
        (5, ' -------\n| *   * |\n|   *   |\n| *   * |\n -------'),
        (6, ' -------\n| *   * |\n| *   * |\n| *   * |\n -------')
    ]
    if check_func(hog.draw_number, test_suite2, file=grades.saneout):
        grades.add_message('Failed additional test(s) of draw_number.')
        return


@worth
def problem_4(grades):
    """Test num_allowed_dice and select_dice."""
    if check_doctest('select_dice', hog, file=grades.saneout):
        grades.fail()
    if check_doctest('num_allowed_dice', hog, file=grades.saneout):
        grades.fail()


def make_secret_strategy(n):
    def secret_strategy(score, opp):
        return int(score * 7 + opp * 17 + n) % 11
    return secret_strategy


@worth
def problem_5(grades):
    """Test play."""
    always = hog.always_roll
    hog.four_sided = make_test_dice(1)
    hog.six_sided = make_test_dice(3)

    test_suite1 = [((always(5), always(5)), (92, 106)), # basic test
                    ((always(2), always(2)), (17, 102)), # hog-wild
                    ((always(2), always(10)), (19, 120)), # hog-tied
                    ((always(0), always(0)), (108, 89)), # always roll 0
                    ((always(0), always(2)), (111, 67))] # roll 0 hog tied
    errors = check_func(hog.play, test_suite1, file=grades.saneout)
    if errors:
        grades.fail('Failed test(s) for play.')
        return

    print('Not all tests have been released for Q5.',
       'Submit your project to the actual autograder to get results!',
       sep='\n', end='\n', file=grades.saneout)

    # Revert dice
    hog.four_sided = four_sided
    hog.six_sided = six_sided


@worth
def problem_6(grades):
    """Test make_average."""
    if check_doctest('make_average', hog, file=grades.saneout):
        grades.fail()
        return
    s = range(1, 100)
    d = make_test_dice(*s)
    a = test_eval(hog.make_average, (d, 5*len(s)))
    if check_func(a, [(tuple(), sum(range(1, 100))/len(s))]*2,
            file=grades.saneout):
        grades.add_message('Averaged function not correct twice.')
        return


@worth
def problem_7(grades):
    """Test make_comeback_strategy."""
    strat1 = test_eval(hog.make_comeback_strategy, (8, 5))
    strat2 = test_eval(hog.make_comeback_strategy, (3, 2))
    test_suite1 = [((20, 30), 6),
                    ((30, 20), 5),
                    ((30, 20), 5),
                    ((20, 28), 6)]
    test_suite2 = [((20, 25), 3),
                    ((20, 15), 2),
                    ((20, 23), 3),
                    ((23, 20), 2)]

    if check_func(strat1, test_suite1, file=grades.saneout):
        grades.fail('Failed test(s) for make_comeback_strategy.')
        return
    if check_func(strat2, test_suite2, file=grades.saneout):
        grades.add_message('Failed test(s).')
        return


@worth
def problem_8(grades):
    """Test make_mean_strategy."""
    strat1 = test_eval(hog.make_mean_strategy, (2, 5))
    strat2 = test_eval(hog.make_mean_strategy, (4, 5))
    test_suite1 = [((20, 30), 5),
                    ((22, 30), 0),
                    ((23, 30), 0),
                    ((20, 7), 5),
                    ((3, 20), 0)]
    test_suite2 = [((22, 30), 0),
                    ((23, 30), 0),
                    ((2, 50), 0)]

    if check_func(strat1, test_suite1, file=grades.saneout):
        grades.fail('Failed test(s) for make_mean_strategy.')
        return
    if check_func(strat2, test_suite2, file=grades.saneout):
        grades.add_message('Failed test(s).')
        return


@worth
def problem_9(grades):
    """Test final_strategy."""
    print('Tests for Q9 are not included here.',
        'Submit your project to the actual autograder to get resuls!',
        sep='\n', end='\n', file=grades.saneout)


@main
def run(*args):
    parser = argparse.ArgumentParser(description='A subset of the autograder tests for Hog. Requires hog.py, dice.py, ucb.py, and grading.py to be in the same directory')
    parser.add_argument('-q', '--question', help='Run tests for the specified questions', type=int)
    parser.add_argument('-a', '--all', help='Run all tests, even if errors occur', action='store_true')
    args = parser.parse_args()

    if args.question and 0 < args.question <= 9:
        grades = Grades([questions[args.question-1]], False)
    else:
        grade_all_and_exit('Project 1: Hog')
