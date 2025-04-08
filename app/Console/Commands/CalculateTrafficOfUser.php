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
    use Notifiable,MustVerifyContact;
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
    public function handle()
    {
        try {

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
        $users=$this->userService->getAllNormalUser();
        foreach ($users as $user) {
            $traffic = $this->calculateTraffic($user->phone);
            $this->blockTraffic($user,$traffic);
        }
    }

    protected function trafficUsageForSupervisorUser()
    {
        $users=$this->userService->getAllSupervisorUser();
        $allTraffic=0;
        foreach ($users as $user) {
            foreach ($user->children as $userChild) {
                $traffic = $this->calculateTraffic($userChild->phone);
                $allTraffic+=$traffic;
                if ((($traffic['bytes'] / 1024) / 1024) > $userChild->traffic_limit && !$userChild->is_vip) {
                    $this->service->blockUserAccess('disable', $userChild->phone);
                    $this->notify(new SendSmsNotification(2,$this->getAdminPhoneNumber()));
                }
            }
            $traffic = $this->calculateTraffic($user->phone);
            $allTraffic+=(($traffic['bytes'] / 1024) / 1024);
        }
    }

    /**
     * @param $user
     * @return float|int
     * @throws Exception
     */
    protected function calculateTraffic($user): float|int
    {
         $traffic=$this->service->getUserTraffic($user->phone);
         return (($traffic['bytes'] / 1024) / 1024);
    }

    /**
     * @param $user
     * @param $traffic
     * @return void
     * @throws Exception
     */
    protected function blockTraffic($user, $traffic): void
    {
        if ($traffic > $user->traffic_limit && !$user->is_vip) {
            $this->service->blockUserAccess('disable', $user->phone);
            $this->notify(new SendSmsNotification(2,$this->getAdminPhoneNumber()));
        }
    }
}
