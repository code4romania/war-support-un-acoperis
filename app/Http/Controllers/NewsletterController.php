<?php

namespace App\Http\Controllers;

class NewsletterController extends Controller
{
    public function newsletter()
    {
        $formUrl = env('NEWSLETTER_SUBSCRIBE_URL', '#');
        return view('frontend.newsletter')->with('formUrl', $formUrl);
    }
}
