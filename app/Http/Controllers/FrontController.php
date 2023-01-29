<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    function landing(){
        return $this->view('home');
    }

    function faqs(){
        $faqs = Faq::latest()->get();

        return $this->view('faqs', [
            'faqs' => $faqs
        ]);
    }
}
