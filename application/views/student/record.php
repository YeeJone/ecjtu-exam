<!DOCTYPE html>
<html>
<head>
	<title>test</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/test.css');?>">
</head>
<body>
    <div class="container">
    	<div class="recorder">
    		<button id="start" class="ui-btn ui-btn-primary" disabled>录音</button>
	        <button id="stop" class="ui-btn ui-btn-primary" disabled>停止</button>
	        <div id="audio-container"></div>
    	</div>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/recorder.js');?>"></script>
    <script type="text/javascript">
    	        window.onload = function(){
                var start = document.querySelector('#start');
                var stop = document.querySelector('#stop');
                var container = document.querySelector('#audio-container');
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

                //开始录音
                //recorder.start();

                //停止录音
                //recorder.stop();

                //获取MP3编码的Blob格式音频文件
                //recorder.getBlob(function(blob){ 获取成功回调函数，blob即为音频文件
                //    ...
                //},function(msg){ 获取失败回调函数，msg为错误信息
                //    ...
                //});

                //getUserMedia() no longer works on insecure origins. To use this feature, you should consider switching your application to a secure origin, such as HTTPS.

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
                    start.disabled = false;
                    recorder.stop();
                    recorder.getBlob(function(blob){
                        var audio = document.createElement('audio');
                        audio.src = URL.createObjectURL(blob);
                        audio.controls = false;
                        var oBlob = new Blob([blob], { type: "text/xml"});
                        $.ajax({
				            url: "<?php echo site_url('upload/uploadRecord');?>",
				            type: 'post',
				            async: false,  
					        cache: false,  
					        contentType: false,  
					        processData: false, 
				            data: oBlob,
				            success: function (data) {
                                //console.log(data);
				            },
				            error: function (error) {
                                //console.log(error.responseText);
				            },
				        });
                        setTimeout(function(){audio.play();},2000)
                        container.appendChild(audio);
                    });
                });
            };
    </script>
</body>
</html>
