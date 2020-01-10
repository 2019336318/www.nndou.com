<?php
function radomStr()
{

    $str = "qwertyuiopasdfghjklzxcvbnm1234567890";

    $shuffle = str_shuffle($str);

    $new_str = substr($shuffle, 0, 4);

    for ($i = 0; $i < strlen($new_str); $i++) {
        if ((mt_rand(0, 1)) == 1) {
            $new_str[$i] = strtoupper($new_str[$i]);
        }
    }

    return $new_str;
}


    $w = 130;
    $h = 40;
    $img = imagecreatetruecolor($w, $h);
    // 背景色
    $white = imagecolorallocate($img, 255, 255, 255);


    // 画矩形
    imagefilledrectangle($img, 0, 0, $w, $h, $white);
    $str = radomStr();

    for ($i = 0; $i < strlen($str); $i++) {

        $y = $h - imagefontheight(20);

        $x = $i * 30 + 8;

        $text = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

        imagettftext($img, 20, rand(-15, 15), $x, $y, $text, 'font/texb.ttf', $str[$i]);
    }


    for ($i = 0; $i < 50; $i++) {

        $pixel = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

        imagesetpixel($img, rand(0, $w), rand(0, $h), $pixel);

        imagefilledellipse($img, rand(0, $w), rand(0, $h), rand(0, 5), rand(0, 5), $pixel);
    }

    for ($i = 0; $i < 5; $i++) {

        $line = imagecolorallocate($img, rand(0, 255), rand(0, 255), rand(0, 255));

        imageline($img, rand(0, $w), rand(0, $h), rand(0, $w), rand(0, $h), $line);
    }

    ob_clean();

    header("Content-Type:image/jpeg");

    imagejpeg($img);


    session_start();

    $_SESSION['code'] = strtolower($str);

    imagedestroy($img);

