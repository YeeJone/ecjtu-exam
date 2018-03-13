<!DOCTYPE html>
<html>
<head>
	<title>Listen list</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/DataTables.min.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/task_list.css');?>">
</head>
<body>
  <div class="container">
    <p>精听试卷列表</p>
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>试卷名称</th>
            <th>试卷类型</th>
            <th>考试开始时间</th>
            <th>考试入口开放时间</th>
            <th>出卷人</th>
            <th>操作</th>
        </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>试卷名称</th>
                <th>试卷类型</th>
                <th>考试开始时间</th>
                <th>考试入口开放时间</th>
                <th>出卷人</th>
                <th>操作</th>
            </tr>
        </tfoot>
 
        <tbody>
           
        </tbody>
    </table>
  </div>  
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript">
	$(document).ready(function() {
  $('#example').dataTable();
} );
</script>
</body>
</html>