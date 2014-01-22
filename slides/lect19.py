from ucb import trace

def count_change(amount, coins = (50, 25, 10, 5, 1)):
    if amount == 0:
        return 1
    elif not coins:
        return 0
    elif amount >= coins[0]:
        return count_change(amount, coins[1:]) \
               + count_change(amount-coins[0], coins)
    else:
        return count_change(amount, coins[1:])


# A variation on the version in lecture.  Here, the 'visited' parameter to
# search doubles as the path up to p.

def solve_maze(start, exit, maze):
    """Assume that 'maze' is a 2D array (list of lists) where
    maze[r][c] is true iff there is a concrete block occupying 
    column 'c' of row 'r'.  'start' and 'exit' are (row,column)
    pairs indicating the initial position of the prisoner and the 
    position of the exit.  Returns a sequence of (row,column) 
    pairs starting with start and ending with exit indicating 
    a sequence of empty squares that are adjacent to each other 
    vertically or horizontally.
    """
    nrows = len(maze)
    ncols = len(maze[0])

    def search(p, visited):
        """Returns a list of pairs starting with 'p' and ending 
        with 'exit' of empty, adjacent squares, none of which 
        are contained in the list of squares 'visited', which is a path
        from start up to but not including p.  Returns None
        if there is no such path."""
        visited = visited + (p,)
        if p == exit:
            return visited
        else:
            r0, c0 = p
            for neigh in (r0+1, c0), (r0-1, c0), (r0, c0+1), (r0, c0-1):
                r, c = neigh
                if 0 <= r < nrows and 0 <= c < ncols \
                   and not maze[r][c] and neigh not in visited:
                    path = search(neigh, visited)
                    if path is not None:
                        return path
            return None

    return search(start, ())

def build_maze(rows, cols, horizontal_walls, vertical_walls):
    """Build a maze with ROWS rows and COLS columns, and walls as specified
    by HORIZONTAL_WALLS and VERTICAL_WALLS.  The walls arguments are sequences
    of tuples (r, c, len), indicating a wall whose lower-left corner is
    at row r and column c in the maze, and which contains len blocks."""

    maze = [ [False] * cols for _ in range(rows) ]

    for r, c, len in horizontal_walls:
        for _ in range(len):
            try: 
                maze[r][c] = True
            except IndexError:
                print("?", r,c, len)
            c += 1

    for r, c, len in vertical_walls:
        for _ in range(len):
            try: 
                maze[r][c] = True
            except IndexError:
                print("?", r,c, len)
            r += 1

    return maze

# Maze from lecture

sample_maze = \
   build_maze(15, 15,
              ((0, 0, 15), (14, 0, 15), (2, 1, 6), (2, 8, 5),
               (10, 4, 7), (10, 1, 2), (4, 2, 3), (8, 2, 2),
               (12, 2,10), (11, 8, 2), (10, 13, 1)),
              ((0, 14, 13), (0, 0, 15), (3, 6, 6), (3, 12, 8), (6, 4, 4),
               (4, 2, 4), (3, 8, 6), (4, 10, 5), (11, 12, 2)))
    
def print_maze(maze):
    rows = len(maze)
    cols = len(maze[0])
    for r in range(rows-1, -1, -1):
        for c in range(cols):
            print("*" if maze[r][c] else " ", end="")
        print()
