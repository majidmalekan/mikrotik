<?php

namespace App\Console\Commands;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Notifications\SendSmsNotification;
use App\Service\MikrotikService;
use App\Service\UserService;
use App\Traits\MustVerifyContact;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Notifications\Notifiable;

class CalculateTrafficOfUser extends Command
{
    use Notifiable, MustVerifyContact;

    protected MikrotikService $service;
    protected UserService $userService;

    public function __construct(MikrotikService $mikrotikService, UserService $userService)
    {
        parent::__construct();
        $this->service = $mikrotikService;
        $this->userService = $userService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-traffic-of-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate traffic of user';

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        try {
            $this->trafficUsageForSupervisorUser();
            $this->trafficUsageForNormalUser();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

    }

    /**
     * @return void
     * @throws Exception
     */
    protected function trafficUsageForNormalUser(): void
    {
        $users = $this->userService->getAllNormalUser();
        foreach ($users as $user) {
            $this->blockTraffic($user);
        }
    }

    /**
     * @throws Exception
     */
    protected function trafficUsageForSupervisorUser(): void
    {
        $users = $this->userService->getAllSupervisorUser();
        foreach ($users as $user) {
            $this->blockTraffic($user);
            $this->notify(new SendSmsNotification(2, $user->phone));
        }
    }

    /**
     * @param $user
     * @return void
     * @throws Exception
     */
    protected function blockTraffic($user): void
    {
        if ($user->traffic > $user->traffic_limit && !$user->is_vip) {
            $this->service->blockUserAccess('disable', $user->phone);
            $this->notify(new SendSmsNotification(2, $user->phone));
        }
    }
}
