<!DOCTYPE html>
<html>
<head>
	<title>teacherMenu</title>
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
                    <li><a href="<?php echo site_url('teacher/techinfo/index/'.$username.'');?>" target="center"><i class="arrow"></i> 查看个人信息</a></li>
                    <li><a href="<?php echo site_url('teacher/techinfo/updateInfo/'.$username.'');?>" target="center"><i class="arrow"></i> 修改个人信息</a></li>
                    <li><a href="<?php echo site_url('teacher/techinfo/stuList');?>" target="center"><i class="arrow"></i> 学生列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#classMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 班级管理</a>
                <ul id="classMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techclass/addClass/'.$username.'');?>" target="center"><i class="arrow"></i> 添加班级</a></li>
                    <li><a href="<?php echo site_url('teacher/techclass/showClass');?>" target="center"><i class="arrow"></i> 班级列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#questionMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i>题目管理</a>
                <ul id="questionMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techques/quesTypeList');?>" target="center"><i class="arrow"></i> 题型列表</a></li>
                    <li><a href="<?php echo site_url('teacher/techques/inputQues/'.$username.'');?>" target="center"><i class="arrow"></i> 题目输入</a></li>
                    <li><a href="<?php echo site_url('teacher/techques/quesList');?>" target="center"><i class="arrow"></i> 题目列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#taskMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 任务管理</a>
                <ul id="taskMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techtask/taskMadeView');?>" target="center"><i class="arrow"></i> 生成任务试卷</a></li>
                    <li><a href="<?php echo site_url('teacher/techtask/taskPubView/'.$username.'');?>" target="center"><i class="arrow"></i> 任务发布</a></li>
                    <li><a href="<?php echo site_url('teacher/techtask/taskManageView');?>" target="center"><i class="arrow"></i> 任务管理</a></li> 
                </ul>
            </li>
            <li>
                <a href="#examMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 考试管理</a>
                <ul id="examMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techexam/examMadeView');?>" target="center"><i class="arrow"></i> 生成考试试卷</a></li>
                    <li><a href="<?php echo site_url('teacher/techexam/examPubView/'.$username.'');?>" target="center"><i class="arrow"></i> 考试发布</a></li>
                    <li><a href="<?php echo site_url('teacher/techexam/examManageView');?>" target="center"><i class="arrow"></i> 考试试卷管理</a></li>
                </ul>
            </li>
            <li>
                <a href="#search_taskMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 查询任务情况</a>
                <ul id="search_taskMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techscore/oricTaskScore');?>" target="center"><i class="arrow"></i> 口语评分</a></li>
                    <li><a href="<?php echo site_url('teacher/techscore/textTaskScore');?>" target="center"><i class="arrow"></i> 写作评分</a></li>
                    <li><a href="<?php echo site_url('teacher/techscore/searchTaskScore');?>" target="center"><i class="arrow"></i> 查看当前分数</a></li>
                </ul>
            </li>
            <li>
                <a href="#search_examMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 查询考试情况</a>
                <ul id="search_examMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techscore/oricExamScore');?>" target="center"><i class="arrow"></i> 口语评分</a></li>
                    <li><a href="<?php echo site_url('teacher/techscore/textExamScore');?>" target="center"><i class="arrow"></i> 写作评分</a></li>
                    <li><a href="<?php echo site_url('teacher/techscore/searchExamScore');?>" target="center"><i class="arrow"></i> 查看当前分数</a></li>
                </ul>
            </li>
            <li>
                <a href="#listenMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 自主学习管理</a>
                <ul id="listenMenu" class="nav nav-list collapse menu-second">
                    <li><a href="#"><i class="arrow"></i> 生成精听试卷</a></li>
                    <li><a href="#"><i class="arrow"></i> 精听列表</a></li>
                    <li><a href="#"><i class="arrow"></i> 设置精听通过分数</a></li>
                </ul>
            </li>
            <li>
                <a href="#taskPKMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 任务PK</a>
                <ul id="taskPKMenu" class="nav nav-list collapse menu-second">
                    <li><a href="#"><i class="arrow"></i> 生成PK试卷</a></li>
                    <li><a href="#"><i class="arrow"></i> 任务PK列表</a></li>
                    <li><a href="#"><i class="arrow"></i> 已发布任务PK列表</a></li>
                    <li><a href="#"><i class="arrow"></i> 设置PK通过分数</a></li>
                </ul>
            </li>
            <li>
                <a href="#tipsMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 通知管理</a>
                <ul id="tipsMenu" class="nav nav-list collapse menu-second">
                    <li><a href="<?php echo site_url('teacher/techmessage/pubMessage/'.$username.'');?>" target="center"><i class="arrow"></i> 发布通知</a></li>
                    <li><a href="<?php echo site_url('teacher/techmessage/showList');?>" target="center"><i class="arrow"></i> 通知列表</a></li>
                </ul>
            </li>
            <li>
                <a href="#scoreMenu" class="nav-header menu-first collapsed" data-toggle="collapse"><i class="icon-book icon-large"></i> 成绩管理</a>
                <ul id="scoreMenu" class="nav nav-list collapse menu-second">
                    <li><a href="#"><i class="arrow"></i> 导出成绩</a></li>
                </ul>
            </li>
        </ul>    
    </div>
        <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
</body>
</html>