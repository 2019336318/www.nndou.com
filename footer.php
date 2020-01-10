<?php
if (!defined('ACCESS')) die('Access Denied!');
$foot_info = select_one('config');
// pre($foot_info);
include './views/footer.html';
