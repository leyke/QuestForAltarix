<?php
$data = (isset($data))? $data: null;
$filter = (isset($filter))? $filter: null;

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
					$date = toDate(substr($row['request_time'],8));
					if($date >= $filter['dateS'] and $$date <= $filter['dateE']){
						echo "<tr id='".  $row['response_id'] ."' class='row' onclick='responseGroup(this)'>";
						echo	"<td>" . $row['request_time'] . "</td>";
						echo	"<td>" . $row['ping'] . "</td>";
						echo	"<td><img src='/img/checkStatus" . $row['check_result'] . ".png'></td>";
						echo "</tr>";
					} else {
						"<h1>DATA NOT FOUND</h1>";
					}
				}
			} else {
				echo "<h1>DATA NOT FOUND</h1>";
			}
			?>
		</tr>
	</table>
</div>


