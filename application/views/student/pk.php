<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>

<input type="text" name="" id="text" />
<button  onclick="print()">提交</button>
<div id="content"></div>
<script type="text/javascript" src="http://cdn.goeasy.io/goeasy.js"></script>
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script type="text/javascript">
function print(){
	    var text = $("#text").val();
        var goEasy = new GoEasy({
             appkey: 'BC-fd87767a14cb4fc7af0eebc535afdfa1'
        });

        goEasy.publish({
    		channel: 'demo_channel',
    		message: text
		});

		goEasy.subscribe({
    		channel: 'demo_channel',
    		onMessage: function(message){
        		$("#content").html(message.content);
    		}
		});
	}
        //GoEasy-OTP可以对appkey进行有效保护，详情请参考：GoEasy-Reference
</script>
</body>
</html>