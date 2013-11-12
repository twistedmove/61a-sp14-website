# A "simple" adventure game.

# README:
# http://www-inst.eecs.berkeley.edu/~cs61a/fa13/lab/lab09/lab09.txt

name = 'Player 1' # Can replace this with your name. :)

def adventure():
    while True:
        check_win_conditions()
        try: # In case of errors... catch them!
            Place.current.describe()
            line = input('adventure> ')
            exp = adv_parse(line)
            output = adv_eval(exp)
            print(output)
            print('\n') # New line for neatness
        except (KeyboardInterrupt, EOFError, SystemExit): # If you ctrl-c or ctrl-d
            print('Bye!')
            return
        # If the player input was badly formed or if something doesn't exist
        except (SyntaxError, NameError, KeyError, TypeError, IndexError) as e:
            print('ERROR:', e)


def adv_parse(line):
    """ Parses adventure.py commands

    Handles things differently when
    the first part of the string is 'give'
    or 'ask'

    >>> adv_parse('look')
    ('look', '')
    >>> adv_parse('take rubber ducky')
    ('take', 'rubber ducky')
    >>> adv_parse('give rubber ducky to Andrew')
    ('give', 'rubber ducky', 'Andrew')
    >>> adv_parse('ask Andrew for advice about the midterm')
    ('ask', 'Andrew', 'advice about the midterm')
    """
    tokens = line.split()
    if not tokens: # empty list
        raise SyntaxError('No command given')
    token = tokens.pop(0)
    if token == 'give':
        """ YOUR CODE HERE """
        return # REPLACE ME
    elif token == 'ask':
        """ YOUR CODE HERE """
        return # REPLACE ME
    else: # Only split out the operator, the rest must be the operand
        """ YOUR CODE HERE """
        return # REPLACE ME


def adv_eval(exp):
    if is_operator(exp): # Use the underlying eval to grab the
        return eval(exp) # function that implements the action.
    if is_person(exp):
        return Person.people[exp]
    elif isinstance(exp, str): # If we're describing something,
        return exp             # just output it.
    elif exp[0] == 'give':
        """ YOUR CODE HERE """
        return # REPLACE ME
    elif exp[0] == 'ask':
        """ YOUR CODE HERE """
        return # REPLACE ME
    else:
        """ YOUR CODE HERE """
        return # REPLACE ME


def adv_apply(operator, operand):
    """ YOUR CODE HERE """
    return # REPLACE ME

def is_person(exp):
    return exp in Person.people

def check_win_conditions():
    pass

# We shouldn't define the following functions in the global frame.  There are
# better ways of doing this (generic operator FTW), but for simplicity's sake,
# this is what I'm going with.

def is_operator(exp):
    return exp in ('look', 'go', 'take', 'give', 'ask',
                   'examine', 'help')

def look(_):
    return Place.current.look()

def go(direction):
    output = Place.current.exit_to(direction)
    return output

def take(thing):
    obj = Place.current.find(thing)
    if obj:
        return me.take(obj)
    return 'No such thing to take!'

def give(person, thing):
    if type(person) != Person:
        return "Who is {}?!".format(person)
    if person not in Place.current.people:
        return person.name + ' not here!'
    obj = None
    for i, e in enumerate(me.inventory):
        if thing in e.name:
            obj = me.inventory.pop(i)
    if obj:
        return person.take(obj)
    return "You don't have this in your possession!"

def ask(person, message):
    if type(person) != Person:
        return "Who is {}?!".format(person)
    return person.ask(message)

def examine(thing):
    for item in me.inventory:
        if thing in item.name:
            return item.examine()
    return "You don't have this in your possession!"

def help(_):
    return \
"""There are 7 possible operators:
  * look
  * go [direction]
  * take [thing]
  * give [thing] to [person]
  * examine [thing in inventory]
  * ask [person] for [message]
  * help"""


# OOP representation of the game models:
class Person(object):
    people = {}
    def __init__(self, name, *things):
        self.name = name
        self.inventory = list(things)
        Person.people[name] = self

    def think(self, msg):
        return self.name + 'remains silent'

    def take(self, thing):
        self.inventory.append(thing)
        return self.name + ' takes the ' + thing.name

    def ask(self, msg):
        return self.brain(self, msg)

    def go(self, direction):
        return


class Place(object):
    current = None
    def __init__(self, name, description, *people_and_things):
        self.name = name
        self.description = description
        self.people = []
        self.things = []
        self.exits = {}
        for obj in people_and_things:
            if type(obj) == Person:
                self.people.append(obj)
            elif type(obj) == Thing:
                self.things.append(obj)

    def describe(self):
        print(self.description)
        if self.exits:
            print('\nExits:')
            for k, v in self.exits.items():
                print('  ', k, '-', v[0].name)
        print()

    def look(self):
        result = 'You take a look around and see:\n'
        if not (self.people or self.things):
            result += 'Nothing!'
        result += '\n'.join([thing.name + ' - ' + thing.description for thing in self.things])
        result += '\n'.join([person.name for person in self.people])
        return result

    def exit_to(self, exit):
        if exit in self.exits:
            new_place, exit_msg = self.exits[exit]
            Place.current = new_place
            return exit_msg
        return "Where do you think you're going?!"

    def find(self, thing):
        for i, e in enumerate(self.things):
            if thing in e.name:
                return self.things.pop(i)
            

class Thing(object):
    def __init__(self, name, description):
        self.name = name
        self.description = description

    def examine(self):
        return self.description
  

# This is what @main does (sorta)
if __name__ == '__main__':
    try:
        import readline # Why?

        from cs61a_world import *

        me = Person(name)
        print(motd)
        adventure()
    except ImportError as e:
        print("ERROR: Something terrible happened to " + world + ".py")
        print("\t Invalid or broken world.")
        print(e)
    except IndexError as e:
        print("ERROR: Could not load world. Did you forget to provide it?")
        print("\tExample: python3 adventure.py cs61as_world")
        print(e)
