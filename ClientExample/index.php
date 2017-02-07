<?php

include_once('../ApiClient/includes.php');
include_once('config.php');

$api = \Virteom\ApiClient\Php\ApiClient::Create(\Virteom\ApiClient\Php\Api::TouchConvertV1);
$request = $api->BuildRequest("ContactsPersonDetail");

$request->setOrderByDesc('LastName');

$pager = new \ODataQuery\Pager\ODataQueryPager(20, 5); // $top=20&$skip=5
$request->setPager($pager);

$filter = new \ODataQuery\Filter\ODataFilterFactory('Id');
$filter = $filter->greaterThanEquals(100);
$request->setFilter($filter);

$result = $request->Get();

print_r($result);