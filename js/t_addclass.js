$(function(){

	var submit=$("#submit");
	submit.on("click",function(){
  
        var $this = $(this);
        var teachername = $('#teachername').text();
        var parent= $this.parent().parent().parent();
		var classnum = $("#classnum").val();
		var classname = $("#classname").val();
		var classinfo = $("#classinfo").val();
		var school = $("#school").val();
		
		$.ajax({
	    	            url: 'http://localhost:8080/ecjtuexam/index.php/teacher/techclass/insertClass',
	    	            type: 'POST',
	    	            dataType: 'json',
	    	            data:{
	    	            	class_teachername:teachername,
	    	    	        class_classnum:classnum,
	    	                class_classname:classname,
	    	                class_classinfo:classinfo,
	    	                class_school:school,
	    	            },
		                success:function(data)
		                {
		                	//console.log(data);
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
		                	console.log(error.responseText);
		        	        //alert("后台出了点小问题，稍后再来吧...");
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