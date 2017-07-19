@extends('dartika-adm::layouts.clear')

@section('title', '404')

@section('content')
    <section class="content">
        <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>

            <div class="error-content">
                <br>
                <h3><i class="fa fa-warning text-yellow"></i> {{ trans('dartika-adm::adm.errors.404.title') }}</h3>

                <p>
                    {!! trans('dartika-adm::adm.errors.404.explain', [ 'link' => route('dartika-adm.dashboard') ]) !!}
                </p>
            </div>
        </div>
    </section>
@endsection