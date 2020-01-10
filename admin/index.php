<?php
  include 'header.php';
//   pre($_SERVER);
$user_info = select_one('admin','*',"WHERE `admin_name` = '".$_COOKIE['username']."'");
// pre($user_info);
	
?> 
  <!-- Start: Content -->
  <section id="content">
    <div id="topbar" class="affix">
      <ol class="breadcrumb">
        <li class="active"><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
      </ol>
    </div>
    <div class="container">
		<div class="col-md-9">
			<div id="docs-content">
				<h2 class="page-header margin-top-none">个人信息</h2>
				<table class="table">
					<tr>
					<td colspan="2">您好，<?php echo $_COOKIE['username']; ?></td>
					</tr>
					<tr>
					<td width="100">最后登录时间:</td>
					<td><?php 
						if($user_info['admin_last_login'] == ''){
							echo date("Y-m-d H:i:s",time());
						}else{
							echo date("Y-m-d H:i:s",$user_info['admin_last_login']);
						}
					 ?></td>
					</tr>
					<tr>
					<td>最后登录IP:</td>
					<td><?php echo $user_info['admin_ip'];?></td>
					</tr>
				</table>

				<h2 class="page-header margin-top-none">系统信息</h2>
				<table class="table">
				  <tr>
				    <td width="100">操作系统：</td>
				    <td><?php echo PHP_OS; ?></td>
				  </tr>
				  <tr>
				    <td>PHP 版本:</td>
				    <td><?php echo  phpversion();?></td>
				  </tr>
				  <tr>
				    <td>MySQL 版本:</td>
				    <td><?php echo mysqli_get_server_info($conn) ;?></td>
				  </tr>
				</table>
			</div>
		</div>
    </div> 
  </section>
  <!-- End: Content --> 
</div>
<!-- End: Main --></body>

</html>