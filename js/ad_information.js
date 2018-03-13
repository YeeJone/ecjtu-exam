//将PHP生成的json字符串赋值给js变量
//var user = '<?php echo $json;?>';

$(function(){

	//将数据加载到表单中
	//loadData(user);

	var submit=$("#submit");
	submit.on("click",function(){
  
        var $this = $(this);
        var user = $('#username').text();
        var parent= $this.parent().parent().parent();
		var name = $("#inputName3").val();//姓名
		var phone = $("#inputphone3").val();//电话
		var sex_input = parent.find("input[name='sex']");
		var passwor = $("#inputPassword3").val();
		var email = $("#inputEmail3").val();
		var qq_numnber = $("#inputqq3").val();
		sex_input.each(function(){
			            if(this.checked){
				           sex_val=this.value;
			            }
		            });
		
		$.ajax({
	    	            url: 'http://localhost:8080/ecjtuexam/index.php/admin/adinfo/updateInfo2',
	    	            type: 'POST',
	    	            dataType: 'json',
	    	            data:{
	    	            	user_id:user,
	    	    	        user_sex:sex_val,
	    	                user_name:name,
	    	                user_phone:phone,
	    	                user_email:email,
	    	                user_password:passwor,
	    	                user_qq_numnber:qq_numnber,
	    	            },
		                success:function(data)
		                {
		        	        if(data.status==1)
		        	        {
		        	        	alert(data.msg);
		        		        //alert('ok');//$(location).attr('href', 't_information.html');//跳转到信息查看页面
		        	        }
		        	        else if(data.status==0)
		        	        {
		        		        alert("填写信息有问题，再检查一下");
		        	        }
		                },
		                error:function(error)
		                {
		                	//console.log(error.responseText);
		                	//console('error');
		        	        alert("后台出了点小问题，稍后再来吧...");
		                },
	                }); 
	})

});


function loadData(jsonStr){
	var obj = eval("("+jsonStr+")");
	var key,value,tagName,type,arr;
	for(x in obj){
		key = x;
		value = obj[x];
		
		$("[name='"+key+"'],[name='"+key+"[]']").each(function(){
			tagName = $(this)[0].tagName;
			type = $(this).attr('type');
			if(tagName=='INPUT'){
				if(type=='radio'){
					$(this).attr('checked',$(this).val()==value);
				}else if(type=='checkbox'){
					arr = value.split(',');
					for(var i =0;i<arr.length;i++){
						if($(this).val()==arr[i]){
							$(this).attr('checked',true);
							break;
						}
					}
				}else{
					$(this).val(value);
				}
			}else if(tagName=='SELECT' || tagName=='TEXTAREA'){
				$(this).val(value);
			}
			
		});
	}
}