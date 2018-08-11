<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="weida">
<meta name="author" content="weida">

<title>数据分析</title>
<link href="libs/css/bootstrap.min.css" rel="stylesheet">

<script src="libs/js/jquery.min.js"></script>
<script src="libs/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4bRePVpicSZLt2recABBT6tZ1qZZ2xXm"></script>
<style>
#allmap {width: 100%;height: 400px;overflow: hidden;margin:0;font-family:"微软雅黑";}
.dashbard-1{height:100%;}
</style>
</head>
<body>
<div class="container">
	<?php echo $__env->make('header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="container center-block row clearfix ">
		<div class="col-md-12 column">
			<div id="allmap"></div>
		</div>
	</div>
</div>

</body>
<script type="text/javascript">
	var chgsize=function() {
		$('#allmap').css('height',$(window).height()-$('#header').height());	
	}
	$(document).ready(chgsize);
	$(window).resize(chgsize);
	var map = new BMap.Map('allmap');

	map.centerAndZoom(new BMap.Point(112.966777,28.196858), 12);
	  
	map.addControl(new BMap.NavigationControl());        // 添加平移缩放控件
	//map.addControl(new BMap.ScaleControl());             // 添加比例尺控件
	map.addControl(new BMap.OverviewMapControl());       //添加缩略地图控件
	map.enableScrollWheelZoom();                         //启用滚轮放大缩小
	map.disable3DBuilding();

	//个性化在线编辑器地址：http://developer.baidu.com/map/custom/
	  var styleJson =[
          {
                    "featureType": "building",
                    "elementType": "all",
                    "stylers": {
                              "visibility": "off"
                    }
          },
          {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": {
                              "visibility": "off"
                    }
          },
          {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": {
                              "visibility": "off"
                    }
          },
          {
                    "featureType": "manmade",
                    "elementType": "all",
                    "stylers": {}
          },
          {
                    "featureType": "land",
                    "elementType": "all",
                    "stylers": {}
          }
]
	map.setMapStyle({styleJson:styleJson});
	
	
	var sContent =
	"<h4 style='margin:0 0 5px 0;padding:0.2em 0'>湘江中游橘子洲检测点</h4>" + 
	"<p style='font-size:13px;'>水质指数：36<br><br><a href=''>查看详情</a></p>" + 
	"</div>";

	map.centerAndZoom(new BMap.Point(112.941925,28.193076), 15);
	var data_info = [[112.966934,28.193394,"湘江中游橘子洲",36],
					 [112.958813,28.188937,"桃子湖",54],
					 [112.921228,28.200334,"梅溪湖",29]
					];
	var opts = {
				width : 100,  
				height: 80, 
				//title : "" ,
				enableMessage:true//设置允许信息窗发送短息
			   };
	for(var i=0;i<data_info.length;i++){
		var marker = new BMap.Marker(new BMap.Point(data_info[i][0],data_info[i][1]));  // 创建标注
		var content = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'>"+data_info[i][2]+"</h4>" + 
	"<p style='font-size:13px;'>水质指数："+data_info[i][3]+"<br><a href=''>查看详情</a></p>" + 
	"</div>";
		map.addOverlay(marker);               // 将标注添加到地图中
		addClickHandler(content,marker);
	}
	function addClickHandler(content,marker){
		marker.addEventListener("click",function(e){
			openInfo(content,e)}
		);
	}
	function openInfo(content,e){
		var p = e.target;
		var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
		var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象 
		map.openInfoWindow(infoWindow,point); //开启信息窗口
	}
	function t(){
		try{
			document.getElementsByClassName('BMap_cpyCtrl')[0].style.display='none';
			document.getElementsByClassName('anchorBL')[0].style.display='none';
		}catch(e){
			setTimeout(t,50);
		}
	}
	t();
</script>
</html>