<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-10-27
 * Time: 오후 12:47
 */

//회원정보 등록
@$userid = $_POST['userid'];
@$username = $_POST['username'];
@$userpassword = $_POST['userpassword'];
@$classification = $_POST['classification'];
@$gender = $_POST['gender'];
@$phone = $_POST['phone'];
@$email = $_POST['email'];

class DB{

    const DB_NAME = 'midtermexam';
    const TABLE_NAME = 'userinfo';
    const DB_SERVER = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PW = 'autoset';

    public $userid;
    public $username;
    public $userpassword;
    public $classification;
    public $gender;
    public $phone;
    public $email;

    public function __construct($userid, $username, $userpassword, $classification, $gender, $phone, $email)
    {
        $this->userid = $userid;
        $this->username = $username;
        $this->userpassword = $userpassword;
        $this->classification = $classification;
        $this->gender = $gender;
        $this->phone=$phone;
        $this->email=$email;
    }

    public function user_insert_test(){

        $ToF= true;//빈공간이 있는지를 검사
        $user_info_null_test = array();

        if($this->userid == null){
            array_push($user_info_null_test, 'userid');
        }
        if($this->username == null){
            array_push($user_info_null_test, 'username');
        }
        if($this->userpassword == null){
            array_push($user_info_null_test, 'userpassword');
        }
        if($this->classification == null){
            array_push($user_info_null_test, 'classification');
        }
        if($this->gender == null){
            array_push($user_info_null_test, 'gender');
        }
        if($this->phone == null){
            array_push($user_info_null_test, 'phone');
        }
        if($this->email == null){
            array_push($user_info_null_test, 'email');
        }

        //입력하지 않은 항목 출력
        for($i = 0; $i<sizeof($user_info_null_test); $i++){
            echo $user_info_null_test[$i]."<br>";
        }

        for($i = 0; $i<sizeof($user_info_null_test); $i++){
            if($user_info_null_test[$i] == null){
                $ToF = true;
            }else{
                $ToF = false;
                break;
            }
        }

        return $ToF;

    }

    public function user_insert(){
        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);
        if(mysql_select_db(self::DB_NAME, $db_connect)){
            $db_insert = "insert into ".self::TABLE_NAME."(userid, classification, name, gender, password, phone, email) values ('".
                $this->userid."', '".
                $this->classification."','".
                $this->username."','".
                $this->gender."','".
                $this->userpassword."','".
                $this->phone."','".
                $this->email."');";

            mysql_query($db_insert);
        }
    }
}

$db = new DB($userid, $username, $userpassword, $classification, $gender, $phone, $email);
if($db->user_insert_test() == true){
    $db->user_insert();
    echo "success";
}else{
    echo $db->user_insert_test();
}
?>