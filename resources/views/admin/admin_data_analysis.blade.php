@extends('admin.admin_template')
@section('title','数据分析')
@section('title_desc','数据分析')
@section('head')
 <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datatables/dataTables.bootstrap.min.css") }}">
 <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css") }}">
 <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/datepicker/datepicker3.css") }}">
@endsection
@section('content')
<div class="box">
	
	<div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">筛选器</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <!-- /.col -->
            <div class="col-md-4">
			    <label>开始时间</label>
				<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="stime">
                </div>
            </div>
			<div class="col-md-4">
			    <label>结束时间</label>
				<div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right datepicker" id="etime">
                </div>
              
              <!-- /.form-group -->
            </div>
			
			<div class="col-md-3">
			 <label style="">　</label><br>
				<button type="button" class="btn btn-info" id="query">查询</button>
			</div>
            <!-- /.col -->
			</div>
          <!-- /.row -->
        </div>
    </div>
	
	<div class="box box-default">
		<div class="box-header with-border">
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<div id="chart1" style="width:100%;height:400px;"></div>
			
		
		</div>
	</div>
</div>

@endsection

@section('foot')
<script src="{{ asset("libs/js/echarts.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/datepicker/bootstrap-datepicker.js") }}"></script>
<script>
option = {
    title : {
        text: '历史数据分析图',
        subtext: '',
        x: 'center',
        align: 'right'
    },
    grid: {
        bottom: 80
    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    tooltip : {
        trigger: 'axis',
        axisPointer: {
            type: 'cross',
            animation: false,
            label: {
                backgroundColor: '#505765'
            }
        }
    },
    legend: {
        data:['总镉','总铅'],
        x: 'left'
    },
    dataZoom: [
        {
            show: true,
            realtime: true,
            start: 65,
            end: 85
        },
        {
            type: 'inside',
            realtime: true,
            start: 65,
            end: 85
        }
    ],
    xAxis : [
        {
            type : 'category',
            boundaryGap : false,
            axisLine: {onZero: false},
            data : [
				
            ]
        }
    ],
   yAxis: [
       {
           //name: 'mg/L',
           name: '',
           type: 'value',
           //max: 500
       },
    ],
    series: [
		
    ],
	
};

function getseries(title,data){
	return {
		name:title,
		type:'line',
		animation: false,
		data:data,
		itemStyle:{
		normal:{
			labelLine:{
				show:false
			}
		}
		}
	};
}
function datatotime(date){
	var d = new Date(date);
	d.setDate(d.getDate());
	return d.getTime();		
}
$('.datepicker').datepicker({
  autoclose: true
});
$('#query').click(function(){
	var stime=datatotime($('#stime').val());
	var etime=datatotime($('#etime').val());
	if(!stime)stime='0';
	if(!etime)etime='1657840800000';
    var loadIndex = layer.load(0, {
        shade: [0.1,'#000'] //0.1透明度的白色背景
    });
	$.ajax({
		type: "GET",
		url: "/admin/data/ajaxanalysis/{{$pid}}",
		data: {stime:stime,etime:etime},
		dataType: "json",
		success: function(json){
		    if(!json||!json.data){
                layer.msg('抱歉，该时间段没有数据',{icon:2});
            }
			option.xAxis[0].data=json.date;
			option.legend.data=[];
			option.series=[];
			for(key in json.data){
				option.series.push(getseries(key,json.data[key]));	
				option.legend.data.push(key);
			}
			
			
			// option.series[1].data=json.data.zq;
			
			var myChart1 = echarts.init(document.getElementById('chart1'));
			myChart1.setOption(option);
		},
		error:function(data){
            layer.msg('抱歉，请求出错',{icon:2});
		},
        complete:function () {
		    layer.close(loadIndex);

        }
	});
	//1357840800000
});






</script>
@endsection