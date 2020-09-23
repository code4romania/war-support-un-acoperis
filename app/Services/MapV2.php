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

        if ($this->geocodeCaching) { // if caching of geocode requests is activated

            $CI = & get_instance();
            $CI->load->database();
            $CI->db->select("latitude,longitude");
            $CI->db->from("geocoding");
            $CI->db->where("address", trim(strtolower($address)));
            $query = $CI->db->get();

            if ($query->num_rows() > 0) {
                $row = $query->row();

                return array($row->latitude, $row->longitude);
            }
        }
        //utf8_encode($address) will return only english adress mean it's take only english address.
        // Remove utf8_encode from urlencode then it'll support all languages(eg. en, ur, chinese, russian, japanese, greek etc.)
        // $data_location = "https://maps.google.com/maps/api/geocode/json?address=".urlencode(utf8_encode($address)); //Old One just for english
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

            if ($this->geocodeCaching) { // if we to need to cache this result
                if ($address != "" && $lat != 0 && $lng != 0) {
                    $data = array(
                        "address" => trim(strtolower($address)),
                        "latitude" => $lat,
                        "longitude" => $lng,
                    );
                    $CI->db->insert("geocoding", $data);
                }
            }
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
