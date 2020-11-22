<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LoginLog extends Model
{
    public const LOGIN_LOG_TYPE_SUCCESS = 'success';
    public const LOGIN_LOG_TYPE_FAIL = 'fail';

    protected $fillable = [
        'user_id', 'email_address', 'ip_address', 'type'
    ];

    public static function record($user = null, $email, $ip, $type)
    {
        return static::create([
            'user_id' => is_null($user) ? null : $user->id,
            'email_address' => $email,
            'ip_address' => $ip,
            'type' => $type
        ]);
    }

    public function getLastLoginAttribute()
    {
        return DB::table($this->table)
            ->where('email_address', $this->email_address)
            ->orderBy('created_at', 'desc')
            ->first()
            ->created_at;
    }

    public function getFailedLoginAttemptsAttribute()
    {
        $entry = DB::table($this->table)
            ->where('email_address', $this->email_address)
            ->where('type', self::LOGIN_LOG_TYPE_FAIL)
            ->groupBy(['email_address'])
            ->select(DB::raw('COUNT(id) AS failed_attempts'))
            ->first();

        if ($entry) {
            return $entry->failed_attempts;
        }

        return 0;
    }
}
