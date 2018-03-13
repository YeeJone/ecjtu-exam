<!DOCTYPE html>
<html>
<head>
	<title>AddQuesType</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>添加题型</p>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" name="fileinfo" id="a_form">
            <div class="form-group">
                <label for="quesname" class="col-sm-2 control-label">题型名称</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="quesname" placeholder="" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="quesenname" class="col-sm-2 control-label">英文名称</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="quesenname" placeholder="" name="enname">
                </div>
            </div>
           <!--  <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">填空题个数</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="" name="email">
                </div>
            </div>  -->
             <!-- <div class="form-group">
                <label class="col-sm-2 control-label">选择题个数</label>
                <label class="checkbox-inline col-sm-1 control-label">
                    <input type="radio" id="inlineCheckbox1" value="男" name="sex" checked="checked"> 男
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox2" value="女" name="sex"> 女
                </label>
            </div> -->
            <!-- <div class="form-group">
                <label for="inputqq3" class="col-sm-2 control-label">选项个数</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputqq3" placeholder="" name="qq_numnber">
                </div>
            </div> -->
            <!-- <div class="form-group">
                <label for="inputphone3" class="col-sm-2 control-label">总时间</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputphone3" placeholder="" name="phone">
                </div>
            </div> -->
            <div class="form-group">
                <label for="direction" class="col-sm-2 control-label">direction</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="direction" placeholder="" name="phone">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">题目描述</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="description" placeholder="" name="phone">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-6 button">
                    <button type="submit" class="btn btn-default" id="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script type="text/javascript">
        var submit=$("#submit");
        submit.on("click",function(){
        var $this = $(this);
        var parent= $this.parent().parent().parent();
        var quesname = $("#quesname").val();
        var quesenname = $("#quesenname").val();
        var direction = $("#direction").val();
        var description = $("#description").val();

        $.ajax({
                        url: "<?php echo site_url('admin/adques/addQuesType');?>",
                        type: 'POST',
                        dataType: 'json',
                        data: {  
                                quesname:quesname,
                                quesenname:quesenname,
                                direction:direction,
                                description:description,
                            },
                        success:function(data)
                        {
                            if(data)
                            {
                                alert("添加成功");
                            }
                            else{
                                alert("添加失败");
                            }
                        },
                        error:function(error)
                        {
                            //console.log(error.responseText);
                            alert("后台出了点小问题，稍后再来吧...");
                        },
                    }); 
    })
    </script>
</body>
</html>