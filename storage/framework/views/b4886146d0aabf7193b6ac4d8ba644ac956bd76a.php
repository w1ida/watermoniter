<?php $__env->startSection('title','用户管理'); ?>
<?php $__env->startSection('title_desc','用户列表'); ?>
<?php $__env->startSection('content'); ?>
<div class="box">
            <div class="box-header with-border">
              <!-- <h3 class="box-title">用户列表</h3> -->
			  <a class="btn  btn-social btn-bitbucket add_user">
                <i class="fa fa-user-plus"></i> 添加用户
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tbody><tr>
                  <th style="width: 10px">Id</th>
                  <th>用户名</th>
                  <th>邮箱</th>
                  <th>创建时间</th>
                  <th style="width: 120px">操作</th>
                </tr>
                <?php $__currentLoopData = $userList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userRow): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <td><?php echo e($userRow->id); ?></td>
                  <td><?php echo e($userRow->name); ?></td>
                  <td><?php echo e($userRow->email); ?></td>
                  <td><?php echo e($userRow->created_at); ?></td>
				  <td>
					<div class="btn-group">
					  <button type="button" class="btn btn-xs btn-info editUser" data-userid="<?php echo e($userRow->id); ?>"><i class="fa fa-edit"></i>编辑</button>
					  <button type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
						<span class="sr-only">Toggle Dropdown</span>
					  </button>
					  <ul class="dropdown-menu " style="min-width:0px;" role="menu">
                          <li ><a class="text-red deluser" href="#" data-userid="<?php echo e($userRow->id); ?>" ><i class="fa fa-remove"></i>删除</a></li>
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
    $('.add_user').click(function () {
        layer.open({
            title : '添加用户',

            scrollbar: false,
            content: '<div class="box-body" style="min-width:300px;">\n' +
            '                <div class="form-group">\n' +
            '                  <label for="edit_username" class=" control-label">用户名</label>\n' +
            '\n' +
            '                  \n' +
            '                    <input type="email" class="form-control" id="edit_username" >\n' +
            '                  \n' +
            '                </div>\n' +
            '<div class="form-group">\n' +
            '                  <label for="edit_email" class="control-label">邮箱</label>\n' +
            '\n' +
            '                  \n' +
            '                    <input type="email" class="form-control" id="edit_email" >\n' +
            '                  \n' +
            '                </div>\n' +
            '                <div class="form-group">\n' +
            '                  <label for="edit_pwd" class=" control-label">密码</label>\n' +
            '\n' +
            '                 \n' +
            '                    <input type="text" class="form-control" id="edit_pwd" placeholder="">\n' +
            '                 \n' +
            '                </div>\n' +
            '              </div>\n' +
            '              <!-- /.box-body -->\n' +
            '              <div class="box-footer">\n' +
            '                <button type="submit" id="adduser_do" class="btn btn-info btn-block">添加用户</button>\n' +
            '              </div>\n' +
            '              <!-- /.box-footer -->',
            type: 1,
            success :function(){
                $('#edit_username').val('');
                $('#edit_email').val('');
                $('#edit_pwd').val('');
                $('#adduser_do').click(function() {
                    $.post(location.pathname,{_method:'post',_token:'<?php echo e(csrf_token()); ?>',data:{email:$('#edit_email').val(),
                        name:$('#edit_username').val(), password: $('#edit_pwd').val()},
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
    
    $('.deluser').click(function () {
        var useId=parseInt($(this).data('userid'));
        console.log(useId);
        layer.confirm('确定删除此用户？', {
            btn: ['是','否'] //按钮
        }, function(){
            $.ajax({
                url:location.pathname+'/'+useId,
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
    $('.editUser').click(function(){
        var useId=parseInt($(this).data('userid'));
        console.log(useId);
        var ajaxlayerid;
        $.ajax({
            url:location.pathname+'/'+useId,
            beforeSend: function(){
                ajaxlayerid=layer.load(3, {
                    shade: [0.1,'#666']
                });
             },
            complete: () => {layer.close(ajaxlayerid)},
            success: data => {


                layer.open({
                    title : '用户编辑',

                    scrollbar: false,
                    content: '<div class="box-body" style="min-width:300px;">\n' +
                    '                <div class="form-group">\n' +
                    '                  <label for="edit_username" class=" control-label">用户名</label>\n' +
                    '\n' +
                    '                  \n' +
                    '                    <input type="email" class="form-control" id="edit_username" >\n' +
                    '                  \n' +
                    '                </div>\n' +
                    '<div class="form-group">\n' +
                    '                  <label for="edit_email" class="control-label">邮箱</label>\n' +
                    '\n' +
                    '                  \n' +
                    '                    <input type="email" class="form-control" id="edit_email" >\n' +
                    '                  \n' +
                    '                </div>\n' +
                    '                <div class="form-group">\n' +
                    '                  <label for="edit_pwd" class=" control-label">密码</label>\n' +
                    '\n' +
                    '                 \n' +
                    '                    <input type="text" class="form-control" id="edit_pwd" placeholder="密码留空即不修改">\n' +
                    '                 \n' +
                    '                </div>\n' +
                    '              </div>\n' +
                    '              <!-- /.box-body -->\n' +
                    '              <div class="box-footer">\n' +
                    '                <button type="submit" id="edit_do" class="btn btn-info btn-block">修改</button>\n' +
                    '              </div>\n' +
                    '              <!-- /.box-footer -->',
                    type: 1,
                    success :function(){
                        $('#edit_username').val(data.name);
                        $('#edit_email').val(data.email);
                        $('#edit_pwd').val('');
                        $('#edit_do').click(function() {
                            $.post(location.pathname+'/'+useId,{_method:'put',_token:'<?php echo e(csrf_token()); ?>',data:{email:$('#edit_email').val(),
                            name:$('#edit_username').val(), password: $('#edit_pwd').val()},
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