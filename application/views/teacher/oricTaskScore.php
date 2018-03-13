<!DOCTYPE html>
<html>
<head>
	<title>RadioList</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/studentList.css');?>">
</head>
<body>
    <div class="container">
    	<p class="title">录音列表</p>
    	<table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <th>任务编号</th>
                <th>测试名称</th>
                <th>学生姓名</th>
                <th>flash题目</th>
                <!-- <th>录音文件</th> -->
                <th>打分</th>
            </thead>
 
            <tbody>
            </tbody>
        </table>
    </div>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
<script type="text/javascript">
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
            "url":"<?php echo site_url('teacher/techscore/getOric/0');?>",
            success:function(data)
            {
                console.log(data);
            },
            error:function(error)
            {
                console.log(error.responseText);
            },
        },
        "columns":[
            {
                "data":"taskid",
            },
            {
                "data":"testname",
            },
            {
                "data":"studentname",
                 "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                 $(nTd).html("<p class='t_active'>"+sData.realname+"</p>");
                }
            },
            {
                "data":"flashfile"
            },
            // {
            //     "data":"radiofile"
            // },
            {
                "data":"score",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                    $(nTd).html("<input type='text' style='width:85px; height:22px' class='form-control' placeholder='填写分数'/>").append("<button type='button' class='btn btn-default activebtn' onclick='activeFun(this)'>提交</button>");
                }
            },
        ]

        });
        return table;
    }

    /**激活**/
    function activeFun(obj) {
        var text=$(obj).text();
        if(text=='踢出'){
            $(obj).prev().attr("data-is","0");
        }else{
            $(obj).prev().attr("data-is","1");
        }       
        var data_is=$(obj).prev().attr("data-is");
        var t_id=$(obj).prev().attr("t_id");
        $.ajax({
            type:"post",
            url:"<?php echo site_url('teacher/techclass/updateApply');?>",//php
            data:{
                'id':t_id,
                'data_is':data_is
            },
            success:function(data){
                   if(text=='踢出'){
                        $(obj).text("批准申请");
                        $(obj).prev().text("申请中");
                    }else{
                        $(obj).text("踢出");
                        $(obj).prev().text("申请成功");
                    }
            },
            error:function(error){
                if(text=='踢出'){
                    $(obj).prev().attr("data-is","1");
                }else{
                    $(obj).prev().attr("data-is","0");
                }
                alert("后台出了点小问题，稍后再来吧~");
            }
        });
    }

</script>
</body>
</html>