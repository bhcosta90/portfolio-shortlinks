<?php

namespace App\Console\Commands;

use App\Jobs\RegisterClickJob;
use Bschmitt\Amqp\Facades\Amqp;
use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickInput;
use DateTime;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use function dispatch;
use function json_decode;

class RegisterClickCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:register-click-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle()
    {
        Amqp::consume('testing', function ($message, $resolver) {
            $data = json_decode($message->body, true);
            Log::info($message->body);
            dispatch(
                new RegisterClickJob(
                    new RegisterClickInput(
                        id: $data['id'],
                        ip: $data['ip'],
                        createdAt: new DateTime($data['date'])
                    )
                )
            );
            $resolver->acknowledge($message);
        }, [
            'routing' => 'short_link',
            'exchange' => 'amq.topic',
            'persistent' => true // required if you want to listen forever
        ]);
    }
}
