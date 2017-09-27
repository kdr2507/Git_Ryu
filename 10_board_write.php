<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-22
 * Time: 오후 4:06
 */

@$user_id = $_SESSION['id'];
@$what = $_GET['what'];
@$change_hide = $_GET['hide'];
$date = date('Y-m-d h:i:s');
if($what == 'write') {
    echo "<form action='10_Board_wds.php' method='post'>";
    echo "<table style='width: 100%;'>
<tr style='width: 100%;'>
<td style='width: 10%; '>제목</td><td style='width: 90%; '><input type='text' name='subject' style='width: 100%;'></td>
</tr>
<tr>
<td>내용</td>
</tr>
</table>";
    echo "<hr>";
    echo "<textarea style='width: 100%; height: 70%;' name='content'></textarea>";
    echo "<hr><input type='submit' name='select' value='저장'>";
    echo "</form>";
}else if($what = '게시글수정'){
    @$db_select = mysql_connect('localhost', 'root', 'autoset');
    if(mysql_select_db('my_first_board', $db_select)){
        $table_select = "select * from ycj_board where board_id = $change_hide";
        if($result = mysql_query($table_select)) {
            $board_contents = mysql_fetch_row($result);
        }
    }
    echo "<form action='10_Board_wds.php' method='post'>";
    echo "<table style='width: 100%;'>
<tr style='width: 100%;'>
<td style='width: 10%; '>제목</td><td style='width: 90%; '><input type='text' name='subject' value='$board_contents[4]' style='width: 100%;'>
<input type='hidden' name='board_no' value='$change_hide'>
</td>
</tr>
<tr>
<td>내용</td>
</tr>
</table>";
    echo "<hr>";
    echo "<textarea style='width: 100%; height: 70%;' name='content'>$board_contents[5]</textarea>";
    echo "<hr><input type='submit' name='select' value='게시글수정'>";
    echo "</form>";

}
?>
