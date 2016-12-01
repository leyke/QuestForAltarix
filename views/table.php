<div class="db-table">
	<table border="1">
		<tr class='fixed'>
			<td>Date</td>
			<td>Ping</td>
			<td>Status</td>
		</tr>
		<tr class="overlow">
			<?php
			foreach ($data as $row){
				echo "<tr id='".  $row['response_id'] ."'>";
				echo	"<td>" . $row['request_time'] . "</td>";
				echo	"<td>" . $row['ping'] . "</td>";
				echo	"<td><img src='/img/checkStatus" . $row['check_result'] . ".png'></td>";
				echo "</tr>";
			}
			?>
		</tr>
	</table>
</div>



