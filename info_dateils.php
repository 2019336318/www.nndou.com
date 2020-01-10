<?php
include 'header.php';
$sql = 'SELECT `ban_url` FROM `nnd_banner` WHERE `ban_type`=2';
$loop_arr = msq($conn, $sql);
$page = $_GET['info'];
// pre($page);
$where = "WHERE info_id={$page}";
$info_dateils= select_all('info','*',$where);
// pre($info_dateils);
include 'views/info.html';
include 'footer.php';