<!DOCTYPE html>
<html>
<head>
	<title>大学英语任务与测试系统</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>" />
	<style type="text/css">
	    *{
	    	border: 0;
	    	padding:0;
	    	margin: 0;
	    	font-family: '微软雅黑';
	    }
        #container{
        	background: rgba(0,0,0,0.5);
        	width: 100%;
        	height: 100%;
        	position: absolute;

        }
	    .bg_img{
			background: url(images/4.jpg) no-repeat center fixed;
            background-attachment: fixed;
            background-position: center 0;
            background-repeat: no-repeat;
            background-size: 100% 100%;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -10;
		}
		#container p{
			width: 100%;
            font-size: 40px;
            font-weight: 800;
            text-align: center;
            color: #fff;
            padding-top: 150px;
            letter-spacing: 5px;
		}
		#container p span{
			font-size: 20px;
			letter-spacing: 2px;
		}
		#container .role{
			width: 750px;
			height: 200px;
			margin: 0 auto;
		}
		#container .role .a_role{
			width: 250px;
			float: left;
            height: 200px;
		}
		#container .role .a_role img{
			display: block;
			margin: 0 auto;
			margin-top: 100px;
		}
		#container .role .a_role p{
			text-align: center;
			font-size: 20px;
			padding-top: 10px;
		}
		#container .role .a_role a{text-decoration: none;}
	</style>
</head>
<body>
    <div class="bg_img"></div>
    <div id="container">
    	<p>欢迎使用大学英语任务与测试系统<br><span>WELCOME TO USE COLLEGE ENGLISH TASK AND TEST SYSTEM</span></p>
    	<div class="role">
    		<div class="a_role">
    		    <a href="<?php echo site_url('login/adminConfirm');?>">
    			    <img src="images/admin.png">
    			    <p>管理员</p>
    			</a>
    		</div>
    		<div class="a_role">
    		    <a href="<?php echo site_url('login/teacherLogin');?>">
    			    <img src="images/teacher.png">
    			    <p>老师</p>
                </a>
    		</div>
    		<div class="a_role">
    		    <a href="<?php echo site_url('login/studentLogin');?>">
    			    <img src="images/student.png">
    			    <p>学生</p>
                </a>
    		</div>
    	</div>
    </div>
</body>
</html>