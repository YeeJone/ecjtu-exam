<!DOCTYPE html>
<html lang="en">
<head>
	<title>管理员验证</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">	
				<form class="form-horizontal" style="position: relative;top: 200px;">
					<div class="form-group">
						<label for="exampleInputEmail1">输入管理员密钥</label>
						<input type="password" class="form-control" id="password" placeholder="密钥">
					</div>
					<div class="form-group">
						<div class="col-sm-offset-5 col-sm-2">
							<button class="btn btn-default" id="submit">确认</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
	<script src="<?php echo base_url('js/md5.js');?>"></script>
	<script type="text/javascript">
		$("#submit").on('click',function(){
			var pass = $("#password").val();
			var password = md5(pass);
			$.ajax({
				url:"<?php echo site_url('login/adminPass');?>",
				type:"post",
				data:{
					"password":password,
				},
				success:function(data)
				{
					if (data == 1) {
						window.location.href = "<?php echo site_url('login/adminLogin');?>";
					}else{
						alert("密钥有误");
					}
				},
				error:function(error)
				{
					console.log(error.responseText);
				},

			});
		});
	</script>
</body>
</html>