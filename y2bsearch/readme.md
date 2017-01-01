# Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).


The elastic search part is based on this docker container:
https://elk-docker.readthedocs.io/

## to reindex you should run
make indexMysql


## use this api to fetch videos
https://www.youtube.com/api/timedtext?v=Jg-BRpn38L8&asr_langs=fr,it,es,ru,pt,ja,nl,en,ko,de&key=yttt1&sparams=asr_langs,caps,v,expire&hl=en_US&caps=asr&signature=7C66C0DC3E235945623A661BDD7D7D7BA7C0C599.64384A577B6184F744C9497CB6506E5F3A6838FB&expire=1476311191&kind=asr&lang=en

##or can download using this 
youtube-dl --write-auto-sub --skip-download "https://www.youtube.com/watch?v=QECX7YvzF_c" -o here.srt
