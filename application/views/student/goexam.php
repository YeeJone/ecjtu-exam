<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/gotask.css');?>">
</head>
<body>
    <div class="container" id="container">
        <div id="countdown"></div>
    	<div id="flash">
            <object id="swf" data="" width="100%" height="500px">
                <param name="wmode" value="window" />
                <param name="allowScriptAccess" value="always" />
            </object>	
    	</div>
        <div class="recorder" id="recorder">
            <button id="start" class="ui-btn ui-btn-primary" disabled>录音</button>
            <button id="stop" class="ui-btn ui-btn-primary" disabled>录音完成</button>
            <div id="audio-container"></div>
        </div>
        <div class="t_text" id="t_text">
            <p>作答区域：</p>
            <textarea class="form-control" rows="20" id="text_content" clientidmode="Static"></textarea>
            <button class="btn btn-info" id="text_submit">提交答案</button>
        </div>
        <div class="nextBtn">
            <button id="next" class="btn btn-default">下一题</button>
        </div>
    </div>
    <div id="timeout">
        <p>考试时间到了！</p>
        <a href="">返回主页</a>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/recorder.js');?>"></script>
    <script type="text/javascript">
        var s = 0;
    	window.onload = function(){
            var start = document.querySelector('#start');
            var stop = document.querySelector('#stop');
            var recorder_box =$('#recorder');
            var t_text =$('#t_text');
            var timeout =document.getElementById('timeout');
            var t_box =document.getElementById('container');
            var text_submit =document.getElementById('text_submit');
            var next =document.getElementById('next');
            var container = document.querySelector('#audio-container');
            var flash_box =document.getElementById('flash');
            var flash =getFlashMovieObject("swf");
            var flash_files = <?php echo $flashlist;?>;
            var i =1;//计数
            var t =<?php echo $time;?>;//考试时间
            var ts = t*60;
            if (flash_files==null) {
                alert('你已经完成考试了');
                 $.ajax({
                        url: "<?php echo site_url('student/stutest/changeExamStatus/'.$stuid.'/'.$examid.'');?>",
                        type:"post",
                        success:function(data){
                            console.log(data);
                            if (data == 1) {
                                window.location.href="<?php echo site_url('student/stutest/examList/'.$stuid.'');?>";
                            }
                        },
                        error:function(error){
                            console.log(error.responseText);
                        },

                    });

            }
            console.log(flash_files);
            var filesLength =flash_files.length;
            flash.data =flash_files[0].filename;
            if(flash_files[0].type == 2){
                recorder_box.css("display","block");
                t_text.css("display","none");
            }else if(flash_files[0].type == 1){
                recorder_box.css("display","none");
                t_text.css("display","block");
            }else{
                    recorder_box.css("display","none");
                t_text.css("display","none");
            }
            console.log(filesLength);

            //录音部分
            var recorder = new Recorder({
                        sampleRate: 44100, //采样频率，默认为44100Hz(标准MP3采样率)
                        bitRate: 128, //比特率，默认为128kbps(标准MP3质量)
                        success: function(){ //成功回调函数
                            start.disabled = false;
                        },
                        error: function(msg){ //失败回调函数
                            alert(msg);
                        },
                        fix: function(msg){ //不支持H5录音回调函数
                            alert(msg);
                        }
            });

            start.addEventListener('click',function(){
                this.disabled = true;
                 stop.disabled = false;
                 var audio = document.querySelectorAll('audio');
                 for(var i = 0; i < audio.length; i++){
                     if(!audio[i].paused){
                          audio[i].pause();
                     }
                }
                recorder.start();
            });

            stop.addEventListener('click',function(){
                        this.disabled = true;
                        start.disabled = true;
                        recorder.stop();
                        recorder.getBlob(function(blob){
                            var audio = document.createElement('audio');
                            audio.src = URL.createObjectURL(blob);
                            audio.controls = false;
                            var oBlob = new Blob([blob], { type: "text/xml"});
                            $.ajax({
    				            url: "<?php echo site_url('student/stutest/uploadRecord/'.$stuid.'/'.$examid.'/'.$list.'/');?>"+flash_files[i-1].fileid+"",
    				            type: 'post',
    				            async: false,  
    					        cache: false,  
    					        contentType: false,  
    					        processData: false, 
    				            data: oBlob,  
    				            success: function (data) {
                                    console.log(1);
    				            },
    				            error: function (error) {
                                    console.log(error.responseText);
    				            },
    				        });
                            setTimeout(function(){audio.play();},2000)
                            container.appendChild(audio);
                        });
            });

            //提交作文文本
            text_submit.onclick =function(){
                var text =document.getElementById('text_content').value;
                $.ajax({
                    url:"<?php echo site_url('student/stutest/uploadText/'.$stuid.'/'.$examid.'/'.$list.'/');?>"+flash_files[i-1].fileid+"/"+flash_files[i-1].type+"",
                    type:"post",
                    data:{
                        "text":text,
                    },
                    success:function(data){
                        if (data == 1) {
                            alert('你已经提交过了,再次提交无效，请点击下一题');
                        }else{
                            document.getElementById("text_content").value="";
                        }
                    },
                    error:function(error){
                        console.log(error.responseText);
                    },
                });
            }

            //下一题点击事件
            next.onclick = function() {
                console.log(456);
                console.log(s);
                if (this.innerText =='下一题') {
                    if(i<= filesLength){
                        if(flash_files[i-1].type == 1 || flash_files[i-1].type == 2){
                            s =0;
                        }
                        //console.log(s);
                        $.ajax({
                            url:"<?php echo site_url('student/stutest/updateStatus/'.$stuid.'/'.$examid.'');?>",
                            type:"post",
                            data:{
                                "file":flash_files[i-1].filename,
                                "type":flash_files[i-1].type,
                                "score":s,
                                'testid':<?php echo $list;?>,
                                "remainingTime":ts
                            },
                            success:function(data){
                                console.log(data);
                                //window.location.reload();
                            },
                            error:function(error){
                                console.log(error.responseText);
                            }
                        });
                        if(i < filesLength){
                            flash.data =flash_files[i].filename;
                            console.log(flash_files[i].type);
                            if(flash_files[i].type == 2){
                                 recorder_box.css("display","block");
                                 t_text.css("display","none");
                            }else if(flash_files[i].type == 1){
                                recorder_box.css("display","none");
                                 t_text.css("display","block");
                            }else{
                                recorder_box.css("display","none");
                                 t_text.css("display","none");
                            }
                            i++;
                            s =0;
                        }else{
                           this.innerText ="完成考试！"; 
                        }    
                    }else{
                        this.innerText ="完成考试！";
                    }
                }else{
                    $.ajax({
                        url: "<?php echo site_url('student/stutest/changeExamStatus/'.$stuid.'/'.$examid.'');?>",
                        type:"post",
                        success:function(data){
                            console.log(data);
                            if (data == 1) {
                                window.location.href="<?php echo site_url('student/stutest/examList/'.$stuid.'');?>";
                            }
                        },
                        error:function(error){
                            console.log(error.responseText);
                        },

                    });
                }
            }
            //倒计时
            var a =setInterval(function(){
                var min =Math.floor(ts/60);
                var second =Math.floor(ts-min*60);
                document.getElementById('countdown').innerHTML =min + '分' + second + '秒';
                ts--;
                if(ts <0){
                    clearInterval(a);
                }
            },1000);
            var b =setTimeout(function(){
                t_box.style.display ="none";
                timeout.style.display ="block";
            },ts*1000)
   
        }; 

        
        //获取flash对象（兼容性）
        function getFlashMovieObject( movieName ) {
            if (window.document[movieName]) {
                return window.document[movieName];
            }
            if (navigator.appName.indexOf("Microsoft Internet") == -1) {
                if (document.embeds && document.embeds[movieName])
                    return document.embeds[movieName];
            } else { // if (navigator.appName.indexOf("Microsoft Internet")!=-1)
                return document.getElementById(movieName);
            }
        }

        function score(score)
        {
            if(score == 'undefined'){ score = 0; }
            s = score;
        }

    </script>
</body>
</html>
