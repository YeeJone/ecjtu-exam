<!DOCTYPE html>
<html>
<head>
	<title>TeacherperfectInformation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>更改个人信息</p>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" name="fileinfo" id="a_form">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-6">
                    <h5 id="username"><?php echo $teachername;?></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-2 control-label">真实姓名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputName3" placeholder="<?php echo $realname;?>" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="<?php echo $password;?>" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="<?php echo $email;?>" name="email">
                </div>
            </div> 
             <div class="form-group">
                <label class="col-sm-2 control-label">性别</label>
                <label class="checkbox-inline col-sm-1 control-label">
                    <input type="radio" id="inlineCheckbox1" value="男" name="sex" checked="checked"> 男
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox2" value="女" name="sex"> 女
                </label>
            </div>
            <div class="form-group">
                <label for="inputqq3" class="col-sm-2 control-label">QQ</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputqq3" placeholder="<?php echo $qq;?>" name="qq_numnber">
                </div>
            </div>
            <div class="form-group">
                <label for="inputphone3" class="col-sm-2 control-label">电话</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputphone3" placeholder="<?php echo $telephone;?>" name="phone">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6 button">
                    <button type="submit" class="btn btn-default" id="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/tp_information.js');?>"></script>
</body>
</html>