@stack('styles')

<script>
(function () {
    "use strict";
    window.CI = {
        version: '{{ app_version() }}',
        csrfToken: '{{ csrf_token() }}',
        baseUrl: '{{ url('/') }}',
        langs: {},
        data: {},
    };
    
    CI.langs['admin::admin.buttons.delete'] = '{{ clean(trans('admin::admin.buttons.delete')) }}';
    CI.langs['admin::admin.delete.confirmation'] = '{{ clean(trans('admin::admin.delete.confirmation')) }}';
    CI.langs['admin::admin.delete.confirmation_message'] = '{{ clean(trans('admin::admin.delete.confirmation_message')) }}';
    CI.langs['admin::admin.delete.btn_delete'] = '{{ clean(trans('admin::admin.delete.btn_delete')) }}';
    CI.langs['admin::admin.delete.btn_cancel'] = '{{ clean(trans('admin::admin.delete.btn_cancel')) }}';
    CI.langs['admin::admin.delete.success_message'] = '{{ clean(trans('admin::admin.delete.success_message')) }}';
    
    CI.langs['files::files.success_message'] = '{{ clean(trans('files::files.success_message')) }}';
    CI.langs['files::files.files_manager'] = '{{ clean(trans('files::files.files_manager')) }}';
    CI.langs['files::messages.image_has_been_added'] = '{{ clean(trans('files::messages.image_has_been_added')) }}';
    CI.langs['files::messages.file_has_been_added'] = '{{ clean(trans('files::messages.file_has_been_added')) }}';
  
})();
</script>

@stack('general')

@routes
