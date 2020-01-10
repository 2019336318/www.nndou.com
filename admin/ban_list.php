<?php
include 'header.php';
// pre($_POST);
$current = (!empty($_GET['page']) && $_GET['page'] > 0) ? $_GET['page'] : 1;
// 限制条数
$limit = 5;
// 偏移量
$offset = ($current - 1) * $limit;
// 显示页码个数
$size = 5;
// 总页数


// $page = page($current, $count, $limit, $size, 'mypage');
// echo $page;

// pre($page_count);
// pre($count);
// pre($_GET);
// $ban_arr=select_all('ban','*' ,"ORDER BY case_id DESC LIMIT {$offset},{$limit}");

if (isset($_GET) && !empty($_GET['type']) && $_GET['type'] > 0) {
  $type = $_GET['type'];
  $condition = "INNER JOIN nnd_bantype AS nip ON nnd_banner.ban_type=nip.btype_id WHERE `ban_type` = {$type} ORDER BY `ban_type` ASC LIMIT {$offset},{$limit}";
  $count_arr = select_one('banner', 'COUNT(*) AS count', "WHERE  `ban_type` = {$type} ");
  $count = $count_arr['count'];
  $page = page($current, $count, $limit, $size, 'mypage');
  $banner_list = select_all('banner', '*', $condition);
} else {
  $condition = "INNER JOIN nnd_bantype AS nip ON nnd_banner.ban_type=nip.btype_id ORDER BY `ban_type` ASC LIMIT {$offset},{$limit}";
  $count_arr = select_one('banner', 'COUNT(*) AS count');
  $count = $count_arr['count'];
  $page_count = ceil($count / $limit);

  // 分页跳转
  if (isset($_GET['page']) && $_GET['page'] > $page_count) {
    echo "<script> alert(\"没有那么多页\");
      location.href=\"banner_list.php\";
    </script>";
  }
  // pre($page_count);
  // pre($_GET['page']);
  $page = page($current, $count, $limit, $size, 'mypage');
  // $condition="LIMIT 6";
  $banner_list = select_all('banner', '*', $condition);
}
// pre($banner_list);
// $type = $_GET['type'];
// pre($type);
// pre($banner_list);
$url=get_url();
// 删除
// “DELETE FROM `nnd_banner` WHERE `nnd_banner`.`banner_id` = 67”
// pre($banner_list);
if (isset($_GET) && !empty($_GET['del']) && $_GET['del'] > 0){
  $img=$_GET['url'];
  $del = $_GET['del'];
  if(isset($_GET['type'])){
    $type = "?type=".$_GET['type'];
  }
  unlink($img);
  $res = delete('nnd_banner',"WHERE ban_id={$del}");
  if($res['code']==1){
   echo "<script>alert('删除成功！');window.location.href='ban_list.php".$type."'</script>";
  }else{
   echo "<script>alert('删除失败！');</script>";
  }
}

// 批量删除
if(isset($_POST['del_ban'])){
  // pre($_POST);
  // pre($_POST['del_ban']);
  // $del=$_POST['del_ban'];
  // $de=explode('|',$del[0]);
  // pre($de);
  // pre($de[0]);
  // pre($de[1]);
  // pre(count($_POST['del_ban']));
  if(isset($_GET['type'])){
    $type = "?type=".$_GET['type'];
  }
  for($i=0;$i<count($_POST['del_ban']);$i++){
    $del=$_POST['del_ban'];
    $de=explode('|',$del[$i]);
    // pre($de);
    // pre($de[0]);
    // pre($de[1]);
    $res = delete('nnd_banner',"WHERE ban_id=".$de[0]."");
    $res1=unlink($de[1]);
  }
  // foreach($_POST['del_ban'] as $v){
  //   $res=delete('nnd_ban',$v);
  //   // pre($v);
  // }
  // foreach($_POST['del_img'] as $v){
  //   $res1=unlink($v);
  //   // pre($v);
  // }
  if($res['code']==1 || $res1){
    echo "<script>alert('删除成功！');window.location.href='ban_list.php".$type."'</script>";
   }else{
    echo "<script>alert('删除失败！');</script>";
   }
}


?>
<style>
  td img{
    width: 160px;
  }
</style>
<!-- Start: Content -->
<section id="content">
  <div id="topbar" class="affix">
    <ol class="breadcrumb">
      <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">案例管理</li>
    </ol>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title">案例列表</div>
            <a href="ban_add.php<?php echo "?type=".$type ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加案例</a>
          </div>
          <form action="" method="post">
            <div class="panel-body">
              <h2 class="panel-body-title">案例中心</h2>
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr class="active">
                  <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                  <th width="50">案例id</th>
                  <th width="150">名字</th>
                  <th width="150">图片</th>
                  <th>分类</th>
                  <th width="200">操作</th>
                </tr>
                <?php foreach ($banner_list as $v) { ?>

                  <tr class="success">
                    <td class="text-center"><input type="checkbox" value="<?php 
                    echo $v['ban_id'].'|'.$v['ban_url']; ?>" name="del_ban[]" class="cbox"></td>
                    <td><?php echo $v['ban_id']; ?></td>
                    <td><?php echo $v['ban_name']; ?></td>
                    <td><img src="<?php echo ROOT.'/admin/' . $v['ban_url'] ?>" alt="" width="200px">
                    </td>
                    <td><?php echo $v['btype_name']; ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="ban_edit.php?ban_id=<?php echo  $v['ban_id'] ;?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                        <a onclick="return confirm('确定要删除吗？');" href="<?php echo $url ?>del=<?php echo $v['ban_id'] ?>&url=<?php echo $v['ban_url'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                      </div>

                    </td>
                  </tr>

                <?php } ?>
              </table>

              <div class="pull-left">
                <button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
              </div>

              <div class="pull-right">
                <!-- <ul class="pagination" id="paginator-example">
                      <li><a href="#">&lt;</a></li>
                      <li><a href="#">&lt;&lt;</a></li>
                      <li><a href="#">1</a></li>
                      <li class="active"><a href="#">2</a></li>
                      <li><a href="#">3</a></li>
                      <li><a href="#">&gt;</a></li>
                      <li><a href="#">&gt;&gt;</a></li>
                    </ul> -->
                <!-- <link rel="stylesheet" href="<?php //echo CSS_DIR . '/page.css' ?>"> -->
                <?php echo $page ?>


              </div>

            </div>
          </form>
          <?php if( $count>$limit) {?>
          <form action="" method="get" class="pull-right" style="padding-bottom: 30px">
            <input type="hidden" name="type" value="<?php echo $type ?>">
            <input type="text" name="page" >
            <button> 点击跳转</button>
          </form>
          <?php }?>
        </div>
      </div>
    </div>





  </div>
</section>
<!-- End: Content -->
</div>
<!-- End: Main -->
</body>

</html>