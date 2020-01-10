<?php
include 'header.php';
$sql = 'SELECT `ban_url` FROM `nnd_banner` WHERE `ban_type`=4';
$loop_arr = msq($conn, $sql);
// pre($loop_arr);
$where1 = "WHERE about_title_en!=''";
$about_arr = select_all('about','*',$where1);
// pre($about_arr);
$where2 = "WHERE about_title_en IS NULL ";
$about_arr1 = select_all('about','*',$where2);
// pre($about_arr1);

// mysqli_close($conn);
include 'views/about.html';
// echo $this_url;
include 'footer.php';
