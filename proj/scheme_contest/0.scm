;;; Scheme Recursive Art Contest Entry
;;;
;;; Please do not include your name or personal info in this file.
;;;
;;; Title: <"Abstract Modern Art">
;;;
;;;Description:
;;;This right here is my
;;;pretty boy, based art skills man
;;;I'm god; give karma.


(speed 0)
(setpos (- 100) (- 100))
(define (draw)
  ; *YOUR CODE HERE*

(define (kobe len)
			(begin_fill)
			(circle 50)
			(fd len)
			(left len)
			(back len)
			(right len)
			(fd len)
			(circle 100)
			(back (+ 50)
			(circle 100)
			(setpos -19 -14)
			(circle 33)
			(setpos 1000 0)
			(end_fill)
			(circle 300)))

(define (wut len)
			(begin_fill)
			(right len)
			(circle 50)
			(left len)
			(back len)
			(end_fill))
			

(define (repeat k fn)
    (if (> k 0)
        (begin (fn) (repeat (- k 1) fn))
        nil
    )
)
(circle 66)
(repeat  2 (kobe 1000))
(repeat  5 (kobe 666))




  (exitonclick))


; Please leave this last line alone.  You may add additional procedures above
; this line.  All Scheme tokens in this file (including the one below) count
; toward the token limit.
(draw)


