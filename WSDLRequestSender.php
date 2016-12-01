<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 01.12.2016
 * Time: 0:28
 */
require_once("classWSDLRequestSender.php");

$WSDLRequestSender = new WSDLRequestSender();

$request_time = date("H:i:s d.m.Y");
$start = microtime(true);

$currentStatus = $WSDLRequestSender->request($WSDLRequestSender->wsdl,$WSDLRequestSender->params);

$ping = round((microtime(true) - $start)*1000);
$response_time = date("H:i:s d.m.Y");
echo "\n$ping \n\n";
var_dump($currentStatus);

$currentStatus = $WSDLRequestSender->check($currentStatus,$WSDLRequestSender->params);

var_dump($currentStatus);

$currentStatus= $WSDLRequestSender->save($request_time,$response_time,$ping,$currentStatus);

var_dump($currentStatus);

