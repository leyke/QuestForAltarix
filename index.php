<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 30.11.2016
 * Time: 15:41
 */
require("classWSDLRequestSender.php");
$WSDLRequestSender = new WSDLRequestSender();

$curDate = date("d.m.Y");
function render($view, $params = array())
{
    foreach ($params as $name => $values)
        $$name = $values;

    require('/views/' . $view . '.php');
}

render('main', array("data"=>$WSDLRequestSender->select(),"curDate"=>$curDate,"lastCheck"=>$WSDLRequestSender->select(null,1)));
