; Ordering between integers 0-5.
(fact (lt 0 1))
(fact (lt 1 2))
(fact (lt 2 3))
(fact (lt 3 4))
(fact (lt 4 5))
(fact (le _a _a))
(fact (le _a _b)  
      (lt _a _c) (le _c _b))

; (ordered X) if X is a list numbers (0-5) in order.
(fact (ordered ()))
(fact (ordered (_x)))
(fact (ordered (_x _y . _rest)) 
      (le _x _y) (ordered (_y . _rest)))

; (perm A B) if B is a permutation of A
(fact (perm () ()))
(fact (perm _Y (_X . _S))
      (member _X _Y _R) (perm _R _S))

; (member A B C) if A is a member of B and C are the elements in B
; apart from A.
(fact (member _X (_X . _R) _R))
(fact (member _X (_Y . _R1) (_Y . _R2))
      (member _X _R1 _R2))

; (sort A B) if B is a sorted version of A
(fact (sorted _A _B) (perm _A _B) (ordered _B))
