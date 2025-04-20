<?php

namespace App\Commands;

use Laravel\Octane\Commands\StartRoadRunnerCommand;

use Laravel\Octane\RoadRunner\ServerProcessInspector;
use Laravel\Octane\RoadRunner\ServerStateFile;

use App\Services\GreeterWithLaravel;
use GRPC\Greeter\GreeterInterface;
use Spiral\RoadRunner\GRPC\Invoker;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\Worker;
use Throwable;

class GrpcStartRoadRunnerCommand extends StartRoadRunnerCommand
{
    public function handle(ServerProcessInspector $inspector, ServerStateFile $serverStateFile)
    {
        $server = new Server(new Invoker(), [
            'debug' => false,
        ]);

        $server->registerService(GreeterInterface::class, new GreeterWithLaravel());

        try {
            $server->serve(Worker::create());
        } catch (Throwable $e) {
            error_log($e->getMessage());
        }
    }
}
