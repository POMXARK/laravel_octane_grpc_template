<?php

namespace App\Providers;

use App\Commands\GrpcStartRoadRunnerCommand;

use Illuminate\Foundation\Providers\ArtisanServiceProvider;

class CustomOctaneServiceProvider extends ArtisanServiceProvider
{
    public function register()
    {
        parent::register();
        if (config('octane.grpc_server')) {
            $this->commands([
                'Grpc' => GrpcStartRoadRunnerCommand::class,
            ]);
        }
    }
}
