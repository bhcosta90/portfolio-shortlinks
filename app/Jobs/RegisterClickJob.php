<?php

namespace App\Jobs;

use Core\Infra\UseCases\DTO\RegisterClick\RegisterClickInput;
use Core\Infra\UseCases\RegisterClickUseCase;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use function json_encode;

class RegisterClickJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(protected RegisterClickInput $registerClickInput)
    {
        //
    }

    /**
     * Execute the job.
     * @throws Exception
     */
    public function handle(RegisterClickUseCase $useCase): void
    {
        $response = $useCase->execute($this->registerClickInput);

        if (!$response->success) {
            throw new Exception(
                'Error in job: ' . self::class . ' with data: ' . json_encode((array)$this->registerClickInput)
            );
        }
    }
}
