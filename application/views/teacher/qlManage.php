<!DOCTYPE html>
<html>
<head>
	<title>题目列表</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/studentlist.css');?>">
</head>
<body>
    <div class="container" style="">
    	<p class="title"><?php echo $typename;?>列表</p>
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <th>题目名称</th>
                <th>出题教师</th>
                <th>文件名称</th>
                <th>测试类型</th>
                <th>发布状态</th>
                <th>编辑</th>
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
            "url":"<?php echo site_url('teacher/techques/getQuesList/'.$typeid.'');?>",
        },
        "columns":[
            {
                "data":"questionname",
            },
            {
                "data":"teachername"
            },
            {
                "data":"flash"
            },
            {
                "data":"testtype",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                    if (sData == 0) {
                        $(nTd).html("考试题目");
                    }else{
                        $(nTd).html("自主学习题");
                    }
                }
            },
            {
                "data":"is_active",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                    if(sData==1){
                        $(nTd).html("<p class='t_active' data-is='1' t_id=" + oData.edit + ">已发布</p>").append("<button type='button' class='btn btn-default activebtn' onclick='activeFun(this)'>取消发布</button>");
                    }else{
                        $(nTd).html("<p class='t_active' data-is='0' t_id=" + oData.edit + ">未发布</p>").append("<button type='button' class='btn btn-default activebtn' onclick='activeFun(this)'>发布</button>");
                    }
                }
            },
            {
                "data":"edit",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='javascript:void(0);' onclick='_deleteFun(" + sData + ")'>删除</a>").append("<a href='<?php echo site_url('teacher/techques/showQues/')?>"+sData+"'> 查看</a>");

                }
            },
        ]

        });
        return table;
    }

    function _deleteFun(id) {
        if(confirm('确定删除这个题目吗?')){ 
                $.ajax({
                    url: "<?php echo site_url('teacher/techques/deleteQues');?>",//php地址
                    data: {"id": id},
                    type: "post",
                    success: function (backdata) {
                        if (backdata) {
                            aTable.draw( false );
                        } else {
                            alert("删除失败");
                        }
                    }, error: function (error) {
                        alert("后台出了点小问题，稍后再来吧~");
                    }
                });
            }
    }

    /**激活**/
    function activeFun(obj) {
        var text=$(obj).text();
        if(text=='取消发布'){
                    $(obj).prev().attr("data-is","0");
                }else{
                    $(obj).prev().attr("data-is","1");
                }       
        var data_is=$(obj).prev().attr("data-is");
        var t_id=$(obj).prev().attr("t_id");
        $.ajax({
            type:"post",
            url:"<?php echo site_url('teacher/techques/quesPub');?>",//php
            data:{
                'id':t_id,
                'data_is':data_is
            },
            success:function(data){
                   if(text=='取消发布'){
                        $(obj).text("发布");
                        $(obj).prev().text("未发布");
                    }else{
                        $(obj).text("取消发布");
                        $(obj).prev().text("已发布");
                    }
            },
            error:function(error){
                if(text=='关闭'){
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