<?php
include 'header.php';
if(!empty($_GET) && isset($_GET['case_id']) ){
    $case_id=$_GET['case_id'];
    // pre($case_id);
    $case_detadils=select_one('cases','*',"INNER JOIN nnd_case_type ON `case_type`=`case_type_id` WHERE `case_id` = {$case_id}");
}
// pre($case_detadils);
include 'views/show_info.html';
include 'footer.php';