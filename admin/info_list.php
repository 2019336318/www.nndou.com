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
// $info_arr=select_all('info','*' ,"ORDER BY info_id DESC LIMIT {$offset},{$limit}");

if (isset($_GET) && !empty($_GET['type']) && $_GET['type'] > 0) {
  $type = $_GET['type'];
  $condition = "INNER JOIN nnd_info_type AS nip ON nnd_info.info_type=nip.info_type_id WHERE `info_type` = {$type} ORDER BY `info_id` DESC LIMIT {$offset},{$limit}";
  $count_arr = select_one('info', 'COUNT(*) AS count', "WHERE  `info_type` = {$type} ");
  $count = $count_arr['count'];
  $page = page($current, $count, $limit, $size, 'mypage');
  $info_list = select_all('info', '*', $condition);
} else {
  $condition = "INNER JOIN nnd_info_type AS nip ON nnd_info.info_type=nip.info_type_id ORDER BY `info_id` DESC LIMIT {$offset},{$limit}";
  $count_arr = select_one('info', 'COUNT(*) AS count');
  $count = $count_arr['count'];
  $page_count = ceil($count / $limit);

  // 分页跳转
  if (isset($_GET['page']) && $_GET['page'] > $page_count) {
    echo "<script> alert(\"没有那么多页\");
      location.href=\"info_list.php\";
    </script>";
  }
  // pre($page_count);
  // pre($_GET['page']);
  $page = page($current, $count, $limit, $size, 'mypage');
  $info_list = select_all('info', '*', $condition);
}
// $type = $_GET['type'];
// pre($type);
// pre($info_list);
$url=get_url();
// 删除
// “DELETE FROM `nnd_info` WHERE `nnd_info`.`info_id` = 67”
// pre($info_list);
if (isset($_GET) && !empty($_GET['del']) && $_GET['del'] > 0){
  $img=$_GET['url'];
  $thumb=$_GET['thumb'];
  $del = $_GET['del'];
  if(isset($_GET['type'])){
    $type = "?type=".$_GET['type'];
  }
  unlink($img);
  unlink($thumb);
  $res = delete('nnd_info',"WHERE info_id={$del}");
  if($res['code']==1){
   echo "<script>alert('删除成功！');window.location.href='info_list.php".$type."'</script>";
  }else{
   echo "<script>alert('删除失败！');</script>";
  }
}

// 批量删除
if(isset($_POST['del_info'])){
  // pre($_POST);
  // die;
  // pre($_POST['del_info']);
  // $del=$_POST['del_info'];
  // $de=explode('|',$del[0]);
  // pre($de);
  // pre($de[0]);
  // pre($de[1]);
  // pre($de[2]);
  // die;
  // pre(count($_POST['del_info']));
  if(isset($_GET['type'])){
    $type = "?type=".$_GET['type'];
  }
  for($i=0;$i<count($_POST['del_info']);$i++){
    $del=$_POST['del_info'];
    $de=explode('|',$del[$i]);
    // pre($de);
    // pre($de[0]);
    // pre($de[1]);
    $res = delete('nnd_info',"WHERE info_id=".$de[0]."");
    $res1=unlink($de[1]);
    $res2=unlink($de[2]);
  }
  // foreach($_POST['del_info'] as $v){
  //   $res=delete('nnd_info',$v);
  //   // pre($v);
  // }
  // foreach($_POST['del_img'] as $v){
  //   $res1=unlink($v);
  //   // pre($v);
  // }
  if($res['code']==1 || $res1 || $res2){
    echo "<script>alert('删除成功！');window.location.href='info_list.php".$type."'</script>";
   }else{
    echo "<script>alert('删除失败！');</script>";
   }
}


?>
<style>

</style>
<!-- Start: Content -->
<section id="content">
  <div id="topbar" class="affix">
    <ol class="breadcrumb">
      <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="active">资讯管理</li>
    </ol>
  </div>
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <div class="panel">
          <div class="panel-heading">
            <div class="panel-title">资讯列表</div>
            <a href="info_add.php<?php echo "?type=".$type ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加文章</a>
          </div>
          <form action="" method="post">
            <div class="panel-body">
              <h2 class="panel-body-title">资讯中心</h2>
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr class="active">
                  <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th>
                  <th width="50">资讯id</th>
                  <th width="150">标题</th>
                  <th width="150">图片</th>
                  <!-- <th width="200">内容</th> -->
                  <th>类型</th>
                  <th>添加时间</th>
                  <th width="200">操作</th>
                </tr>
                <?php foreach ($info_list as $v) { ?>

                  <tr class="success">
                    <td class="text-center"><input type="checkbox" value="<?php 
                    echo $v['info_id'].'|'.$v['info_img'].'|'.$v['info_thumb']; ?>" name="del_info[]" class="cbox"></td>
                    <!-- <input type="hidden" name='del_img[]' value="<?php 
                      echo $v['info_img'];
                    ?>"> -->
                    <td><?php echo $v['info_id']; ?></td>
                    <td><?php echo $v['info_title']; ?></td>
                    <td>
                      <img src="<?php 
                    
                    $img_url= ROOT.'/admin/' . $v['info_thumb'] ;
                    //  thumb($img_url,240,144) ;
                    echo  $img_url;
                    
                    
                    ?>
                    " alt="">
                    </td>

                   

                    <!-- <td><?php echo mb_substr($v['info_content'], 0, 250); ?>...</td> -->

                    <td><?php 
                      echo $v['info_type_name'];
                    ?></td>

                    <td><?php echo date('Y-m-d H:i:s', $v['info_time']); ?></td>
                    <td>
                      <div class="btn-group">
                        <a href="info_edit.php?info_id=<?php echo  $v['info_id'] ;?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                        <a onclick="return confirm('确定要删除吗？');" href="<?php echo $url ?>del=<?php echo $v['info_id'] ?>&url=<?php echo $v['info_img'] ?>&thumb=<?php echo $v['info_thumb'] ?>" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                      </div>

                    </td>
                  </tr>

                <?php } ?>



                <!-- <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
		                      <div class="btn-group">
		                        <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
		                        <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
		                      </div>
                        
                        </td>
                      </tr>


                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr>
                      <tr class="success">
                        <td class="text-center"><input type="checkbox" value="1" name="idarr[]" class="cbox"></td>
                        <td>再谈互联网给传统金融带来的颠覆</td>
                        <td>2015-01-10</td>
                        <td>
                          <div class="btn-group">
                            <a href="article_edit.html" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>
                            <a onclick="return confirm('确定要删除吗？');" href="#" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicons glyphicon-trash"></span></a>
                          </div>
                        
                        </td>
                      </tr> -->
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