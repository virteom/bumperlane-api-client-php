<?php
require_once('includes/on-each-page.php');

$api = \Virteom\ApiClient\Php\ApiClient::Create(\Virteom\ApiClient\Php\Api::TouchConvertV1);
$request = $api->BuildRequest("ContactsPersonDetail");

$request->setOrderByDesc('LastName');

$pager = new \ODataQuery\Pager\ODataQueryPager(20, 5); // $top=20&$skip=5
$request->setPager($pager);

$filter = new \ODataQuery\Filter\ODataFilterFactory('Id');
$filter = $filter->greaterThanEquals(100);
$request->setFilter($filter);

$result = $request->Get();

echo $twig->render('get-contacts.html', array("data" => json_encode(json_decode($result), JSON_PRETTY_PRINT)));