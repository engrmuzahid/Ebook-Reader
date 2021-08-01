import CategoryTree from './CategoryTree';

export default class {
    constructor() {
        let tree = $('.category-tree');

        new CategoryTree(this, tree);

        this.collapseAll(tree);
        this.expandAll(tree);
        this.addRootCategory();
        this.addSubCategory();
        this.deleteCategory();

        $('#category-form').on('submit', this.submit);
    }

    collapseAll(tree) {
        $('.collapse-all').on('click', (e) => {
            e.preventDefault();

            tree.jstree('close_all');
        });
    }

    expandAll(tree) {
        $('.expand-all').on('click', (e) => {
            e.preventDefault();

            tree.jstree('open_all');
        });
    }

    addRootCategory() {
        $('.add-root-category').on('click', () => {
            $('.add-sub-category').addClass('disabled');

            $('.category-tree').jstree('deselect_all');

            this.clear();

            
        });
    }

    addSubCategory() {
        $('.add-sub-category').on('click', () => {
            let selectedId = $('.category-tree').jstree('get_selected')[0];

            if (selectedId === undefined) {
                return;
            }

            this.clear();
            
            window.form.appendHiddenInput('#category-form', 'parent_id', selectedId);

            
        });
    }

    deleteCategory() {
        $('.btn-delete-category').on('click', (e) => {
           
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
                    $('#categories-delete-form').submit();
                }
                $('.btn-delete-category').removeClass('btn-loading');
                
            });

        });
    }
    fetchCategory(id) {
        $('.add-sub-category').removeClass('disabled');

        $.ajax({
            type: 'GET',
            url: route('admin.categories.show', id),
            success: (category) => {
                this.update(category);
            },
            error: (xhr) => {
                error(`${xhr.statusText}: ${xhr.responseJSON.message}`);
            },
        });
    }

    update(category) {
        window.form.removeErrors();

        $('.btn-delete-category').removeClass('d-none');
        
        $('.form-group .help-block').remove();

        $('#categories-delete-form').attr('action', route('admin.categories.destroy', category.id));
        
        $('#name').val(category.name);

        $('#slug').val(category.slug);
        $('#slug-field').removeClass('d-none');
        

        $('#is_searchable').prop('checked', category.is_searchable);
        $('#is_active').prop('checked', category.is_active);

        $('#category-form input[name="parent_id"]').remove();
    }

    clear() {
        $('#name').val('');

        $('#slug').val('');
        $('#slug-field').addClass('d-none');
        
        $('#is_searchable').prop('checked', false);
        $('#is_active').prop('checked', false);

        $('.btn-delete-category').addClass('d-none');
        $('.form-group .help-block').remove();

        $('#category-form input[name="parent_id"]').remove();

    }

    submit(e) {
        let selectedId = $('.category-tree').jstree('get_selected')[0];

        if (! $('#slug-field').hasClass('d-none')) {
            window.form.appendHiddenInput('#category-form', '_method', 'put');

            $('#category-form').attr('action', route('admin.categories.update', selectedId));
        }

        e.currentTarget.submit();
    }
}
