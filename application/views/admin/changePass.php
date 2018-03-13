<!DOCTYPE html>
<html lang="en">
<head>
	<title>修改密钥</title>
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
						<label for="exampleInputEmail1">输入旧密钥</label>
						<input type="password" class="form-control" id="password1" placeholder="密钥">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">输入新密钥</label>
						<input type="password" class="form-control" id="password2" placeholder="密钥">
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
			var pass1 = $("#password1").val();
			var password1 = md5(pass1);
			var pass2 = $("#password2").val();
			var password2 = md5(pass2);
			$.ajax({
				url:"<?php echo site_url('admin/adinfo/passConfirm');?>",
				type:"post",
				data:{
					"password1":password1,
					"password2":password2,
				},
				success:function(data)
				{
					if (data == 1) {
						alert('修改成功');
					}else{
						alert("原密钥有误");
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