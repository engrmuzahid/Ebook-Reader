import NProgress from 'nprogress';

export default class {
    constructor() {
        this.tooltip();
        this.nprogress();
        this.btnloading();
        this.ciAccordion();
        this.buidSelect2();
    }

    tooltip() {
        /* $('[data-toggle="tooltip"]').tooltip({ trigger : 'hover' })
            .on('click', (e) => {
                $(e.currentTarget).tooltip('hide');
            }); */
        $('[data-toggle="tooltip"]').tooltip()
        $('[data-toggle="popover"]').popover();
        $(document).ajaxComplete(() => {
            $('[data-toggle="tooltip"]').tooltip()
            $('[data-toggle="popover"]').popover();
        });
    }
    
    ciAccordion() {
        $('.ci-accordion .nav.nav-pills a.nav-link').on('click', (e) => {
            $(".ci-accordion .nav.nav-pills a.nav-link").not($(this)).removeClass('active');
        });
    }

    nprogress() {
        let inMobile = /iphone|ipod|android|ie|blackberry|fennec/i.test(window.navigator.userAgent);

        if (inMobile) {
            return;
        }

        NProgress.configure({ showSpinner: true });

        $(document).ajaxStart(() => NProgress.start());
        $(document).ajaxComplete(() => NProgress.done());
    }
    
    btnloading() {
        $('[data-loading]').on('click', (e) => {
            let button = $(e.currentTarget);

            if (button.is('i')) {
                button = button.parent();
            }

            button.data('loading-text', button.html())
                .addClass('btn-loading')
                .button('loading');
        });

    }
    
    buidSelect2() {
          //$('.select2').select2();
        let $select2 =$('.select2');
        $select2.select2();
    }
}
