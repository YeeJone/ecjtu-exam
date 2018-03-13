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
    	<p class="title">文本列表</p>
    	<table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <th>任务编号</th>
                <th>测试名称</th>
                <th>学生姓名</th>
                <th>flash题目</th>
                <th>文本内容</th>
                <th>打分</th>
                <th>操作</th>
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
            "url":"<?php echo site_url('teacher/techscore/getText/0');?>",
            // success:function(data)
            // {
            //     console.log(data);
            // },
            // error:function(error)
            // {
            //     console.log(error.responseText);
            // },
        },
        "columns":[
            {
                "data":"taskid",
            },
            {
                "data":"testname"
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
            {
                "data":"text",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                 $(nTd).html("<a href='<?php echo site_url('teacher/techscore/searchText/');?>"+sData+"'>查看详情</a>");
                }
            },
            {
                "data":"score",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                    if (sData.scorestatus == 0) {
                        $(nTd).html("<input type='text' t_id="+sData.id+" flashfile="+oData.flashfile+" s_id="+oData.studentname.stuid+" id='textscore' taskid="+oData.taskid+" style='width:83px; height:22px' class='form-control' placeholder='填写分数'/>").append("<button id='textbutton' type='button' style='width:53px' class='btn btn-default activebtn' onclick='activeFun(this)'>提交</button>");
                    }else{
                        $(nTd).html("").append("<button  style='width:83px' type='button' disabled='disabled' class='btn btn-default activebtn'>已评分</button>");
                    }
                }
            },
            {
                "data":"edit",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='javascript:void(0);' onclick='_deleteFun(" + sData + ")'>删除</a>");
                }
            },
        ]

        });
        return table;
    }

    /**激活**/
    function activeFun(obj) {
        var id = $(obj).prev().attr("t_id");
        var studentid = $(obj).prev().attr("s_id");
        var taskid = $(obj).prev().attr("taskid");
        var flashfile = $(obj).prev().attr("flashfile");
        var score = $("#textscore").val();
        if (score == '') {
            alert('请填写分数后再提交');
        }else{
            $.ajax({
                type:"post",
                url:"<?php echo site_url('teacher/techscore/updateTextTaskScore/');?>"+id+"",//php
                data:{
                    'studentid': studentid,
                    'taskid': taskid,
                    'score':score,
                    "flashfile":flashfile,
                },
                success:function(data){
                    $("#textbutton").replaceWith("<button disabled='disabled' class='btn btn-default activebtn'>提交成功</button>");
                },
                error:function(error){
                    console.log(error.responseText);
                    alert("后台出了点小问题，稍后再来吧~");
                }
            });
        }
    }

    function _deleteFun(id)
    {
        if(confirm('确定删除?')){ 
            $.ajax({
                url: "<?php echo site_url('teacher/techscore/deleteText');?>",//php地址
                data: {"id": id},
                type: "post",
                success: function (backdata) {
                    if (backdata) {
                        aTable.draw( false );
                    } else {
                        alert("删除失败");
                    }
                }, 
                error: function (error) {
                    alert("后台出了点小问题，稍后再来吧~");
                }
                });
            }
    }

</script>
</body>
</html>