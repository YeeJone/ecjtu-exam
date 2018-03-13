<!DOCTYPE html>
<html lang="en" class="no-js">
    <head>

        <meta charset="utf-8">
        <title>找回密码</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- CSS -->
        <!-- <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=PT+Sans:400,700'> -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/supersized.css');?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/lose_pd.css');?>">

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>
    <body>

        <div class="page-container">
            <h1>找回密码</h1>
            <form action="" method="post">
                <select class="select">
                    <option value="" selected="true" disabled="true">选择身份</option>
                    <option value="学生">学生</option>
                    <option value="教师">教师</option>
                    <option value="管理员">管理员</option>
                </select>
                <input type="text" name="username" class="username" placeholder="用户名">
                <input type="text" name="truename" class="truename" placeholder="真实姓名">
                <input type="text" name="phone" class="phone" placeholder="手机号码">
                <button type="submit">提交</button>
                <div class="error"><span>+</span></div>
            </form>
            <div class="connect">
                <p>Or connect with:</p>
                <p>
                    <a class="home" href="<?php echo site_url();?>"></a>
                    <!-- <a class="register" href="<?php echo site_url('login/studentLogin');?>"></a> -->
                </p>
            </div>
            <p class="tips"><b>学生身份找回密码时遗忘以上信息，请告知本班老师帮助找回！</b></p>
        </div>

        <!-- Javascript -->
        <script src="<?php echo base_url('js/jquery-1.8.2.min.js');?>"></script>
        <script src="<?php echo base_url('js/supersized.3.2.7.min.js');?>"></script>
        <script src="<?php echo base_url('js/supersized-init.js');?>"></script>
        <script src="<?php echo base_url('js/lose_pd.js');?>"></script>
    </body>

</html>

