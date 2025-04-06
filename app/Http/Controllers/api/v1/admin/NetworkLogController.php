<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Service\NetworkLogService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NetworkLogController extends Controller
{
    public function __construct(protected NetworkLogService $networkLogService)
    {
    }

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return Factory|View|Application|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $logs = $this->networkLogService->index($request);
        return view('Admin.NetworkLog.index',compact('logs'));
    }

    public function exportCsv()
    {
        $logs = $this->networkLogService->getAll();
        $csv = "IP,MAC,Download(Bytes),Upload(Bytes),Logged At\n";
        foreach ($logs as $log) {
            $csv .= "{$log->ip_address},{$log->mac_address},{$log->download_bytes},{$log->upload_bytes},{$log->logged_at}\n";
        }
        $fileName = 'network_logs_' . now()->format('Ymd_His') . '.csv';
        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
