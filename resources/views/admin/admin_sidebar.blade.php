<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user['name'] }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i>在线</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
		<ul class="sidebar-menu">
			
			<li><a href="/" target="_blank"><i class="fa fa-home"></i> <span>首页</span></a></li>
		</ul>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">主菜单</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="!active"><a href="/admin"><i class="fa fa-dashboard"></i> <span>面板</span></a></li>

            <li class="treeview">
                <a href="#"><i class="fa fa-user"></i> <span>用户</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/user">用户列表</a></li>
                    <!-- <li><a href="#">权限设置</a></li> -->
                </ul>
            </li> 
			<li class="treeview">
                <a href="#"><i class="fa fa-database"></i> <span>数据</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/data">数据查看</a></li>
                    <li><a href="/admin/data/analysis">数据分析</a></li>
                </ul>
            </li>
            <li ><a href="/admin/map"><i class="fa fa-map"></i> <span>地图</span></a></li>
            <li ><a href="/admin/waterarea"><i class="fa fa-anchor"></i> <span>水域</span></a></li>
            <li ><a href="/admin/monitorpoint"><i class="fa fa-map-pin"></i> <span>监测点</span></a></li>

            <li ><a href="/admin/syssetting"><i class="fa fa-server"></i> <span>系统设置</span></a></li>
            {{--<li ><a href="/admin/syslog"><i class="fa fa-file-text-o"></i> <span>系统日志</span></a></li>--}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>