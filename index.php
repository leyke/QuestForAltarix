<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 30.11.2016
 * Time: 15:41
 */
require("classWSDLRequestSender.php");
$WSDLRequestSender = new WSDLRequestSender();
$lastCheck = $WSDLRequestSender->select(null,1);

function render($view, $params = array())
{
    foreach ($params as $name => $values)
        $$name = $values;

    require('/views/' . $view . '.php');
}
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Test For Altarix</title>
        <link href="/css/main.css" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="/resources/js.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script>
            $( function() {
                $( "#datepickerS" ).datepicker();
                $( "#datepickerE" ).datepicker();
            } );
        </script>
	</head>

	<body>
	    <table class="main-table">
	    	<tr>
	    		<td><p>Date Start: <input type="text" id="datepickerS"> <span> ... </span> Date End: <input type="text" id="datepickerE"></p></td>
	    		<td class="align-left">Last check:<a style="color:<?=($lastCheck['check_result'] == 0)?"Green":"Red"?>"><?=($lastCheck['check_result'] == 0)?"OK":"FAIL"?></a></td>
            </tr>

            <tr>
                <td>
                    <?php render('table', array("data"=>$WSDLRequestSender->select(),"lastCheck"=>$lastCheck));?>
                </td>
                <td style="vertical-align: top">
                    <?php render('responseGroup', array("lastCheck"=>$lastCheck));?>
                </td>
            </tr>
        </table>
    </body>
</html>
