@extends('dartika-adm::layouts.default')

@section('title', trans('dartika-adm::adm.admin_users') . ' - ' . (isset($admUser) ? trans('dartika-adm::adm.edit') . ' ' . $admUser->email : trans('dartika-adm::adm.new')))

@section('page_title', trans('dartika-adm::adm.admin_users') . ' - ' . (isset($admUser) ? trans('dartika-adm::adm.edit') . ' ' . $admUser->email : trans('dartika-adm::adm.new')))
@section('page_description', '')

@section('breadcrumb')
    <li><a href="{{ route('dartika-adm.adm_users.index') }}"><i class="fa fa-users"></i> {{ trans('dartika-adm::adm.admin_users') }}</a></li>
    <li class="active">{{ isset($admUser) ? trans('dartika-adm::adm.edit') : trans('dartika-adm::adm.new') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"></h3>
                </div>

                <form class="form-horizontal" action="{{ isset($admUser) ? route('dartika-adm.adm_users.update', $admUser) : route('dartika-adm.adm_users.store') }}" method="POST">
                    <input name="_method" type="hidden" value="{{ isset($admUser) ? 'PUT' : 'POST' }}">
                    {{ csrf_field() }}

                    <div class="box-body">
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label"><span class="text-red">*</span> {{ trans('dartika-adm::adm.auth.email') }}</label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="email" class="form-control" name="email" value="{{ isset($admUser) ? $admUser->email : old('email') }}" placeholder="{{ trans('dartika-adm::adm.auth.email') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label"><span class="text-red {{ isset($admUser) ? 'collapse' : ''}}">*</span> {{ trans('dartika-adm::adm.auth.password') }}</label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="*****">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-sm-2 control-label"><span class="text-red {{ isset($admUser) ? 'collapse' : ''}}">*</span> {{ trans('dartika-adm::adm.auth.password_confirm') }}</label>

                            <div class="col-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="*****">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">{{ trans('dartika-adm::adm.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection