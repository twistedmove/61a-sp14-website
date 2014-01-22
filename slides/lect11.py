from ucb import main, interact

def indent_lines(s, n):
    """'s' with all lines prefixed by 'n' blanks."""
    return "\n".join(map(lambda line: " " * n + line, s.split('\n')))

import re
def indent_lines2(s, n):
    """'s' with all lines prefixed by 'n' blanks."""
    return re.sub(r'(?m)^', ' ' * n, s)
# Notes:
#   (?m)    sets "multiline mode"
#   ^       means 'beginning of string' by default unless in multiline mode,
#               where it means 'beginning of line'.
#   "Lines" are substrings that begin at the beginning of the string or
#   immediately after a \n (newline) character.
#
#   re.sub(PATTERN, REPLACEMENT, STRING) replaces all instances of PATTERN
#       STRING by REPLACEMENT and returns the result.
#
#   We don't really need to make the pattern string raw here, but raw strings
#   are generally useful in pattern strings, since the pattern language uses
#   backslash as its own escape character (e.g., \d means 'any digit').

def indent_file(input, output, n):
    """Write the contents of file INPUT to OUTPUT, indented by N spaces."""
    print(indent_lines(input.read(), n).rstrip(), file = output)
    # Notes: We use rstrip() to remove any final newline and whitespace, so
    # as not to introduce a bogus indentded empty line at the end.

# Example:
#  To read file foo, indent by 8 spaces, and write file foo_indented:
#      in, out = open("foo"), open("foo_indented", "w")
#      indent_file(in, out, 8)
#      out.close()


@main
def main():
    interact()
    
          
