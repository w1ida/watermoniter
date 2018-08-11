@extends('admin.admin_template')
@section('title','地图显示')
@section('title_desc','')
@section('content')
<div id="allmap"></div>
@endsection

@section('foot')
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=4bRePVpicSZLt2recABBT6tZ1qZZ2xXm"></script>
	<script type="text/javascript">
        var chgsize=function() {
            $('.content').attr('style','padding:0');
            $('.main-footer').hide();
            var headh=$('.main-header').height();
            var cheadh=$('.content-header').height();
            $('#allmap').css('height',$(window).height()-headh-cheadh);
        }
        $(document).ready(chgsize);
        $(window).resize(chgsize);
        var map = new BMap.Map('allmap',{enableMapClick:false});

        map.centerAndZoom(new BMap.Point(112.966777,28.196858), 12);

        map.addControl(new BMap.NavigationControl());        // 添加平移缩放控件
        //map.addControl(new BMap.ScaleControl());             // 添加比例尺控件
        //map.addControl(new BMap.OverviewMapControl());       //添加缩略地图控件
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
            },
            {
                "featureType": "point",
                "elementType": "all",
                "stylers": {
                    "visibility": "off"
				}
            }
        ]
        map.setMapStyle({styleJson:styleJson});
//        $('.BMap_Marker').remove();
//        $('.BMap_mask').remove();

        var sContent =
            "<h4 style='margin:0 0 5px 0;padding:0.2em 0'>湘江中游橘子洲检测点</h4>" +
            "<p style='font-size:13px;'>水质指数：36<br><br><a href=''>查看详情</a></p>" +
            "</div>";

        map.centerAndZoom(new BMap.Point({{$points[0]->lng}},{{$points[0]->lat}}), 12);
        var data_info = [
            @foreach($points as $point)
				[{{$point->lng}},{{$point->lat}},'{{$point->pname}}',{{$point->pid}},'{{$point->area->aname}}',{{$point->aid}}],
			@endforeach
//            [112.966934,28.193394,"湘江中游橘子洲",36],
//            [112.958813,28.188937,"桃子湖",54],
//            [112.921228,28.200334,"梅溪湖",29]
        ];
        var opts = {
            width : 100,
            height: 80,
            title : "监测点信息" ,
            enableMessage:true//设置允许信息窗发送短息
        };

        for(var i=0;i<data_info.length;i++){
            var marker = new BMap.Marker(new BMap.Point(data_info[i][0],data_info[i][1]));  // 创建标注
            var content = "<h4 style='margin:0 0 5px 0;padding:0.2em 0'>监测点：<a href='#'>"+data_info[i][2]+"</a></h4>" +
                "<p style='font-size:13px;'>水域：<a href='/admin/monitorpoint?aids=%5B"+data_info[i][5]+"%5D'>"+data_info[i][4]+"</a></p>" +
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
                console.log('hide succ');
                map.centerAndZoom(new BMap.Point({{$points[0]->lng}},{{$points[0]->lat}}), 8);
            }catch(e){
                setTimeout(t,50);
            }
        }
        t();
	</script>

@endsection
