<!DOCTYPE html>
<html>
<head>
	<title>T_information</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>教师<?php echo $realname;?>的个人信息</p>
    	<div class="table-responsive">
            <table class="table table-bordered the_table">
                <tr>
                	<th scope="row">用户名</th>
                	<td><?php echo $teachername;?></td>
                	<th scope="row">角色</th>
                	<td>教师</td>
                </tr>
                <tr>
                	<th scope="row">真实姓名</th>
                	<td><?php echo $realname;?></td>
                	<th scope="row"">密码</th>
                	<td><?php echo $password;?></td>
                </tr>
                <tr>
                	<th scope="row">邮箱</th>
                	<td><?php echo $email;?></td>
                	<th scope="row">性别</th>
                	<td><?php echo $sex;?></td>
                </tr>
                <tr>
                	<th scope="row">QQ</th>
                	<td ><?php echo $qq;?></td>
                	<th scope="row">电话</th>
                	<td ><?php echo $telephone;?></td>
                </tr>
                <tr>
                    <th scope="row">创建时间</th>
                    <td ><?php echo $createtime;?></td>
                    <th scope="row">所属学校</th>
                    <td ><?php echo $college_id;?></td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>