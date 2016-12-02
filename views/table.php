<?php

$filter= ([
	"dateS" => (isset($_REQUEST['dateS']))? $_REQUEST['dateS'] : $curDate,
	"dateE" => (isset($_REQUEST['dateE']))? $_REQUEST['dateE'] : $curDate,
]);
$data = (isset($data))? $data: null;
$data = (isset($_REQUEST['Data']))? unserialize($_REQUEST['Data']) : $data;

function toDate ($str){
	if (($timestamp = strtotime($str)) === false) {
		echo ($str) . " недопустима";
	} else {
		$str = date('d.m.Y', $timestamp);
	}
	return $str;
}
?>

<div class="db-table">
	<table border="1">
		<tr class='fixed'>
			<td>Date</td>
			<td>Ping</td>
			<td>Status</td>
		</tr>
		<tr>
			<?php
				if ($data){
					foreach ($data as $row){
						$date=toDate($row['request_time']);
						if($date >= $filter['dateS'] and $date <= $filter['dateE']){
							echo "<tr id='".  $row['response_id'] ."' class='row' onclick='responseGroup(this)'>";
							echo	"<td>" . $row['request_time'] . "</td>";
							echo	"<td>" . $row['ping'] . "</td>";
							echo	"<td><img src='/img/checkStatus" . $row['check_result'] . ".png'></td>";
							echo "</tr>";
						}
					}
				} else {
					echo "<h1>DATA NOT FOUND</h1>";
				}
			?>
		</tr>
	</table>
</div>


