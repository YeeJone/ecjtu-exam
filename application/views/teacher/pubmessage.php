<!DOCTYPE html>
<html>
<head>
	<title>MessageInformation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>发布通知</p>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" name="fileinfo" id="a_form">
            <div class="form-group">
                <label for="teachername" class="col-sm-2 control-label">发布教师登录名</label>
                <div class="col-sm-6">
                    <h5 id="teachername"><?php echo $teachername;?></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="info" class="col-sm-2 control-label">发布内容</label>
                <div class="col-sm-6">
                    <input type="textarea" class="form-control" id="info" placeholder="" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="time" class="col-sm-2 control-label">发布日期</label>
                <div class="col-sm-6">
                    <h5 id="time"><?php echo date("Y-m-d");?></h5>
                </div>
            </div> 
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6 button">
                    <button type="submit" class="btn btn-default" id="submit">发布</button>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/msg_information.js');?>"></script>
</body>
</html>