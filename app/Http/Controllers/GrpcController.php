<?php

namespace App\Http\Controllers;

use Grpc\ChannelCredentials;
use GRPC\Greeter\GreeterClient;
use GRPC\Greeter\HelloRequest;
use Illuminate\Support\Facades\Log;

class GrpcClient
{
    private static $instance = null;

    private $client;

    private function __construct()
    {
        $this->client = new GreeterClient(config('octane.grpc_server_host').':9001', [
            'credentials' => ChannelCredentials::createInsecure(),
        ]);
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance->client;
    }
}

class GrpcController extends Controller
{
    public function sayHello($name)
    {
        // Проверка на пустое или null значение
        if (empty($name)) {
            return response()->json(['error' => 'Name cannot be empty'], 400);
        }

        $client = GrpcClient::getInstance();
        $request = new HelloRequest();
        $request->setName($name);

        $attempt = 0;
        $maxRetries = 10; // Максимальное количество попыток

        while ($attempt < $maxRetries) {
            try {
                $responseMessage = $this->send($client, $request);
                // Если ответ получен корректно, выходим из цикла
                if ($responseMessage !== null) {
                    return response()->json(['message' => $responseMessage]);
                }
            } catch (\Exception $e) {
                Log::error('Exception: ' . $e->getMessage());
            }

            $attempt++;
            // Можно добавить задержку перед повторной попыткой
            usleep(500000); // Задержка 500 мс
        }

        return response()->json(['error' => 'Failed to get a valid response after retries'], 500);
    }

    private function send($client, $request)
    {
        list($reply, $status) = $client->SayHello($request)->wait();

        if ($status->code !== \Grpc\STATUS_OK) {
            Log::error('gRPC Error: ' . $status->details);
            return null; // Возвращаем null, чтобы продолжить попытки
        }

        return $reply->getMessage() ?? null;
    }
}
