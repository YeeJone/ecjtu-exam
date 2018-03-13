<!DOCTYPE html>
<html>
<head>
	<title>StudentperfectInformation</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('webupload/webuploader.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/s_information.css');?>">
</head>
<body>
    <div class="container">
    	<p>完善个人信息</p>
        <form class="form-horizontal" enctype="multipart/form-data" id="a_form">
            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-6">
                    <h5 id="username"><?php echo $user;?></h5>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName3" class="col-sm-2 control-label">真实姓名</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputName3" placeholder="真实姓名" name="true_name">
                </div>
            </div>
            <div class="form-group">
                <label for="inputNumber3" class="col-sm-2 control-label">身份证号码</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputNumber3" placeholder="身份证号码" name="id_number">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="密码" name="password">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">邮箱</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="邮箱" name="email">
                </div>
            </div> 
             <div class="form-group">
                <label class="col-sm-2 control-label">性别</label>
                <label class="checkbox-inline col-sm-1 control-label">
                    <input type="radio" id="inlineCheckbox1" value="男" name="sex" checked /> 男
                </label>
                <label class="checkbox-inline">
                    <input type="radio" id="inlineCheckbox2" value="女" name="sex" /> 女
                </label>
            </div>
            <div class="form-group">
                <label for="inputqq3" class="col-sm-2 control-label">QQ</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputqq3" placeholder="QQ号码" name="qq_numnber">
                </div>
            </div>
            <div class="form-group">
                <label for="inputphone3" class="col-sm-2 control-label">电话</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputphone3" placeholder="电话" name="phone">
                </div>
            </div>
            <div class="form-group">
                <label for="inputaddress3" class="col-sm-2 control-label">地址</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="inputaddress3" placeholder="地址" name="address">
                </div>
            </div>            
            <div class="form-group">
              <label for="exampleInputFile" class="col-sm-2 control-label">照片上传</label>                
              <div id="uploader" class="wu-example col-sm-6">
                <div id="thelist" class="uploader-list"></div>
                <div class="btns">
                    <div id="picker" style="width: 30%;float: left;">选择图片</div>
                </div>
                <div id="name" style="display: none;"></div>
              </div>
            </div>
            <div class="form-group">
                <div class="button">
                    <button type="submit" class="btn btn-default" id="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <!-- <script src="<?php echo base_url('js/sp_information.js');?>"></script> -->
    <script src="<?php echo base_url('webupload/webuploader.js');?>"></script> 
<script type="text/javascript">
$(function(){
        var Uploader = WebUploader.Uploader;
        var $list=$("#thelist");
        var t_val=0;     
        //var $btn =$("#ctlBtn");   //开始上传  
        var thumbnailWidth = 100;   //缩略图高度和宽度 （单位是像素），当宽高度是0~1的时候，是按照百分比计算，具体可以看api文档  
        var thumbnailHeight = 100;
        var uploader = WebUploader.create({

            // swf文件路径
            swf:'<?php echo base_url('webupload/Uploader.swf');?>',
            
            auto:true,

            server:'<?php echo site_url('upload/uploadFile/'.$user.'');?>',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#picker',
            fileNumLimit:1,

            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: false,
            dnd:'#thelist',
           accept: {
                title: 'images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
           },
            method:'POST',  
        });
         uploader.on( 'beforeFileQueued', function(file) {  
           if(confirm("确定选择这张图片吗？")){
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
               $('#name').html(response._raw);
               //console.log(response._raw);
           });  
      
           uploader.on('uploadBeforeSend',function (object ,data ,headers){
               headers['X-Requested-With']=  'XMLHttpRequest';
           });

       // 文件上传失败，显示上传出错。  
           uploader.on( 'uploadError', function( file, reason ) {  
               var $li = $( '#'+file.id ),  
                   $error = $li.find('div.error'); 
      
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
           }
       });
    });
 
</script>
<script src="<?php echo base_url('js/sp_information.js');?>"></script>
</body>
</html>
