<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $model = Audit::query();
        return DataTables::eloquent($model)
            ->setTransformer(function ($item) {
                return [
                    $item->user ? $item->user->name : '',
                    $item->user ? $item->user->roles->pluck('name')->implode(', ') : '',
                    $item->event,
                    $item->auditable_type,
                    $item->url,
                    $item->created_at->toDateTimeString(),
                    '<td><a class="btn btn-primary btn-sm text-purple" href="'
                    . route('admin.auditLogs.show', ['log' => $item])
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
