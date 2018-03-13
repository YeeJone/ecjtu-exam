<!DOCTYPE html>
<html>
<head>
	<title>welcome</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/welcome.css');?>">
</head>
<body>
    <div class="container">
    	<p>感谢使用大学英语任务与测试系统</p>
    	<hr style="border: 1px solid rgb(0,202,121); width: 98%;margin: 0 auto;">
    	<i>提示：您现在使用的是大学英语任务与测试系统</i>
    	<hr style="border: 1px dotted rgb(0,202,121); width: 98%;margin: 0 auto;">
    	<div id="carousel-example-generic" class="carousel slide banner" data-ride="carousel">
  <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

  <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="<?php echo base_url('images/one.jpg');?>" style="width: 100%;height: 400px;">
                <div class="carousel-caption">
                    <h3>听力练习</h3>
                </div>
              </div>
              <div class="item">
                <img src="<?php echo base_url('images/two.jpg');?>" style="width: 100%;height: 400px;">
                <div class="carousel-caption">
                    <h3>口语练习</h3>
                </div>
              </div>
              <div class="item">
                <img src="<?php echo base_url('images/three.jpg');?>" style="width: 100%;height: 400px;">
                <div class="carousel-caption">
                    <h3>各种题型应有尽有</h3>
                </div>
              </div>
   
            </div>

  <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div> 
    	<div class="a_date">
    		 <div id="full-clndr">
                <script type="text/template" id="id_clndr_template">
                <div class="clndr-controls">
                  <div class="clndr-previous-button"><</div>
                  <div class="clndr-next-button">></div>
                  <div class="month"><%= month %> <%= year %></div>
                </div>
                <div class="clndr-grid">
                  <div class="days-of-the-week">
                    <% _.each(daysOfTheWeek, function(day) { %><div class="header-day"><%= day %></div><% }); %>
                  </div>
                  <div class="days">
                    <% _.each(days, function(day) { %><div class="<%= day.classes %>" id="<%= day.id %>"><span class="day-number"><%= day.day %></span></div><% }); %>
                  </div>
                </div>
                </script>
            </div>
    	</div> 
    	<div class="introduce">
    		<p>
    			<h4>系统介绍</h4>
    			系统工能介绍系统工能介绍系统工能介绍系统工能介绍系统工能介绍,英语学习是一个长期抗战过程，基础扎实，弹药充足按照学习计划循序渐进的学习，英语不过是a piece of cake~.移动互联时代需要高效能碎片化学习！
    		</p>
    	</div>                
    	<div class="notice">
    		<div><i class="tip"></i>通知</div>
    		<ul>
    			<li>1.第一条提示</li>
    			<li>2.第二条提示</li>
    		</ul>
    	</div>
    </div>
    <script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
    <script src="<?php echo base_url('js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('js/underscore.js');?>"></script>
    <script src="<?php echo base_url('js/moment.js');?>"></script>
    <script src="<?php echo base_url('js/clndr.min.js');?>"></script>
    <script type="text/javascript">
    	 $("#full-clndr").clndr({
        template: $('#id_clndr_template').html(),
        clickEvents: {
            onMonthChange: function(month) {
                // TODO: 这边写月份改变事件，控制底部线条图的变化
            },
            click: function(target){
                var dateDom = $(target.element);
                if((!dateDom.hasClass("focusIn")) && (dateDom.hasClass("past") || dateDom.hasClass("today"))){
                    $(".focusIn").removeClass("focusIn");
                    dateDom.addClass("focusIn");
                    // TODO: 这边写日期改变的事件，控制右边环形图的变化
                    
                }
            },
        },
        daysOfTheWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
        forceSixRows : true,
        adjacentDaysChangeMonth : true,
    });
    </script>
</body>
</html>