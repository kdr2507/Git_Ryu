<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-11-02
 * Time: 오후 12:05
 */
//회원 정보 삭제
@$userid = $_POST['userid'];
@$password = $_POST['password'];

class DB{
    public $userid;
    public $password;

    const DB_NAME = 'midtermexam';
    const TABLE_NAME = 'userinfo';
    const DB_SERVER = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PW = 'autoset';

    function __construct($userid, $password)
    {
        $this->userid = $userid;
        $this->password = $password;
    }

    function user_delete(){
        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);

        if(mysql_select_db(self::DB_NAME, $db_connect)){
            $user_delete = "delete from ".self::TABLE_NAME ." where userid= '$this->userid'";

            mysql_query($user_delete);
        }
    }

    function user_check()
    {

        $user_id_check = false;
        $user_pw_check = false;

        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);

        if (mysql_select_db(self::DB_NAME, $db_connect)) {
            $user_select = "select userid,password from ".self::TABLE_NAME." where userid = '$this->userid'";
            if ($select_result = mysql_query($user_select)) {
                $select_array = mysql_fetch_row($select_result);

                if ($select_array[0] == $this->userid) {
                    $user_id_check = true;
                }
                if ($select_array[1] == $this->password) {
                    $user_pw_check = true;
                }

                if ($user_id_check == true) {
                    if($user_pw_check == true){
                        $this->user_delete();
                        echo "<script>
                                alert('삭제되었습니다.');
                                location.href='main.html';
                                </script>";
                    }else if($user_pw_check == false){
                        echo "<script>
                                alert('암호가 일치하지 않습니다.');
                                location.href = 'delete.html';
                                </script>";
                    }
                } else if ($user_id_check == false) {
                    echo "<script>
                                alert('등록되지 않은 ID입니다.');
                                location.href = 'delete.html';
                           </script>";
                }
            }
        }

    }
}

$db = new DB($userid, $password);

$db->user_check();
?>