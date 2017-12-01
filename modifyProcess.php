<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-10-27
 * Time: 오후 1:57
 */
//유저정보 수정
$searchid = $_POST['search_id'];
$userid = $_POST['userid'];
$name = $_POST['name'];
$password = $_POST['password'];
$classification = $_POST['classification'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];

class Updata_user_info{
    const DB_NAME = 'midtermexam';
    const TABLE_NAME = 'userinfo';
    const DB_SERVER = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PW = 'autoset';

    public $searchid;
    public $userid;
    public $name;
    public $password;
    public $classification;
    public $gender;
    public $phone;
    public $email;

    function __construct($searchid,$userid, $name, $password, $classification, $gender, $phone, $email)
    {
        $this->searchid = $searchid;
        $this->userid=$userid;
        $this->name=$name;
        $this->password=$password;
        $this->classification=$classification;
        $this->gender=$gender;
        $this->phone=$phone;
        $this->email=$email;
    }


    //유저정보 수정
    function user_Update(){

        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);
        if(mysql_select_db(self::DB_NAME, $db_connect)) {
            $db_update = "UPDATE ".self::TABLE_NAME.
                " SET userid='".$this->userid.
                "', name='".$this->name.
                "', password='".$this->password.
                "', classification='".$this->classification.
                "', gender='".$this->gender.
                "', phone='".$this->phone.
                "', email='".$this->email.
                "' where userid='".$this->searchid."'";

            mysql_query($db_update);
        }
        echo "<script>
                    alert('수정이 완료되었습니다.');
                    location.href = 'main.html';
                </script>";
    }

}
//sdfskdfl
$update_user_info = new Updata_user_info($searchid,$userid, $name,$password,$classification,$gender,$phone,$email);
$update_user_info->user_Update();
?>

