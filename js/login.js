var code;//定义一个全局验证码
var l_judge=1;//登录格式填写正确判断
var r_judge=1;//注册格式填写正确判断
			$(function(){
				jcPublic.register();
				jcPublic.Tab();
				jcPublic.login();	
				jcPublic.createCode();
				jcPublic.clickCode();
				$(".wrap>div>input").focus(function(){
        			$(this).css({"outline": "none" });
        			var $this = $(this);
        			$this.next("label").removeClass("move")//隐藏提示信息
    			})
    			$(".sex>input").focus(function(){
        			
        			$(".sex").next("label").removeClass("move")//隐藏提示信息
    			})
				$(".password>select").focus(function(){
        			
        			$(this).css({"outline": "none" });
        			var $this = $(this);
        			$this.next("label").removeClass("move")//隐藏提示信息
    			})
				
				//ajax数据交互

				//注册部分
				var r_submit=$("#register");
				r_submit.on("click",function(){
                    var $this = $(this);
                    var parent= $this.parent();
					var name = $("#name").val();//姓名
					var phone = $("#phone").val();//电话
					var sex_input = parent.find("input[name='sex']");
					var passwor = $("#passwor").val();//第一次密码
					var pd_again = $("#pd_again").val();//第二次密码
					var select1 = $(".select1 option:selected").val();
					var select2 = $(".select2 option:selected").val();
					var Code = $("#code").val();//验证码 
		            sex_input.each(function(){
			            if(this.checked){
				           sex_val=this.value;
			            }
		            });
		            if (r_judge) {
			    	$.ajax({
	    	            url: 'http://localhost:8080/ecjtuexam/index.php/register/registerCheck',
	    	            type: 'POST',
	    	            dataType: 'json',
	    	            data: { 
	    	    	            user_sex:sex_val,
	    	                    user_name:name,
	    	                    user_phone:phone,
	    	                    user_school:select1,
	    	                    user_class:select2,
	    	                    user_password:passwor,
	    	                    user_passrepeat:pd_again,
	    	                    code:Code,
	    	                },
		                success:function(data)
		                {

		        	        if(data.status==1)
		        	        {
		        	         	//console.log(data);
		        		        alert("注册成功！");
		        		        location.href = "http://localhost:8080/ecjtuexam/index.php/login/studentLogin";

		        	        }
		        	        else
		        	        if(data.status==2)
		        	        {
		        	        	console.log(data);
		        		        alert("填写信息有问题，再检查一下");
		        	        }
		        	        else
		        	        if(data.status==3)
		        	        {
		        		        alert("你已经注册过了");
		        	        }
		                },
		                error:function(error)
		                {
		                	//console.log(error.responseText);
		        	        alert("后台出了点小问题，稍后再来吧...");
		                },
	                });            	
		            }					
				});
				
			})
			
			var jcPublic = new Object( Boolean ); 
			jcPublic = {
				register:function(){//注册
					var currentThis = this//当前对象
					$("#register").on("click",function(){
						var $this = $(this);
						var name = $("#name").val();//姓名
						var phone = $("#phone").val();//电话
						var man = $("#man");
						var woman = $("#woman");
						var passwor = $("#passwor").val();//第一次密码
						var pd_again = $("#pd_again").val();//第二次密码
						var select1 = $(".select1 option:selected").val();
						var select2 = $(".select2 option:selected").val();
						var Code = $("#code").val();//验证码
						var p_reg = /^0{0,1}(13[0-9]|15[0-9]|153|156|18[0-9])[0-9]{8}$/;//电话验证
						if(name.length==0 && phone.length==0 && passwor.length==0){//同时为空
							$this.prev(".wrap").find("label").addClass("move");
							r_judge=0;
							return false;
						}else if(name.length!=0 && phone.length!=0 && passwor.length!=0){
							$this.prev(".wrap").find("label").removeClass("move");
							return false;
						}else if(name == "" || name == "undefined" || name == "null"){
							$this.prev(".wrap").find(".name").addClass("move");
							r_judge=0;
							return false;
						}else if(phone == "" || phone == "undefined" || phone == "null"){
							$this.prev(".wrap").find(".phone").addClass("move");
							r_judge=0;
							return false;
						}else if(passwor == "" || passwor == "undefined" || passwor == null ){
							$this.prev(".wrap").find(".passwor").addClass("move");
							r_judge=0;
							return false;
						}else if(select1 == "" || select1 == "undefined" || select1 == null ){
                            $this.prev(".wrap").find(".school").addClass("move");
                            r_judge=0;
                            return false;
						}else if(select2 == "" || select2 == "undefined" || select2 == null ){
                            $this.prev(".wrap").find(".class").addClass("move");
                            r_judge=0;
                            return false;
						}else if(Code == "" || Code == "undefined" || Code == null ){
							$this.prev(".wrap").find(".code").addClass("move");
							r_judge=0;
							return false;
						}else if(!man.prop('checked') && !woman.prop('checked')){
							$this.prev(".wrap").find(".a_sex").addClass("move");
							r_judge=0;
							return false;
						}else if(code !== Code ){
							$this.prev(".wrap").find(".code").html("验证码有误").addClass("move");
							r_judge=0;
							return currentThis.createCode();//验证码输入有误就刷新验证码重新输入
						}else if(!p_reg.test(phone)){
							$this.prev(".wrap").find(".restet").html("手机号码格式不正确").addClass("move");
							r_judge=0;
							return false;
						}else if (passwor !== pd_again) {
                            $this.prev(".wrap").find(".pd_again").html("两次密码不一致！").addClass("move");
                            r_judge=0;
                            return false;
						}else{r_judge=1;}
					})
				},
				Tab:function(){//切换注册和登录
					$(".nav-sliders>a").on("click",function(){
						$(this).addClass("active").siblings().removeClass("active");
						var $width = $(this).width();//当前a的宽度
						var $index = $(this).index();//索引
						$(".on").stop(true,true).animate({"left":$width*$index+5+"px"},300);
						$(this).parents(".index-body").children(".change").children().eq($index).stop(true,false).show().siblings().hide();
					})
				},
				login:function(){
					$("#login").on("click",function(){
						var $this = $(this);
						var name = $("#login-name").val();//电话
						var passwor = $("#login-password").val();
						if(name.length==0 && passwor.length==0){//同时为空
							$this.prev(".wrap").find("label").addClass("move");
							l_judge=0;
							return false;
						}else if(name == "" || name == "undefined" || name == "null"){
							$this.prev(".wrap").find(".phone").addClass("move");
							l_judge=0;
							return false;
						}else if(passwor == "" || passwor == "undefined" || passwor == null ){
							$this.prev(".wrap").find(".passwor").addClass("move");
							l_judge=0;
							return false;
						}else{l_judge=1;}
					})
				},
				createCode:function(){//验证码
						var selectChar = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9,'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');//所有候选组成验证码的字符，也可以用中文的 
						code="";
						var codeLength=4;//验证码的长度
						for(var i =0;i<codeLength;i++){
							var index = Math.floor(Math.random()*selectChar.length)//随机数
							code +=selectChar[index];
							//$("#createCade").html(code)
						}
						return $("#createCade").html(code)
	
				},
				clickCode:function(){//切换验证码
					var $this = this;
					$("#createCade").on("click",function(){
						return $this.createCode();
					})
				}
			}