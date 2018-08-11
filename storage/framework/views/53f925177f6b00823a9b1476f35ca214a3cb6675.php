<?php $__env->startSection('title','数据查看'); ?>
<?php $__env->startSection('title_desc','数据列表'); ?>
<?php $__env->startSection('head'); ?>
 <link rel="stylesheet" href="<?php echo e(asset("AdminLTE/plugins/datatables/dataTables.bootstrap.min.css")); ?>">
 <link rel="stylesheet" href="<?php echo e(asset("AdminLTE/plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css")); ?>">
 <link rel="stylesheet" href="<?php echo e(asset("AdminLTE/plugins/datepicker/datepicker3.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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

<div class="box-header with-border">
<h3 class="box-title">数据表</h3> 

</div>
<div class="box-body">
	<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
	<thead>
        
            
            
            
            
            
            
        
	</thead>
	</table>
</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('foot'); ?>
<!-- DataTables -->
<script src="<?php echo e(asset("AdminLTE/plugins/datatables/jquery.dataTables.min.js")); ?>"></script>
<script src="<?php echo e(asset("AdminLTE/plugins/datatables/dataTables.bootstrap.min.js")); ?>"></script>
<script src="<?php echo e(asset("AdminLTE/plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js")); ?>"></script>
<script src="<?php echo e(asset("AdminLTE/plugins/datatables/extensions/Buttons/js/buttons.colVis.min.js")); ?>"></script>
<script src="<?php echo e(asset("AdminLTE/plugins/jszip/3.1.5/jszip.min.js")); ?>"></script>

<script src="<?php echo e(asset("AdminLTE/plugins/datatables/extensions/Buttons/js/buttons.html5.min.js")); ?>"></script>

<script src="<?php echo e(asset("AdminLTE/plugins/datepicker/bootstrap-datepicker.js")); ?>"></script>
<script>
$(document).ready(function() {
	$('select').select2();
	 //Date picker
    $('.datepicker').datepicker({
      autoclose: true
    });

	function datatotime(date){
	    if(!date)return null;
		var d = new Date(date);
		d.setDate(d.getDate());
		return d.getTime();		
	}

	$('#query').click(function(){
		var stime=datatotime($('#stime').val());
		var etime=datatotime($('#etime').val());
		if(!stime)stime='0';
		if(!etime)etime='1657840800000';
        //$('#example').DataTable().destroy();
		//thead=$('#example thead>tr');
        //thead.empty();
		var rowdata;
        var loadIndex = layer.load(0, {
            shade: [0.1,'#000'] //0.1透明度的白色背景
        });
        $.get('/admin/data/ajaxdata/<?php echo e($pid); ?>?stime='+stime+'&etime='+etime,function(ajaxdata){
            if(!ajaxdata||!ajaxdata.data){
                layer.msg('抱歉，该时间段没有数据',{icon:2});
                return ;
			}
            console.log(ajaxdata);
            $tableConfig={
                "destroy": true,
                // "ajax" :'/admin/data/ajaxdata/<?php echo e($pid); ?>?stime='+stime+'&etime='+etime,
                "data":ajaxdata.data,
                columns:ajaxdata.columns,
                dom: 'Bfrtip',
                buttons: [
                    'colvis', 'copy', 'csv', 'excel', 'pdf',
                ],
                language: {
                    "sProcessing": "处理中...",
                    "sLengthMenu": "显示 _MENU_ 项结果",
                    "sZeroRecords": "没有匹配结果",
                    "sInfo": "显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项",
                    "sInfoEmpty": "显示第 0 至 0 项结果，共 0 项",
                    "sInfoFiltered": "(由 _MAX_ 项结果过滤)",
                    "sInfoPostFix": "",
                    "sSearch": "搜索:",
                    "sUrl": "",
                    "sEmptyTable": "表中数据为空",
                    "sLoadingRecords": "载入中...",
                    "sInfoThousands": ",",
                    "oPaginate": {
                        "sFirst": "首页",
                        "sPrevious": "上页",
                        "sNext": "下页",
                        "sLast": "末页"
                    },
                    "oAria": {
                        "sSortAscending": ": 以升序排列此列",
                        "sSortDescending": ": 以降序排列此列"
                    },
                    buttons: {
                        colvis: '查看列',
                        copy: '复制',
                        copyTitle: '已复制到剪切板',
                        csv: '导出csv',
                        excel: '导出excel',
                    },

                }
            };

            $('#example').DataTable($tableConfig);
		},'json').error(function () {
            layer.msg('抱歉，请求出错',{icon:2})
        }).complete(function () {
			layer.close(loadIndex);
        });
        //$('#example thead').html('<th><td>111</td></th>')

        // $(table .table().header()).find("tr").html("");
//        $('#example').empty();
        //1357840800000


	});

} );

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>