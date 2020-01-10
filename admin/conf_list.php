<?php
include 'header.php';

$conf = select_one('config');

// pre($conf);

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
            <div class="panel-title">网站配置列表</div>
            <!-- <a href="config_add.php<?php echo "?type=".$type ?>" class="btn btn-info btn-gradient pull-right"><span class="glyphicons glyphicon-plus"></span> 添加网站配置</a> -->
          </div>
          <form action="" method="post">
            <div class="panel-body">
              <h2 class="panel-body-title">网站配置中心</h2>
              <table class="table table-striped table-bordered table-hover dataTable">
                <tr class="active">
                  <!-- <th class="text-center" width="100"><input type="checkbox" value="" id="checkall" class=""> 全选</th> -->
                  <th width="150">地址</th>
                  <th width="150">版权信息</th>
                  <th width="150">备案</th>
                  <th width="150">联系方式</th>
                  <th width="200">操作</th>
                </tr>
  
                  <tr class="success">
                    <td><?php echo $conf['config_addr']; ?></td>
                    <td><?php echo $conf['config_copy']; ?></td>
                    <td><?php echo $conf['config_beian']; ?></td>
                    <td><img src="<?php echo ROOT.'/admin/' . $conf['config_contact'] ?>" alt="" width="200px">
                    </td>
                    <td>
                      <div class="btn-group">
                        <a href="conf_edit.php?config_id=<?php echo  $conf['config_id'] ;?>" class="btn btn-default btn-gradient"><span class="glyphicons glyphicon-pencil"></span></a>

                      </div>

                    </td>
                  </tr>

     
              </table>

              <!-- <div class="pull-left">
                <button type="submit" class="btn btn-default btn-gradient pull-right delall"><span class="glyphicons glyphicon-trash"></span></button>
              </div> -->

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



              </div>

            </div>
          </form>
         
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