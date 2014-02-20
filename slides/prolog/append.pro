; (append X Y Z) if Z is the result of appending lists X and Y.
(fact (append () _X _X))
(fact (append (_A . _R1) _Y (_A . _Z))
      (append _R1 _Y _Z))

