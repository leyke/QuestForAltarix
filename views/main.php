<?php
/**
 * Created by PhpStorm.
 * User: Артём
 * Date: 02.12.2016
 * Time: 15:28
 */
$data = (isset($data))? $data : null;
$lastCheck = (isset($lastCheck))? $lastCheck : null;
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test For Altarix</title>
    <link href="/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/main.js"></script>
    <script type="text/javascript">
        function ajx(){
            var s = document.getElementById('datepickerS').value;
            var e = document.getElementById('datepickerE').value;
            var obj = $('#DateGetter').html();

            $.ajax({
                type: "POST",
                url: "./views/table.php",
                data: { dateS: s, dateE: e , Data: obj},
                success: function(html){
                    $(".db-table-wrap").html(html);
                }
            });
            return false;
        }

    </script>
</head>
    <body>
        <table class="main-table">
            <tr>
                <td><p>Date Start: <input name="dateS" type="text" id="datepickerS" value="<?=$curDate?>" oninput="return ajx()"> <span>-----------</span> Date End: <input name="dateE" type="text" id="datepickerE" value="<?=$curDate?>" oninput="return ajx()"></p></td>
                <td class="align-left">Last check:<?if ($lastCheck){?><a style="color:<?=($lastCheck['check_result'] == 0)?"Green":"Red"?>"><?=($lastCheck['check_result'] == 0)?"OK":"FAIL"?></a><?}else { echo "LAST CHECK ERROR";}?></td>
            </tr>

            <tr>
                <td>
                    <div hidden id="DateGetter"><?=serialize($data)?></div>
                    <div class="db-table-wrap">
                        <?php
                            render('table', array("data"=>$data,"curDate"=>$curDate));
                        ?>
                    </div>
                </td>
                <td style="vertical-align: top">
                    <input hidden id="responseIdGetter" name="responseIdGetter" value="<?=$lastCheck['response_id']?>>
                    <?php render('responseGroup', array("data"=>$WSDLRequestSender->select($_GET['responseIdGetter'])));?>
                </td>
            </tr>
        </table>
    </body>
</html>

