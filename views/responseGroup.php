<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 01.12.2016
 * Time: 4:28
 */
?>
<div class="response-Group-wrap align-left">
    <label class="response-Group-label">Group</label>
        <div class="response-Group">
            <?
                echo "<p>Дата запроса:" . $lastCheck['request_time'] . "</p>";
                echo "<p>Дата ответа:" . $lastCheck['response_time'] . "</p>";
                echo "<p>Время ожидания:". ($lastCheck['ping']/1000). " c ( " . $lastCheck['ping'] . " мс )</p>";
                echo "<p>" . ($lastCheck['check_result'] == 0)?'Результат проверки: OK':'Результат проверки: FAIL' ."</p>";
                If ($lastCheck['check_result'] != 0){ echo "<p>Тело ответа:".  $lastCheck['fail_result_body'] ."</p>";}

            ?>
        </div>
</div>