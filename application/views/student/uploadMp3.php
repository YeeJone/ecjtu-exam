<!DOCTYPE html>
<html>
<head>
	<title>Upload MP3</title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('webupload/webuploader.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('webupload/uploadMp3.css');?>">
</head>
<body>
    <div class="container">
        <p class="t_title">上传音频文件</p>
        <div id="uploader" class="wu-example">
            <!--用来存放文件信息-->
            <div id="thelist" class="uploader-list">
                <div class="icons">
                    <i class="mp3"></i>
                    <i class="au"></i>
                    <i class="mid"></i>
                    <i class="more"></i>
                    <p>可将文件拖入方框内</p>
                </div>
            </div>
            <div class="btns">
                <div id="picker" >选择文件</div>
                <button id="ctlBtn" class="btn btn-default">开始上传</button>
            </div>
        </div>   	
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('webupload/webuploader.js');?>"></script>
    <script type="text/javascript">
    $(function(){
        var Uploader = WebUploader.Uploader;
        var $list=$("#thelist");   
        var $btn =$("#ctlBtn");   //开始上传  
        var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
        var thumbnailHeight = 100;
        var uploader = WebUploader.create({

            // swf文件路径
            swf:'<?php echo base_url('webupload/Uploader.swf');?>',
            //auto:true,
            // 文件接收服务端。
            server:'<?php echo site_url('upload/uploadFile/'.$user.'');?>',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',

            //sendAsBinary: true,
            chunked:true,
            chunkSize:2048576,
            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            dnd:'#thelist',
            accept: {  
                title: 'audios',  
                extensions: 'au,snd,mid,rmi,mp3,aif,aifc,aiff,m3u,ra,ram,wav',  
                mimeTypes: 'audio/*'  
             },  
            method:'POST',  
        });

         uploader.on( 'fileQueued', function( file ) {  // webuploader事件.当选择文件后，文件被加载到文件队列中，触发该事件。等效于 uploader.onFileueued = function(file){...} ，类似js的事件定义。  
           var $li = $(  
                   '<div id="' + file.id + '" class="file-item thumbnail">' +  
                       '<img>' +  
                       '<div class="info">' + file.name + '</div>' +  
                   '</div>'
                   ),  
               $img = $li.find('img');  
  
           // $list为容器jQuery实例  
           $list.append( $li );  
  
       // 创建缩略图  
       // 如果为非图片文件，可以不用调用此方法。  
       // thumbnailWidth x thumbnailHeight 为 100 x 100  
           uploader.makeThumb( file, function( error, src ) {   //webuploader方法  
               if ( error ) {  
                   $img.replaceWith('<span>不能预览</span>');  
                   return;  
              }  
  
               $img.attr( 'src', src );  
           }, thumbnailWidth, thumbnailHeight );
       });  
   // 文件上传过程中创建进度条实时显示.
       uploader.on( 'uploadProgress', function( file, percentage ) {  
           var $li = $( '#'+file.id ),  
               $percent = $li.find('.progress .progress-bar');  
  
       // 避免重复创建  
           if ( !$percent.length ) {  
               $percent = $('<div class="progress progress-striped active">' +
          '<div class="progress-bar" role="progressbar" style="width: 0%">' +
          '</div>' +
          '</div>').appendTo( $li ).find('.progress-bar'); 
           }  
           
           $li.find('p.state').text('上传中');
           $percent.css( 'width', percentage * 100 + '%' );  
       });  
  
   // 文件上传成功，给item添加成功class, 用样式标记上传成功。  
       uploader.on( 'uploadSuccess', function( file , response ) {  
           $( '#'+file.id ).addClass('upload-state-done');
           console.log(response._raw);
       });  
  
       uploader.on('uploadBeforeSend',function (object ,data ,headers){
           headers['X-Requested-With']=  'XMLHttpRequest';
       });

   // 文件上传失败，显示上传出错。  
       uploader.on( 'uploadError', function( file, reason ) {  
           var $li = $( '#'+file.id ),  
               $error = $li.find('div.error'); 

           console.log(reason); 
  
       // 避免重复创建  
           if ( !$error.length ) {  
               $error = $('<div class="error"></div>').appendTo( $li );  
           }  
  
           $error.text('上传失败');
           console.log('上传失败');
           console.log(reason);  
       });  
  
   // 完成上传完了，成功或者失败，先删除进度条。  
       uploader.on( 'uploadComplete', function( file ) {  
           $( '#'+file.id ).find('.progress').remove();  
       });  
          $btn.on( 'click', function() {  
            //console.log(file);  
            uploader.upload();  
          });  
    });
</script>
</body>
</html>
