<?php

namespace App\Console\Commands;

use Bschmitt\Amqp\Facades\Amqp;
use Core\Domain\Repository\ShotLinkRepositoryInterface;
use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickInput;
use Core\Infra\UseCases\RegisterClick;
use DateTime;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

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
     */
    public function handle()
    {
        Amqp::consume('testing', function ($message, $resolver) {
            try {
                $data = json_decode($message->body, true);
                Log::info($message->body);

                $useCase = new RegisterClick(
                    shotLinkRepository: app(ShotLinkRepositoryInterface::class),
                );

                $response = $useCase->execute(
                    new RegisterClickInput(
                        id: $data['id'],
                        ip: $data['ip'],
                        createdAt: new DateTime($data['date'])
                    )
                );

                if ($response->success) {
                    $resolver->acknowledge($message);
                }
            } catch (Exception $exception) {
                Log::error($exception->getMessage());
            }
        }, [
            'routing' => 'short_link',
            'exchange' => 'amq.topic',
            'persistent' => true // required if you want to listen forever
        ]);
    }
}
