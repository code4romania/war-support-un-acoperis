<?php

namespace App\Http\Controllers;

class NewsletterController extends Controller
{
    public function newsletter()
    {
        $formUrl = config('newsletter.mc_form_url');
        return view('frontend.newsletter')->with('formUrl', $formUrl);
    }
}
