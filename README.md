# Plain PHP MVC CRUD Blog App

## Website:

https://ruslan-website.com/plain_php_mvc/trip_blog/

## Tutorial

- https://www.youtube.com/playlist?list=PLfdtiltiRHWGXVHXX09fxXDi-DqInchFD

## User Accounts and Security notes

https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC/blob/master/Illustrations/Users%20Accounts%20and%20Security%20Notes.pdf

## Facebook Developer Console Setup

![](https://raw.githubusercontent.com/atabegruslan/Trip-Blog-Plain-PHP-MVC/master/Illustrations/FBSignin1.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Trip-Blog-Plain-PHP-MVC/master/Illustrations/FBSignin2.PNG)

![](https://raw.githubusercontent.com/atabegruslan/Trip-Blog-Plain-PHP-MVC/master/Illustrations/FBSignin3.PNG)

- https://www.tutorialspoint.com/php/php_facebook_login.htm?fbclid=IwAR3GRF-FSdNIiEvEO18HlrUImiGFf3YjSazR3-4QGZZJLyP4NETE5BRkF0Q
- https://developers.facebook.com/docs/reference/php/

# Twig

1. `composer init`

2. `composer search Twig`

3. `composer require twig/twig`

4. https://twig.symfony.com/doc/3.x/intro.html

5. `require 'vendor/autoload.php'`  in https://github.com/atabegruslan/Trip-Blog-Plain-PHP-MVC/blob/master/index.php

6. In `composer.json`
```
"autoload": {
    "files": [
        "helpers/twig_helper.php"
    ]
}
```

7. `composer dump-autoload`

8. See `helpers/twig_helper.php`

9. In code: `echo $twig->render('test.html', [ 'users' => [ Blah... ] ]);`

10. In template file: `{{ users }}`
