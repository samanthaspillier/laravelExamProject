<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Faq;

class FaqController extends Controller
{
    /**
     * Show the FAQ page.
     */

    public function showFAQ(): View
    {
        $faqs = Faq::all();
        return view('content.faq', compact('faqs'));
    }
}
