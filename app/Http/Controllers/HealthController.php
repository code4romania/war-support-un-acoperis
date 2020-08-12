<?php

namespace App\Http\Controllers;

/**
 * Class HealthController
 * @package App\Http\Controllers
 */
class HealthController extends Controller
{
    public function check()
    {
        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
