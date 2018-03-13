<!DOCTYPE html>
<html>
<head>
	<title>studentMenu</title>
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
                    <li><a href="<?php echo site_url('student/stuinfo/index/'.$username.'');?>" target="center"><i class="arrow"></i> 查看个人信息</a></li>
                    <li><a href="<?php echo site_url('student/stuinfo/updateInfo/'.$username.'')?>" target="center"><i class="arrow"></i> 完善个人信息</a></li>
                </ul>
            </li>
            <li>
                <a href="#taskMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 我的任务</a>
                <ul id="taskMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('student/stutask/taskList/'.$username.'');?>" target="center"><i class="arrow"></i> 进入任务列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#examMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 我的考试</a>
                <ul id="examMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('student/stutest/examList/'.$username.'');?>" target="center"><i class="arrow"></i> 进入考试列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#listenMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 我的自主学习</a>
                <ul id="listenMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('student/stuself/assemblyQues/'.$username.'');?>" target="center"><i class="arrow"></i> 进入自主组题模块</a></li>
                </ul>
            </li>
            <li>
                <a href="#scoreMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 查询成绩模块</a>
                <ul id="scoreMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('student/stuscore/examScore/'.$username.'');?>" target="center"><i class="arrow"></i> 考试成绩</a></li>
                    <li><a href="<?php echo site_url('student/stuscore/taskScore/'.$username.'');?>" target="center"><i class="arrow"></i> 任务成绩</a></li>
                    <li><a href="<?php echo site_url('student/stuscore/selfScore/'.$username.'');?>" target="center"><i class="arrow"></i> 自主学习成绩</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="#followreadMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 跟读训练模块</a>
                <ul id="followreadMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php //echo site_url('student/stuupmp3/index/'.$username.'');?>" target="center"><i class="arrow"></i> 上传MP3</a></li>
                </ul>
            </li> -->
            <li>
                <a href="#PKMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> PK模块</a>
                <ul id="PKMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('student/stupk/test');?>" target="center"><i class="arrow"></i> 进入PK页面</a></li>
                </ul>
            </li>
        </ul>    
    </div>
        <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
</body>
</html>