<?php

namespace App\Repository\NetworkLog;

use App\Models\MacAddress;
use App\Models\NetworkLog;
use App\Repository\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class NetworkLogRepository extends BaseRepository implements NetworkLogRepositoryInterface
{
    public function __construct(NetworkLog $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $macAddress
     * @param string|null $ip
     * @param int $rx
     * @param int $tx
     * @return void
     */
    public function startOrUpdateSession(string $macAddress, ?string $ip, int $rx, int $tx): void
    {
        $session=$this->firstNetworkLog($macAddress);
        if ($session) {
            $session->update([
                'download_bytes' => $rx,
                'upload_bytes' => $tx,
            ]);
        } else {
            $this->create([
                'mac_address' => $macAddress,
                'ip_address' => $ip,
                'started_at' => Carbon::now(),
                'download_bytes' => $rx,
                'upload_bytes' => $tx,
            ]);
        }
    }

    /**
     * @param array $activeMacs
     * @return void
     */
    public function closeInactiveSessions(array $activeMacs): void
    {
        $this->model->query()->whereNull('finished_at')
            ->whereNotIn('mac_address', $activeMacs)
            ->update(['finished_at' => Carbon::now()]);
    }

    /**
     * @param string $macAddress
     * @return Model|null
     */
    public function firstNetworkLog(string $macAddress): ?Model
    {
        return $this->model->query()->where('mac_address', $macAddress)
            ->whereNull('finished_at')
            ->first();
    }
}
