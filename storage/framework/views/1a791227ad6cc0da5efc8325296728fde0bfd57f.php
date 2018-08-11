<?php $__env->startSection('title','面板'); ?>
<?php $__env->startSection('title_desc','面板简介'); ?>
<?php $__env->startSection('content'); ?>
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo e($areaCnt); ?></h3>
                    <p>水域</p>
                </div>
                <div class="icon">
                    <i class="fa fa-location-arrow"></i>
                </div>
                <a href="/admin/waterarea" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo e($pointCnt); ?><sup style="font-size: 20px"></sup></h3>

                    <p>监测点</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/admin/monitorpoint" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo e($userCnt); ?></h3>

                    <p>用户</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="/admin/user" class="small-box-footer">更多信息<i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
                <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">水域</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">监测点</a></li>
                    <li class="pull-left header"><i class="fa fa-info"></i> 资源概览</li>
                </ul>
                <div class="tab-content no-padding">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">水域列表</h3>
							  <div class="box-tools">
								<ul class="pagination pagination-sm no-margin pull-right">
								  <li><a href="#">«</a></li>
								  <li><a href="#">1</a></li>
								  <li><a href="#">»</a></li>
								</ul>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body no-padding">
							  <table class="table">
								<tbody><tr>
								  <th style="width: 10px">#</th>
								  <th>名称</th>
								  <th style="width:7em;">查看</th>
								</tr>
								<?php $__currentLoopData = $areaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
								  <td><?php echo e($area->aid); ?></td>
								  <td><?php echo e($area->aname); ?></td>
								  <td>
									
									<button type="button" class="btn btn-default btn-sm" onclick="location.href='/admin/monitorpoint?aids=%5B<?php echo e($area->aid); ?>%5D'"><i class="fa fa-database"></i></button>
								  </td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  </tbody></table>
							</div>
							<!-- /.box-body -->
						  </div>
					</div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
						<div class="box">
							<div class="box-header">
							  <h3 class="box-title">监测点列表</h3>

							  <div class="box-tools">
								<ul class="pagination pagination-sm no-margin pull-right">
								  <li><a href="#">«</a></li>
								  <li><a href="#">1</a></li>
								  <li><a href="#">»</a></li>
								</ul>
							  </div>
							</div>
							<!-- /.box-header -->
							<div class="box-body no-padding">
							  <table class="table">
								<tbody><tr>
								  <th style="width: 10px">#</th>
								  <th>名称</th>
								  <th style="width:7em;">查看</th>
								</tr>
								<?php $__currentLoopData = $pointlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
								  <td><?php echo e($point->pid); ?>.</td>
								  <td><?php echo e($point->pname); ?></td>
								   <td>
									   <button type="button" class="btn btn-default btn-sm" onclick="location.href='/admin/monitorpoint?aids=%5B<?php echo e($point->aid); ?>%5D'"><i class="fa fa-database"></i></button>
								  </td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							  </tbody></table>
							</div>
							<!-- /.box-body -->
						  </div>
					</div>
                </div>
            </div>
            <!-- /.nav-tabs-custom -->
			
			</section>
			<section class="col-lg-6 connectedSortable">
            
            <!-- TO DO List -->
            <div class="box box-primary">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>

                    <h3 class="box-title">系统概览</h3>

                    
                </div>
                <!-- /.box-header -->
                <div class="box-body">
						<a class="text-aqua" href="#"><i class="fa fa-square"></i></a>OS: <?php echo PHP_OS; ?><hr>
						<a class="text-aqua" href="#"><i class="fa fa-square"></i></a>PHP版本: <?php echo PHP_VERSION;?><hr>
						<a class="text-aqua" href="#"><i class="fa fa-square"></i></a>Web Server: <?php echo $_SERVER['SERVER_SOFTWARE'];?><hr>
<!-- 						<a class="text-aqua" href="#"><i class="fa fa-square"></i></a>文件上传限制: <?php echo get_cfg_var("upload_max_filesize");?><hr> -->
						<a class="text-aqua" href="#"><i class="fa fa-square"></i></a>脚本超时限制: <?php echo get_cfg_var("max_execution_time");?>S<hr>
						
						<?php 
							$dt = round(@disk_total_space(".")/(1024*1024*1024),3); //总
							$df = round(@disk_free_space(".")/(1024*1024*1024),3); //可用
							$du = $dt-$df; //已用
							$hdPercent = (floatval($dt)!=0)?round($du/$dt*100,2):0;
						?>
						<h5><a class="text-aqua" href="#"><i class="fa fa-square"></i></a>硬盘:<?=$du?>/<?=$dt?></h5>
						<div class="progress">
							
							<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?=$hdPercent?>%">
							  <span class="sr-only">
							  
							  </span>
							</div>
						 </div>
			   </div>
                
            </div>
            <!-- /.box -->

        </section>
    </div>
    <!-- /.row (main row) -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>