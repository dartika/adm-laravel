<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title>@yield('title', 'Admin') - {{ config('dartika-adm.title') }}</title>

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<link rel="shortcut icon" href="{{ asset('/vendor/dartika-adm/img/favicon.ico') }}" type="image/x-icon">

<!-- Theme style -->
<link rel="stylesheet" type="text/css" href="{{ asset('/vendor/dartika-adm/css/admin.css') }}">

@stack('css_includes')

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">