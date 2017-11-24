<?php
/**
 * Created by PhpStorm.
 * User: ehfle
 * Date: 2017-11-02
 * Time: 오후 7:41
 */

//회원 리스트 출력, 페이지네이션
@$nowpage = $_GET['nowpage'];
class DB{

    private $nowpage;

    const DB_NAME = 'midtermexam';
    const TABLE_NAME = 'userinfo';
    const DB_SERVER = 'localhost';
    const DB_USERNAME = 'root';
    const DB_PW = 'autoset';

    function __construct($nowpage)
    {
        $this->nowpage = $nowpage;
    }

    function memberlist(){
        @$db_connect = mysql_connect(self::DB_SERVER, self::DB_USERNAME, self::DB_PW);
        if(mysql_select_db(self::DB_NAME,$db_connect)) {
            $page_num = ($this->nowpage -1)*10;
            @$memberlist = "select * from " . self::TABLE_NAME;
            @$memberlist_print = "select * from " . self::TABLE_NAME." order by sysid DESC limit $page_num, 10";

            if($member_result_all = mysql_query($memberlist_print)){
                echo "<table border='1'>";
                //회원 리스트 출력
                for($i = 0; $i<mysql_num_rows($member_result_all); $i++){
                    $memberprint = mysql_fetch_row($member_result_all);
                    echo "<tr>";
                    for($j = 0; $j<mysql_num_fields($member_result_all); $j++){
                        echo "<td>$memberprint[$j]</td>";
                    }
                    echo "</tr>";
                }
            }

            if ($member_result = mysql_query($memberlist)) {

                //회원 총 인원수
                $page_number = mysql_num_rows($member_result);
                //회원수의 총 수를 10으로 나눴을때 몫
                $page_nation_number = (int)($page_number / 10);
                //페이지 네이션 시작 숫자
                if($this->nowpage%10 == 0){
                    $page_exception = $this->nowpage-1;
                    $page_nation_start_number = (int)($page_exception / 10) * 10 + 1;
                }else {
                    $page_nation_start_number = (int)($this->nowpage / 10) * 10 + 1;
                }
                //페이지 네이션 끝 숫자
                $page_nation_count = 10;
                if ((floor($page_nation_number / 10) * 10 < $this->nowpage) && ($this->nowpage <= ($page_nation_number + 1))) {
                    $page_nation_count = $page_nation_number % 10 + 1;
                }

                //페이지 네이션 출력

                echo "<tr><td align='center' colspan='8'>";
                if ($this->nowpage != 1) {
                    $backpage = $this->nowpage-1;
                    echo "<a href='Memberlist.php?nowpage=$backpage'>< </a>";
                }

                for ($i = $page_nation_start_number; $i < $page_nation_start_number + $page_nation_count; $i++) {
                    if($this->nowpage == $i){
                        echo "<a href='Memberlist.php?nowpage=$i'><b>$i </b></a>";
                    }else{
                        echo "<a href='Memberlist.php?nowpage=$i'>$i </a>";
                    }
                }

                if ($this->nowpage != $page_nation_number + 1) {
                    $nextpage = $this->nowpage+1;
                    echo "<a href='Memberlist.php?nowpage=$nextpage'>></a>";
                }
                echo "</td></tr></table>";
                echo "<br><a href='main.html'>돌아가기</a>";
            }
        }
    }
}
$db = new DB($nowpage);

$db->memberlist();

?>