$('.banner-image').on('click', (e) => {
    let picker = new MediaPicker({ type: 'image' });

    picker.on('select', (file) => {
        $(e.currentTarget).find('i').remove();
        $(e.currentTarget).find('img').attr('src', file.path).removeClass('hide');
        $(e.currentTarget).find('.banner-file-id').val(file.id);
    });
});
