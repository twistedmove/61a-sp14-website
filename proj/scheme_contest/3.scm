;Take 9 (WITH STARS)

;Haiku
; The "hill fingers" of
; The sum torus of human
; knowledge - oh, how fine!

(define (draw)
	(begin
		(drawsix 75)
		(pu)
		(define yhill -150)
		(seth 0)
		(setpos 0 yhill)
		(pd)
		(color "brown")
		(draw-hill 0 10)
		(pu)
		(define yfinger (+ -125 yhill))
		
		(finger -35 yfinger)
		(finger 0 (+ yfinger -7))
		(finger 35 yfinger)
	)
	)

(define (drawsix n)
    (if (> n 0)
        (begin
            (speed 0)
            (goto 0 100)
            (pd)
            (color "blue")
            (six-like 150)
            (goto 0 100)
            (rt 30)
            (pu)
            (color "yellow")
            (star 0 20 30)
            (drawsix (- n 1))
            )
        )
    )

(define (six-like n)
    (begin
        (if (= n 150) (rt 160))     
        (if (< n 30)
        	(begin
        		(circle (* n 3) 95)
        		)
            (begin
                (circle n 60)
                (six-like (/ n 1.25))
                )
            )
        )
    )


(define (finger xpos ypos)
    (begin
    	
    	(seth 0)
    	(goto xpos ypos)
    	(pd)
        (lt 180)
        (finger-helper 1.5 5)
        (finger-helper 2.5 5)
        (finger-helper 2.5 15)
        (finger-helper 2.5 25)
        (pu)
    )
)

(define (finger-helper n k)
    (begin 
    	(circle (* n 5) 90) 
    	(fd (* n k)) 
    	(lt 60) 
    	(circle (* n 10) 60) 
    	(lt 60) 
    	(fd (* n k)) 
    	(circle (* n 5) 90)
    	)
)

(define (draw-hill d n)
    (if (<= d n)
    (begin
        (if (= d 0) (lt 180))
        (hill 5 d n)
        (draw-hill (+ d 1) n)
    ))
)

(define (hill n d k)
    (begin (define u (/ 60 (* 2 k))) (lt 21.5) (circle (* n 10) 38.5)
         (lt 90) (circle (* n 10) (* d u)) (rt 90) (fd (* n 20)) (lt 90) (circle (* n 30) (- 60 (* 2 (* d u)))) (lt 90)  (fd (* n 20)) (rt 90) (circle (* n 10) (* d u)) (lt 90)
        (circle (* n 10) 38.5) (lt 21.5))
)


(define (star n side distance)
	(begin 
		(if (= n 0) (begin 
						(fd distance) 
						(pd) 
						) )
		(if (< n 5) 
			(begin 
				(fd side)
				(lt 144)
				(star (+ n 1) side distance)
				)
			)
		(pu)
		(goto 0 100)
		)
	)

(draw)