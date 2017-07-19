@push('js_includes')
    <script>
        $(document).ready(function() {
            'use strict';

            $('#destroyItem').on('show.bs.modal', function (event) {
                $('#actionBtn', $(this)).attr('href', $(event.relatedTarget).data('targeturl'))
                $('.modal-title .tit', $(this)).html($(event.relatedTarget).data('modaltitle'));
            });
        });
    </script>
@endpush

<!-- Modal -->
<div class="modal" id="destroyItem" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ trans('dartika-adm::adm.delete') }} - <span class="tit"></span></h4>
            </div>
            <div class="modal-body">
                {{ trans('dartika-adm::adm.are_sure') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('dartika-adm::adm.cancel') }}</button>
                <a href="" class="btn btn-danger" id="actionBtn">{{ trans('dartika-adm::adm.delete') }}</a>
            </div>
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->