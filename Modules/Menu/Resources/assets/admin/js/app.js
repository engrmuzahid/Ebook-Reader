import 'nestable2';

$('#type').on('change', (e) => {
    $('.link-field').addClass('d-none');
    $(`.${e.currentTarget.value}-field`).removeClass('d-none');
});

$('.dd').nestable({ maxDepth: 15});

$('.dd').on('change', () => {
    $.ajax({
        type: 'PUT',
        url: route('admin.menus.items.order.update'),
        contentType: 'application/json; charset=utf-8',
        data: JSON.stringify($('.dd').nestable('serialize')[0]),
        success() {
            success(CI.langs['menu::messages.menu_items_order_updated']);
        },
        error(xhr) {
            error(`${xhr.statusText}: ${xhr.responseJSON.message}`);
        },
    });
});

let id;
$('.delete-menu-item').on('click', (e) => {
    id = $(e.currentTarget).closest('.dd-item').data('id');
    swal({
        title: CI.langs['admin::admin.delete.confirmation'],
        text: CI.langs['admin::admin.delete.confirmation_message'],
        type: 'warning',
        buttons:{
            cancel: {
                visible: true,
                text : CI.langs['admin::admin.delete.btn_cancel'],
                className: 'btn btn-danger'
            },        			
            confirm: {
                text : CI.langs['admin::admin.delete.btn_delete'],
                className : 'btn btn-success'
            }
        }
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'DELETE',
                url: route('admin.menus.items.destroy', id),
                success() {
                    success(CI.langs['menu::messages.menu_item_deleted']);

                    $(`.dd-item[data-id="${id}"]`).fadeOut();
                },
                error(xhr) {
                    error(`${xhr.statusText}: ${xhr.responseJSON.message}`);
                },
            });
        }
    });

});