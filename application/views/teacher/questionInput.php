<!DOCTYPE html>
<html>
<head>
	<title>Examination Questions Input</title>
	<meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('webupload/webuploader.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/questionInput.css');?>">
</head>
<body>
    <div class="container">
    	<p class="t_title">题目上传</p>
    	<div class="selectType">
    	    <span>选择上传测试类型：</span>
			<label class="radio-inline">
			  <input type="radio" name="type" id="inlineRadio1" value="0" checked="checked"> 考试题目
			</label>
			<label class="radio-inline">
			  <input type="radio" name="type" id="inlineRadio2" value="1"> 任务题目
			</label>
      <label class="radio-inline">
        <input type="radio" name="type" id="inlineRadio2" value="2"> 自主学习题目
      </label>  		
    	</div>
      <div class="questionName">
          <label>题目名称： </label>
          <input class="qnInput" type="text" placeholder="输入考试题目">
      </div>
      <div class="questionType">
          <span>选择题目类型：</span>
          <select class="form-control" id="select">
          <?php foreach($quesType as $key => $value):?>
            <option value="<?=$value['id']?>"><?=$value['questiontypename'];?></option>
          <?php endforeach;?>
          </select>  
      </div>
      <div class="questionType">
          <span>选择题目风格：</span>
          <select class="form-control" id="style">
            <?php foreach($quesStyle as $key => $value):?>
            <option value="<?=$value['id']?>"><?=$value['questionstylename']?></option>
          <?php endforeach;?>
          </select>  
      </div>
    	<div id="uploader" class="wu-example">
            <!--用来存放文件信息-->
            <div id="thelist" class="uploader-list">
                <div class="icons">
                    <i class="flash"></i>
                    <p>可将文件拖入方框内,先上传文件,文件名请规范使用英文命名,信息填全之后再点击提交</p>
                </div>
            </div>
            <div id="name" style="display: none;"></div>
            <div id="teachername" style="display: none;"><?php echo $teachername;?></div>
            <button type="button" id="empty" class="btn btn-danger">清空</button>
            <div class="btns">
                <div id="picker" >选择文件</div>
                <button id="ctlBtn" class="btn btn-default">开始上传</button>
                <button id="submit" class="btn btn-default">提交</button>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('webupload/webuploader.js');?>"></script>
    <script type="text/javascript">
    	$(function(){
        var $list=$("#thelist");     
        var $btn =$("#ctlBtn");
        var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
        var thumbnailHeight = 100;   //开始上传 
        var GUID = WebUploader.Base.guid();
        var uploader = WebUploader.create({


            // swf文件路径
            swf:"<?php echo base_url('webupload/Uploader.swf');?>",

            // 文件接收服务端。
            server: "<?php echo site_url('upload/uploadFlash');?>",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
            	id:'#picker',
            	multiple:false
            },

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            chunked: true,
            chunkSize: 2*1024*1024,
            //chunkRetry: 2,
            threads: 4,
            fileNumLimit: 1,
            formData: { 
              guid:GUID
            },
            dnd:'#thelist',
            accept: {  
                title: 'flash', 
                extensions: 'swf,flv,mp4,avi,wmv',
                mimeTypes: 'flash/*'
             },  
            method:'POST',  
        });

         uploader.on( 'fileQueued', function( file ) {  // webuploader事件.当选择文件后，文件被加载到文件队列中，触发该事件。等效于 uploader.onFileueued = function(file){...} ，类似js的事件定义。  
           var $li = $(  
                   '<div id="' + file.id + '" class="file-item thumbnail">' +  
                       '<input>' +  
                       '<div class="info">' + file.name + '</div>' +  
                   '</div>'  
                   ),  
               $img = $li.find('input');  
  
  
       // $list为容器jQuery实例  
           $list.append( $li ); 
       }); 
       $("#empty").click( function() {        
        //移除所有缩略图并将上传文件移出上传序列
        for (var i = 0; i < uploader.getFiles().length; i++) {
            // 将图片从上传序列移除
            uploader.removeFile(uploader.getFiles()[i]);
            //uploader.removeFile(uploader.getFiles()[i], true);
            //delete uploader.getFiles()[i];
            // 将图片从缩略图容器移除
            var $li = $('#' + uploader.getFiles()[i].id);
            $li.off().remove();
        }
        // 重置文件总个数和总大小
        fileCount = 0;
        fileSize = 0;
        // 重置uploader，目前只重置了文件队列
        uploader.reset();
        // 更新状态等，重新计算文件总个数和总大小
    });  
   // 文件上传过程中创建进度条实时显示。  
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
           
           $li.find('p.state').text('上传中...');
           $percent.css( 'width', percentage * 100 + '%' );  
       });  
  
   // 文件上传成功，给item添加成功class, 用样式标记上传成功。  
       uploader.on( 'uploadSuccess', function( file , response ) { 
          $( '#'+file.id ).addClass('upload-state-done');
          if (response == 1) { 
            alert('与现存的文件重名,请修改名称后再上传'); 
            window.location.reload(); 
          }
          else if (response == 2) {
            alert('文件名存在非法字符,请修改名称后再上传'); 
            window.location.reload(); 
          }else if (response == 3) {
            alert('文件名使用英文命名'); 
            window.location.reload(); 
          }else{
            $.ajax({
              url:"<?php echo site_url('upload/mergeFlash');?>",
              type:"post",
              data:{
                "guid":GUID,
                "fileName":file.name
              },
              success:function(data)
              {
                $('#name').html(data); 
                alert('文件上传成功');
              },
              error:function(error)
              {
                console.log(error.responseText);
              },
            });
          }
       });  
  
   // 文件上传失败，显示上传出错。  
       uploader.on( 'uploadError', function( file ) {  
           var $li = $( '#'+file.id ),  
               $error = $li.find('div.error');  
  
       // 避免重复创建  
           if ( !$error.length ) {  
               $error = $('<div class="error"></div>').appendTo( $li );  
           }  
  
           $error.text('上传失败');
       });  
  
   // 完成上传完了，成功或者失败，先删除进度条。  
       uploader.on( 'uploadComplete', function( file ) {  
           $( '#'+file.id ).find('.progress').remove();  
       });  
          $btn.on( 'click', function(){  
	            uploader.upload();
          });    
    });
  </script>
<script src="<?php echo base_url('js/questionInput.js');?>"></script>
</body>
</html>