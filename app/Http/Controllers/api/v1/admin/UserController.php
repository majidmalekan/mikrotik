<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Http\Requests\admin\user\UpdateUserRequest;
use App\Service\UserService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserService $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|Factory|Application
    {
        return view('Admin.User.index', compact($this->service->index($request)));
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
            $inputs = $request->only(['phone', 'name', 'is_vip', 'email']);
            $users = $this->service->create($inputs);
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
        return view('Admin.User.edit', compact($this->service->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $inputs=$request->all();
        $this->service->updateAndFetch($id,$inputs);
        return redirect()->route('dashboard')->with('success','کاربر با موفقیت اضافه شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->service->delete($id);
        return redirect()
            ->route('dashboard')
            ->with('success', 'کاربر موردنظر با موفقیت حذف شد.');
    }
}
