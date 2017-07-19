<!DOCTYPE html>
<html>
<head>
    @include('dartika-adm::includes.head')
</head>
<body class="skin-blue sidebar-mini fixed">
    <div class="wrapper">
        @include('dartika-adm::includes.header')
        @include('dartika-adm::includes.nav')

        <div class="content-wrapper">
            @include('dartika-adm::includes.messages')

            <section class="content-header">
                <h1>
                    @yield('page_title')
                    <small>@yield('page_description')</small>
                </h1>
                <ol class="breadcrumb">
                    @yield('breadcrumb')
                </ol>
            </section>

            <section class="content container-fluid">
                @yield('content')
            </section>
        </div>

        @include('dartika-adm::includes.footer')
    </div>

    @if(App::isLocal())
        <script id="__bs_script__">//<![CDATA[
    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.18.8'><\/script>".replace("HOST", location.hostname));
//]]></script>
    @endif
    
    <script src="{{ mix('/js/vendor.js', '/vendor/dartika-adm') }}"></script>
    <script src="{{ mix('/js/adminlte.js', '/vendor/dartika-adm') }}"></script>
    <script src="{{ mix('/js/global.js', '/vendor/dartika-adm') }}"></script>

    @stack('js_includes')

</body>
</html>