<?php

//////////////////////////////////////////////////////////////////////////
////// To include the library using composer, replace the line:    ///////
//////    include_once(__DIR__ . '/../../ApiClient/includes.php'); ///////
//////                                                             ///////
////// With the following line instead:                            ///////
//////    include_once('vendor/autoload.php');                     ///////
//////                                                             ///////
//////////////////////////////////////////////////////////////////////////
require_once('vendor/autoload.php');
include_once(__DIR__ . '/config.php');

$loader = new Twig_Loader_Filesystem(__DIR__ . '/../page-templates');
$twig = new Twig_Environment($loader, array(
    'cache' => 'cache',
));