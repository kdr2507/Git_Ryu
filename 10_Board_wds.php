<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-19
 * Time: 오후 3:15
 */

@$select = $_POST['select'];
@$subject = $_POST['subject'];//제목
@$content = $_POST['content'];//내용
@$board_num = $_POST['board_no'];
@$comment_board = $_POST['comment_board'];

@$type = $_GET['type'];//댓글 수정,삭제 결정
@$what = $_GET['what'];//댓글의 번호
@$con = $_GET['con'];
$date = date('Y-m-d h:i:s');
@$id = $_SESSION['id'];
@$name = $_SESSION['name'];


@$db_select = mysql_connect('localhost', 'root', 'autoset');

//--------
@$db_insert = "insert into ycj_board (user_id, user_name, subject, contents, hits, rreg_date) VALUES ('$id', '$name', '$subject' ,'$content', 0, '$date')";
@$db_comment_insert = "insert into ycj_board (board_pid, user_id, user_name, contents, rreg_date) VALUES ($comment_board, '$id', '$name', '$content', '$date')";
@$db_delete = "delete from ycj_board where board_id = $what";
@$db_update = "UPDATE ycj_board SET contents = '$con', rreg_date = '$date' WHERE board_id = $what";
@$db_board_update = "UPDATE ycj_board SET subject = '$subject', contents = '$content', rreg_date = '$date' WHERE board_id = $board_num";
//-------

//echo "<script>window.location.reload();</script>";//윈도우 새로고침


if(mysql_select_db('my_first_board', $db_select)) {
    if ($type == '수정') {
        mysql_query($db_update);
        echo "<script>window.close()</script>";
    } else if ($type == '삭제') {
        mysql_query($db_delete);
        echo "<script>window.close()</script>";
    }
    if($select == '댓글 달기'){
        mysql_query(@$db_comment_insert);
        echo "<script>
                window.open('http://192.168.56.1:8080/10_board_contents.php?select='+'$comment_board','','menubar=1')
                window.close()</script>";
    }else if($select == '저장'){
        mysql_query(@$db_insert);
        echo "<script>window.close()</script>";
    }else if($select == '게시글수정'){
        mysql_query($db_board_update);
        echo "<script>
window.open('http://192.168.56.1:8080/10_board_contents.php?select='+'$board_num','','menubar=1')
               window.close()</script>";
    }

}
