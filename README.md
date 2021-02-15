# URL Shortener
Yes, another URL shortener!

---
This is a small pet project to practise with TDD and Event Sourcing with Laravel.

Frontend is made using ReactJS, which is the first time that I use it.

### What does this application
It's simple and not very original: you give a very long URL and the application automatically
returns a shorter URL using a random code of 5 chars. 
You can also set a maximum number of times that short URL can be requested, or a date limit.

### Endpoints
It just has two endpoints:

- `POST /api/v1/create`: it generates a code to make a redirection to the provided URL.
- `GET /api/v1/check/{code}`: it checks if the code is valid and returns the long URL to the be redirected.

### Tests
I have made some tests to check if events are dispatched and to check if endpoints
works properly. You can run the tests with PHPUnit or the `php artisan tests` command.
