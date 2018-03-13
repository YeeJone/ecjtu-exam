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
        <p class="title">详细介绍</p>
        <table id="example" class="table table-bordered" cellspacing="0" width="100%">
            <tbody>
            <tr>
                <th>题目名称</th>
                <th>题目文件</th>
                <th>分数</th>
            </tr>
            <?php foreach($detail as $key=>$value):?>
                <tr>
                    <td><?=$value['quesname']['quesname']?></td>
                    <td><?=$value['quesname']['queslocate']?></td>
                    <td><?=$value['score']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>

        <?php if($type == 2):?>
        <div class="nextBtn">
            <button type='button' class='btn btn-default activebtn'><a href="<?php echo site_url('student/stuscore/selfScore/'.$stuid.'');?>">返回</a></button>
        </div>
        <?php elseif($type == 1):?>
        <div class="nextBtn">
            <button type='button' class='btn btn-default activebtn'><a href="<?php echo site_url('student/stuscore/examScore/'.$stuid.'');?>">返回</a></button>
        </div>
        <?php else:?>
        <div class="nextBtn">
            <button type='button' class='btn btn-default activebtn'><a href="<?php echo site_url('student/stuscore/taskScore/'.$stuid.'');?>">返回</a></button>
        </div>
        <?php endif;?>

    </div>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
</body>
</html>
