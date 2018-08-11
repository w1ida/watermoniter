@extends('admin.admin_template')
@section('title','系统设置')
@section('title_desc','')
@section('content')

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">运行配置</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Hbase地址</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id" placeholder="" value="127.0.0.1">
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-2 control-label">Hbase端口</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" placeholder="" value="9090">
                  </div>
                </div>
				
				<div class="form-group">
                  <label for="" class="col-sm-2 control-label">Hbase表名</label>

                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="" placeholder="" value="water">
                  </div>
                </div>
				
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
				<div class="form-group">
                  <div class="col-sm-2">
                  <button type="submit" class="btn btn-info pull-right">保存设置</button>
                  </div>
                </div>
                
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->

@endsection