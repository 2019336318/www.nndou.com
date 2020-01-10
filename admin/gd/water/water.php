<?php
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
    // $font_h = $font_w ;

    // echo $font_w;
    // die;
    // echo strlen($str);
    // echo imagefontwidth(50);
    // echo $font_h;

    // $y = 200;


    for ($x = 0; $x <= $w; $x += ($font_w+50)) {
        for ($y = 0; $y < $h; $y +=200) {
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

    header("Content-Type:image/{$types[$type]}");
    $save = "image" . $types[$type];

    if ($filename == '') {
        $filename = date("YmdHis");
    }
    if($path == ''){
        if(!file_exists('uploads/water')){
            mkdir('uploads/water',0777,TRUE);
        }

        $path = 'uploads/'.$filename;

    }else{
        
        if(!file_exists($path)){
            mkdir($path,0777,TRUE);
        }

        $path = $path.$filename;
    }
    
    // $save($img,$path);
    $save($img);

    imagedestroy($img);
    return $path;
}
watermark('20200107104709732.jpeg', 'HELLO','20200107104709732.jpeg');
// echo $aaa;





//文字水印

// function watermark($img_addr,$string='',$filename=''){

//     list($width,$height,$type) = getimagesize($img_addr);

//     $types = [
//         1 => 'gif',
//         2 => 'jpeg',
//         3 => 'png'
//     ];

//     //变量函数
//     $createimg = "imagecreatefrom".$types[$type];

//     //原图
//     $img = $createimg($img_addr);

//     // 为图像分配颜色
//     $white = imagecolorallocate($img,255,255,255);
//     $black = imagecolorallocate($img,0,0,0);
//     $red = imagecolorallocate($img,255,0,0);
//     $blue = imagecolorallocate($img,0,255,0);
//     $pink = imagecolorallocate($img,255,0,255);

//     //添加线条
//     //imageline($img,0,0,$width,$height,$red);

//     //添加文字
//     //imagestring — 水平地画一行字符串
//     //imagestringup — 垂直地画一行字符串

//     //$x = mt_rand(4,$width - strlen($string)*imagefontwidth(7));
//     //$y = mt_rand(4,$height - imagefontheight(7)+7);

//     //imagestring($img,7,$x,$y,$string,$pink);

//     //用 TrueType 字体向图像写入文本
//     $x = mt_rand(50,$width - strlen($string)*50);
//     $y = mt_rand(50,$height - 50);

//     // php5 imagettftext
//     imagettftext($img,50,0,$x,$y,$red,'./font/STXINGKA.TTF',$string);
//     imagettftext($img,50,0,$x+1,$y+1,$blue,'./font/STXINGKA.TTF',$string);
//     imagettftext($img,50,0,$x+2,$y+3,$white,'./font/STXINGKA.TTF',$string);

//     // php7 imagefttext 使用 FreeType 2 字体将文本写入图像

//     //保存/输出图片
//     header("Content-Type:image/{$types[$type]}");
//     $save = "image".$types[$type];

//     // $save($img,'img/aaa.'.$types[$type]);
//     if($filename === ''){
//         $filename = date("YmdHis").$types[$type];
//     }

//     $save($img,'img/'.$filename);
//     $save($img);

//     //释放资源
//     imagedestroy($img);
// }
