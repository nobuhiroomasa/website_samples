<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function store(StoreInquiryRequest $request): RedirectResponse
    {
        Inquiry::create($request->validated());

        return redirect()
            ->route('contact')
            ->with('status', 'お問い合わせを受け付けました。ありがとうございます。');
    }
}
