<?php $__env->startSection('title','水域管理'); ?>
<?php $__env->startSection('title_desc','水域列表'); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
	<div class="box-header with-border">
	  <!-- <h3 class="box-title">水域列表</h3> -->
	  <a class="btn  btn-social btn-bitbucket add_area">
		<i class="fa fa-user-plus"></i> 添加水域
	  </a>
	</div>
	<!-- /.box-header -->
	<div class="box-body">
	  <table class="table table-bordered">
		<tbody><tr>
		  <th style="width: 10px">Id</th>
		  <th>水域名称</th>
		  <th>描述</th>
		  <th>创建时间</th>
		  <th style="width: 120px">操作</th>
		</tr>
		<?php $__currentLoopData = $waterareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $waterarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<tr>
		  <td><?php echo e($waterarea->aid); ?></td>
			<td><a href="/admin/monitorpoint?aids=%5B<?php echo e($waterarea->aid); ?>%5D"><?php echo e($waterarea->aname); ?></a></td>
		  <td><?php echo e($waterarea->remark); ?></td>
		  <td><?php echo e($waterarea->created_at); ?></td>
		  <td>
			<div class="btn-group">
			  <button type="button" class="btn btn-xs btn-info editarea" data-areaid="<?php echo e($waterarea->aid); ?>"><i class="fa fa-edit"></i>编辑</button>
			  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
				<span class="caret"></span>
				<span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu " style="min-width:0px;" role="menu">
				  <li><a class="text-red delarea" href="#" data-areaid="<?php echo e($waterarea->aid); ?>" ><i class="fa fa-remove"></i>删除</a></li>
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
        $('.add_area').click(function () {
            var addlayerid=layer.open({
                title : '添加水域',
                scrollbar: false,
                content: '<div class="box-body" style="min-width:300px;">\n' +
                '                <div class="form-group">\n' +
                '                  <label for="add_aname" class=" control-label">水域名称</label>\n' +
                '\n' +
                '                  \n' +
                '                    <input type="text" class="form-control" id="add_aname" >\n' +
                '                  \n' +
                '                </div>\n' +
                '<div class="form-group">\n' +
                '                  <label for="add_remark" class="control-label">备注/描述</label>\n' +
                '\n' +
                '                  \n' +
                '                    <input type="text" class="form-control" id="add_remark" >\n' +
                '                  \n' +
                '                </div>\n' +
                '              </div>\n' +
                '              <!-- /.box-body -->\n' +
                '              <div class="box-footer">\n' +
                '                <button type="submit" id="adduser_do" class="btn btn-info btn-block">添加水域</button>\n' +
                '              </div>\n' +
                '              <!-- /.box-footer -->',
                type: 1,
                success :function(e){
                    $('#edit_aname').val('');
                    $('#edit_remark').val('');
                    $('#adduser_do').click(function() {
                        $.post(location.pathname,{_method:'post',_token:'<?php echo e(csrf_token()); ?>',data:{aname:$('#add_aname').val(),
                            remark:$('#add_remark').val()},
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

        $('.delarea').click(function () {
            var areaId=parseInt($(this).data('areaid'));
            console.log(areaId);
            layer.confirm('确定删除该水域？', {
                btn: ['是','否'] //按钮
            }, function(){
                $.ajax({
                    url:location.pathname+'/'+areaId,
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

        $('.editarea').click(function(){
            var areaId=parseInt($(this).data('areaid'));
            console.log(areaId);
            var ajaxlayerid;
            $.ajax({
                url:location.pathname+'/'+areaId,
                beforeSend: function(){
                    ajaxlayerid=layer.load(3, {
                        shade: [0.1,'#666']
                    });
                },
                complete: function() {layer.close(ajaxlayerid)},
            success: function (data){

                layer.open({
                    title : '水域编辑',
                    scrollbar: false,
                    content: '<div class="box-body" style="min-width:300px;">\n' +
                    '                <div class="form-group">\n' +
                    '                  <label for="edit_aname" class=" control-label">水域名称</label>\n' +
                    '\n' +
                    '                  \n' +
                    '                    <input type="email" class="form-control" id="edit_aname" >\n' +
                    '                  \n' +
                    '                </div>\n' +
                    '<div class="form-group">\n' +
                    '                  <label for="edit_remark" class="control-label">备注/描述</label>\n' +
                    '\n' +
                    '                  \n' +
                    '                    <input type="text" class="form-control" id="edit_remark" >\n' +
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
                        $('#edit_aname').val(data.aname);
                        $('#edit_remark').val(data.remark);
                        $('#edit_do').click(function() {
                            $.post(location.pathname+'/'+areaId,{_method:'put',_token:'<?php echo e(csrf_token()); ?>',data:{aname:$('#edit_aname').val(),
                                remark:$('#edit_remark').val()},
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