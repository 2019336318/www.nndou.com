<?php
include 'includes/function.php';
$img_url=$_GET['img'];
echo thumb($img_url,240,144);
