<script type="text/javascript" src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<script type="text/javascript" src="http://cdn.hcharts.cn/highcharts/exporting.js"></script>

<div class="container">
	<div class="span9">
		<div class="page-header">
			<h3>文章统计</h3>
			<h4><small>文章统计数据</small></h4>
		</div>
		
		<script>
			function pvuv() {
				document.getElementById('s').value = document.getElementById('startDate').innerHTML;
				document.getElementById('e').value = document.getElementById('endDate').innerHTML;				
				document.getElementById('pvuv_form').submit();
			}
		</script>
		
		<form id="pvuv_form" action="/admins/statarticle" method="post">
		<div class="well">
            
			<div class="alert alert-warn" id="alert">
				<strong>请选择起始时间和结束时间，然后点击查看</strong>
			</div>
			<input id="s" style="display: none;" name="data[beginTime]" />  
			<input id="e" style="display: none;" name="data[endTime]" />
			<table class="table">
				<thead>
					<tr>
						<th>开始时间&nbsp;&nbsp;<a href="#" class="btn btn-primary small" id="dp4" data-date-format="yyyy-mm-dd">选择</a></th>
						<th>结束时间&nbsp;&nbsp;<a href="#" class="btn btn-primary small" id="dp5" data-date-format="yyyy-mm-dd">选择</a></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="startDate"></td>
						<td id="endDate"></td>
					</tr>
				</tbody>
			</table>
			<a href="#" class="btn btn-primary" onclick="pvuv()">查看</a>
          </div>
		</form>
		
		<div id="container" style="width: 100%; height:400px">
			
		</div>
	</div>
</div>


<link href="/app/webroot/css/datepicker.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="/app/webroot/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
var startDate = new Date();
var endDate = new Date();
$('#dp4').datepicker()
	.on('changeDate', function(ev){
		if (ev.date.valueOf() > endDate.valueOf()){
			$('#alert').show().find('strong').text('起始时间不能大于结束时间');
		} else {
			$('#alert').hide();
			startDate = new Date(ev.date);
			$('#startDate').text($('#dp4').data('date'));
		}
		$('#dp4').datepicker('hide');
	});
$('#dp5').datepicker()
	.on('changeDate', function(ev){
		if (ev.date.valueOf() < startDate.valueOf()){
			$('#alert').show().find('strong').text('结束时间不能小于起始时间');
		} else {
			$('#alert').hide();
			endDate = new Date(ev.date);
			$('#endDate').text($('#dp5').data('date'));
		}
		$('#dp5').datepicker('hide');
	});
</script>

<script>
	var date = <?php echo $statDate;?>;
	var pv = <?php echo $statValue;?>;
	var pv_data = (pv.series[0].data);
	
$('#container').highcharts({
    title: {
        text: '文章统计',
        x: -20 //center
    },
    subtitle: {
        text: '达人吧',
        x: -20
    },
    xAxis: {
        categories: date
    },
    yAxis: {
        title: {
            text: '文章个数'
        },
        plotLines: [{
            value: 0,
            width: 1,
            color: '#808080'
        }]
    },
    tooltip: {
        valueSuffix: '篇'
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle',
        borderWidth: 0
    },
    series: [{
        name: '文章',
        data: pv_data
    }]
});
</script>