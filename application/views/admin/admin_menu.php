<!DOCTYPE html>
<html>
<head>
	<title>adminMenu</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/menu.css');?>">
</head>
<body>
    <div class="sidebar-menu">
        <ul>
            <li>
                <div class="user-img-div">
                    <img src="<?php echo base_url('images/header.jpg');?>" class="img-thumbnail" />
                    <div class="inner-text">
                    <p>UserName:<?php echo $realname;?></p>
                     <p>角色:<?php echo $role;?></p>
                     <small>Last Login : 2 Weeks Ago </small>
                    </div>
                </div>
            </li>            
            <li>
                <a href="#userMeun" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-user-md icon-large"></i> 个人信息管理</a>
                <ul id="userMeun" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('admin/adinfo/index/'.$username.'');?>" target="center"><i class="arrow"></i> 查看个人信息</a></li>
                    <li><a href="<?php echo site_url('admin/adinfo/updateInfo/'.$username.'');?>" target="center"><i class="arrow"></i> 修改个人信息</a></li>
                    <li><a href="<?php echo site_url('admin/adinfo/changePass');?>" target="center"><i class="arrow"></i> 修改密钥</a></li>
                </ul>
            </li>
            <li>
                <a href="#t_inforMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 教师信息管理</a>
                <ul id="t_inforMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('admin/adteach/addTech');?>" target="center"><i class="arrow"></i> 添加教师</a></li>
                    <li><a href="<?php echo site_url('admin/adteach/techList');?>" target="center"><i class="arrow"></i> 教师列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#classMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 班级管理</a>
                <ul id="classMenu" class="nav nav-list collapse menu-second">
                    <li><a href="#"><i class="arrow"></i> 添加班级</a></li>
                    <li><a href="<?php echo site_url('teacher/techclass/showClass');?>" target="center"><i class="arrow"></i> 班级列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#re_pageMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 注册页面管理</a>
                <ul id="re_pageMenu" class="nav nav-list collapse menu-second">
                    <li><a href="#"><i class="arrow"></i> 注册列表</a></li>
                    <li><a href="#"><i class="arrow"></i> 批量注册学生</a></li>
                </ul>
            </li>
            <li>
                <a href="#questionMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 题型管理</a>
                <ul id="questionMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('admin/adques/addQuesTypeView');?>" target="center"><i class="arrow"></i> 添加题型</a></li>
                    <li><a href="<?php echo site_url('admin/adques/quesTypeManageView');?>" target="center"><i class="arrow"></i> 题型列表</a></li>
                </ul>
            </li>
        </ul>    
    </div>
         <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
</body>
</html>