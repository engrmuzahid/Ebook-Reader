import '../../../../node_modules/x-editable/dist/bootstrap3-editable/js/bootstrap-editable';

$('.translations-table').dataTable({
    pageLength: 10,
    lengthMenu: [10, 20, 50, 100, 200],
    drawCallback: () => {
        $('.translation').editable({
            url: function(data) {
                $.ajax({
                    url: route('admin.translations.update', this.dataset.key),
                    type: 'PUT',
                    data: {
                        locale: this.dataset.locale,
                        value: data.value,
                    },
                    success(message) {
                        success(message);
                    },
                    error(xhr) {
                        error(`${xhr.statusText}: ${xhr.responseJSON.message}`);
                    },
                });
            },
            type: 'text',
            mode: 'inline',
            send: 'always',
        });
        //modify buttons style
        $.fn.editableform.buttons = 
          '<button type="submit" class="btn btn-primary btn-sm editable-submit"><i class="fas fa-check"></i></button><button type="button" class="btn btn-default btn-sm editable-cancel"><i class="fas fa-times"></i></button>';   
    },
});

