<?php

namespace App\Services;

use Spiral\RoadRunner\GRPC;
use GRPC\Greeter\GreeterInterface;
use GRPC\Greeter\HelloRequest;
use GRPC\Greeter\HelloReply;

final class Greeter implements GreeterInterface
{
    public function SayHello(GRPC\ContextInterface $ctx, HelloRequest $in): HelloReply
    {
        $greeting = "Hello " . $in->getName() . "!";

        return new HelloReply([
            'message' => $greeting
        ]);
    }
}
