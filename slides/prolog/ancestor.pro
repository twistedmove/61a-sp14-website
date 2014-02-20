    (fact (parent george paul))
    (fact (parent martin george))
    (fact (parent martin martin_jr))
    (fact (parent martin donald))
    (fact (parent george ann))

    (fact (ancestor _X _Y) (parent _X _Y))
    (fact (ancestor _X _Y) (parent _X _Z) (ancestor _Z _Y))
