
from lect36 import *

def tree_path_gen(tree, path):
    """A generator of the items of TREE along the path
    described by PATH, where a true value in PATH indicates
    a left child and a false value indicates a right child."""
    while not tree.is_empty:
        yield tree.label
        if not path:
            tree = empty_tree
        else:
            if path[0]:
                tree = tree.left
            else:
                tree = tree.right
            del path[0]



