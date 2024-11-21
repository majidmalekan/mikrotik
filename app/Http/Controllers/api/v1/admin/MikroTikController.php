<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mikrotik\AddUserRequest;
use App\Http\Requests\Mikrotik\BlockAccessRequest;
use App\Http\Requests\Mikrotik\GetTrafficRequest;
use App\Http\Requests\Mikrotik\GetUserMacRequest;
use App\Service\MikrotikService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MikroTikController extends Controller
{
    protected MikrotikService $mikrotikService;

    public function __construct(MikroTikService $mikrotikService)
    {
        $this->mikrotikService = $mikrotikService;
    }

    /**
     * @return JsonResponse
     */
    public function getSystemIdentity(): JsonResponse
    {
        try {
            $identity = $this->mikrotikService->getSystemIdentity();
            return success('', $identity);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }

    /**
     * @param AddUserRequest $request
     * @return JsonResponse
     */
    public function addUser(AddUserRequest $request): JsonResponse
    {
        try {
            $response = $this->mikrotikService->addUser(
                $request->input('username'),
                $request->input('password'),
                $request->input('profile') ?? 'default'
            );
            return success('User added successfully', $response);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }


    /**
     * @param GetUserMacRequest $request
     * @return JsonResponse
     */
    public function getUserMAC(GetUserMacRequest $request): JsonResponse
    {
        try {
            if ($request->input('username')) {
                $mac = $this->mikrotikService->getActiveUserMAC($request->input('username'));
            } elseif ($request->input('ip_address')) {
                $mac = $this->mikrotikService->getUserMACByIP($request->input('ip_address'));
            } else {
                throw new \Exception('Provide either a username or an IP address.');
            }
            return success('', ['mac_address' => $mac]);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }

    /**
     * @param GetTrafficRequest $request
     * @return JsonResponse
     */
    public function getTraffic(GetTrafficRequest $request): JsonResponse
    {
        try {
            if ($request->input('username')) {
                $traffic = $this->mikrotikService->getUserTraffic($request->input('username'));
            } elseif ($request->input('queue_name')) {
                $traffic = $this->mikrotikService->getQueueTraffic($request->input('queue_name'));
            } elseif ($request->input('interface_name')) {
                $traffic = $this->mikrotikService->getInterfaceTraffic($request->input('interface_name'));
            } else {
                throw new \Exception('Provide either a username, queue name, or interface name.');
            }
            return success('', ['traffic' => $traffic]);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }

    /**
     * @param BlockAccessRequest $request
     * @return JsonResponse
     */
    public function blockAccess(BlockAccessRequest $request): JsonResponse
    {
        try {
            $result = $this->mikrotikService->blockUserAccess($request->input('username'));
            return success('',$result);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }


}
