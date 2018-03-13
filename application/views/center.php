<!DOCTYPE html>
<html>
<head>
	<title>英语在线学习管理系统</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=0.25,user-scalable=no">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/center.css');?>">
</head>
<body>
    <div class="wrapper">
        <div class="header">
        	<p><i class="h_icon"></i>大学英语任务与测试系统</p>
        	<a href="<?php echo site_url('login/logoutSafe/'.$status.'/'.$name.'');?>" title="安全退出"><i class="logout"></i></a>
        </div>
    </div>
<div class="iframes">
            <div class="iframe1">
                <iframe width=100% height=1200px id="iframe" frameborder=0 src="" background:transparent;>对不起，您使用的浏览器不兼容！</iframe>
            </div>
            <div class="iframe2">
                <iframe width=100% height=1200px; src="<?php echo site_url('main');?>" name="center">对不起，您使用的浏览器不兼容！</iframe>
            </div>
</div> 
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script type="text/javascript">
    var status;
    status="<?php echo $status;?>";
    if(status==1){
        $("#iframe").attr('src',"<?php echo site_url('student/stumain/studentMenu/'.$name.'');?>");
        }
    else if(status==2){
        $("#iframe").attr('src',"<?php echo site_url('teacher/techmain/teacherMenu/'.$name.'');?>");
    }
    else if(status==3){
        $("#iframe").attr('src',"<?php echo site_url('admin/admain/admainMenu/'.$name.'');?>");
    }
</script> 
</body>
</html>