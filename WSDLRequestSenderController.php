<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 02.12.2016
 * Time: 18:11
 */

require_once("classWSDLRequestSender.php");

$WSDLRequestSender = new WSDLRequestSender();
$curDate = date("d.m.Y");

function render($view, $params = array())
{
    foreach ($params as $name => $values)
        $$name = $values;

    require('/views/' . $view . '.php');
}

function toDate ($str){
    if (($timestamp = strtotime($str)) === false) {
        echo ($str) . " недопустима";
    } else {
        $str = date('d.m.Y', $timestamp);
    }
    return $str;
}

$action = (isset($_REQUEST['action']))? ($_REQUEST['action']): null;
switch ($action) {
    case "table":
        $filter= ([
            "dateS" => (isset($_REQUEST['dateS']))? $_REQUEST['dateS'] : $curDate,
            "dateE" => (isset($_REQUEST['dateE']))? $_REQUEST['dateE'] : $curDate,
        ]);

        $data = (isset($data))? $data: null;
        $data = (isset($_REQUEST['Data']))? unserialize($_REQUEST['Data']) : $data;

        render('table', array("data"=>$data,"filter"=>$filter));
        break;
    case "responseGroup":
        $response_id = (isset($_REQUEST['elemId']))? $_REQUEST['elemId']: null;
        $data = $WSDLRequestSender->select($response_id,null);
        render('responseGroup', array("data"=>$data));
        break;
    default:
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
        break;
}