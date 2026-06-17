<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        return view('owner.inquiries.index', [
            'inquiries' => Inquiry::query()->latest()->get(),
        ]);
    }

    public function show(Inquiry $inquiry): View
    {
        return view('owner.inquiries.show', compact('inquiry'));
    }
}
