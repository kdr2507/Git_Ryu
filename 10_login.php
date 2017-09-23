<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-12
 * Time: 오후 9:38
 */

function logcheck($id, $pw){

    if($id != null && $pw != null) {
        @$db_select = mysql_connect('localhost', 'root', 'autoset');

        if (mysql_select_db('my_first_board', $db_select)) {
            $user_find = "select * from user_info";
            if ($result = mysql_query($user_find)) {
                for ($i = 0; $i < mysql_num_rows($result); $i++) {
                    $user_check = mysql_fetch_row($result);
                    if ($id == $user_check[0] && $pw == $user_check[1]) {

                        $find = 1;
                        $_SESSION['find'] = $find;
                        $_SESSION['id'] = $user_check[0];
                        $_SESSION['name'] = $user_check[2];
                        $_SESSION['level'] = $user_check[3];
                        $_SESSION['age'] = $user_check[4];
                        return $find . "," . $user_check[0] . "," . $user_check[2] . "," . $user_check[3] . "," . $user_check[4];


                        break;
                    } else {
                        $find = 0;
                        $_SESSION['find'] = $find;
                    }
                }
            } else {
                echo "0,존재 하지 않음";
            };

        } else {

        };
    }else{

    }
}

if(@$_SESSION['id'] == null){

    @$ID = $_GET['ID'];
    @$PW = $_GET['password'];


    echo logcheck($ID, $PW);

}else if(@$_SESSION['id'] != null){
    @$logout = $_GET['logout'];

    if($logout == '로그아웃') {
        session_destroy();
        session_unset();
        echo ("<script>location.href='http://192.168.56.1:8080/10_board_main.html'</script>");
    }else if($logout == null){
        echo $_SESSION['find'].",".$_SESSION['id'].",".$_SESSION['name'].",".$_SESSION['level'].",".$_SESSION['age'];
    }

}
