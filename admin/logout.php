<?php
include 'test.php';
include 'includes/function.php';
$conn = conn('nndou');
$user = $_COOKIE['username'];
// print_r($_COOKIE);
// die;
// $time = time();
$ip = $_SERVER['REMOTE_ADDR'];
$up_ad = [];
$up_ad['admin_name'] = $user;
$up_ad['admin_last_login'] = time();
$up_ad['admin_ip'] = $ip;
// pre($up_ad);
// die;
// echo date('ymd H:i:s');
$res = update('`nnd_admin`', $up_ad, "WHERE `admin_name` = '{$user}'");
// die;
if ($res) {
    echo '<script> alert("再见,' . $user . '用户");location.href="login.php"; </script>';
    foreach ($_COOKIE as $k => $v) {
        setcookie($k, '', time() - 1);
    }
} else {
    echo '<script> alert("再见失败,' . $user . '用户");location.href="index.php"; </script>';
}
