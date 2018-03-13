$(function(){

	//将数据加载到表单中
	//loadData(user);

	var submit=$("#submit");
	submit.on("click",function(){
  
        var $this = $(this);
        var user = $('#username').val();
        var parent= $this.parent().parent().parent();
		var name = $("#inputName3").val();//姓名
		var phone = $("#inputphone3").val();//电话
		var sex_input = parent.find("input[name='sex']");
		var passwor = $("#inputPassword3").val();
		var email = $("#inputEmail3").val();
		var qq_numnber = $("#inputqq3").val();
		var school = $('#school option:selected').val();
		sex_input.each(function(){
			            if(this.checked){
				           sex_val=this.value;
			            }
		            });
		
		$.ajax({
	    	            url: 'http://localhost:8080/ecjtuexam/index.php/admin/adteach/addTechInfo',
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
	    	                user_school:school,
	    	            },
		                success:function(data)
		                {
		        	        if(data.status==1)
		        	        {
		        	        	alert(data.msg);
		        	        }
		        	        else if(data.status==0)
		        	        {
		        		        alert(data.msg);
		        	        }
		                },
		                error:function(error)
		                {
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