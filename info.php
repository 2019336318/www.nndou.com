<?php
include 'header.php';
$sql = 'SELECT `ban_url` FROM `nnd_banner` WHERE `ban_type`=2';
$loop_arr = msq($conn, $sql);
// pre($loop_arr);
// mysqli_close($conn);
// $limit=6;
// $where="ORDER BY `info_id` DESC LIMIT $limit";
$count_arr = select_one('info','COUNT(*) AS count');
$count = $count_arr['count'];
$current = (!empty($_GET['page']) && $_GET['page'] >0)? $_GET['page'] : 1;
// 限制条数
$limit = 5;
// 偏移量
$offset = ($current-1) * $limit;
// 显示页码个数
$size = 5;
// 总页数
$page_count = ceil($count/$limit);

$page = page($current,$count,$limit,$size,'mypage');
// echo $page;

// pre($page_count);
// pre($count);
// pre($page);
$info_arr=select_all('info','*' ,"ORDER BY info_id DESC LIMIT {$offset},{$limit}");

// pre($info_arr);
include 'views/news_center.html';

// echo $this_url;
// include 'footer.php';
