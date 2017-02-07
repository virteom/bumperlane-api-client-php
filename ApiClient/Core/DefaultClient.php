<?php

namespace Virteom\ApiClient\Php;
include_once(__DIR__ . '/../includes.php');

class DefaultClient implements Core\IApiClient {
    public $BaseUrl = null;
    public $Api = null;
    public $ClientId = null;
    public $ClientSecret = null;
    public $UseCredentials = true;

    public function __construct($api, $clientId = MODERN_API_CLIENT_ID, $clientSecret = MODERN_API_CLIENT_SECRET, $baseUrl = MODERN_API_SITE_URL){
        $this->BaseUrl = $baseUrl;
        $this->Api = $api;
        $this->ClientId = $clientId;
        $this->ClientSecret = $clientSecret;
    }

    public function GetUrl(){
        return rtrim($this->BaseUrl, '/') . '/' . $this->Api;
    }

    public function BuildRequest($property){
        return new Core\ApiRequest($this, $property);
    }
}       