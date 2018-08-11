<?php $__env->startSection('title','新闻'); ?>
<?php $__env->startSection('contents'); ?>
<div class="row clearfix container center-block">
		<div class="col-lg-12 column fullblock">
			<div id="myCarousel" class="carousel slide">
				<!-- 轮播（Carousel）指标 -->
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
					<li data-target="#myCarousel" data-slide-to="4"></li>
				</ol>    
				<!-- 轮播（Carousel）项目 -->
				<div class="carousel-inner">
					<div class="item active" >
						<img width="100%" src="/img/1.jpg" alt="" class="center-block">
					</div>
					<div class="item">
						<img width="100%" src="/img/2.jpg" alt="" class="center-block">
					</div>
					<div class="item">
						<img width="100%" src="/img/3.jpg" alt="" class="center-block">
					</div>
					<div class="item">
						<img width="100%" src="/img/4.jpg" alt="" class="center-block">
					</div>
					<div class="item">
						<img width="100%" src="/img/5.jpg" alt="" class="center-block">
					</div>
					
				</div>
				<!-- 轮播（Carousel）导航 -->
			<!---	<a class="carousel-control left" href="#myCarousel" 
					data-slide="prev">&lsaquo;
				</a>
				<a class="carousel-control right" href="#myCarousel" 
					data-slide="next">&rsaquo;
				</a>
				-->
			</div>
		</div>
	</div>
	<div class="row container center-block">
		<div class="col-lg-12 column ">
		<div class="jumbotron">
			<h1>
				地表水质量监测系统
			</h1>
			<p>
				<div class="container">
			
				 </div>
				
			</p>
			<p>
				<a class="btn btn-primary btn-large" href="/admin">查看监控数据</a>
			</p>
		</div>
		</div>
		</div>
		<div class="row container center-block" style="background-image:url(/img/9.jpg)" >
			<div class="col-xs-4 column">
				<h4 >
					快捷导航
				</h4>
				<p>
					<a href="">国家环保局</a><br>
					<a href="">中国水网</a><br>
					<a href="">Google大数据实验室</a><br>
					<a href="">全国污染地图</a><br>
				</p>
				<p>
					<!-- <a class="btn" href="#">View more ?</a>-->
				</p>
			</div>
			<div class="col-xs-4 column">
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
					<!-- <a class="btn" href="#">View details ?</a>-->
				</p>
			</div>
			<div class="col-xs-4 column" >
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
					<!-- <a class="btn" href="#">View details ?</a>-->
				</p>
			</div>
		</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>