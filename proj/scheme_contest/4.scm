;Name: Franklin Lee
;Email: flee@berkeley.edu


;Title: Now I am become Death, the Destroyer of Worlds

;It's not an earthquake,
;A typhoon, or tsunami:
;It is GODZILLA.


(rt 90)(speed 0)
(define (reset) (begin (goto 0 0) (clear) (seth 90)))

(define (draw_wave len)
  (begin_fill)(color "blue")(circle len 90)(circle (- len) 90)(rt 90)(circle (* 2 len) 90)(bk (* 4 len))(end_fill)(fd (* 4 len)))

(define (draw_wave_line num len)
  (if (> num 0)
    (begin (draw_wave len) (draw_wave_line (- num 1) len))))

(define (draw_wave_scene spikiness num_rows num_waves len index)
  (if (< 0 index)
    (if (> 3 (- num_rows index))
      (if (= 1 (- num_rows index))
        (begin (color "black") (begin_fill) (draw_goji_spikes spikiness (* 4 len num_waves)) (end_fill)
               (pu) (bk (* 4.05 len num_waves)) (rt 90) (fd (* 1.5 len)) (lt 90) (pd)
              (draw_wave_scene spikiness num_rows num_waves (* 0.9 len) (- index 1)))
        (begin (color "#131313") (begin_fill) (draw_goji_spikes spikiness (* 4 len num_waves)) (end_fill)
               (pu) (bk (* 4.1 len num_waves)) (rt 90) (fd (* 1.5 len)) (lt 90) (pd)
               (draw_wave_scene spikiness num_rows num_waves (* 1.2 len) (- index 1))))
      (begin (draw_wave_line num_waves len)
           (pu) (bk (* 4 len num_waves)) (rt 90) (fd (* 0.9 len)) (lt 90) (fd (* 0.05 len))
           (draw_wave_scene spikiness num_rows num_waves (* 1.1 len) (- index 1))))))

(define (draw_goji_spikes num_spikes len)
  (if (= 0 num_spikes)
    (begin (pd) (fd len))
    (begin (draw_goji_spikes (- num_spikes 1) (/ len 3))
           (lt 70) (dorsal_spike num_spikes (/ (* (sin 70) (/ len 3)) (sin 40)) #t)
           (rt 140) (dorsal_spike num_spikes (/ (* (sin 70) (/ len 3)) (sin 40)) #f)
           (lt 70) (draw_goji_spikes (- num_spikes 1) (/ len 3)))))

(define (dorsal_spike nums len left_or_right)
  (if (> nums 0)
    (if left_or_right
      (begin (lt 40) (fd (/ (* len (/ 2 3) (sin 130)) (sin 10) nums))
             (rt 170) (fd (/ (* len (/ 2 3) (sin 40)) (sin 10) nums))
             (lt 130) (fd (/ len 3 nums))
             (dorsal_spike (- nums 1) (* len (/ (- nums 1) nums)) left_or_right))
      (begin (fd (/ len 3 nums)) (lt 130)
             (fd (/ (* len (/ 2 3) (sin 40)) (sin 10) nums)) (rt 170)
             (fd (/ (* len (/ 2 3) (sin 130)) (sin 10) nums)) (lt 40)
             (dorsal_spike (- nums 1) (* len (/ (- nums 1) nums)) left_or_right)))))

(pu) (goto -500 200) (pd)
(draw_wave_scene 5 15 6 15 15)    ;You may need to maximize your window.

;Witness man's careless
;Mistake: Nature will restore
;Balance to the Earth.
