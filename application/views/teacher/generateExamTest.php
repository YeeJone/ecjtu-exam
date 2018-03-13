<!DOCTYPE html>
<html>
<head>
	<title>generate exam test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/generateTaskTest.css');?>">
</head>
<body>
    <div class="container">
    	<p class="title">生成考试试卷</p>
        <div class="testName">
            <label>试卷名称: </label>
            <input type="text" name="testName" class="t_name" placeholder="  请填写试卷名称">
        </div>
        <div class="testName">
            <label>答卷时长: </label>
            <input type="text" name="testName" class="t_time" placeholder="  请填写答卷时长">
        </div>
    	<div class="main">
            <ul class="nav nav-tabs" role="tablist">
			<?php foreach($type as $key => $value):?>
                <?php if($key == 0):?>
                 <li role="presentation" class="active">
                <?php else:?>
                 <li role="presentation">
                <?php endif; ?>
                <a href="#tab<?=$key?>" aria-controls="tab<?=$key?>" role="tab" data-toggle="tab"><?=$value['questiontypename']?></a>
                </li>
            <?php endforeach; ?>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
			<?php foreach($type as $key => $value):?>
                <?php if($key == 0):?>
                 <div role="tabpanel" class="tab-pane active" id="tab<?=$key?>">
                <?php else:?>
                 <div role="tabpanel" class="tab-pane" id="tab<?=$key?>">
                <?php endif; ?>
                    <table id="example<?=$value['id']?>" class="display" cellspacing="0" width="100%">
                        <thead>
                            <th>题目名称</th>
                            <th>
                                <span class="tips">全选 </span><input type="checkbox" name="allcbx" class="CheckAll">  
                            </th>
                        </thead>
             
                        <tbody>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
			</div>
    	</div>
    	<button type="button" class="btn btn-default" id="submit">提交</button>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
    <script type="text/javascript">
    <?php foreach($type as $key => $value):?>
    $('#example<?=$value['id']?>').removeClass( 'display' ).addClass('table table-sthiped table-bordered');
    <?php endforeach; ?>

    <?php foreach($type as $key => $value):?>
    var Table<?=$key?>;
    <?php endforeach; ?>

    var testName =$(".t_name");
    var testTime =$(".t_time");
    var allVal =new Array();

    <?php foreach($type as $key => $value):?>
    Table<?=$key?> =initTable(<?=$value['id']?>);
    <?php endforeach; ?>

    $('#submit').on('click',function(){
        var testNameVal =testName.val();
        var testTimeVal =testTime.val();
        if(testNameVal == ''){
            alert("请填写试卷名称！");
        }else{
            $("input[name='checkList']:checkbox:checked").each(function(){ 
                allVal.push($(this).val()); 
            });
            $.ajax({
            	url:'<?php echo site_url('teacher/techexam/examMade');?>',
            	type:"post",
            	data:{
                    name:testNameVal,
                    time:testTimeVal,
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
                    console.log(error.responseText);
                    //alert("后台出了点小问题，请稍后再试...");
            	}
            });
            }
        });
    

    /**初始化表格**/
    function initTable(id){
        var table=$('#example'+id).DataTable({
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
            "url":"<?php echo site_url('teacher/techexam/searchExam');?>",
            "data":{
                id:id,
            },
        },
        "columns":[
            {
                "data":"questionname",
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