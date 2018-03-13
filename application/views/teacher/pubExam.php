<!DOCTYPE html>
<html>
<head>
	<title>PubTask</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/generateTaskTest.css');?>">
</head>
<body>
    <div class="container">
    	<p class="title">考试发布</p>
        <div class="testName">
            <label>考试名称: </label>
            <input type="text" name="testName" class="t_name" placeholder="  请填写试卷名称">
        </div>
        <div class="testTime">
            <label>考试时长: </label>
            <input type="text" name="testName" class="t_time" placeholder="  请填写考试时长">
        </div>
        <div class="testInfo">
            <label>考试描述: </label>
            <input type="text" name="testName" class="t_info" placeholder="  请填写考试描述">
        </div>

    	<div class="main">

			<!-- Tab panes -->
			<div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="first">
			    	<table id="example" class="display" cellspacing="0" width="100%">
			            <thead>
			                <th>已有考试试卷</th>
			                <th>
                                <span class="tips">全选 </span><input type="checkbox" name="allcbx" class="CheckAll">  
			                </th>
			            </thead>
			 
			            <tbody>
			            </tbody>
			        </table>
			    </div>
			</div>
    	</div>
    	<button type="button" class="btn btn-default" id="submit">提交</button>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
    <script type="text/javascript">
    $('#example').removeClass( 'display' ).addClass('table table-sthiped table-bordered');
    var examName =$(".t_name");
    var examTime =$(".t_time");
    var examInfo =$(".t_info");
    var allVal = new Array();
    var aTable =initTable();
    

    $('#submit').on('click',function(){
        var examNameVal =examName.val();
        var examTimeVal =examTime.val();
        var examInfoVal =examInfo.val();
        var teachername ="<?php echo $teachername;?>";
        if(examNameVal == '' || examTimeVal =='' || examInfoVal == ''){
            alert("请填写试卷名称！");
        }else{
            $("input[name='checkList']:checkbox:checked").each(function(){ 
                allVal.push($(this).val()); 
            });
            $.ajax({
            	url:'<?php echo site_url('teacher/techexam/examPub');?>',
            	type:"post",
            	data:{
                    examname:examNameVal,
                    examtime:examTimeVal,
                    examinfo:examInfoVal,
                    teachername:teachername,
            		val:allVal,
            	},
            	success:function(data){
                     if(data==1){
                     	alert("提交成功！");
                        window.location.reload();
                     }else{
                     	alert("提交失败！");
                        window.location.reload();
                     }
            	},
            	error:function(error){
                    //alert("后台出了点小问题，请稍后再试...");
                    console.log(error.responseText);
            	}
            });
            }
        });
    

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
        "searching": false,
        "ordering": false,
        "lengthChange": false,
        "processing": true,
        "deferRender":true, //延迟加载
        "serverSide": true,
        "ajax":{
            "type":"post",
            "url":"<?php echo site_url('teacher/techexam/examList');?>",
        },
        "columns":[
            {
                "data":"testname",
            },
            {
                "data":"edit",
                "fnCreatedCell": function(nTd,sData,oData,iRow,iCol){
                   $(nTd).html(" <input type='checkbox' name='checkList' value=" + sData + ">")
                    }
            },
        ]

        });
        return table;
    }	

    /**全选函数**/
    $(".CheckAll").bind("click",function(){           
        var a =$(this).parents('table').find($("input[name='checkList']")).prop("checked",this.checked);
    });
    </script>
</body>
</html>