@extends('layout')
@section('title','地表水质量监测系统')
@section('contents')
<div class="row clearfix">
	<div class="col-md-12 column">
		<div class="row clearfix">
			<div class="col-md-12 column">
				<div id="myCarousel" class="carousel slide">
					<!-- 轮播（Carousel）指标 -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>   
					<!-- 轮播（Carousel）项目 -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="/img/panel1.png" alt="First slide1">
						</div>
						<div class="item">
							<img src="/water/img/1.jpg" alt="Second slide2">
						</div>
						<div class="item">
							<img src="http://www.jq22.com/demo/unslider-150203225543/03.jpg" alt="Third slide">
						</div>
					</div>
					<!-- 轮播（Carousel）导航 -->
					<a class="carousel-control left" href="#myCarousel" 
						data-slide="prev">&lsaquo;
					</a>
					<a class="carousel-control right" href="#myCarousel" 
						data-slide="next">&rsaquo;
					</a>
				</div>
			</div>
		</div>
		<div class="jumbotron">
			<h1>
				地表水质量监测系统
			</h1>
			<p>
				工业化的不断发展导致环境破坏日益严重，尤其是地表水环境的污染。工业污水和生活废水的不断排放，已经严重的影响我们的日常生活用水。进行有效的水环境监测和管理工作已经刻不容缓。如何在大面积、零散的水域实施在线、实时的监测是解决水环境污染问题的基础。因此，设计一套具有在线、实时功能的水环境监测系统具有非常重要的意义...
			</p>
			<p>
				<a class="btn btn-primary btn-large" href="#">查看详情</a>
			</p>
		</div>
		<div class="row clearfix">
			<div class="col-md-4 column">
				<h4>
					快捷导航
				</h4>
				<p>
					<a href="">国家环保局</a><br>
					<a href="">中国水网</a><br>
					<a href="">Google大数据实验室</a><br>
					<a href="">全国污染地图</a><br>
				</p>
				<p>
					<!-- <a class="btn" href="#">View more »</a>-->
				</p>
			</div>
			<div class="col-md-4 column">
				<h4>
					关于系统
				</h4>
				<p>
					<a href="">系统简介</a><br>
					<a href="">发展历程</a><br>
					<a href="">核心优势</a><br>
					<a href="">成功案例</a><br>

				</p>
				<p>
					<!-- <a class="btn" href="#">View details »</a>-->
				</p>
			</div>
			<div class="col-md-4 column">
				<h4>
					其他
				</h4>
				<p>
					<a href="">管理控制台</a><br>
					<a href="">留言反馈</a><br>
					<a href="">提交建议</a><br>
					<a href="">联系我们</a><br>
				</p>
				<p>
					<!-- <a class="btn" href="#">View details »</a>-->
				</p>
			</div>
		</div>
	</div>
</div>
@endsection
