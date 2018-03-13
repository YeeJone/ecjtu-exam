<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>教师登录</title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<style>
		body{padding: 0;margin: 0;background: #F7FAFC;}
		a{text-decoration: none;}
		.index-box{width:300px;height: auto;margin:0 auto;margin-top: 40px;}		
		.title{font-size: 18px;text-align: center;color: #707171;font-weight: bold;margin: 30px auto;}		
		.index-body{text-align: center;}
		.nav-sliders{position: relative;display: inline-block;margin-bottom: 20px;}
		.nav-sliders>a{font-size: 20px;display: inline-block;width:60px ;font-family: "微软雅黑";color: #999;cursor: pointer;float: left;text-decoration: none;}
		.nav-sliders>a.active{color: #0f88eb;}
		.nav-sliders>span{position: absolute;height: 2px;background:#0f88eb;display:block;left: 65px;width: 50px;bottom:-8px;}
		
		
		.login-box{width: 300px;display: block;}
		.wrap{border:1px solid #d5d5d5;border-radius: 5px;background: #fff;}
		.wrap>div{position: relative;overflow: hidden;}
		.wrap>div>input{width: 95%;border:none;padding:17px 2.5%;border-radius: 5px;}
		.wrap>div>label.error{position: absolute;color: #c33;top: 0;line-height: 50px;transform: translate(25px,0);transition: all 0.5s ease-out;-webkit-transform: translate(25px,0);-moz-transform: translate(25px,0);opacity: 0;visibility:hidden;cursor: text;}
		.wrap>div>label.move{transform: translate(0,0);transition: all 0.5s ease-out;-webkit-transform: translate(0,0);-moz-transform: translate(0,0);opacity: 1;visibility: visible;}
		.password{height:50px;border-top: solid 1px #d5d5d5 ;}
		.code{right:115px ;}
		.button{height: 40px;background:#0f88eb;text-align: center;line-height: 40px;border-radius: 5px;margin-top: 25px;color: #fff;font-family: "微软雅黑";cursor: pointer;}
		.remember{text-align: left;margin-top: 20px;font-family: "微软雅黑";color: #666666;}
		.remember>a{float:right;cursor: pointer;color: #666666;text-decoration: none;}
		.download{border:solid 1px #0f88eb;height: 40px;line-height: 40px;border-radius: 5px;color:#0f88eb ;font-family: "微软雅黑";margin-top: 50px;cursor: pointer;position: relative;}
		.download>.close{display: none;}
		.download .pic{display:none;position: absolute;background: #fff;bottom: 78px;width: 310px;left: -10px;z-index: 5;padding: 40px 0;border-radius: 8px;box-shadow: 0 0 8px 0 rgba(0,0,0,.15);}
		.download a{text-decoration: none;}
		.registered-box{width: 300px;display: none;}
		.text{font-size: 14px;margin-top: 20px;font-family: "微软雅黑";color: #666666;}
		.text>a{color: #0f88eb;}
		.verification-code{position: absolute;right:22px;top: 14px;font-family: "微软雅黑";font-size: 18px;cursor: pointer;}
		#register:hover{opacity: 0.7;}
		#login:hover{opacity: 0.7;}
		#man,#woman{width: 20px;border:none;padding:17px 2.5%;border-radius: 5px;}
		.sex{float: left;padding-top: 15px;}
		.password select{float: left;height: 50px;width: 40%;border-top: 0px;border-left: 0px;border-bottom: 0px;}
	</style>
	</head>
	<body>
		<div class="index-box">
			<div class="index-header">
				<h2 class="title">快快加入我们，一起快乐学英语</h2>
			</div>
			<div class="index-body">
				<div class="nav-sliders">
					<a class="registered">注册</a>
					<a class="login active">教师登录</a>
					<span class="on"></span>
				</div>
				<div class="change">
				<!--登录开始-->
				<?php echo form_open('login/teacherCheck');?>
					<div class="login-box">
						<div class="wrap">
							<div class="phone">
								<input type="text" name="username" id="login-name" value="" placeholder="用户名">
								<label class="error phone restet">请输入用户名</label>
							</div>
							<div class="password">
								<input type="password" name="password"  id="login-password" placeholder="密码" minlength="1">
								<label class="error passwor">请输入密码</label>
							</div>
						</div>
						<div class="button" id="login">登录</div>
						<input type="submit" style="display:none;" id="btn" />
						<div class="remember">
							<label><input type="checkbox">记住我:</label>
							<a href="<?php echo site_url('losepd');?>">忘记密码?</a>
						</div>
						<div class="download">
							<span><a href="<?php echo site_url();?>">返回角色选择</a></span>
						</div>
					</div>
				</form>
				<!--登录结束-->
				</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
		<script type="text/javascript">
			var $button=document.querySelector('#login');
			$button.addEventListener('click',function(){
				var $btn=document.querySelector('#btn');
				$btn.click();
			});

		</script>
	</body>
</html>