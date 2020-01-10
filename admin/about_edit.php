<?php
include 'header.php';
if (!empty($_GET) && isset($_GET['about_id']) && $_GET['about_id'] > 0) {
    $about_id = $_GET['about_id'];
    $about = select_one('about', '*', "WHERE about_id =$about_id");
    $img = $about['about_img'];
}
// pre($_FILES['pic1']['error']);
if (!empty($_FILES) && $_FILES['pic1']['error'] == 0) {
    // pre($_FILES);
    // die;
    unlink($img);
    $upload = upload('pic1','uploads/about');
    if ($upload['code'] == 1) {
        $img = $upload['path'];
    }
}
// pre($about);
// pre($_POST);
// pre($_FILES);
if (!empty($_POST)) {

    $update_arr = [];
    $up_id = $about_id;

    $update_arr['about_title'] = $_POST['title'];
    $update_arr['about_title_en'] = $_POST['title_en'];
    $update_arr['about_content'] = $_POST['editorValue'];
    $update_arr['about_img'] = $img;
    // pre($update_arr);
    $con = "WHERE about_id={$up_id}";
    $res = update('`nnd_about`', $update_arr, $con);
    if ($res['code'] == 1) {
        echo "<script>alert('编辑成功！');window.location.href='about_list.php'</script>";
    } else {
        echo "<script>alert('编辑失败！');</script>";
    }
}


// UPDATE `nnd_info` SET `info_id`=[value-1],`info_title`=[value-2],`info_content`=[value-3],`info_time`=[value-4],`info_author`=[value-5],`info_type`=[value-6],`info_img`=[value-7] WHERE 1
// unlink('uploads/news/20200106090706685.jpeg');

// die;
?>
<link href="css/bootstrap-fileinput.css" rel="stylesheet">

<!-- End: Sidebar -->
<!-- Start: Content -->
<section id="content">
    <div id="topbar" class="affix">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">修改资讯</li>
        </ol>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-lg-8 center-column">
                <form action="#" method="post" class="cmxform" enctype="multipart/form-data">
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">编辑文章</div>
                            <div class="panel-btns pull-right margin-left">
                                <a href="#" onclick="history.go(-1)" class="btn btn-default btn-gradient dropdown-toggle"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-7">

                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon">标题</span>
                                        <input type="text" name="title" value="<?php echo $about['about_title']; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group"><span class="input-group-addon">英文标题</span>
                                        <input type="text" name="title_en" value="<?php echo $about['about_title_en']; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group col-md-12">

                                <script type="text/plain" id="myEditor" style="width:100%;height:200px;">

                                    <p><?php echo $about['about_content']; ?></p>

    </script>

                            </div>

                            <div class="form-group col-md-12">
                                <div class="h4">图片预览</div>
                                <div class="fileinput fileinput-new" data-provides="fileinput" id="exampleInputUpload">
                                    <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                        <img id='picImg' style="width: 100%;height: auto;max-height: 140px;" src="<?php echo ROOT . '/admin/' . $about['about_img'] ?>" alt="" />
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
                                    <input type="submit" value="提交" class="submit btn btn-blue">
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
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-fileinput.js"></script>
<link type="text/css" rel="stylesheet" href="umeditor/themes/default/_css/umeditor.css">

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