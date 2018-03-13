$(function(){

	var submit=$("#submit");
	submit.on("click",function(){
        var $this = $(this);
        var radio = $('input:radio:checked').val();
        var name = $('.qnInput').val();
        var select = $('#select option:selected').val();
        var style = $('#style option:selected').val();
        var flash = $("#name").text();
        var teachername = $("#teachername").text();
        if(name =="" || flash ==""){
        	alert("请检查信息是否填写完整,flash文件要先上传再提交!");
        }else{
            $.ajax({
                    type:"post",
                    url:"http://localhost:8080/ecjtuexam/index.php/teacher/techques/questionSave",
                    dataType:"json",
                    data:{
                      testtype:radio,
                      questiontype:select,
                      questionname:name,
                      t_flash:flash,
                      questionstyle:style,
                      teachername:teachername
                    },
                    success:function(data)
                    {
                    	if (data.status == 1) {
                    		alert(data.msg);
                    		window.location.reload();
                    	}else if(data.status == 0){
							alert(data.msg);
							window.location.reload();
                    	}
                    },
                    error:function(error)
                    {
                    	console.log(error.resopnseText);
                    	//console.log(123);
                    	//alert('后台出了点问题请稍后再来');
                    	//window.location.reload();
                    },
                });
		}
	});
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
