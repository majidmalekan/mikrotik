<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\StoreUserRequest;
use App\Service\UserService;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('Admin.User.index', compact($this->service->index($request)));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.User.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
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
    public function edit(string $id)
    {
        return view('Admin.User.show', compact($this->service->show($id)));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->service->delete($id);
        return redirect()
            ->route('dashboard')
            ->with('success', 'کاربر موردنظر با موفقیت حذف شد.');
    }
}
