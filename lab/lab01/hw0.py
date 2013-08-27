# Name:
# Login:
# TA:
# Section:


def my_first_name():
    """Returns a string that contains your first name.
    >>> my_first_name() != 'PUT YOUR FIRST NAME HERE'
    True
    >>> type(my_first_name()) == str
    True
    """
    return 'PUT YOUR FIRST NAME HERE'

def my_last_name():
    """Returns a string that contains your last name.
    >>> my_last_name() != 'PUT YOUR LAST NAME HERE'
    True
    >>> type(my_last_name()) == str
    True
    """
    return 'PUT YOUR LAST NAME HERE'

def my_sid():
    """Returns a number that is your student ID. Put 0 if you are a concurrent enrollment student.
    >>> my_sid() != 99999999
    True
    >>> type(my_sid()) == int
    True
    """
    return 99999999

def my_email():
    """Returns a string that contains your email address.
    >>> my_email() != 'put_your_email_here@berkeley.edu'
    True
    >>> type(my_email()) == str
    True
    """
    return 'put_your_email_here@berkeley.edu'

def my_lab_section():
    """Returns a number that represents the section that you are enrolled in.
    >>> 11 <= my_lab_section() <= 43
    True
    >>> type(my_lab_section()) == int
    True
    """
    return 0

def my_login():
    """Returns a string that represents your login. Your login should start with cs61a-
    >>> my_login() != 'cs61a-??'
    True
    >>> type(my_login()) == str
    True
    """
    return 'cs61a-??'