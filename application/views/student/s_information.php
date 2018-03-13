<!DOCTYPE html>
<html>
<head>
	<title>s_information</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>学生<?php echo $realname;?>的个人信息</p>
    	<div class="table-responsive">
            <table class="table table-bordered the_table">
                <tr>
                	<td class="name">用户名</td>
                	<td class="value"><?php echo $studentname;?></td>
                	<td class="name">班级</td>
                	<td class="value"><?php echo $classes_id;?></td>
                </tr>
                <tr>
                	<td class="name">真实姓名</td>
                	<td class="value"><?php echo $realname;?></td>
                	<td class="name">密码</td>
                	<td class="value"><?php echo $password;?></td>
                </tr>
                <tr>
                	<td class="name">邮箱</td>
                	<td class="value"><?php echo $email?></td>
                	<td class="name">性别</td>
                	<td class="value"><?php echo $sex;?></td>
                </tr>
                <tr>
                	<td class="name">qq</td>
                	<td class="value"><?php echo $qq;?></td>
                	<td class="name">电话</td>
                	<td class="value"><?php echo $telephone;?></td>
                </tr>
                <tr>
                	<td class="name">身份证号</td>
                	<td class="value"><?php echo $idcard?></td>
                	<td class="name">积分</td>
                	<td class="value"><?php echo $point;?></td>
                </tr>
                <tr>
                	<td class="name">地址</td>
                	<td class="value"><?php echo $address;?></td>
                	<td class="name">头像</td>
                	<td class="value"><img src="<?php echo base_url('student/headimg/'.$studentname.'/'.$photo.'')?>" height="100px" width="220px"/></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>