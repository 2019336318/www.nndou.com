<?php
include 'includes/function.php';
session_start();
// pre($_SESSION['code']);
$dbms = 'mysql';     //数据库类型
$host = 'localhost'; //数据库主机名
$dbName = 'nndou';    //使用的数据库
$dbuser = 'root';      //数据库连接用户名
$pass = '123456';          //对应的密码
$dsn = "$dbms:host=$host;dbname=$dbName";

if (isset($_POST['user']) && isset($_POST['pwd'])) {
  $new_code=$_POST['code'];
  $old_code=$_SESSION['code'];
  for($i=0;$i<strlen($new_code);$i++){
    $new_code[$i]=strtolower($new_code[$i]);
  }

  if($old_code != $new_code){
    echo '<script> alert("验证码错误");location.href="login.php"; </script>';
  }

  // pre($new_code);
  // pre($old_code);

  $user = $_POST['user'];
  $pwd = md5($_POST['pwd']);
  // echo $user;
  //     die;
  $db = new PDO($dsn, $dbuser, $pass); //初始化一个PDO对象
  // print_r($db) ;
  // die;
  $sql = " SELECT * FROM `nnd_admin` WHERE admin_name =:username AND admin_pwd = :pwd ";
  $info = $db->prepare($sql);
  // pre($info);
  // die;
  $info->execute([':username' => $user, ':pwd' => $pwd]);
  if ($info->rowCount() > 0) {
    // echo '11111';
    // echo $info->rowCount();
    // die;
    list($id, $user, $pwd, $role, $lastlog) = $info->fetch(PDO::FETCH_NUM);
    // echo $id,$user;
    // die;
    setcookie('username', $user, time() + 60 * 10);
    setcookie('pwd', $pwd, time() + 60 * 10);
    setcookie('logtime', date('Y-m-d H:i:s', $lastlog), time() + 60 * 10);
    setcookie('login', 1, time() + 60 * 10);
    echo '<script> alert("欢迎回来' . $user . '用户");location.href="index.php"; </script>';
  } else {
    echo '<script> alert("用户名或密码错误"); </script>';
  }
}


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

</head>

<body class="login-page">

  <!-- Start: Main -->
  <div id="main">
    <div class="container">
      <div class="row">
        <div id="page-logo"></div>
      </div>
      <div class="row">
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title">CMS内容管理系统</div>
          </div>
          <form action="login.php" class="cmxform" id="altForm" method="post">
            <div class="panel-body">
              <div class="form-group">
                <div class="input-group"> <span class="input-group-addon">用户名</span>
                  <input type="text" name="user" class="form-control phone" maxlength="10" autocomplete="off" placeholder="">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group"> <span class="input-group-addon">密&nbsp;&nbsp;&nbsp;码</span>
                  <input type="password" name="pwd" class="form-control product" maxlength="10" autocomplete="off" placeholder="">
                </div>
              </div>

              <div class="form-group">
                <div class="input-group"> <span class="input-group-addon">验证码</span>
                  <input type="text" name="code" class="form-control product" maxlength="10" autocomplete="off" placeholder="" style="width: 60%;">

                  <img src="ma.php" alt="" height="33px" width="40%" style="border:1px solid #CCC"  id="code">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group"> 
                  
                </div>
              </div>

            </div>
            <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"></span>
              <div class="form-group margin-bottom-none">
                <input class="btn btn-primary pull-right" type="submit" value="登 录" />
                <div class="clearfix"></div>
              </div>
              <div class="form-group margin-bottom-none" style="margin-top:5px">
                <input class="btn btn-primary pull-right" type="button" value="没有账号,去注册" onclick="res()" />
                <div class="clearfix"></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End: Main -->

  <!-- Core Javascript - via CDN -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/bootstrap.min.js"></script> <!-- Theme Javascript -->
  <script type="text/javascript" src="js/uniform.min.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript">
    function res() {
      // alert('111');
      location.href="register.php";
    }
    $('#code').click(function(){
      
      $(this).attr('src','ma.php?'+Math.random());
    })
    jQuery(document).ready(function() {

      // Init Theme Core 	  
      Core.init();


    });
  </script>
</body>

</html>