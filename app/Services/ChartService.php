<?php


namespace App\Services;


use App\Exceptions\ChartServiceException;
use App\HelpRequestType;
use App\HelpResourceType;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;

class ChartService
{
    const AVAILABLE_TYPES = [
        'registredHosts',
        'registredHelpRequest',
        'accomodationsApproved',
        'fundRaisingApproved',
        'infosApproved',
        'othersApproved',
    ];

    const AVAILABLE_INTERVALS = [
        'days',
        'mixed',
        'months',
    ];

    private function getDateListByInterval(string $interval)
    {
        $date = new DateTime();

        switch ($interval) {
            case 'mixed':
                $endDate = $date->format('Y-m-d');
                $startDate = (new DateTime($date->format('Y-01-01')))->format('Y-m-d');

                $diff = date_diff(new DateTime($endDate), new DateTime($startDate));

                $days = $diff->format("%a");

                if ($days < 15) {
                    $format = 'Y-m-d';
                    $step = 'P1D';
                    $newInterval = 'days';
                } elseif ($days < 71) {
                    $format = 'Y-W';
                    $step = 'P1W';
                    $newInterval = 'weeks';
                } else {
                    $format = 'Y-m';
                    $step = 'P1M';
                    $newInterval = 'months';
                }

                break;
            case 'months':
                $format = 'Y-m';
                $dateInterval = 'P12M';
                $step = 'P1M';
                $endDate = $date->add(new DateInterval($step))->format('Y-m-d');
                $startDate = $date->sub(new DateInterval($dateInterval))->format('Y-m-d');
                break;
            default:
                $format = 'Y-m-d';
                $dateInterval = 'P14D';
                $step = 'P1D';
                $endDate = $date->add(new DateInterval($step))->format('Y-m-d');
                $startDate = $date->sub(new DateInterval($dateInterval))->format('Y-m-d');
                break;
        }

        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval($step),
            new DateTime($endDate)
        );

        $results = [];
        foreach ($period as $key => $value) {
            $results[] = $value->format($format);
        }

        return [$newInterval ?? $interval, $results];
    }

    /**
     * @param string $type
     * @param string $interval
     * @throws ChartServiceException
     */
    public function handleChart(string $type, string $interval)
    {
        if (!in_array($type, self::AVAILABLE_TYPES)) {
            throw new ChartServiceException('Invalid chart type');
        }

        if (!in_array($interval, self::AVAILABLE_INTERVALS)) {
            throw new ChartServiceException('Invalid interval type');
        }

        list($interval, $intervalArray) = $this->getDateListByInterval($interval);

        switch ($type) {
            case 'registredHosts':
                $results = $this->getRegistredHosts($interval);
                break;
            case 'registredHelpRequest':
                $results = $this->registredHelpRequest($interval);
                break;
            case 'accomodationsApproved':
                $results = $this->accomodationsApproved($interval);
                break;
            case 'fundRaisingApproved':
                $results = $this->fundRaisingApproved($interval);
                break;
            case 'infosApproved':
                $results = $this->infosApproved($interval);
                break;
            case 'othersApproved':
                $results = $this->othersApproved($interval);
                break;
            default:
                $results = [];
                break;
        }

        $fullResults = [];
        foreach($intervalArray as $intervalStep) {
            $fullResults[$intervalStep] = array_key_exists($intervalStep, $results) ? $results[$intervalStep] : 0;
        }

        return $fullResults;
    }

    private function getGroupBy(string $interval, string $field)
    {
        switch ($interval) {
            case 'weeks':
                $groupBy = "CONCAT(YEAR({$field}), '-', WEEK({$field}))";
                break;
            case 'months':
                $groupBy = "DATE_FORMAT({$field}, '%Y-%m')";
                break;
            default:
                $groupBy = "DATE({$field})";
                break;
        }

        return $groupBy;
    }

    private function getRegistredHosts(string $interval)
    {

        $queryResults = DB::select("
            SELECT
                DATE(created_at) as label,
                COUNT(*) val
            FROM users
            JOIN model_has_roles ON model_has_roles.model_type = 'App\\\\User'
                AND model_has_roles.model_id = users.id
                AND model_has_roles.role_id = 3
            GROUP BY label
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }

    private function registredHelpRequest(string $interval)
    {
        $queryResults = DB::table('help_requests')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as number'))
            ->groupBy('date')
            ->get();

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->date] = $queryResult->number;
        }

        return $results;
    }

    private function accomodationsApproved(string $interval)
    {
        $queryResults = DB::table('accommodations')
            ->select(DB::raw('DATE(approved_at) as date'), DB::raw('count(*) as number'))
            ->groupBy('date')
            ->get();

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->date] = $queryResult->number;
        }

        return $results;
    }

    private function fundRaisingApproved(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'help_requests.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM help_requests
            JOIN help_request_types ON help_request_types.help_request_id = help_requests.id
                AND help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "'
                AND help_request_types.help_type_id = 4
            WHERE help_requests.deleted_at IS NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }

    private function infosApproved(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'help_requests.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM help_requests
            JOIN help_request_types ON help_request_types.help_request_id = help_requests.id
                AND help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "'
                AND help_request_types.help_type_id IN (1, 2)
            WHERE help_requests.deleted_at IS NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }

    private function othersApproved(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'help_requests.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM help_requests
            JOIN help_request_types ON help_request_types.help_request_id = help_requests.id
                AND help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "'
                AND help_request_types.help_type_id IN (3, 5, 7, 8)
            WHERE help_requests.deleted_at IS NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }
}
