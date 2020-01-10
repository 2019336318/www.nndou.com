<?php
include 'header.php';
$ban_type = select_all('bantype');
// pre($_POST);
if (isset($_POST['sub'])) {
    // pre($_POST);
    // pre($_FILES);
    // $type = $_POST['type'];
    // $title = $_POST['title'];
    // $content = $_POST['editorValue'];
    // $time = time();
    if (!empty($_FILES)) {
        // $name
        $upload = upload('pic1','uploads/banner');
        if ($upload['code'] == 1) {
            $img = $upload['path'];
        }
        $msg = $upload['msg'];

       

        $upload_arr = [];
        $upload_arr['ban_type'] = $_POST['type'];
        $upload_arr['ban_name'] = $_POST['name'];
        $upload_arr['ban_url'] = $img;

         // $sql="INSERT INTO nnd_info ( `info_title`, `info_content`, `info_time`, `info_author`, `info_type`, `info_img`) VALUES ('$title','$content',$time,'','$type','$img')";
        // echo $sql;
        // echo $msg,'',$img_path;
        // pre($upload);

        $res = insert('nnd_banner',$upload_arr);
        // die;
	    if($res['code']==1){
		   echo "<script>alert('添加成功！');window.location.href='ban_list.php?type=".$upload_arr['info_type']."'</script>";
	    }else{
		   echo "<script>alert('添加失败！');</script>";
	    }
    }
}
?>
<link href="css/bootstrap-fileinput.css" rel="stylesheet">

<!-- End: Sidebar -->
<!-- Start: Content -->
<section id="content">
    <div id="topbar" class="affix">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">添加资讯</li>
        </ol>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-lg-8 center-column">
                <form action="" method="post" class="cmxform" enctype='multipart/form-data'>
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">添加文章</div>
                            <div class="panel-btns pull-right margin-left">
                                <a href="info_list.php" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon">分类</span>
                                        <select name="type" id="standard-list1" class="form-control">
                                            <?php foreach ($ban_type as $v) { ?>
                                                <option value="<?php echo $v['btype_id']; ?>"
                                                <?php if($_GET['type'] == $v['btype_id']) echo 'selected' ?>
                                                ><?php echo $v['btype_name']; ?></option>
                                            <?php } ?>
                                            <!-- <option>科技</option>
                                                <option>文化</option>
                                                <option>生活</option> -->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon">名字</span>
                                        <input type="text" name="name" value="" class="form-control" required>
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                        <div class="input-group"><span class="input-group-addon">作者</span>
                                            <input type="text" name="author" value="" class="form-control" required>
                                        </div>
                                    </div> -->

                            </div>

                            <div class="form-group col-md-12">
                                <div class="h4">图片预览</div>
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="images/noimage.png" alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-primary btn-file">
                                            <span class="fileinput-new">选择文件</span>
                                            <span class="fileinput-exists">换一张</span>
                                            <input type="file" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png" />
                                        </span>
                                        <a href="javascript:;" class="btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="submit" value="提交" name="sub" class="submit btn btn-blue">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
<!-- End: Content -->
</div>
<!-- End: Main -->
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-fileinput.js"></script>
<script src="umeditor/umeditor.config.js" type="text/javascript"></script>
<script src="umeditor/editor_api.js" type="text/javascript"></script>
<script src="umeditor/lang/zh-cn/zh-cn.js" type="text/javascript"></script>

<script type="text/javascript">
    var ue = UM.getEditor('myEditor', {
        autoClearinitialContent: false,
        wordCount: false,
        elementPathEnabled: false,
        initialFrameHeight: 300
    });


    $(function() {
        //比较简洁，细节可自行完善
        $('#uploadSubmit').click(function() {
            var data = new FormData($('#uploadForm')[0]);
            $.ajax({
                url: 'xxx/xxx',
                type: 'POST',
                data: data,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.status) {
                        console.log('upload success');
                    } else {
                        console.log(data.message);
                    }
                },
                error: function(data) {
                    console.log(data.status);
                }
            });
        });

    })
</script>
</body>

</html>