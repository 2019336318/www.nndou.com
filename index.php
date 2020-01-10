<?php
include 'header.php';

$sql = 'SELECT `ban_url` FROM `nnd_banner` WHERE `ban_type`=1';
$loop_arr = msq($conn, $sql);
// pre($loop_arr);

// $sql = "SELECT * FROM `nnd_serv_type` ";
// $where="LIMIT";
$serv_arr = select_all('serv_type');
// pre($serv_arr);
$where='LIMIT 6 ';
$case_arr = select_all('case','*',$where);
// pre($case_arr);
$slogan_arr = select_all('slogan');
// pre($slogan_arr);

// mysqli_close($conn);


include 'views/index.html';

include 'footer.php';


// echo $_SERVER['PHP_SELF'];
// pre($_SERVER);
// echo $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$url = $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    // define();
