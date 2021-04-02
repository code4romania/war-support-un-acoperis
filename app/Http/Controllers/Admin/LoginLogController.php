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
            ->groupBy('email_address', 'user_id')
            ->select(['user_id', 'email_address', 'created_at']);

        return DataTables::of($model)
//        return DataTables::eloquent($model)
            ->only(['user_id', 'email_address'])
            ->setTransformer(function ($item) {
                return [
                    'user_id' => $item->user_id,
                    'email_address' => htmlentities($item->email_address, ENT_QUOTES | ENT_HTML5, 'UTF-8'),
                    'failed_login_attempts' => $this->getFailedLoginAttempts($item->email_address),
                    'last_login' => $this->getLastLogin($item->email_address)
                ];
            })
            ->toJson();
    }

    private function getFailedLoginAttempts(string $email): int
    {
        $entry = DB::table('login_logs')
            ->where('email_address', $email)
            ->where('type', LoginLog::LOGIN_LOG_TYPE_FAIL)
            ->groupBy(['email_address'])
            ->select(DB::raw('COUNT(id) AS failed_attempts'))
            ->first();

        if ($entry) {
            return $entry->failed_attempts;
        }

        return 0;
    }

    private function getLastLogin(string $email)
    {
        return DB::table('login_logs')
            ->where('email_address', $email)
            ->orderBy('created_at', 'desc')
            ->first()
            ->created_at;
    }
}
