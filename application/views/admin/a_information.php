<!DOCTYPE html>
<html>
<head>
	<title>Ad_information</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>管理员<span><?php echo $realname;?></span>的个人信息</p>
    	<div class="table-responsive">
            <table class="table table-bordered the_table">
                <tr>
                	<td class="name">登录名</td>
                	<td class="value"><?php echo $adminname;?></td>
                	<td class="name">真实姓名</td>
                    <td class="value"><?php echo $realname;?></td>
                </tr>
                <tr>
                	<td class="name">密码</td>
                	<td class="value"><?php echo $password;?></td>
                    <td class="name">邮箱</td>
                    <td class="value"><?php echo $email;?></td>
                </tr>
                <tr>
                	<td class="name">性别</td>
                	<td class="value"><?php echo $sex;?></td>
                    <td class="name">QQ</td>
                    <td class="value"><?php echo $qq;?></td>
                </tr>
                <tr>             	
                	<td class="name">电话</td>
                	<td class="value"><?php echo $telephone;?></td>
                     <td class="name">所属学校</td>
                    <td class="value"><?php echo $college_id;?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>