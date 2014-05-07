; title: Darkness of Human Nature

; haiku:
; Pandora's box opened
; Dark beams penetrate outwards
; Human lives begin



(define (draw)
  (speed 0)
  (repeat 360
    (lambda () (fd 160) (rt 90) (fd 160) (rt 90) (fd 160) (rt 90) (fd 160) (rt 91))))

(define (repeat n func) ; Repeat func k times.
  (if (> n 1)
      (begin (func) (repeat (- n 1) func))
      (func)))

(draw)