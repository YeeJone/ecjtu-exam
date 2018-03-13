<!DOCTYPE html>
<html>
<head>
    <title>QuesList</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/studentList.css');?>">
</head>
<body>
    <div class="container">
        <p class="title">文本内容</p>
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <tbody>
                <tr>
                    <th scope="row">文本内容</th>
                    <td><?php echo $text;?></td>
                </tr>
                <!-- <tr>
                    <th scope="row">EnglishName</th>
                    <td><?php echo $Q_Ename;?></td>
                </tr>
                <tr>
                    <th scope="row">题型简介</th>
                    <td><?php echo $Q_CInfo;?></td>
                </tr>
                <tr>
                    <th scope="row">英文简介</th>
                    <td><?php echo $Q_EInfo;?></td>
                </tr> -->
               <!--  <tr>
                    <th scope="row">选择题个数</th>
                    <td><?php echo $Q_Select;?></td>
                </tr>
                <tr>
                    <th scope="row">填空题个数</th>
                    <td><?php echo $Q_Blank;?></td>
                </tr>
                <tr>
                    <th scope="row">选项个数</th>
                    <td><?php echo $Q_Num;?></td>
                </tr>
                <tr>
                    <th scope="row">总时间</th>
                    <td><?php echo $Q_Time;?></td>
                </tr> -->
                <!-- <tr>
                    <th scope="row">题目类型</th>
                    <td><?php echo $Q_Type;?></td>
                </tr>
                <tr>
                    <th scope="row">题型名称</th>
                    <td><?php echo $Q_Temp;?></td>
                </tr> -->
                <tr>
                    <th scope="row">操作</th>
                    <td><a href="<?php echo site_url('teacher/techscore/textTaskScore');?>">返回</a></td>
                </tr>
            </tbody>
        </table>
    </div>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
</body>
</html>