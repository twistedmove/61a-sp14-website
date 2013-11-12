# CS 61A World Game Data:
from adventure import Person, Thing, Place 

motd = """
Welcome to the micro-world of CS 61A! You have a
midterm tomorrow, and in hopes of doing well, you
quest to seek the TA, Werdna, a mythical creature who
is rumored to hold the key to besting the test."""


RubberDucky = Thing('rubber ducky', "Hm. It's yellow and it's rubber and it squeaks. Fascinating.")

HearstAve = Place('Hearst Ave.',
                     'You find yourself on the sidewalk of Hearst Ave.')

EuclidAve = Place('Euclid Ave.',
                     "You find yourself on the corner of Euclid Ave. It's not "
                       + "as noisy here!")

def werdnas_brain(self, msg):
    """ A dispatch function for Werdna.

        Werdna becomes aware of self
        if you set his brain attribute accordingly
        (which is why you can use self outside of
         a class; probably not the best thing to do)
        ;)
    """
    if self.inventory.count(RubberDucky) != 2:
        return 'I miss my rubber duckies. :('
    elif self.inventory.count(RubberDucky) == 2:
        print('Werdna tells you all the secrets to 61A...')
        LiKaShing.exits['to victory'] = (Victory, 'Victory')
        LiKaShing.description = 'You arrive at the auditorium where ' +\
            'lecture is held. The room is filled with students about to ' +\
            'start the midterm!'
        return 'The path is clear for you now. You are Enlightened Go off and ace your midterm!'

Werdna = Person('Werdna')
Werdna.think = werdnas_brain

WerdnasHouse = Place("Werdna's House.",
                        'You find yourself on the steps to a small apartment.',
                        Werdna)

Campus = Place('UC Berkeley Campus',
                  'You stumble onto the main campus. There are students going'
                    + ' to and from class. You better get going too!',
                  RubberDucky)
# Sssshhh, Easter egg...
real_input = input
def input(prompt):
    result = real_input(prompt)
    if result == 'xyzzy':
        print("Secret win! You've won the game!")
        print("Now if only life had a cheatcode...")
        exit()
    return result

def check_win_conditions():
    global place
    if place == Victory and Exam not in inventory:
        print("Hold up, you haven't taken the exam!")
        print('Returning you to the exam room...')
        place = LiKaShing
        if place == Victory and Exam in inventory:
            print("You've bested the midterm and won the game! w00t ;D")
            exit()

Exam = Thing('CS 61A Midterm II', 'A 10 page bundle of paper with recursion in Scheme, OOP, environment diagrams, etc...')
LiKaShing = Place('Li Ka Shing',
                     'You arrive at the auditorium where lecture is held. The '
                       + 'room is empty.', RubberDucky, Exam)

soda_description = \
"""You arrive in 271 Soda. The room is bright
and miserable as always. A few 61A students are
scattered among the lab computers, working
on the latest project."""

SodaHall = Place('271 Soda', soda_description, RubberDucky)
place = SodaHall

Place.current = SodaHall

SodaHall.exits['out'] = (HearstAve, 'You leave 2nd floor Soda through the exit all the cool kids use.')
HearstAve.exits['north'] = (SodaHall, 'You re-enter Soda Hall. Uggggggg')
HearstAve.exits['west'] = (EuclidAve, 'You go down the hill toward North Gate.')
HearstAve.exits['south'] = (Campus, 'You hop across the street')

EuclidAve.exits['north'] = (WerdnasHouse, 'You head up Euclid...')
EuclidAve.exits['east'] = (HearstAve, 'You go up the hill along Hearst')
EuclidAve.exits['south'] = (Campus, 'You hop across the street')

Campus.exits['north'] = (EuclidAve, 'You walk up to North Gate and end up back at the edge of campus.')
Campus.exits['west'] = (LiKaShing, 'You go down the leafy path toward West side')

LiKaShing.exits['out'] = (LiKaShing, "You can check out any time you'd like, but you can NEVER leave")

Victory = Place('Victory', 'YAAAAAAAYYYY!')

WerdnasHouse.exits['south'] = (EuclidAve, 'You head back down Euclid.')

