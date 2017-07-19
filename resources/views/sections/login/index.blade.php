@extends('dartika-adm::layouts.clear')

@section('title', trans('dartika-adm::adm.login'))

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('dartika-adm.login') }}"><b>CMS</b></a>
        </div>

        @include('dartika-adm::includes.messages')

        <div class="login-box-body">
            <form action="{{ route('dartika-adm.login') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">{{ trans('dartika-adm::adm.login') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection