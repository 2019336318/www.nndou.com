<?php
include 'config.php';


function pre($arr)
{
    echo '<pre style="width:70%;margin:0 auto;text-align:;">';
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
        die('连接失败');
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
    // pre($sql);
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


// 更新
function update($table, $update_arr, $con)
{
    global $conn;
    $set = '';
    foreach ($update_arr as $k => $v) {
        $set .= "`$k`='$v',";
    }
    $set = rtrim($set, ',');
    //  pre($set);
    $sql =  "UPDATE {$table} SET {$set} {$con}";
    //  pre($sql);
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $ins['code'] = 1;
    } else {
        $ins['code'] = 0;
    }
    return $ins;
}
// 删除
function delete($table, $con)
{
    global $conn;
    $sql =  "DELETE FROM {$table} {$con}";
    pre($sql);
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $del['code'] = 1;
    } else {
        $del['code'] = 0;
    }
    return $del;
}
// 添加
function insert($table, $upload_arr)
{
    global $conn;
    $key = '';
    $value = '';
    foreach ($upload_arr as $k => $v) {
        $key .= "`$k`,";
        $value .= "'$v',";
    }
    $key = rtrim($key, ',');
    $value = rtrim($value, ',');

    $sql = "INSERT INTO $table ($key) VALUES ($value)";
    pre($sql);
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $ins['code'] = 1;
    } else {
        $ins['code'] = 0;
    }
    return $ins;
}

// 分页
function page($current, $count, $limit, $size, $class = 'mypage')
{
    // echo $current, $count, $limit, $size;
    global $type;
    $str = "";
    if ($count > $limit) { //如果数据大于每页限制条数就分页
        $str .= "<div class='pull-right'><ul class='pagination'>";
        $pages = ceil($count / $limit);
        // 上一页
        if ($current == 1) {
            // $str .= " <li class='prev'>&lt;</li>";
        } else {
            $str .= " <li class='prev'><a href='?type={$type}&page=" . (1) . "'>&lt;&lt;</a></li>";
            $str .= " <li class='prev'><a href='?type={$type}&page=" . ($current - 1) . "'>&lt;</a></li>";
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
                $str .= "<li><a href='?type={$type}&page={$i}'>$i</a><li>";
            }
        }

        //  下一页
        if ($current == ceil($count / $limit)) {
            // $str .= " <li class='next'>&gt;</li>";
        } else {
            $str .= " <li class='next'><a href='?type={$type}&page=" . ($current + 1) . "'>&gt;</a></li>";
            $str .= " <li class='next'><a href='?type={$type}&page=" . ($pages) . "'>&gt;&gt;</a></li>";
        }

        //     $str .='<form action="" method="get">
        //     <input type="text" name="page">
        //     <button> 跳转</button>
        //   </form>';

        $str .= "<ul></div>";
        return $str;
    }
}

function get_url()
{
    $url = $_SERVER['PHP_SELF'] . '?';
    if ($_GET) {
        foreach ($_GET as $k => $v) {
            if ($v != $k) {
                $url .= "{$k}={$v}&";
            }
        }
    }
    return $url;
}
function upload($name, $file_dir = 'uploads/news')
{

    $up_info = [];

    if ($_FILES[$name]['error'] > 0) {
        switch ($_FILES[$name]['error']) {
            case 1:
                return "文件大小超出upload_max_filesize指令指定的值";
                break;
            case 2:
                return "文件大小超出MAX_FILE_SIZE指令（可能嵌入在HTML表单中）指定的值";
                break;
            case 3:
                return "文件没有完全上传，则返回3;";
                break;
            case 4:
                return "没有指定上传的文件就提交表单，则返回4";
                break;

            default:
                return "未知错误";
        }
    }

    $uploads = $file_dir;
    if (!is_dir($uploads)) {
        mkdir($uploads, 0755, TRUE);
    }
    // pre($uploads);
    // $filename = $_FILES[$name]['name'];
    $type = $_FILES[$name]['type'];
    // pre($type);
    $suffix = substr($type, strrpos($type, '/') + 1);
    // pre($suffix);

    $allows = array('jpeg', 'jpg', 'png', 'gif');

    if (!in_array($suffix, $allows)) {
        return "不允许上传{$suffix}";
    }

    $new_name = date("YmdHis") . mt_rand(100, 999) . '.' . $suffix;
    // pre($new_name);

    $path = $uploads . '/' . $new_name;
    // pre($_FILES[$name]);
    // pre($_FILES[$name]['tmp_name']);
    // pre($path);
    if (move_uploaded_file($_FILES[$name]['tmp_name'], $path)) {
        $up_info['path'] = $path;
        $up_info['code'] = 1;
        $up_info['msg'] = '上传成功';
        $up_info['filename']=$new_name;
        return $up_info;
        // }
    } else {
        $up_info['code'] = 0;
        $up_info['msg'] = '上传失败';
        return $up_info;
    }
}


// 图片路径 略缩宽 略缩高 路径 文件名
// function thumb($img_addr, $width, $hight, $path = 'uploads/thumb/', $filename = '')
// {
// 	list($w, $h, $type) = getimagesize($img_addr);
// 	// var_dump($type);die;

// 	$types = [
// 		1 => 'gif',
// 		2 => 'jpeg',
// 		3 => 'png'
// 	];
// 	// var_dump($types[$type]);die;


// 	$desc_str = "imagecreatefrom" . $types[$type];
// 	$desc_img = $desc_str($img_addr);

// 	$img_new = imagecreatetruecolor($width, $hight);

// 	imagecopyresized($img_new, $desc_img, 0, 0, 0, 0, $width, $hight, $w, $h);

// 	header("Content-Type:image/" . $types[$type] . "");
// 	$show_img = "image{$types[$type]}";
// 	$show_img($img_new);
// 	// $show_img($img_new, "uploads/thumb/thumb_".rand().".$types[$type]");
// 	// imagepng($img_new); //输出
// 	// imagepng($img_new,"thumb_hahah.$types[$type]"); //保存

// 	//8. 释放内存
// 	imagedestroy($img_new);
// }


	/**
	 * 缩略图
	 * @param $img_addr         [原图路径]
	 * @param $width            [缩略图宽度]
	 * @param $hight            [缩略图高度]
	 * @param string $path      [存储目录]
	 * @param string $filename  [原图文件名]
	 * @return string           [缩略图路径]
	 */
	function thumb($img_addr,$width,$hight,$path='',$filename=''){
		list($w,$h,$type) = getimagesize($img_addr);

		$types = [
			1 => 'gif',
			2 => 'jpeg',
			3 => 'png'
		];
		$desc_str = "imagecreatefrom".$types[$type];
		$desc_img = $desc_str($img_addr);
        
        // 创造一个画布(彩色)
		$img_new = imagecreatetruecolor($width,$hight);

		//imagecolorallocate 为一幅图像分配颜色
		$white = imagecolorallocate($img_new,255,255,255);
		//imagecolorallocate 为一幅图像分配颜色 + alpha(透明度)
		//$white = imagecolorallocatealpha($img_new,255,255,255,100);

		//区域填充
		imagefill($img_new,0,0,$white);

		imagecopyresized($img_new,$desc_img,0,0,0,0,$width,$hight,$w,$h);


		//后缀
		$suffix = $types[$type];

//		header("Content-Type:image/{$suffix}");

		$filename = 'thumb_'.$filename;

		$thumb = $path.'/'.$filename;

		$save = "image".$types[$type];
		$save($img_new,$thumb); //保存
		//$save($img_new); //输出

		//8. 释放内存
		imagedestroy($img_new);

		return $thumb;
    }
    
    function watermark($img_addr, $str = '', $filename = '',$path='')
{

    list($w, $h, $type) = getimagesize($img_addr);

    $types = [
        1 => 'gif',
        2 => 'jpeg',
        3 => 'png'
    ];
    // 变量函数
    $createimg = "imagecreatefrom" . $types[$type];
    // 原图
    $img = $createimg($img_addr);
    // 分配颜色
    $white = imagecolorallocate($img, 0, 255, 255);
    $black = imagecolorallocate($img, 0, 0, 0);
    $red = imagecolorallocate($img, 255, 0, 0);

    // for($i=0;$i<1000;$i++){
    //     imageline($img,$w/2,$h/2,rand(0,$w),rand(0,$h),$red);
    // }

    // imageline($img,0,0,rand(0,500),rand(0,500),$red);
    // $x=200;
    $font_w = strlen($str) * imagefontwidth(50);
    // echo $w;
    // $y = 200;


    for ($x = 0; $x <= $w; $x += ($font_w+50)) {
        for ($y = 0; $y < $h; $y += 250) {
            imagettftext($img, 50, 45, $x, $y, $red, 'font/FZSTK.TTF', $str);
        }
        // $x += $logoWidth; 
        //  imagettftext($img,50,0,$i,$y,$red,'font/FZSTK.TTF',$str);
    }

    // echo $i;
    // imagestring($img,7,$x,$y,$str,$red);
    // imagettftext($img,50,0,$x,$y,$red,'font/FZSTK.TTF',$str);
    // 保存输出
    // $suffix = $types[$type];

    // header("Content-Type:image/{$types[$type]}");
    $save = "image" . $types[$type];

    if ($filename == '') {
        $filename = date("YmdHis");
    }
    if($path == ''){
        if(!file_exists('uploads/water')){
            mkdir('uploads/water',0777,TRUE);
        }

        $path = 'uploads/water/'.$filename;

    }else{
        
        if(!file_exists($path)){
            mkdir($path,0777,TRUE);
        }

        $path = $path.'/'.$filename;
    }
    
    $save($img,$path);
    // $save($img);

    imagedestroy($img);
    return $path;
}

// echo code();
// dump($msg);
