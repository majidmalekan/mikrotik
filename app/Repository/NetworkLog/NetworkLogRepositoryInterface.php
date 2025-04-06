<?php

namespace App\Repository\NetworkLog;

use Illuminate\Database\Eloquent\Model;

interface NetworkLogRepositoryInterface
{
    /**
     * @param string $macAddress
     * @param string|null $ip
     * @param int $rx
     * @param int $tx
     * @return void
     */
    public function startOrUpdateSession(string $macAddress, ?string $ip, int $rx, int $tx): void;

    /**
     * @param array $activeMacs
     * @return void
     */
    public function closeInactiveSessions(array $activeMacs): void;

    /**
     * @param string $macAddress
     * @return Model|null
     */
    public function firstNetworkLog(string $macAddress): ?Model;
}
