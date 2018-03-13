<!DOCTYPE html>
<html>
<head>
	<title>StudentList</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/studentList.css');?>">
</head>
<body>
    <div class="container">
    	<p class="title">教师列表</p>
    	<table id="example" class="display" cellspacing="0" width="100%">
            <thead>
                <th>登录名</th>
                <th>密码</th>
                <th>电话</th>
                <th>教师姓名</th>
                <th>性别</th>
                <th>邮箱</th>
                <th>QQ</th>
                <th>是否激活</th>
                <th>所在学校</th>
                <th>编辑</th>
            </thead>
 
            <tbody>
            </tbody>
        </table>
    </div>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
<!-- <script src="http://cdn.datatables.net/plug-ins/1.10.15/api/fnReloadAjax.js"></script> -->
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
            "url":"<?php echo site_url('admin/adteach/techShowList');?>",
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
                "data":"T_number",
            },
            {
                "data":"password",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='javascript:void(0);' class='pd_text' onclick='hiddenShow(this)'>显示</a>").append("<p class='pd'>"+sData+"</p>");
                },
            },
            {
                "data":"phone"
            },
            {
                "data":"true_name"
            },
            {
                "data":"sex"
            },
            {
                "data":"email"
            },
            {
                "data":"QQ"
            },
            {
                "data":"is_active",
                "fnCreatedCell":function(nTd,sData,oData,iRow,iCol){
                    if(sData==1){
                        $(nTd).html("<p class='t_active' data-is='1' t_id=" + oData.T_number + ">已激活</p>").append("<button type='button' class='btn btn-default activebtn' onclick='activeFun(this)'>关闭</button>");
                    }else{
                        $(nTd).html("<p class='t_active' data-is='0' t_id=" + oData.T_number + ">未激活</p>").append("<button type='button' class='btn btn-default activebtn' onclick='activeFun(this)'>激活</button>");
                    }
                }
            },
            {
                "data":"college"
            },
            {
                "data":"edit",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                $(nTd).html("<a href='<?php echo site_url('admin/adteach/searchClass/');?>"+sData+"'>查看所带班级</a>");

                }
            },
        ]

        });
        return table;
    }

    /**密码显示，隐藏**/
    function hiddenShow(obj) {
        var val=$(obj).next().css("display");
        if(val=="none"){
            $(obj).next().css("display","block");
            $(obj).text("隐藏");
        }else{
            $(obj).text("显示");
            $(obj).next().css("display","none");
        }
    }

    /**删除函数**/
    function _searchFun(id) {
                $.ajax({
                    url: "<?php echo site_url('teacher/adteach/searchClass');?>",//php地址
                    data: {"id": id},
                    type: "post",
                    success: function (backdata) {
                        if (backdata) {
                            aTable.draw( false );
                        } else {
                            alert("删除失败");
                        }
                        //console.log(backdata);
                    }, error: function (error) {
                        alert("后台出了点小问题，稍后再来吧~");
                    }
                });
    }

    /**激活**/
    function activeFun(obj) {
        var text=$(obj).text();
        if(text=='关闭'){
                    $(obj).prev().attr("data-is","0");
                }else{
                    $(obj).prev().attr("data-is","1");
                }       
        var data_is=$(obj).prev().attr("data-is");
        var t_id=$(obj).prev().attr("t_id");
        $.ajax({
            type:"post",
            url:"<?php echo site_url('admin/adteach/isActive');?>",//php
            data:{
                'id':t_id,
                'data_is':data_is
            },
            success:function(data){
                   if(text=='关闭'){
                        $(obj).text("激活");
                        $(obj).prev().text("未激活");
                    }else{
                        $(obj).text("关闭");
                        $(obj).prev().text("已激活");
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