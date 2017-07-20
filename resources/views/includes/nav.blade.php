<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('dartika-adm::adm.menu') }}</li>

            <li class="{{ Route::is('dartika-adm.dashboard') ? 'active' : ''}}"><a href="{{ route('dartika-adm.dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('dartika-adm::adm.dashboard') }}</span></a></li>
            
            <li class="{{ Route::is('dartika-adm.adm_users*') ? 'active' : ''}}"><a href="{{ route('dartika-adm.adm_users.index') }}"><i class="fa fa-users"></i> <span>{{ trans('dartika-adm::adm.admin_users') }}</span></a></li>

            <li class="{{ Route::is('dartika-adm.helloworld') ? 'active' : ''}}"><a href="{{ route('dartika-adm.helloworld') }}"><i class="fa fa-hand-spock-o"></i> <span>Hello World!</span></a></li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>