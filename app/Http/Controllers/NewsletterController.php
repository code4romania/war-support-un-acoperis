<?php

namespace App\Http\Controllers;

class NewsletterController extends Controller
{
    public function newsletter()
    {
        return view('frontend.newsletter');
    }
}
