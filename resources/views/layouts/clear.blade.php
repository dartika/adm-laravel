<!DOCTYPE html>
<html>
<head>
    @include('dartika-adm::includes.head')
</head>
<body class="clear-page">
    @yield('content')

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