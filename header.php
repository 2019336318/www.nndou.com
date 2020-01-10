<?php
// 头部
include './include/conf.php';

include './include/function.php';


$conn = conn('nndou');
$sql = 'SELECT `nav_name`,`nav_url` FROM `nnd_nav` ';
$nav_arr = msq($conn, $sql);
// mysqli_close($conn);

$this_url = pathinfo($_SERVER['PHP_SELF'])['basename'];



include './views/header.html';

define('ACCESS',TRUE);

// dump(conn('nndou'));
// $conn = conn('nndou');
// $sql = 'SELECT `nav_name`,`nnd_url` FROM `nnd_nav` WHERE 1';
// $nav_arr=msq($conn,$sql);
// pre($nav_arr);
// echo ROOT.'<br>';
// echo CSS_DIR;
// echo IMG_DIR;
// pre($_SERVER);
