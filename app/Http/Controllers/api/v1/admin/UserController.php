<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Http\Requests\admin\user\UpdateUserRequest;
use App\Service\MikrotikService;
use App\Service\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $service;
    protected MikrotikService $mikrotikService;

    public function __construct(UserService $userService, MikrotikService $mikrotikService)
    {
        $this->service = $userService;
        $this->mikrotikService = $mikrotikService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory|Application
    {
        $users = $this->service->index($request);
        return view('Admin.User.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Factory|Application
    {
        return view('Admin.User.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            $inputs = $request->only(['phone', 'name', 'email', 'is_vip', 'traffic_limit','role','status']);
            $inputs["username"] = $request->validated('phone');
            $inputs["password"] = bcrypt($request->validated('phone'));
            $inputs["parent_id"] = $request->user()->id;
            $this->service->create($inputs);
            return redirect()
                ->route('dashboard')
                ->with('success', 'کاربر با موفقیت اضافه شد.');
        } catch (Exception $error) {
            return back()->withErrors('مشکلی پیش آمده است.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View|Factory|Application
    {
        $user = $this->service->show($id);
        return view('Admin.User.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $inputs = $request->except(['_token']);
        $this->service->updateAndFetch($id, $inputs);
        return redirect()->route('dashboard')->with('success', 'کاربر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()
            ->route('dashboard')
            ->with('success', 'کاربر موردنظر با موفقیت حذف شد.');
    }

    /**
     * @param string $id
     * @return RedirectResponse
     * @throws Exception
     */
    public function block(string $id): RedirectResponse
    {
        try {
            $user = $this->service->show($id);
            $userUpdate = $this->service->updateAndFetch($id, ["status" => $user->status == "active" ? "disable" : "active"]);
            $this->mikrotikService->blockUserAccess($userUpdate->status == "active" ? "enable" : "disable", $user->phone);
            return redirect()
                ->route('dashboard')
                ->with('success', 'کاربر موردنظر با موفقیت حذف شد.');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
