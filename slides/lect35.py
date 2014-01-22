import concurrent.futures
import math

# Code from the Python 3 Library Documentation, adapted.

PRIMES = [
    112272535095293,
    112582705942171,
    112272535095293,
    115280095190773,
    115797848077099,
    1099726899285419]

def is_prime(n):
    if n % 2 == 0:
        return False

    sqrt_n = int(math.floor(math.sqrt(n)))
    for i in range(3, sqrt_n + 1, 2):
        if n % i == 0:
            return False
    return True

def find_primes():
    with concurrent.futures.ProcessPoolExecutor() as executor:
        for number, prime in zip(PRIMES, executor.map(is_prime, PRIMES)):
            print('%d is prime: %s' % (number, prime))

def find_primes():
    executor = concurrent.futures.ProcessPoolExecutor()
    for number, prime in zip(PRIMES, executor.map(is_prime, PRIMES)):
        print('%d is prime: %s' % (number, prime))
    executor.shutdown()

import urllib.request

URLS = ['http://www.foxnews.com/',
        'http://www.cnn.com/',
        'http://europe.wsj.com/',
        'http://www.bbc.co.uk/',
        'http://some-made-up-domain.com/']

def load_url(url, timeout):
    return urllib.request.urlopen(url, timeout=timeout).read()

def check_urls():
    with concurrent.futures.ThreadPoolExecutor(max_workers=5) as executor:
        future_to_url = dict((executor.submit(load_url, url, 60), url)
                             for url in URLS)

        for future in concurrent.futures.as_completed(future_to_url):
            url = future_to_url[future]
            if future.exception() is not None:
                print('%r generated an exception: %s' % (url,
                                                         future.exception()))
            else:
                print('%r page is %d bytes' % (url, len(future.result())))

from multiprocessing  import Process, Queue

def form_pipe(*funcs):
    inp = result = multiprocessing.Queue()
    procs = []
    for f in funcs[0:-1]:
        out = multiprocessing.Queue() 
        procs.append(Process(target = f, args = (inp, out)))
        inp = out
    procs.append(Process(target = funcs[-1], args = (inp, None)))
    for p in procs:
        p.start()
    return result

def stage(func):
    def result(inp, out):
        while True:
            x = inp.get()
            y = func(x)
            if out is not None:
                out.put(y)

from operator import *

inp = form_pipe(stage(lambda x: 
                    
