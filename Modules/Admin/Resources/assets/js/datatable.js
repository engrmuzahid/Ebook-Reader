// Initialize state holders.
CI.dataTable = { routes: {}, selected: {},customBtn: '' };

export default class {
    constructor(selector, options, callback) {
        this.selector = selector;
        this.element = $(selector);

        if (CI.dataTable.selected[selector] === undefined) {
            CI.dataTable.selected[selector] = [];
        }

        this.initiateDataTable(options, callback);

        this.addErrorHandler();
        this.registerTableProcessingPlugin();
    }

    initiateDataTable(options, callback) {
        let sortColumn = this.element.find('th[data-sort]');

        this.element.dataTable(_.merge({
            serverSide: true,
            processing: true,
            ajax: this.route('index', { table: true }),
            stateSave: true,
            sort: true,
            info: true,
            filter: true,
            lengthChange: true,
            paginate: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100, 200],
            language: { processing: '<i class="fas fa-spinner fa-spin"></i>' },
            order: [
                sortColumn.index() !== -1 ? sortColumn.index() : 1,
                sortColumn.data('sort') || 'desc',
            ],
            initComplete: () => {
                if (this.hasRoute('destroy')) {
                    let deleteButton = this.addTableActions();

                    deleteButton.on('click', () => this.deleteRows());
                }
                this.selectAllRowsEventListener();
                if (CI.dataTable.customBtn != '') {
                   let customButton = this.addTableCustomActions();
                }

                if (this.hasRoute('show') || this.hasRoute('edit')) {
                    this.onRowClick(this.redirectToRowPage);
                }

                if (callback !== undefined) {
                    callback.call(this);
                }
            },
            rowCallback: (row, data) => {
                if (this.hasRoute('show') || this.hasRoute('edit')) {
                    this.makeRowClickable(row, data.id);
                }
            },
            drawCallback: () => {
                this.element.find('.select-all').prop('checked', false);

                setTimeout(() => {
                    this.selectRowEventListener();
                    this.checkSelectedCheckboxes(this.constructor.getSelectedIds(this.selector));
                });
            },
            stateSaveParams(settings, data) {
                delete data.start;
                delete data.search;
            },
        }, options));
    }

    addTableActions() {
        let button = `
            <button type="button" class="btn btn-primary btn-delete m-2">
                ${CI.langs['admin::admin.buttons.delete']}
            </button>
        `;
        
        
        
        return $(button).appendTo(
            this.element.closest('.dataTables_wrapper').find('.dataTables_length')
        );
    }
    
    addTableCustomActions() {
        let button = CI.dataTable.customBtn
        
        return $(button).appendTo(
            this.element.closest('.dataTables_wrapper').find('.dataTables_length')
        );
    }

    deleteRows() {
        let checked = this.element.find('.select-row:checked');

        if (checked.length === 0) {
            return;
        }

        let deleted = [];
        
        let table = this.element.DataTable();
        let token = $("meta[name='csrf-token']").attr("content");
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
                
                table.processing(true);
        
                let ids = this.constructor.getRowIds(checked);
                
                // Don't make ajax request if an id was previously deleted.
                if (deleted.length !== 0 && _.difference(deleted, ids).length === 0) {
                    return;
                }
                
                $.ajax({
                    type: 'DELETE',
                    url: this.route('destroy', { ids: ids.join() }),
                    data: {
                        "_token": token,
                    },
                    success: () => {
                        deleted = _.flatten(deleted.concat(ids));

                        this.constructor.setSelectedIds(this.selector, []);

                        this.constructor.reload(this.element);
                        
                        swal(CI.langs['admin::admin.delete.success_message'], {
                            icon: "success",
                            buttons : {
                                confirm : {
                                    className: 'btn btn-success'
                                }
                            }
                        });
                        
                    },
                    error: (xhr) => {
                        error(`${xhr.statusText}: ${xhr.responseJSON.message}`);

                        deleted = _.flatten(deleted.concat(ids));

                        this.constructor.setSelectedIds(this.selector, []);

                        this.constructor.reload(this.element);
                    },
                });
                
            }
        });
        
    }

    makeRowClickable(row, id) {
        let key = this.hasRoute('show') ? 'show' : 'edit';
        let url = this.route(key, { id });

        $(row).addClass('clickable-row').data('href', url);

        setTimeout(() => {
            $('.clickable-row td:not(:first-child,.noclickable)').css('cursor', 'pointer');
        });
    }

    onRowClick(handler) {
        let row = 'tbody tr.clickable-row td';

        if (this.element.find('.select-all').length !== 0) {
            row += ':not(:first-child,.noclickable)';
        }else{
             row += ':not(.noclickable)';
        }            
        
        this.element.on('click', row, handler);
    }

    redirectToRowPage(e) {
        window.open(
            $(e.currentTarget).parent().data('href'),
            e.ctrlKey ? '_blank' : '_self'
        );
    }

    selectAllRowsEventListener() {
        this.element.find('.select-all').on('change', (e) => {
            if (e.currentTarget.checked) {
                this.element.find('.select-row').not(":checked").prop('checked', e.currentTarget.checked).trigger("change");
            }else {
                this.element.find('.select-row:checked').prop('checked', e.currentTarget.checked).trigger("change");
            }
        });
    }

    selectRowEventListener() {
        this.element.find('.select-row').on('change', (e) => {
            if (e.currentTarget.checked) {
                this.appendToSelected(e.currentTarget.value);
            } else {
                this.removeFromSelected(e.currentTarget.value);
            }
        });
    }

    appendToSelected(id) {
        id = parseInt(id);

        if (! CI.dataTable.selected[this.selector].includes(id)) {
            CI.dataTable.selected[this.selector].push(id);
        }
        
        //console.log(CI.dataTable.selected);
    }

    removeFromSelected(id) {
        id = parseInt(id);
        
        //CI.dataTable.selected[this.selector].remove(id);
        _.pull(CI.dataTable.selected[this.selector], id);
        //console.log(CI.dataTable.selected);
    }

    checkSelectedCheckboxes(selectedIds) {
        let rows = this.element.find('.select-row');

        let checkableRows = rows.toArray().filter((row) => {
            return selectedIds.includes(parseInt(row.value));
        });

        $(checkableRows).prop('checked', true);
    }

    route(name, params) {
        let router = CI.dataTable.routes[this.selector][name];

        if (typeof router === 'string') {
            router = { name: router, params };
        }

        router.params = _.merge(params, router.params);

        return window.route(router.name, router.params).url();
    }

    hasRoute(name) {
        return CI.dataTable.routes[this.selector][name] !== undefined;
    }

    static setRoutes(selector, routes) {
        CI.dataTable.routes[selector] = routes;
    }
    
    static customBtn(btn) {
        CI.dataTable.customBtn = btn;
    }

    static setSelectedIds(selector, selected) {
        CI.dataTable.selected[selector] = selected;
    }

    static getSelectedIds(selector) {
        return CI.dataTable.selected[selector];
    }

    static reload(selector, callback, resetPaging = false) {
        $(selector).DataTable().ajax.reload(callback, resetPaging);
    }

    static getRowIds(rows) {
        return rows.toArray().reduce((ids, row) => {
            return ids.concat(row.value);
        }, []);
    }

    static removeLengthFields() {
        $('.dataTables_length select').remove();
    }

    addErrorHandler() {
        $.fn.dataTable.ext.errMode = (settings, helpPage, message) => {
            this.element.html(message);
        };
    }

    registerTableProcessingPlugin() {
        $.fn.dataTable.Api.register('processing()', function (show) {
            return this.iterator('table', function (ctx) {
                ctx.oApi._fnProcessingDisplay(ctx, show);
            });
        });
    }
}
