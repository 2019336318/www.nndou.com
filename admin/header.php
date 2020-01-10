<?php
    include 'includes/function.php';
    include 'test.php';
    $conn = conn('nndou');
    // pre(select_all('about','*'));die;
    // echo get_url();die;
    $info_type = select_all('info_type');
    $case_type = select_all('case_type');
    $ban_type = select_all('bantype');
    // pre($ban_type);
    $this_url = pathinfo($_SERVER['PHP_SELF'])['basename'];

    // pre($this_url);
?>

    
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <title>CMS内容管理系统</title>
  <meta name="keywords" content="Admin">
  <meta name="description" content="Admin">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Core CSS  -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/glyphicons.min.css">

  <!-- Theme CSS -->
  <link rel="stylesheet" type="text/css" href="css/theme.css">
  <link rel="stylesheet" type="text/css" href="css/pages.css">
  <link rel="stylesheet" type="text/css" href="css/plugins.css">
  <link rel="stylesheet" type="text/css" href="css/responsive.css">

  <!-- Boxed-Layout CSS -->
  <link rel="stylesheet" type="text/css" href="css/boxed.css">

  <!-- Demonstration CSS -->
  <link rel="stylesheet" type="text/css" href="css/demo.css">

  <!-- Your Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/custom.css">
  
  <!-- Core Javascript - via CDN --> 
  <script type="text/javascript" src="js/jquery.min.js"></script> 
  <script type="text/javascript" src="js/jquery-ui.min.js"></script> 
  <script type="text/javascript" src="js/bootstrap.min.js"></script> 
  <script type="text/javascript" src="js/uniform.min.js"></script> 
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/custom.js"></script> 
</head>

<body>
<!-- Start: Header -->
<header class="navbar navbar-fixed-top" style="background-image: none; background-color: rgb(240, 240, 240);">
  <div class="pull-left"> <a class="navbar-brand" href="#">
    <div class="navbar-logo"><img src="images/logo.png" alt="logo"></div>
    </a> </div>
  <div class="pull-right header-btns">
    <a class="user"><span class="glyphicons glyphicon-user"></span> <?php echo $_COOKIE['username']; ?></a>
    <a href="logout.php" class="btn btn-default btn-gradient" type="button"><span class="glyphicons glyphicon-log-out"></span> 退出</a>

  </div>
</header>
<!-- End: Header -->

<!-- Start: Main -->
<div id="main"> 
    <!-- Start: Sidebar -->
  <aside id="sidebar" class="affix">
    <div id="sidebar-search">
    		<div class="sidebar-toggle"><span class="glyphicon glyphicon-resize-horizontal"></span></div>
    </div>
    <div id="sidebar-menu">
      <ul class="nav sidebar-nav">
        <li class="<?php 
            if($this_url == "index.php"){
              echo 'active';
            } 
            ?>">
          <a href="index.php">
              <span class="glyphicons glyphicon-home"></span>
              <span class="sidebar-title">后台首页</span>
            </a>
        </li>

        <li  class="<?php 
            if($this_url == "info_list.php"){
              echo 'active';
            } 
            ?>"> 
            <a href="#sideEight" class="accordion-toggle <?php 
            if($this_url == "info_list.php"){
              echo 'menu-open';
            } 
            ?>">
                <span class="glyphicons glyphicon-list"></span>
                <span class="sidebar-title">资讯管理</span>
                <span class="caret"></span></a>

          <ul class="nav sub-nav" id="sideEight" style="">
            <li class="<?php if($_GET['type'] == '' && $this_url=='info_list.php') echo 'active'; ?>">
                <a href="info_list.php"><span class="glyphicons glyphicon-record"></span> 所有资讯</a>
            </li>
            <?php foreach ($info_type as $v){?>
                <li  class="<?php if($_GET['type'] ==$v['info_type_id']) echo 'active'; ?>">
                    <a href="info_list.php?type=<?php echo $v['info_type_id'] ?>"><span class="glyphicons glyphicon-record"></span><?php echo $v['info_type_name'];?></a>
                </li>
            <?php }?>
          </ul>
        </li>
        <li  class="<?php 
            if($this_url == "case_list.php"){
              echo 'active';
            } 
            ?>"> 
            <a href="#sideEight" class="accordion-toggle <?php 
            if($this_url == "case_list.php"){
              echo 'menu-open';
            } 
            ?>">
                <span class="glyphicons glyphicon-list"></span>
                <span class="sidebar-title">案例管理</span>
                <span class="caret"></span></a>

          <ul class="nav sub-nav" id="sideEight" style="">
            <li class="<?php if($_GET['type'] == '' && $this_url=='case_list.php') echo 'active'; ?>">
                <a href="case_list.php"><span class="glyphicons glyphicon-record"></span> 所有案例</a>
            </li>
            <?php foreach ($case_type as $v){?>
                <li  class="<?php if($_GET['type'] ==$v['case_type_id']) echo 'active'; ?>">
                    <a href="case_list.php?type=<?php echo $v['case_type_id'] ?>"><span class="glyphicons glyphicon-record"></span><?php echo $v['case_type_name1'];?></a>
                </li>
            <?php }?>
          </ul>
        </li>

        <li  class="<?php 
            if($this_url == "ban_list.php"){
              echo 'active';
            } 
            ?>"> 
            <a href="#sideEight" class="accordion-toggle <?php 
            if($this_url == "ban_list.php"){
              echo 'menu-open';
            } 
            ?>">
                <span class="glyphicons glyphicon-list"></span>
                <span class="sidebar-title">轮播图管理</span>
                <span class="caret"></span></a>

          <ul class="nav sub-nav" id="sideEight" style="">
            <li class="<?php if($_GET['type'] == '' && $this_url=='ban_list.php') echo 'active'; ?>">
                <a href="ban_list.php"><span class="glyphicons glyphicon-record"></span> 所有轮播图</a>
            </li>
            <?php foreach ($ban_type as $v){?>
                <li  class="<?php if($_GET['type'] ==$v['btype_id']) echo 'active'; ?>">
                    <a href="ban_list.php?type=<?php echo $v['btype_id'] ?>"><span class="glyphicons glyphicon-record"></span><?php echo $v['btype_name'];?></a>
                </li>
            <?php }?>
          </ul>
        </li>

        <li class="<?php 
            if($this_url == "about_list.php"){
              echo 'active';
            } 
            ?>">
          <a href="about_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">关于我们管理</span></a>
        </li>

        <li class="<?php 
            if($this_url == "conf_list.php"){
              echo 'active';
            } 
            ?>">
          <a href="conf_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">网站配置管理</span></a>
        </li>

        <li>
          <a href="cate_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">文章分类管理</span></a>
        </li>
        <li>
          <a href="user_list.php"><span class="glyphicons glyphicon-list"></span><span class="sidebar-title">系统管理员</span></a>
        </li>
      </ul>
    </div>
  </aside>
  <!-- End: Sidebar -->   