<?php
if (!isset($_COOKIE['login']) && $_COOKIE['login'] != 1) {
    // echo 'no';
    echo "<script>alert(\"爬\");location.href=\"login.php\"</script>";
    exit;
}
