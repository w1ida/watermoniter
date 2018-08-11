<?php $__env->startSection('title','系统日志'); ?>
<?php $__env->startSection('title_desc',''); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
	<div class="box-header">
	  <h3 class="box-title">运行记录</h3>
	</div>
	<!-- /.box-header -->
	<div class="box-body no-padding">
	  <table class="table table-striped">
		<tr>
		  <th style="width:12em">时间</th>
		  <th>事件</th>
		  <th style="width:6em">类型</th>
		</tr>
		<tr>
		  <td>2017-06-21 18:52:56</td>
		  <td>
			修改用户admin密码
		  </td>
		  <td><span class="badge bg-green">INFO</span> </td>
		</tr>
		<tr>
		  <td>2017-06-28 10:55:56</td>
		  <td>
			添加水域
		  </td>
		  <td><span class="badge bg-green">INFO</span> </td>
		</tr>
		<tr>
		  <td>2017-06-28 10:54:21</td>
		  <td>
			添加监测点
		  </td>
		  <td><span class="badge bg-green">INFO</span></td>
		</tr>
		<tr>
		  <td>2017-06-30 13:12:08</td>
		  <td>
			添加调试数据
		  </td>
		  <td><span class="badge bg-blue">DEGUG</span></td>
		</tr>
	  </table>
	</div>
	<!-- /.box-body -->
  </div>
  <!-- /.box -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>