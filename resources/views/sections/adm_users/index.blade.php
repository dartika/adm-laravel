@extends('dartika-adm::layouts.default')

@section('title', trans('dartika-adm::adm.admin_users'))

@section('page_title', trans('dartika-adm::adm.admin_users'))
@section('page_description', '')

@section('breadcrumb')
    <li><a href="{{ route('dartika-adm.adm_users.index') }}"><i class="fa fa-users"></i> {{ trans('dartika-adm::adm.admin_users') }}</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('dartika-adm.adm_users.create') }}" type="button" class="btn btn-primary pull-right"><i class="fa fa-fw fa-plus"></i> {{ trans('dartika-adm::adm.new') }}</a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover table-striped">
                        <tr>
                            <th style="width: 1%">_id</th>
                            <th>{{ trans('dartika-adm::adm.auth.email') }}</th>
                            <th style="width: 3%"></th>
                        </tr>
                        @foreach ($admUsers as $admUser)
                            <tr>
                                <td class="text-center"><a href="{{ route('dartika-adm.adm_users.edit', $admUser) }}" class="anchor_block">{{ $admUser->id }}</a></td>
                                <td><a href="{{ route('dartika-adm.adm_users.edit', $admUser) }}" class="anchor_block">{{ $admUser->email }}</a></td>
                                <td class="text-center text-red">
                                    <a data-toggle="modal" data-targeturl="{{ route('dartika-adm.adm_users.deleteget', $admUser) }}" data-modaltitle="{{ trans('dartika-adm::adm.admin_users') }}" href="#destroyItem" title="{{ trans('dartika-adm::adm.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer">
                    {{ $admUsers->links('dartika-adm::includes.pagination-table') }}
                </div>
            </div>
        </div>
    </div>
@endsection