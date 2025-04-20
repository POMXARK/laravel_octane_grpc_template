<?php

use App\Services\Greeter;
use GRPC\Greeter\GreeterInterface;
use Spiral\RoadRunner\GRPC\Invoker;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\Worker;

require __DIR__ . '/vendor/autoload.php';
require 'app/Services/Greeter.php';

$server = new Server(new Invoker(), [
    'debug' => false, // optional (default: false)
]);

$server->registerService(GreeterInterface::class, new Greeter());

$server->serve(Worker::create());
