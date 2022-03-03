<?php

namespace App\Http\Controllers\Admin;

use App\HelpRequest;
use App\HelpType;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\View\View;

/**
 * Class HelpRequestController
 * @package App\Http\Controllers\Admin
 */
class HelpRequestController extends Controller
{
    /**
     * @return View
     */
    public function helpList()
    {
        return view('admin.help-list', [
            'area' => 'admin'
        ]);
    }

    /**
     * @param int $id
     * @return View
     */
    public function helpDetail($id)
    {
        /** @var HelpRequest $helpRequest */
        $helpRequest = HelpRequest::find($id);

        if (empty($helpRequest)) {
            abort(404);
        }

        return view('admin.help-detail', [
            'helpRequest' => $helpRequest,
            'area' => 'admin'
        ]);
    }
}
