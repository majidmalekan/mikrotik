<?php

namespace App\Console\Commands;

use App\Service\MikrotikService;
use Illuminate\Console\Command;

class LogNetworkUsageCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'network:log';
    /**
     * @var string
     */
    protected $description = 'Log network usage from MikroTik';

    public function __construct(protected MikrotikService $service)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle(): void
    {
        try {
            $this->service->getNetworkLogUsage();
            $this->info('Network usage logged successfully.');
        } catch (\Exception $e) {
            $this->error('Network usage logged unsuccessfully.');
        }

    }
}
