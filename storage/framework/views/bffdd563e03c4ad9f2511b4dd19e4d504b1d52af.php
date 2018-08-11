<?php $__env->startSection('title','监测点管理'); ?>
<?php $__env->startSection('title_desc','监测点列表'); ?>
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
            <div class="col-md-6">
              <div class="">
                <select class="form-control select2" multiple="multiple" id="select_areas" data-placeholder="选择一个地点" style="width: 60%;">
					<?php $__currentLoopData = $waterareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waterarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($waterarea->aid); ?>"><?php echo e($waterarea->aname); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
				<button type="button" class="btn btn-info" id="query_btn">查询</button>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
    </div>
	<div class="box-header with-border">
	  <!-- <h3 class="box-title">水域列表</h3> -->
	  <a class="btn  btn-social btn-bitbucket addpoint">
		<i class="fa fa-user-plus"></i> 添加监测点
	  </a>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
	
	  <table class="table table-bordered">
		<tbody><tr>
		  <th style="width: 10px">Id</th>
		  <th>监测点名称</th>
		  <th>水域</th>
		  <th style="width: 40px">坐标</th>
		  <th style="width: 120px">操作</th>
		</tr>
		<?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
		  <td><?php echo e($point->pid); ?></td>
			<td><a href="/admin/data/<?php echo e($point->pid); ?>"><?php echo e($point->pname); ?></a></td>
			<td><a href="/admin/monitorpoint?aids=%5B<?php echo e($point->aid); ?>%5D"><?php echo e($point->area->aname); ?></a></td>
		  <td><?php echo e($point->lng); ?>,<?php echo e($point->lat); ?></td>
		  <td style="min-width:130px">

			<div class="btn-group">
                <button type="button" class="btn btn-xs btn-success" onclick="location.href='/admin/data/analysis/<?php echo e($point->pid); ?>'">分析</button>
			  <button type="button" class="btn btn-xs btn-info editpoint" data-pointid="<?php echo e($point->pid); ?>"><i class="fa fa-edit"></i>编辑</button>

			  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu " style="min-width:0px;" role="menu">
				  <li><a class="text-red delpoint" href="#" data-pointid="<?php echo e($point->pid); ?>" ><i class="fa fa-remove"></i>删除</a></li>
			  </ul>


			</div>
		  </td>
		</tr>
	   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	  </tbody></table>
	</div>
	<!-- /.box-body -->
	<div class="box-footer clearfix">
	  <ul class="pagination pagination-sm no-margin pull-right">
		<li><a href="#">«</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">»</a></li>
	  </ul>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('foot'); ?>
<script>
$('.select2').select2();
$('#query_btn').click(function () {
    var aids=[];
    try {
        $('#select_areas').val().forEach(function (e) {
            aids.push(parseInt(e));
        });
        location.href = location.pathname + "?" + "aids=" + encodeURIComponent(JSON.stringify(aids));
    }catch(e){
        location.href=location.pathname;
    }
});
$('.addpoint').click(function () {
    var addlayerid=layer.open({
        title : '添加监测点',
        scrollbar: false,
        content: '<div class="box-body" style="min-width:300px;">\n' +
        '                <div class="form-group">\n' +
        '                  <label for="add_pname" class=" control-label">监测点名称</label>\n' +
        '                  \n' +
        '                    <input type="text" class="form-control" id="add_pname" >\n' +
        '                  \n' +
        '                </div>\n' +
		'<div class="form-group">\n' +
        '<label>水域</label>\n' +
        '<select class="form-control select2" id="add_aid" style="width: 100%;">\n' +
		<?php $__currentLoopData = $waterareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waterarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            '  <option value="<?php echo e($waterarea->aid); ?>"><?php echo e($waterarea->aname); ?></option>\n' +
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        '</select>\n' +
        '</div>'+
        '<div class="form-group">\n' +
        '                  <label for="add_lng" class="control-label">经度</label>\n' +
        '\n' +
        '                  \n' +
        '                    <input type="text" class="form-control" id="add_lng" >\n' +
        '                  \n' +
        '                </div>\n' +
		'<div class="form-group">\n' +
        '                  <label for="add_lat" class="control-label">纬度</label>\n' +
        '\n' +
        '                  \n' +
        '                    <input type="text" class="form-control" id="add_lat" >\n' +
        '                  \n' +
        '                </div>\n' +
        '              </div>\n' +
        '              <!-- /.box-body -->\n' +
        '              <div class="box-footer">\n' +
        '                <button type="submit" id="adduser_do" class="btn btn-info btn-block">添加监测点</button>\n' +
        '              </div>\n' +
        '              <!-- /.box-footer -->',
        type: 1,
        success :function(e){
            $('#add_pname').val('');
            $('#add_aid').val('');
            $('#add_lng').val('');
            $('#add_lat').val('');
            $('#adduser_do').click(function() {
                $.post(location.pathname,{_method:'post',_token:'<?php echo e(csrf_token()); ?>',data:{
                    pname:$('#add_pname').val(),
                    aid:$('#add_aid').val(),
                    lng:$('#add_lng').val(),
                    lat:$('#add_lat').val(),
				},
                },function(data){
                    console.log(data);
                    layer.msg(data.msg,{icon: data.code==0?1:2,time:1500},function () {
                        if(data.code==0){
                            location.reload();
                        }
                    });
                }).error(function (e) {
                    layer.alert("请求错误，代码"+e.status);
                    console.log(e);
                });
            });

        }
    });
});

$('.delpoint').click(function () {
    var pointId=parseInt($(this).data('pointid'));
    console.log(pointId);
    layer.confirm('确定删除该监测点？', {
        btn: ['是','否'] //按钮
    }, function(){
        $.ajax({
            url:location.pathname+'/'+pointId,
            type:"delete",
            data:{_method:'delete',_token:'<?php echo e(csrf_token()); ?>'},
            success:function(data){
                console.log(data);
                layer.msg(data.msg,{icon: data.code==0?1:2,time:1500},function () {
                    if(data.code==0){
                        location.reload();
                    }
                });
            },
            error:function(e){
                layer.alert("请求错误，代码"+e.status);
                console.log(e);
            }
        });
    });
});

$('.editpoint').click(function(){
    var pointId=parseInt($(this).data('pointid'));
    console.log(pointId);
    var ajaxlayerid;
    $.ajax({
        url:location.pathname+'/'+pointId,
        beforeSend: function(){
            ajaxlayerid=layer.load(3, {
                shade: [0.1,'#666']
            });
        },
        complete: function() {layer.close(ajaxlayerid)},
        success: function (data){
            layer.open({
                title : '监测点编辑',
                scrollbar: false,
                content: '<div class="box-body" style="min-width:300px;">\n' +
                '                <div class="form-group">\n' +
                '                  <label for="edit_pname" class=" control-label">监测点名称</label>\n' +
                '                  \n' +
                '                    <input type="text" class="form-control" id="edit_pname" >\n' +
                '                  \n' +
                '                </div>\n' +
                '<div class="form-group">\n' +
                '<label>水域</label>\n' +
                '<select class="form-control select2" id="edit_aid" style="width: 100%;">\n' +
				<?php $__currentLoopData = $waterareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waterarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    '  <option value="<?php echo e($waterarea->aid); ?>"><?php echo e($waterarea->aname); ?></option>\n' +
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    '</select>\n' +
                '</div>'+
                '<div class="form-group">\n' +
                '                  <label for="edit_lng" class="control-label">经度</label>\n' +
                '\n' +
                '                  \n' +
                '                    <input type="text" class="form-control" id="edit_lng" >\n' +
                '                  \n' +
                '                </div>\n' +
                '<div class="form-group">\n' +
                '                  <label for="edit_lat" class="control-label">纬度</label>\n' +
                '\n' +
                '                  \n' +
                '                    <input type="text" class="form-control" id="edit_lat" >\n' +
                '                  \n' +
                '                </div>\n' +
                '              </div>\n' +
                '              <!-- /.box-body -->\n' +
                '              <div class="box-footer">\n' +
                '                <button type="submit" id="edit_do" class="btn btn-info btn-block">修改</button>\n' +
                '              </div>\n' +
                '              <!-- /.box-footer -->',
                type: 1,
                success :function(){
                    $('#edit_pname').val(data.pname);
                    $('#edit_aid').val(data.aid);
                    $('#edit_lng').val(data.lng);
                    $('#edit_lat').val(data.lat);
                    $('#edit_do').click(function() {
                        $.post(location.pathname+'/'+pointId,{_method:'put',_token:'<?php echo e(csrf_token()); ?>',data:{
                            pname:$('#edit_pname').val(),
                            aid:$('#edit_aid').val(),
                            lng:$('#edit_lng').val(),
                            lat:$('#edit_lat').val(),
                            },
                        },function(data){
                            console.log(data);
                            layer.msg(data.msg,{icon: data.code==0?1:2,time:1500},function () {
                                if(data.code==0){
                                    location.reload();
                                }
                            });

                        }).error(function (e) {
                            layer.alert("请求错误，代码"+e.status);
                            console.log(e);
                        });
                    });

                }
            });
        }
    });

    return ;



});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>