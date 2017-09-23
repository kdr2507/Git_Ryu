<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-22
 * Time: 오후 4:06
 */

@$user_id = $_SESSION['id'];
$date = date('Y-m-d h:i:s');

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
?>