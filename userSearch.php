<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-10-27
 * Time: 오후 3:07
 */
//회원 검색
$search_id = $_GET['search_id'];

class Updata_user_info{
    const DB_NAME = 'midtermexam';
    const TABLE_NAME = 'userinfo';
    const DB_SERVER = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PW = 'autoset';
    public $search_id;

    function __construct($search_id)
    {
        $this->search_id = $search_id;
    }

    function user_search(){

        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);
        if(mysql_select_db(self::DB_NAME, $db_connect)){
            $db_select = "select * from ".self::TABLE_NAME." where userid = '$this->search_id'";
            if($result = mysql_query($db_select)){
                for($i = 0; $i<mysql_num_rows($result); $i++){
                    $user_array[$i] = mysql_fetch_row($result);
                }
            }
            if(@sizeof($user_array) == 0) {
                echo false;
            }else{
                for($i =0; $i<mysql_num_fields($result); $i++){
                    echo $user_array[0][$i].",";
                }

            }
        }
    }

}

$update_user_info = new Updata_user_info($search_id);
$update_user_info->user_search();

?>