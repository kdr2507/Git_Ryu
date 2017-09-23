<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-09-14
 * Time: 오후 3:28
 */
@$Select = $_GET['select'];
@$Search_result = $_GET['search_result'];
@$Search_type = $_GET['search'];
$list = null;
$Page_nation = 10;
$Page = ($Select-1) * 10;
@$db_select = mysql_connect('localhost', 'root', 'autoset');

//if($Search_type == 'default' && $Search_result == 'default'){//숫자만 들어갈수 있다.
    if (mysql_select_db('my_first_board', $db_select)) {

        if($Search_result == 'default' && $Search_type == 'default') {
            $db_list = "select * from ycj_board where board_pid = 0 ORDER BY board_id DESC limit $Page, $Page_nation";
        }else if ($Search_type == 'default' && $Search_result != null){

            $db_list = "select * from ycj_board where (user_id LIKE '%$Search_result%' OR subject LIKE '%$Search_result%' OR contents LIKE '%$Search_result%') AND board_pid = 0 ORDER BY board_id DESC limit $Page, $Page_nation";

        }else{
            $db_list = "select * from ycj_board where board_pid = 0 AND $Search_type LIKE '%$Search_result%' ORDER BY board_id DESC limit $Page, $Page_nation";
        }

        if ($list_result = mysql_query($db_list)) {

            if($Search_result == 'default' && $Search_type == 'default') {
                $list_count = mysql_num_rows(mysql_query("select * from ycj_board WHERE board_pid = 0"));
            }else if ($Search_type == 'default' && $Search_result != null){

                $list_count = mysql_num_rows(mysql_query("select * from ycj_board where board_pid = 0 and (user_id LIKE '%$Search_result%' OR subject LIKE '%$Search_result%' OR contents LIKE '%$Search_result%') AND board_pid = 0"));

            }else{
                $list_count = mysql_num_rows(mysql_query("select * from ycj_board where board_pid = 0 AND $Search_type LIKE '%$Search_result%'"));
            }

            for ($i = 0; $i <$Page_nation; $i++) {
                $list_check = mysql_fetch_row($list_result);
                for($j = 0; $j<=mysql_num_fields($list_result); $j++){
                    if($j == mysql_num_fields($list_result)){
                        $list[$i][$j] = $list_count;
                    }else {
                        $list[$i][$j] = $list_check[$j];
                    }
                }
            }
            echo json_encode($list);
        }
  //  }
}

?>