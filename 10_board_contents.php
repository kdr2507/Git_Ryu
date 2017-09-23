<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-21
 * Time: 오전 11:02
 */

//게시판 번호
@$select = $_GET['select'];
@$now_user = $_SESSION['id'];
//댓글 정보 저장
@$comment_array = null;
//DB검색
@$db_select = mysql_connect('localhost', 'root', 'autoset');
if(mysql_select_db('my_first_board', $db_select)){
    $table_select = "select * from ycj_board where board_id = $select";
    $table_comment_select = "select * from ycj_board where board_pid = $select";
    if($result = mysql_query($table_select)){
        $board_contents = mysql_fetch_row($result);

        if(@$_COOKIE[$select] == null){
            setcookie($select, $select);
            $board_contents[6]++;
            @$db_update = "UPDATE ycj_board SET hits = $board_contents[6] WHERE board_id = $select";
            mysql_query($db_update);
        }

    }
    if($comment_result = mysql_query($table_comment_select)){
        for($i = 0; $i<mysql_num_rows($comment_result); $i++){
            $board_contents_comment = mysql_fetch_row($comment_result);

            echo "<script>
            if('$select' == '$board_contents_comment[1]')
                var comment = document.getElementById('comment');
                var tr = document.createElement('tr');
                var td = document.createElement('td');
                td.innerHTML = '$board_contents_comment[2]'
                tr.appendChild(td);
                td = document.createElement('td');
                td.innerHTML = '$board_contents_comment[5]';
                tr.appendChild(td);
                comment.appendChild(tr);
               
            </script>";
        }
    }
}

echo "
<div class='container theme-showcase'>
<h5 align='right'>
    <span>No</span>
    <span>'$board_contents[0]'</span>
    <span>ID</span>
    <span>'$board_contents[2]'</span>
    <span>조회수</span>
    <span>'$board_contents[6]'</span>
    <span>최종 수정일</span>
    <span>'$board_contents[7]'</span>
    </h5>
    
";
echo "<table>
<tr>
<td colspan='2'></td><td><h1>$board_contents[4]</h1></td>
</tr>
</table>
<hr>
<div style='width: 100%; height: 60%;'>$board_contents[5]</div>
<hr>

<table width='100%'>
<tr><td style='width: 10%;'>ID</td><td style='width: 80%;'></td><td style='width: 5%;'></td><td style='width: 5%;'></td></tr>
<tbody id='comment'>

</tbody>
</table>
";
if(mysql_select_db('my_first_board', $db_select)){

    $table_comment_select = "select * from ycj_board where board_pid = $select";

    if($comment_result = mysql_query($table_comment_select)){
        for($i = 0; $i<mysql_num_rows($comment_result); $i++){
            $board_contents_comment = mysql_fetch_row($comment_result);

            echo "<script>
            function update(what) {
                var con = prompt('수정할 내용을 입력하시오');
                if(con != null){
                window.open('http://192.168.56.1:8080/10_Board_wds.php?type='+'수정'+'&what='+what+'&con='+con,'','menubar=1');
                window.location.reload();
                }else{
                    alert('댓글을 입력하세요');
                }
            }
            function del(what) {
                 window.open('http://192.168.56.1:8080/10_Board_wds.php?type='+'삭제'+'&what='+what,'','menubar=1');
                 window.location.reload();
            }

            if('$select' == '$board_contents_comment[1]'){
                var comment = document.getElementById('comment');
                var tr = document.createElement('tr');
                var td = document.createElement('td');

                td.innerHTML = '$board_contents_comment[2]'
                tr.appendChild(td);
                td = document.createElement('td');
                td.innerHTML = '$board_contents_comment[5]';
                tr.appendChild(td);
                if('$now_user' == '$board_contents_comment[2]'){
                    var input = document.createElement('input');
                    td = document.createElement('td');
                    input.type = 'button';
                    input.value = '수정';
                    input.setAttribute('onclick', 'update($board_contents_comment[0])');
                    td.appendChild(input);
                    
                    tr.appendChild(td);
                    input = document.createElement('input');
                    td = document.createElement('td');
                    input.setAttribute('onclick', 'del($board_contents_comment[0])');
                    input.type = 'button';
                    input.value = '삭제';
                    
                    td.appendChild(input);
                    tr.appendChild(td);
                                        
                }
                    comment.appendChild(tr);
               }
            </script>";
        }
    }
}
if(@$_SESSION['id'] != null){
    echo "<hr>";
    echo "
<form action='10_Board_wds.php' method='post'>
    <table  style='width: 100%'>
    <tr>
    <td align='center' style='width: 10%;'>$now_user</td>
    <td style='width: 80%;'><textarea name='content' style='width: 100%;'></textarea></td>
    <td style='width: 10%;'><input type='submit' name='select' value='댓글 달기'><input type='hidden' name='comment_board' value='$board_contents[0]'></td>
    </tr>
    </table>
</form>

</div>
";
}

?>