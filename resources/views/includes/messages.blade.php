@push('js_includes')
    <script>
        $(document).ready(function() {
            'use strict';

            $('div.alert').not('.alert-important').delay(10000).slideUp(350);
        });
    </script>
@endpush

@include('flash::message')

@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
        @foreach ($errors->all() as $error)
            <div>• {{ $error }}</div>
        @endforeach
    </div>
@endif