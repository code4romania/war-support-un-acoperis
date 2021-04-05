<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use OwenIt\Auditing\Models\Audit;
use Yajra\DataTables\Facades\DataTables;

class AuditLogController extends Controller
{
    public function index()
    {
        return view('admin.log.audit.index');
    }

    public function search()
    {
        $model = DB::table('audits_view');

        return DataTables::of($model)
           ->setTransformer(function ($item) {
                return [
                    'user' => $item->user ? htmlentities($item->user, ENT_QUOTES | ENT_HTML5, 'UTF-8') : '',
                    'role' => $item->role ? $item->role : '',
                    'event' => $item->event,
                    'type' => $item->type,
                    'url' => $item->url,
                    'created_at' => (new Carbon($item->created_at))->toDateTimeString(),
                    'action' => '<td><a class="btn btn-primary btn-sm text-purple" href="'
                    . route('admin.auditLogs.show', ['log' => Audit::find($item->id)])
                    . '">'
                    . __('Details')
                    . '</a></td>',
                ];
            })
            ->toJson();
    }

    public function show(Audit $log)
    {
        return view('admin.log.audit.view')
            ->with('log', $log);
    }
}
