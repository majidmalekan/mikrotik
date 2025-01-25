<?php

namespace App\Http\Controllers\api\v1\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\faq\UpdateFaqRequest;
use App\Service\FaqService;
use App\Service\MikrotikService;
use App\Service\UserService;
use Exception;
use Illuminate\Http\Request;

class FaqController extends Controller
{


    public function __construct(protected FaqService $faqService){}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $faqs = $this->faqService->index($request);
        return view('Admin.Faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Faq.addFaq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $inputs = $request->only(['question', 'answer']);
            $this->faqService->create($inputs);
            return redirect()
                ->route('index-faq')
                ->with('success', 'سوال متداول با موفقیت اضافه شد.');
        } catch (Exception $error) {
            return back()->withErrors('مشکلی پیش آمده است.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = $this->faqService->show($id);
        return view('Admin.Faq.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request, string $id)
    {
        $inputs = $request->except(['_token']);
        $this->faqService->updateAndFetch($id, $inputs);
        return redirect()->route('index-faq')->with('success', 'سوال با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->faqService->delete($id);
        return redirect()
            ->route('index-faq')
            ->with('success', 'سوال موردنظر با موفقیت حذف شد.');
    }
}
