<?php
// phpinfo();
function pre($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}
function dump($arr)
{
    echo "<pre>";
    var_dump($arr);
    echo "</pre>";
}
$img_addr = "../uploads/news/20200106145044620.jpeg";
$img_info = getimagesize($img_addr);
pre($img_info);
$width = $img_info[0];
$height = $img_info[1];
$img_type = $img_info[2];
switch ($img_type) {
    case  1:
        $desc_img = imagecreatefromgif($img_addr);
        break;
    case  2:
        $desc_img = imagecreatefromjpeg($img_addr);
        break;
    case  3:
        $desc_img = imagecreatefrompng($img_addr);
        break;
    default:
        break;
}
var_dump($desc_img);
$desc_w=150;
$desc_h=102;
$img_new=imagecreatetruecolor($desc_w,$desc_h);
pre($img_new);

imagecopyresized($img_new,$desc_img,0,0,0,0,$desc_w,$desc_h,$width,$height);


header("Content-Type:image/jpeg");
imagejpeg($img_new);

imagedestroy($img_new);
