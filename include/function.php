<?php



function pre($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

function dump($arr)
{
    echo '<pre>';
    var_dump($arr);
    echo '</pre>';
}

function conn($dbname)
{
    global $conn;
    $host = 'localhost';
    $user = 'root';
    $pwd = '123456';
    // $dbname = 'msg_board';
    $conn = mysqli_connect($host, $user, $pwd, $dbname);
    if (!$conn) {
        die('no');
    }
    mysqli_set_charset($conn, 'utf8');
    return $conn;
}

function msq($conn, $sql)
{
    $msg = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_assoc($msg)) {
        $msg_arr[] = $res;
    }
    return $msg_arr;
}

function select_all($table, $ele = '*', $con = '')
{
    global $conn;
    $sql = "SELECT {$ele} FROM nnd_{$table} {$con}";
    $info = mysqli_query($conn, $sql);
    while ($res = mysqli_fetch_array($info)) {
        $res_arr[] = $res;
    }
    if (isset($res_arr)) {
        return $res_arr;
    } else {
        return '无记录';
    }
}

function select_one($table, $ele = '*', $con = '')
{
    global $conn;
    $sql = "SELECT  {$ele}  FROM nnd_{$table} {$con}";
    // pre($sql);
    $info = mysqli_query($conn, $sql);
    return  mysqli_fetch_array($info);
}

function page($current, $count, $limit, $size, $class = 'mypage')
{
    // echo $current, $count, $limit, $size;
    $str = "";
    if ($count > $limit) { //如果数据大于每页限制条数就分页
        $str .= "<div class='{$class}'><ul>";
        $pages = ceil($count / $limit);
        // 上一页
        if ($current == 1) {
            $str .= " <li class='prev'>&lt;</li>";
        } else {
            $str .= " <li class='prev'><a href='?page=" . ($current - 1) . "'>&lt;</a></li>";
        }


        if ($current <= floor($size / 2)) {
            $start = 1;
            $end = $pages > $size ? $size : $pages;
        } else if ($current > $pages -  floor($size / 2)) {
            $start = ($pages - $size + 1 < 1) ? 1 : $pages - $size + 1;
            $end = $pages;
        } else {
            $start = $current - floor($size / 2);
            $end = $current + floor($size / 2);
        }
        for ($i = $start; $i <= $end; $i++) {
            if ($i == $current) {
                $str .= "<li class='active'><a>$i</a><li>";
            } else {
                $str .= "<li><a href='?page={$i}'>$i</a><li>";
            }
        }

        //  下一页
        if ($current == ceil($count / $limit)) {
            $str .= " <li class='next'>&gt;</li>";
        } else {
            $str .= " <li class='next'><a href='?page=" . ($current + 1) . "'>&gt;</a></li>";
        }


        $str .= "<ul></div>";
        return $str;
    }
}
// dump($msg);
