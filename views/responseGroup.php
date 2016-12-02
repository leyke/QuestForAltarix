<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 01.12.2016
 * Time: 4:28
 */

$data = (isset($data))? $data: null;
if ($data['check_result'] == 0) {$checkResult = "OK";} else {$checkResult = "FAIL";}
?>
<div class="align-left">
    <label class="response-Group-label">Group</label>
    <div class="response-Group">
        <?php
            echo "<p>Дата запроса: " . $data['request_time'] . "</p>";
            echo "<p>Дата ответа: " . $data['response_time'] . "</p>";
            echo "<p>Время ожидания: ". ($data['ping']/1000). " c ( " . $data['ping'] . " мс )</p>";
            echo "<p>Результат проверки: ". $checkResult . "</p>";
        if ($data['check_result'] != 0){
            echo "<div class='response-body'><p>Тело ответа:</p>";
               print_r(unserialize($data['fail_result_body']));
            echo "</div>";}
        ?>
    </div>
</div>