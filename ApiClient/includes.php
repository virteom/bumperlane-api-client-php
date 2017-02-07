<?php

if(!defined('INCLUDED_BUMPERLANE_APIS')){
    define('INCLUDED_BUMPERLANE_APIS', 1);
    $autoloadFile = __DIR__ . '/../vendor/autoload.php';
    if(file_exists($autoloadFile)){
        include_once($autoloadFile);
    }

    include_once(__DIR__ . '/Core/IApiClient.php');
    include_once(__DIR__ . '/Core/DefaultClient.php');
    include_once(__DIR__ . '/Api.php');
    include_once(__DIR__ . '/ApiClient.php');
    include_once(__DIR__ . '/Core/ApiRequest.php');

    //API Clients
    include_once(__DIR__ . '/Clients/TouchConvertV1.php');
    include_once(__DIR__ . '/Clients/TouchConvertV2.php');
    include_once(__DIR__ . '/Clients/CoreV2.php');
}