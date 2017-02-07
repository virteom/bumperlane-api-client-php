<?php

namespace Virteom\ApiClient\Php;
include_once('includes.php');

class ApiClient {

    public static function Create($api, $clientId = MODERN_API_CLIENT_ID, $clientSecret = MODERN_API_CLIENT_SECRET, $baseUrl = MODERN_API_SITE_URL){
        if($api === Api::TouchConvertV1){
            return new TouchConvertV1($api, $clientId, $clientSecret, $baseUrl);
        }
        else if($api === Api::TouchConvertV2){
            return new TouchConvertV2($api, $clientId, $clientSecret, $baseUrl);
        }
        else if($api === Api::CoreV2){
            return new CoreV2($api, $clientId, $clientSecret, $baseUrl);
        }

        return new DefaultClient($api, $clientId, $clientSecret, $baseUrl);
    }

}       