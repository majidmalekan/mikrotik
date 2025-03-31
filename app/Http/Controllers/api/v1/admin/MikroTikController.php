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
        dd(bcrypt('09381933579'));
        try {
            $this->mikrotikService->addressList($request->ip(),$request->post('phone'));
            $response = $this->mikrotikService->addUser(
                $request->post('phone')
            );
            return success('User added successfully', $response);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUserMAC(Request $request): JsonResponse
    {
        try {
            $mac = $this->mikrotikService->getUserMACByIP($request->ip());
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
            return success('', $this->mikrotikService->getUserTraffic($request->input('phone')));
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
            $result = $this->mikrotikService->blockUserAccess($request->input('phone'));
            return success('', $result);
        } catch (\Exception $e) {
            return failed($e->getMessage());
        }
    }


}
