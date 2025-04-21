<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

## Learning Laravel

[documentation](https://laravel.com/docs)

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

[Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript.

laravel sail
```shell
./vendor/bin/sail build
./vendor/bin/sail up -d
```

server
```shell
protoc --plugin=protoc-gen-php-grpc --php_out=./generated --php-grpc_out=./generated proto/helloworld.proto
```

client
```shell
protoc --plugin=protoc-gen-grpc=grpc_php_plugin --php_out=./generated --grpc_out=./generated proto/helloworld.proto
```

https://grpc.io/docs/languages/php/basics/#setup

https://docs.roadrunner.dev/docs/general/install
https://docs.roadrunner.dev/docs/plugins/grpc
https://igancev.ru/2023-08-14-grpc-server-on-symfony
https://github.com/grpc/grpc/tree/master/src/php

php-grpc
```shell
git clone -b v1.72.0-pre1  https://github.com/grpc/grpc
```

laravel octane + Spiral RoadRunner GRPC
```shell
./rr serve
```

grpc roadrunner
```shell
./rr serve

127.0.0.1:9001
SayHello

{
    "name": "User"
}
```

https://github.com/fullstorydev/grpcurl/releases

```shell
docker pull fullstorydev/grpcurl:latest
go install github.com/fullstorydev/grpcurl/cmd/grpcurl@latest

./vendor/bin/sail up -d

grpcurl -proto ./proto/helloworld.proto -plaintext -d '{"name": "User"}' 0.0.0.0:9001 helloworld.Greeter/SayHello
grpcurl -proto ./proto/helloworld.proto -plaintext -d '{"name": "User"}' server:9001 helloworld.Greeter/SayHello
```
http://127.0.0.1/say-hello/superman
