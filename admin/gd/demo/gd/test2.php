<?php
function thumb($img_addr, $width, $hight, $path = '', $filename = '')
{
	list($w, $h, $type) = getimagesize($img_addr);
	// var_dump($type);die;

	$types = [
		1 => 'gif',
		2 => 'jpeg',
		3 => 'png'
	];
	// var_dump($types[$type]);die;


	$desc_str = "imagecreatefrom" . $types[$type];
	$desc_img = $desc_str($img_addr);

	$img_new = imagecreatetruecolor($width, $hight);

	imagecopyresized($img_new, $desc_img, 0, 0, 0, 0, $width, $hight, $w, $h);

	header("Content-Type:image/" . $types[$type] . "");
	$show_img = "image{$types[$type]}";
	$show_img($img_new);
	$show_img($img_new, "thumb_hahah.$types[$type]");
	// imagepng($img_new); //输出
	// imagepng($img_new,"thumb_hahah.$types[$type]"); //保存

	//8. 释放内存
	imagedestroy($img_new);
}

echo thumb('11.jpeg', 150, 102);
