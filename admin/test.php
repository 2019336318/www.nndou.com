<?php
if (!isset($_COOKIE['login']) || $_COOKIE['login'] != 1) {
    // echo 'no';
    echo "<script>alert(\"未登录,请登录\");location.href=\"login.php\"</script>";
    exit;
}
