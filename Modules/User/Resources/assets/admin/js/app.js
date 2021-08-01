$('.permission-all > .btn-action-all').on('click', (e) => {
    let action = e.currentTarget.getAttribute('data-action');
    $(`.permission-${action}`).prop('checked', true);
});

$('.permission-group-all > .btn-action-all').on('click', (e) => {
    let action = e.currentTarget.getAttribute('data-action');
     
    $(e.currentTarget).closest('.permission-group').find(`.permission-${action}`).prop('checked', true);
       
});
