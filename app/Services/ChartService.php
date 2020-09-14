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
        'weeks',
        'months',
        'years',
    ];

    private function getDateListByInterval(string $interval)
    {
        switch ($interval) {
            case 'weeks':
                $format = 'Y-W';
                $interval = 'P12W';
                $step = 'P1W';
                break;
            case 'months':
                $format = 'Y-m';
                $interval = 'P12M';
                $step = 'P1M';
                break;
            case 'years':
                $format = 'Y';
                $interval = 'P10Y';
                $step = 'P1Y';
                break;
            default:
                $format = 'Y-m-d';
                $interval = 'P30D';
                $step = 'P1D';
                break;
        }

        $date = new DateTime();

        $endDate = $date->add(new DateInterval($step))->format('Y-m-d');
        $startDate = $date->sub(new DateInterval($interval))->format('Y-m-d');

        $period = new DatePeriod(
            new DateTime($startDate),
            new DateInterval($step),
            new DateTime($endDate)
        );

        $results = [];
        foreach ($period as $key => $value) {
            $results[] = $value->format($format);
        }

        return $results;
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

        $intervalArray = $this->getDateListByInterval($interval);

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
            case 'years':
                $groupBy = "YEAR({$field})";
                break;
            default:
                $groupBy = "DATE({$field})";
                break;
        }

        return $groupBy;
    }

    private function getRegistredHosts(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'users.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM users
            JOIN model_has_roles ON model_has_roles.model_type = 'App\\\\User'
                AND model_has_roles.model_id = users.id
                AND role_id = 2
            WHERE users.approved_at IS NOT NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }

    private function registredHelpRequest(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'help_requests.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM help_requests
            WHERE help_requests.deleted_at IS NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
        }

        return $results;
    }

    private function accomodationsApproved(string $interval)
    {
        $groupBy = $this->getGroupBy($interval, 'help_requests.created_at');

        $queryResults = DB::select("
            SELECT
                {$groupBy} label,
                COUNT(*) val
            FROM help_requests
            JOIN help_request_types ON help_request_types.help_request_id = help_requests.id
                AND help_request_types.approve_status = '" . HelpRequestType::APPROVE_STATUS_APPROVED . "'
                AND help_request_types.help_type_id = 6
            WHERE help_requests.deleted_at IS NULL
            GROUP BY {$groupBy}
        ");

        $results = [];
        foreach ($queryResults as $queryResult) {
            $results[$queryResult->label] = $queryResult->val;
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
