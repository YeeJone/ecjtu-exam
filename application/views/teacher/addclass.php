<!DOCTYPE html>
<html>
<head>
	<title>AddTeacher</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>添加班级</p>
        <form class="form-horizontal" enctype="multipart/form-data" method="post" name="fileinfo" id="a_form">
            <div class="form-group">
                <label for="classnum" class="col-sm-2 control-label">班级编号</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="classnum" placeholder="" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="classname" class="col-sm-2 control-label">班级名称</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="classname" placeholder="" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="classinfo" class="col-sm-2 control-label">班级标语</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="classinfo" placeholder="" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="teachername" class="col-sm-2 control-label">负责教师</label>
                <div class="col-sm-6">
                    <h5 id="username"><?php echo $teachername;?></h5>
                    <p id="teachername" style="display: none;"><?php echo $id;?></p>
                </div>
            </div>
            <div class="form-group">
                <label for="school" class="col-sm-2 control-label">所属学校</label>
                <div class="col-sm-6">
                    <select class="form-control" id="school">
                        <!-- <option value="" selected="true" disabled="true">选择学校</option> -->
                        <?php foreach($college as $key => $value):?>
                            <?php if($key == 0):?>
                                <option value="<?=$value['id']?>" selected="true"><?=$value['collegename']?></option>
                            <?php else:?>
                                <option value="<?=$value['id']?>"><?=$value['collegename']?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    </select>
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
    <script src="<?php echo base_url('js/t_addclass.js');?>"></script>
</body>
</html>