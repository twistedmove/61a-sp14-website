;;; Scheme Recursive Art Contest Entry
;;;
;;; Title: Pipes
;;;
;;; Description:
;;;   Carrying nothing
;;;   From nowhere to nowhere, why?
;;;   No reason at all
;;;
;;; Features:
;;;   3D perspective projection
;;;   Proper occlusion using painter's algorithm
;;;   Distance-based shading
;;;   Procedural generation
;;;
;;; Inspired by the Windows "3D Pipes" screensaver

(hideturtle)

(define pi 3.141592653589793238462643383279)

(define (vector-foreach vector procedure)
        (vector-foreach-loop vector procedure 0))

(define (vector-foreach-loop vector procedure index)
        (if (< index (length vector))
            (begin (procedure index (vector-ref vector index))
                   (vector-foreach-loop vector procedure (+ index 1)))))

(define (deg2rad degrees)
        (/ (* degrees pi) 180))

(define (min x0 x1) (if (< x0 x1) x0 x1))
(define (max x0 x1) (if (> x0 x1) x0 x1))

(define (square x) (* x x))

(define (lerp x0 x1 s) (+ x0 (* (- x1 x0) s)))

;;; Transformations

(define (make-rotate-y angle next)
        (define a (cos angle))
        (define b (sin angle))
        (lambda (x y z)
                (next (+ (* a x) (* b z))
                      y
                      (- (* a z) (* b x)))))

(define (make-scale scale next)
        (lambda (x y z)
                (next (* x scale)
                      (* y scale)
                      (* z scale))))

(define (make-translate dx dy dz next)
        (lambda (x y z)
                (next (+ x dx)
                      (+ y dy)
                      (+ z dz))))

(define (make-perspective fl next)
        (lambda (x y z)
                (next (/ (* x fl) z)
                      (/ (* y fl) z)
                      z)))

;;; Geometry operations

(define (setpos-3d x y z)
        (setpos x y))

(define make-line vector)

(define (transform-lines! lines trans)
        (define (transform-line index line)
                (define v0 (trans (vector-ref line 0)
                                  (vector-ref line 1)
                                  (vector-ref line 2)))
                (define v1 (trans (vector-ref line 3)
                                  (vector-ref line 4)
                                  (vector-ref line 5)))
                (vector-set! line 0 (vector-ref v0 0))
                (vector-set! line 1 (vector-ref v0 1))
                (vector-set! line 2 (vector-ref v0 2))
                (vector-set! line 3 (vector-ref v1 0))
                (vector-set! line 4 (vector-ref v1 1))
                (vector-set! line 5 (vector-ref v1 2)))
        (vector-foreach lines transform-line))

; Sorts lines by the depth of their midpoint, farthest first
(define (sort-lines! lines)
        (define (line-comp line1 line2)
                (- (+ (vector-ref line1 2) (vector-ref line1 5))
                   (+ (vector-ref line2 2) (vector-ref line2 5))))
        (sort! lines line-comp))

(define (draw-lines! lines point)
        (define (draw-line index line)
                (define z0 (vector-ref line 2))
                (define z1 (vector-ref line 5))
                (define z (* (+ z0 z1) 0.5))
                (define line-color (vector-ref line 6))
                (define color-factor (max 0 (min 1 (/ -5 z))))
                (define shaded-color (vector (* (vector-ref line-color 0) color-factor)
                                             (* (vector-ref line-color 1) color-factor)
                                             (* (vector-ref line-color 2) color-factor)))
                (color_rgb shaded-color)
                (pensize (max 0 (/ -100 z)))
                (point (vector-ref line 0)
                       (vector-ref line 1)
                       z0)
                (pendown)
                (point (vector-ref line 3)
                       (vector-ref line 4)
                       z1)
                (penup))
        (vector-foreach lines draw-line))

;;; Pipe generation

(define dim 20)
(define half-dim (/ dim 2))
(define occupied (make-vector (* dim dim dim) #f))
(define (is-occupied x y z)
        (vector-ref occupied (+ (* dim (+ (* dim z) y)) x)))
(define (set-occupied x y z o)
        (vector-set! occupied (+ (* dim (+ (* dim z) y)) x) o))
(define (pipe-allowed x y z)
        (and (>= x 0)
             (>= y 0)
             (>= z 0)
             (< x dim)
             (< y dim)
             (< z dim)
             (not (is-occupied x y z))))

(define (make-pipe x y z dx dy dz length total-length)
        (if (> total-length 0)
            (begin  (define nx (+ x dx))
                    (define ny (+ y dy))
                    (define nz (+ z dz))
                    (define total-length (- total-length 1))
                    (if (and (pipe-allowed nx ny nz) (> length 0))
                        (begin (line-out x y z nx ny nz)
                               (set-occupied nx ny nz #t)
                               (make-pipe nx ny nz dx dy dz (- length 1) total-length))
                        (begin (define length (square (random 4.0)))
                               (define (choose-dir tries)
                                       (if (> tries 0)
                                           (begin (define dir (random 6))
                                                  (define dx 0)
                                                  (define dy 0)
                                                  (define dz 0)
                                                  (cond ((= dir 0) (define dx -1))
                                                        ((= dir 1) (define dx 1))
                                                        ((= dir 2) (define dy -1))
                                                        ((= dir 3) (define dy 1))
                                                        ((= dir 4) (define dz -1))
                                                        ((= dir 5) (define dz 1)))
                                                  (if (pipe-allowed (+ x dx) (+ y dy) (+ z dz))
                                                      (make-pipe x y z dx dy dz length total-length)
                                                      (choose-dir (- tries 1))))))
                               (choose-dir 50))))))

(define (start-pipe x y z total-length)
        (set-occupied x y z #t)
        (make-pipe x y z 0 0 0 0 total-length))

(define (generate-pipe)
        (define (try-generate-pipe tries)
                (if (> tries 0)
                    (begin  (define x (random dim))
                            (define y (random dim))
                            (define z (random dim))
                            (if (not (is-occupied x y z))
                                (start-pipe x y z 500)
                                (try-generate-pipe (- tries 1))))))
        (try-generate-pipe 10))

;;; Drawing

(speed 0)
(tracer 0)
(penup)
(bgcolor (vector 0 0 0))

(define (make-camera-trans next) (make-translate (- half-dim) (- half-dim) (- half-dim) (make-scale (/ 10 dim) (make-rotate-y (deg2rad 10) (make-translate 0.2 -0.1 -9.2 (make-perspective 300 next))))))
(define point (make-camera-trans vector))

(random-seed 117) ; Remove this line for a new layout every time

; Temporary buffer for lines
(define line-index 0)
(define lines (make-vector 10000))
(define (append-line line)
        (vector-set! lines line-index line)
        (set! line-index (+ line-index 1)))
(define (make-subdivided-line-out divisions)
        (lambda (x y z nx ny nz)
                (define (subdivided-line-out-loop n)
                        (define s0 (/ n divisions))
                        (define s1 (/ (+ n 1) divisions))
                        (append-line (make-line (lerp x nx s0)
                                                (lerp y ny s0)
                                                (lerp z nz s0)
                                                (lerp x nx s1)
                                                (lerp y ny s1)
                                                (lerp z nz s1)
                                                pipe-color))
                        (if (< (+ n 1) divisions)
                            (subdivided-line-out-loop (+ n 1))))
                (subdivided-line-out-loop 0)))
(define line-out (make-subdivided-line-out 4))

(define pipe-color (vector 0.5 0.75 0)) ; lime green
(generate-pipe)
(define pipe-color (vector 0.75 0.5 0)) ; gold
(generate-pipe)
(define pipe-color (vector 0 0 0.5)) ; blue
(generate-pipe)
(define pipe-color (vector 0 0.5 1)) ; sky blue
(generate-pipe)
(define trimmed-lines (make-vector line-index))
(subvector-move-left! lines 0 line-index trimmed-lines 0)
(transform-lines! trimmed-lines point)
(sort-lines! trimmed-lines)

(define (draw)
        (draw-lines! trimmed-lines setpos-3d)
        (update))

(draw)
