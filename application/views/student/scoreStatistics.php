<!DOCTYPE html>
<html>
<head>
	<title>Score statistics</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/reset.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/dataTables.bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/task_list.css');?>">
</head>
<body>
  <div class="container">
    <p>成绩统计</p>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    <p>任务成绩表</p>
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>试卷名称</th>
            <th>试卷类型</th>
            <th>考试开始时间</th>
            <th>考试入口开放时间</th>
            <th>出卷人</th>
            <th>操作</th>
        </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>试卷名称</th>
                <th>试卷类型</th>
                <th>考试开始时间</th>
                <th>考试入口开放时间</th>
                <th>出卷人</th>
                <th>操作</th>
            </tr>
        </tfoot>
 
        <tbody>
         
        </tbody>
    </table>
    <p>考试成绩表</p>
    <table id="example1" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>试卷名称</th>
            <th>试卷类型</th>
            <th>考试开始时间</th>
            <th>考试入口开放时间</th>
            <th>出卷人</th>
            <th>操作</th>
        </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>试卷名称</th>
                <th>试卷类型</th>
                <th>考试开始时间</th>
                <th>考试入口开放时间</th>
                <th>出卷人</th>
                <th>操作</th>
            </tr>
        </tfoot>
 
        <tbody>
          
        </tbody>
    </table>
    <p>精听练习成绩表</p>
    <table id="example2" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>试卷名称</th>
            <th>试卷类型</th>
            <th>考试开始时间</th>
            <th>考试入口开放时间</th>
            <th>出卷人</th>
            <th>操作</th>
        </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>试卷名称</th>
                <th>试卷类型</th>
                <th>考试开始时间</th>
                <th>考试入口开放时间</th>
                <th>出卷人</th>
                <th>操作</th>
            </tr>
        </tfoot>
 
        <tbody>
          
        </tbody>
    </table>
  </div>  
<script src="<?php echo base_url('js/jquery-3.2.0.min.js');?>"></script>
<script src="<?php echo base_url('js/DataTables.min.js');?>"></script>
<script src="<?php echo base_url('js/highcharts.js');?>"></script>
<script src="<?php echo base_url('js/dataTables.bootstrap.js');?>"></script>
<script src="<?php echo base_url('js/exporting.js');?>"></script>
<script type="text/javascript">

	$(document).ready(function() {
        Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: '成绩统计曲线图'
    },
    subtitle: {
        text: '任务成绩，考试成绩，自主学习成绩'
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
            month: '%Y.%e. %b',
            year: '%b'
        },
        title: {
            text: '试卷名称'
        }
    },
    yAxis: {
        title: {
            text: '分数'
        },
        min: 0,
        max:100,
        plotLines:[{
        color:'red',            //线的颜色，定义为红色
        dashStyle:'solid',//标示线的样式，默认是solid（实线），这里定义为长虚线
        value:60,                //定义在哪个值上显示标示线，这里是在x轴上刻度为3的值处垂直化一条线
        width:2,
        label:{
        text:'60',
        align:'left',
        x:-20,
        y:5
    }                
    }]
    },
    tooltip: {
        headerFormat: '{series.name}<br>',
        pointFormat: '{point.x:%Y.%e. %b}: <b>{point.y:.2f}</b>'
    },

    plotOptions: {
        spline: {
            marker: {
                enabled: true
            }
        }
    },

    series: [{
        name: '任务成绩',
        // Define the data points. All series have a dummy year
        // of 1970/71 in order to be compared on the same x axis. Note
        // that in JavaScript, months start at 0 for January, 1 for February etc.
        data: [
            [Date.UTC(1970, 9, 21), 98],
            [Date.UTC(1970, 10, 4), 67],
            [Date.UTC(1970, 10, 9), 76],
            [Date.UTC(1970, 10, 27), 67],
            [Date.UTC(1970, 11, 2),90],
            [Date.UTC(1970, 11, 26), 20],
            [Date.UTC(1970, 11, 29), 45],
            [Date.UTC(1971, 0, 11), 78],
            [Date.UTC(1971, 0, 26), 87],
            [Date.UTC(1971, 1, 3), 65],
            [Date.UTC(1971, 1, 11), 34],
            [Date.UTC(1971, 1, 25), 34],
            [Date.UTC(1971, 2, 11), 56],
            [Date.UTC(1971, 3, 11), 69],
            [Date.UTC(1971, 4, 1), 42],
            [Date.UTC(1971, 4, 5), 67],
            [Date.UTC(1971, 4, 19), 98],
            [Date.UTC(1971, 5, 3), 23]
        ]
    }, {
        name: '考试成绩',
        data: [
            [Date.UTC(1970, 9, 29), 34],
            [Date.UTC(1970, 10, 9), 34],
            [Date.UTC(1970, 11, 1), 45],
            [Date.UTC(1971, 0, 1), 67],
            [Date.UTC(1971, 0, 10), 78],
            [Date.UTC(1971, 1, 19), 89],
            [Date.UTC(1971, 2, 25), 87],
            [Date.UTC(1971, 3, 19), 76],
            [Date.UTC(1971, 3, 30), 65],
            [Date.UTC(1971, 4, 14), 54],
            [Date.UTC(1971, 4, 24), 43],
            [Date.UTC(1971, 5, 10), 5]
        ]
    }, {
        name: '精听练习成绩',
        data: [
            [Date.UTC(1970, 10, 25), 67],
            [Date.UTC(1970, 11, 6), 76],
            [Date.UTC(1970, 11, 20), 89],
            [Date.UTC(1970, 11, 25),90],
            [Date.UTC(1971, 0, 4), 90],
            [Date.UTC(1971, 0, 17), 90],
            [Date.UTC(1971, 0, 24), 78],
            [Date.UTC(1971, 1, 4), 87],
            [Date.UTC(1971, 1, 14), 84],
            [Date.UTC(1971, 2, 6), 67],
            [Date.UTC(1971, 2, 14), 67],
            [Date.UTC(1971, 2, 24), 76],
            [Date.UTC(1971, 3, 2), 32],
            [Date.UTC(1971, 3, 12), 54],
            [Date.UTC(1971, 3, 28), 54],
            [Date.UTC(1971, 4, 5), 65],
            [Date.UTC(1971, 4, 10), 89],
            [Date.UTC(1971, 4, 15), 89],
            [Date.UTC(1971, 4, 20),98],
            [Date.UTC(1971, 5, 5), 67],
            [Date.UTC(1971, 5, 10),67],
            [Date.UTC(1971, 5, 15), 76],
            [Date.UTC(1971, 5, 23), 76]
        ]
    }]
});
        $('#example').removeClass( 'display' ).addClass('table table-striped table-bordered');
        $('#example1').removeClass( 'display' ).addClass('table table-striped table-bordered'); 
        $('#example2').removeClass( 'display' ).addClass('table table-striped table-bordered');      
        $('#example').dataTable();
        $('#example1').dataTable();
        $('#example2').dataTable();
    } );
</script>
</body>
</html>