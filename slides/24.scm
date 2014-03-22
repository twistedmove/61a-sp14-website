(define pi 3.1415926)
(define pi**2 (* pi pi))

(set! pi 3)

(define (fib n)
     (define (fib1 n1 n2 n)
             (if (< n 2) 
                 n2
                 (fib1 n2 (+ n1 n2) (- n 1))))
     (if (= n 0) 0
         (fib1 0 1 n)))

(define (length L)
   (if (null? L) 0 (+ 1 (length (cdr L)))))

;; Tail-recursive version.
(define (length L)
   (define (add-length prev L)
      (if (null? L) prev (add-length (+ prev 1) (cdr L))))
   (add-length 0 L))

(define (nth k L)
    (if (= k 0) (car L) (nth (- k 1) (cdr L))))

(define (eval E)
    (if (number? E) E
        (let ((left (eval (nth 1 E)))
              (right (eval (nth 2 E)))
              (op (nth 0 E)))
          (let ((func (cond ((eq? op '+) +)
                            ((eq? op '-) -)
                            (#t *))))
              (func left right)))))

;; >>> (eval '(- (* (* (+ 3 (+ 7 10)) (- 1000 8)) 0.00100806451613) 17))
;; 3.00000000001923
