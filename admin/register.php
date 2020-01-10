<?php
include 'includes/function.php';


$user = @trim($_POST['user']);
$pwd = @trim($_POST['pwd']);

if (isset($_POST['res']) && $user != '' && $pwd != '') {
  
    // pre($user);
    // pre($pwd);
    $re = [];
    $re['admin_name'] = $user;
    $re['admin_pwd'] =md5($pwd) ;
    $re['admin_regtime'] = time();
    // pre($re);
    $conn = conn('nndou');
    $res = insert('nnd_admin', $re);
    // pre($res);
    // die;
    if ($res['code'] == 1) {
        echo '<script>alert("注册成功, 欢迎你'.$user.'用户 ");location.href="login.php";</script>';
    } else {
        echo '<script>alert("注册失败用户,已存在")</script>';
    }

    // pre($info);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        *{
            color: #FFF;
        }
        body{
            background: url('images/71875439_p0.jpg');
            background-size: 100%;
        }
        form{
            padding: 60px;
            background: linear-gradient(to bottom ,rgba(0,230,250,.2) 50%,transparent)
        }
    </style>
</head>

<body>
    <form class="form-horizontal col-xs-8 col-xs-offset-2" action="register.php" method="POST" onsubmit="datemine()">
        <h1 class="text-center" style="padding-bottom: 30px">注册表</h1>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 col-xs-offset-2 control-label">用户名</label>
            <div class="col-sm-6">
                <input type="text" name="user" class="form-control" id="inputEmail3" placeholder="用户名" pattern="\w{3,12}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 col-xs-offset-2 control-label">密码</label>
            <div class="col-sm-6">
                <input type="password" name="pwd" class="form-control password" id="inputPassword3" placeholder="密码" pattern="\w{6,12}">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 col-xs-offset-2 control-label">确认密码</label>
            <div class="col-sm-6">
                <input type="password" class="form-control password1" id="inputPassword3" placeholder="确认密码" onblur="datemine()">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" name="res" class="btn btn-default" style="background:rgba(0,230,250,.2);color:#FFF;">注册</button>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <a href="login.php" class="btn btn-default" style="background:rgba(0,230,250,.2);color:#FFF;">已有账号,去登录</a>
            </div>
        </div>
    </form>
</body>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.js"></script>
<script>
    console.log($(".password"));
    //    $(".password")
    function datemine() {
        $pwd = $(".password").val();
        $pwd1 = $(".password1").val();
        if ($pwd != $pwd1) {

            alert("两次密码不一致");

            return false;
        }
    }
</script>

</html>