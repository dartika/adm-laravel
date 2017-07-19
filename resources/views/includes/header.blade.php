<header class="main-header">
    <a href="#" class="logo">
        <span class="logo-mini"><b>C</b></span>
        <span class="logo-lg"><b>CMS</b></span>
    </a>

    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ Auth::user()->email }}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('dartika-adm.logout') }}"><i class="glyphicon glyphicon-log-out"></i> {{ trans('dartika-adm::adm.logout') }}</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>