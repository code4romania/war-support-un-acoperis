<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\LoginLog;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LoginLogController extends Controller
{
    public function index()
    {
        return view('admin.log.login.index');
    }

    public function search()
    {
        $model = DB::table('login_logs_view')
            ->select(['user_id', 'email_address', 'failed_attempts', 'last_login']);

        return DataTables::of($model)
//        return DataTables::eloquent($model)
            ->only(['user_id', 'email_address'])
            ->setTransformer(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'email_address' => htmlentities($item->email_address, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                    'failed_login_attempts' => $item->failed_attempts,
                    'last_login' => $item->last_login
                ];
            })
            ->toJson();
    }
}
