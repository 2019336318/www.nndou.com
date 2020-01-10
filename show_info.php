<?php
include 'header.php';
$sql = 'SELECT `ban_url` FROM `nnd_banner` WHERE `ban_type`=3';
$loop_arr = msq($conn, $sql);
// pre($loop_arr);
// mysqli_close($conn);
$case_type = select_all('case_type','*','LIMIT 3');
// pre($case_type);



// if(isset($_GET['type']) && !empty($_GET['type'])){
//     // echo $_GET['type'];
 
    if(!empty($_GET['type'])){
		$type = $_GET['type'];
	}else{
		$type = 1;
	}
    
// }
    $con = "WHERE case_type = {$type}";
    $cases = select_all('case','*',$con);
    // pre($cases);
    // pre($case_type[$type-1]['case_type_name1']);
include 'views/show.html';
include 'footer.php';
