<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LoginLog;
use Yajra\DataTables\Facades\DataTables;

class LoginLogController extends Controller
{
    public function index()
    {
        return view('admin.log.login.index');
    }

    public function search()
    {
        $model = LoginLog::query();

        $model = $model->groupBy('email_address', 'user_id')
            ->select(['user_id', 'email_address']);


        return DataTables::eloquent($model)
            ->only(['id', 'email_address'])
            ->setTransformer(function ($item) {
                return [
                    $item->user_id,
                    htmlentities($item->email_address, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                    $item->failedLoginAttempts,
                    $item->lastLogin,
                ];
            })
            ->toJson();
    }
}
