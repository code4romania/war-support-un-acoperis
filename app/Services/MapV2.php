<?php

namespace App\Services;

use GeneaLabs\LaravelMaps\Map;

class MapV2 extends Map
{
    public function get_lat_long_from_address($address, $attempts = 0)
    {
        $lat = 0;
        $lng = 0;
        $error = '';

        $data_location = "https://maps.google.com/maps/api/geocode/json?address=".urlencode($address); // New One for every language.

        if ($this->apiKey != "") {
            $data_location .= '&key='.$this->apiKey.'&';
        }

        if ($this->region != "" && strlen($this->region) == 2) {
            $data_location .= "&region=".$this->region;
        }
        $data = file_get_contents($data_location);
        $data = json_decode($data);

        if ($data->status == "OK") {
            $lat = $data->results[0]->geometry->location->lat;
            $lng = $data->results[0]->geometry->location->lng;
        } else {
            if ($data->status == "OVER_QUERY_LIMIT") {
                $error = $data->status;
                if ($attempts < 2) {
                    sleep(1);
                    ++$attempts;
                    list($lat, $lng, $error) = $this->get_lat_long_from_address($address, $attempts);
                }
            }
        }

        return array($lat, $lng, $error);
    }
}
