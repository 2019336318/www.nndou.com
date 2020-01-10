<?php
    // function watermark_img($origin_img,$water_img){
    //     list($org_w,$org_h,$org_type)=getimagesize($origin_img);
    //     list($w_w,$w_h,$w_type)=getimagesize($water_img);
    //     $types = [
    //         1 => 'gif',
    //         2 => 'jpeg',
    //         3 => 'png'
    //     ];

    //     $origincreate = "imagecreatefrom".$types[$org_type];
    //     $watercreate = "imagecreatefrom".$types[$w_type];

    //     $img_src = $origincreate($origin_img);
    //     $img_des = $watercreate($water_img);

    //     $x=mt_rand(4,$org_w-$w_w);
    //     $y=mt_rand(4,$org_h-$w_h);

    //     // for($i=0;$i<20;$i++){
    //         imagecopy($img_src,$img_des,$x,$y,0,0,$w_w,$w_h);
    //     // }
    //     header("Content-Type:image/{$types[$org_type]}");
    //     $save = "image".$types[$org_type];
    //     $save($img_src);

    //     //释放资源
    //     imagedestroy($img_src);
    //     imagedestroy($img_des);

    // }
    // watermark_img('20200107104709732.jpeg','logo.png');

    /**
	 * 图片水印
	 * @param $origin_img
	 * @param $water_img
	 * @param string $path
	 */
	function watermark_img($origin_img,$water_img,$path=''){

		list($ori_width,$ori_height,$ori_type) = getimagesize($origin_img);
		list($w_width,$w_height,$w_type) = getimagesize($water_img);

		$types = [
			1 => 'gif',
			2 => 'jpeg',
			3 => 'png'
		];

		//函数变量
		$origincreate = "imagecreatefrom".$types[$ori_type];//原图片
		$watercreate = "imagecreatefrom".$types[$w_type];//水印图片

		$img_src = $origincreate($origin_img);//原图片
		$img_des = $watercreate($water_img);//水印图片

		//随机位置(不能超出原图位置)
		//$x = mt_rand(4,$ori_width - $w_width);
		//$y = mt_rand(4,$ori_height - $w_height);
		$x = 10;
		$y = $ori_height - $w_height - 10;

		//imagecopy — 拷贝图像的一部分
		imagecopy($img_src,$img_des,$x,$y,0,0,$w_width,$w_height);

		//输出
		header("Content-Type:image/{$types[$ori_type]}");
		$save = "image".$types[$ori_type];

		if($path === ''){
			$path = './';
		}
		$save($img_src,$path.date("YmdHis").'.'.$types[$ori_type]);
		$save($img_src);

		//释放资源
		imagedestroy($img_src);
		imagedestroy($img_des);
    }
    watermark_img('20200107104709732.jpeg','logo.png');

