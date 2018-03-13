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
                    <th scope="row">题型名称</th>
                    <td><?php echo $Q_Cname;?></td>
                </tr>
                <tr>
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
                </tr>
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
                    <td><a href="<?php echo site_url('teacher/techques/quesList');?>">返回</a></td>
                </tr>
            </tbody>
        </table>
    </div>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
<!-- <script src="http://cdn.datatables.net/plug-ins/1.10.15/api/fnReloadAjax.js"></script> -->
<!-- <script type="text/javascript">
    $('#example').removeClass( 'display' ).addClass('table table-sthiped table-bordered');
    var aTable;
    aTable=initTable();

    /**初始化表格**/
    function initTable(){
        var table=$('#example').DataTable({
            "language": {
            "sLengthMenu": "每页显示 _MENU_ 条记录",
            "sZeroRecords": "抱歉， 没有找到",
            "sInfo": "从 _START_ 到 _END_ /共 _TOTAL_ 条数据",
            "sInfoEmpty": "没有数据",
            "sInfoFiltered": "(从 _MAX_ 条数据中检索)",
            "sProcessing": "载入中...",
            "paginate": {
                "first":      "首页",
                "last":       "尾页",
                "next":       "下一页",
                "previous":   "上一页"
            }
        },
        "searching": true,
        "ordering": false,
        "processing": true,
        "deferRender":true, //延迟加载
        "serverSide": true,
        "ajax":{
            "type":"POST",
            "url":"<?php echo site_url('teacher/techques/showDetails/'.$id.'');?>",
        },
        "columns":[
            {
                "data":"Q_Cname",
            },
            {
                "data":"Q_Ename"
            },
            {
                "data":"Q_CInfo"
            },
            {
                "data":"Q_EInfo"
            },
            {
                "data":"Q_Select"
            },
            {
                "data":"Q_Blank"
            },
            {
                "data":"Q_Num"
            },
            {
                "data":"Q_Time"
            },
            {
                "data":"Q_Type"
            },
            {
                "data":"Q_Temp"
            },
            {
                "data":"edit",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='<?php echo site_url('teacher/techques/quesList');?>'>返回</a>");
                }
            },
        ]

        });
        return table;
     }

</script> -->
</body>
</html>