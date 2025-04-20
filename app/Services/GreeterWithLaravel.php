<?php

namespace App\Services;

use App\Models\Greeting;
use Spiral\RoadRunner\GRPC;
use GRPC\Greeter\GreeterInterface;
use GRPC\Greeter\HelloRequest;
use GRPC\Greeter\HelloReply;

final class GreeterWithLaravel implements GreeterInterface
{
    public function SayHello(GRPC\ContextInterface $ctx, HelloRequest $in): HelloReply
    {
        print_r(Greeting::query()->first()->name);

        try {
            $greeting = new Greeting();
            $greeting->name = $in->getName();
            $greeting->save();

            $response = new HelloReply();
            $response->setMessage("Hello, " . $in->getName() . "!");
            return $response;
        } catch (\Exception $e) {
            error_log("Error: " . $e->getMessage());
            throw new \Exception("Internal server error");
        }
    }
}
