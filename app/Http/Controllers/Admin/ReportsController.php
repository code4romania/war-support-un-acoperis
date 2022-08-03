<?php

namespace App\Http\Controllers\Admin;

use App\AllocationHistory;
use App\HelpRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Reports\OffersRequest;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Carbon\CarbonPeriod;
use Doctrine\DBAL\Schema\Schema;
use Faker\Provider\DateTime;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports');
    }

    /**
     * @param OffersRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function offers(OffersRequest $request) {
        if (!$request->validated()) {
            return redirect()->back();
        }

        $start = Carbon::parse($request->startDate);
        $end = Carbon::parse($request->endDate);
        $interval = CarbonInterval::day();

        $dateRange = CarbonPeriod::between($start, $end);
        $dateRange->setDateInterval($interval);

        DB::unprepared(DB::raw("
            DROP TABLE IF EXISTS tmp_reports_offers_days;
            CREATE TEMPORARY TABLE tmp_reports_offers_days(
                day DATE,
                PRIMARY KEY i_day(day)
            );
        "));

        foreach($dateRange as $day) {
            DB::insert("INSERT INTO tmp_reports_offers_days VALUES (?)", [$day->format("Y-m-d")]);
        }

        $dbRows = DB::select("
            SELECT
                rd.day,
                count(id) as requests,
                IFNULL(sum(guests_number), 0) as people,
                IFNULL(sum(need_car), 0) as need_car,
                IFNULL(sum(need_special_transport), 0) as need_special_transport,
                sum(IF(special_needs = '' OR special_needs IS NULL, 0, 1)) as special_needs,
                (SELECT COUNT(*) FROM accommodations acc WHERE rd.day = DATE(acc.created_at) AND acc.deleted_at IS NULL) as accommodation_offers
            FROM tmp_reports_offers_days rd
            LEFT JOIN help_requests hr ON rd.day = DATE(hr.created_at) AND hr.deleted_at IS NULL
            GROUP BY rd.day
        ");

        $columns = ["zi", "Nr. Cereri", "Nr. Persoane", "Nevoie de masina", "Nevoie de transport special", "Nevoi speciale", "Oferte cazare"];

        $callback = function() use ($dbRows, $columns) {
            $file = fopen("php://output", "w");
            fputcsv($file, $columns);

            foreach($dbRows as $row) {
                fputcsv($file, (array)$row);
            }
            fclose($file);

            DB::unprepared(DB::raw("
                DROP TABLE IF EXISTS tmp_reports_offers_days;
            "));

        };

        return response()->stream($callback, 200, [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=offers_report_". Carbon::today()->format("YmdHis") .".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ]);
    }
}
