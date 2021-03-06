<!DOCTYPE html>
<html>
<head>
    <title>Task list</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/task_list.css');?>">
</head>
<body>
  <div class="container">
    <p>考试试卷列表</p>
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>任务名称</th>
            <th>任务简介</th>
            <th>入口开放时间时间</th>
            <th>入口关闭时间时间</th>
            <th>出卷人</th>
            <th>操作</th>
        </tr>
        </thead>
    </table>
  </div>  
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript">
   $('#example').removeClass( 'display' ).addClass('table table-sthiped table-bordered');
    var aTable;
    var studentname = "<?php echo $studentname;?>";
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
            "url":"<?php echo site_url('student/stutest/getExam/'.$studentname.'');?>",
            // success:function(data)
            // {
            //     console.log(data);
            // },
            // error:function(error)
            // {
            //     console.log(error.responseText)
            // },
        },
        "columns":[
            {
                "data":"T_Name",
            },
            {
                "data":"T_Info"
            },
            {
                "data":"T_Start"
            },
            {
                "data":"T_Finish"
            },
            {
                "data":"T_Author"
            },
            {
                "data":"edit",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    if(sData.status == 2){
                        $(nTd).html("<a href='<?php echo site_url('student/stutest/goExam/');?>"+sData.taskid+"/"+sData.studentname+"'>进入任务</a>");
                    }else if(sData.status == 0){
                        $(nTd).html("<a href='<?php echo site_url('student/stutest/goExam/');?>"+sData.taskid+"/"+sData.studentname+"'>继续任务</a>");
                    }else{
                        $(nTd).html("已完成");
                    }
                }
            },
        ]

        });
        return table;
    }


</script>
</body>
</html>