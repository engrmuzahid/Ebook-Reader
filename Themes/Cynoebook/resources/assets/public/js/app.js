require('./bootstrap');

import Vue from 'vue';
import NewsletterPopup from './components/layout/NewsletterPopup';
import NewsletterSubscription from './components/layout/NewsletterSubscription';
import CookieBar from './components/layout/CookieBar';

Vue.component('newsletter-popup', NewsletterPopup);
Vue.component('newsletter-subscription', NewsletterSubscription);
Vue.component('cookie-bar', CookieBar);

new Vue({
    el: '#app',
});

import { stopButtonLoading, trans } from './functions';

$(function () {
    let isRTL = $('body').hasClass('rtl');
    let directionClass = isRTL ? 'rtl' : 'ltr';

    /*----------------------------------------*/
    /*      sticky nav
    /*----------------------------------------*/

    let stickyNavTop = $('.header-wrapper').offset().top;

    let stickyNav = () => {
        let scrollTop = $(window).scrollTop();

        if (scrollTop > stickyNavTop) {
            $('.header-inner, .autocomplete-suggestions').addClass('sticky');

            return;
        }

        $('.header-inner, .autocomplete-suggestions').removeClass('sticky');
    };

    $(window).on('load scroll', () => {
        stickyNav();
    });

    /*----------------------------------------*/
    /*      content wrapper minimum height
    /*----------------------------------------*/

    let contentWrapper = $('.content-wrapper');
    let footer = $('.footer');

    $(window).on('load resize', () => {
        $('.content-wrapper').css('min-height', $(window).height() - contentWrapper.offset().top - footer.height() + 'px');
    });

    /*----------------------------------------*/
    /*      search box
    /*----------------------------------------*/

    function autocomplete(selector, options) {
        $(selector).autocomplete(Object.assign({
            dataType: 'json',
            triggerSelectOnValidInput: false,
            transformResult(response) {
                let ebooks = response.data.map((ebook) => {
                    return {
                        value: ebook.title.toLowerCase(),
                        label: ebook.title.toLowerCase(),
                    };
                });

                return { suggestions: ebooks };
            },
            onSelect() {
                $(selector).closest('#search-box-form').submit();
            },
        }, options));
    }

    autocomplete('.search-box .search-box-input', {
        serviceUrl() {
            return route('ebooks.index', { category: $('.search-box-select').val(), perPage: 10 });
        },
    });

    autocomplete('.mobile-search .search-box-input', {
        appendTo: '.mobile-search .dropdown-menu',
        serviceUrl() {
            return route('ebooks.index', { perPage: 5 });
        },
        beforeRender(container) {
            container.addClass('mobile-search-suggestions');
        },
    });

    $('#search-box-form').on('submit', function (e) {
        e.preventDefault();

        let searchBoxInputs = $('.search-box-input');

        searchBoxInputs.each((i, el) => {
            if (el.value === '') {
                el.removeAttribute('name');
            }
        });

        let categorySelect = $('select[name="category"]');

        if (categorySelect.val() === '') {
            categorySelect.removeAttr('name');
        }

        e.currentTarget.submit();
    });

    /*----------------------------------------*/
    /*      dynamic select option width
    /*----------------------------------------*/

    $('.select').each(function () {
        let self = $(this);

        self.on('change', function () {
            let selectOption = self.find('option:selected').text();
            let tempSelect = $('<span>').html(selectOption);

            tempSelect.appendTo('body');

            let selectOptionWidth = tempSelect.width();

            tempSelect.remove();

            self.width(selectOptionWidth);
        }).change();
    });

    /*----------------------------------------*/
    /*      button loader
    /*----------------------------------------*/

    $(document).on('click', '[data-loading]', (e) => {
        let button = $(e.currentTarget);

        if (button.is('i')) {
            button = button.parent();
        }

        if (button.hasClass('disabled')) {
            return e.preventDefault();
        }

        button.data('loading-text', button.html())
            .addClass('btn-loading')
            .button('loading');
    });

    /*----------------------------------------*/
    /*      mega menu
    /*----------------------------------------*/

    $('.navbar-default .dropdown-toggle').append('<i class="fa fa-angle-down"></i>');

    /*----------------------------------------*/
    /*      custom input
    /*----------------------------------------*/

    function customInputField() {
        let checkboxInput = $('.checkbox > input');
        let switchInput = $('.switch > input');

        function customInput(selector) {
            selector.on('click', (e) => {
                let target = $(e.currentTarget);
                target.toggleClass('checked');
            });
        }

        customInput(checkboxInput);
        customInput(switchInput);
    }

    customInputField();

    /*----------------------------------------*/
    /*      sidebar
    /*----------------------------------------*/

    $('.navbar-toggle').on('click', function () {
        $('.wrapper').toggleClass('offcanvas');
    });

    $(window).on('load resize', function () {
        if ($(window).width() >= 768) {
            $('.wrapper').removeClass('offcanvas');
        }
    });

    $('.sidebar-content li').each(function () {
        if ($(this).children('ul').length > 0) {
            $(this).addClass('parent');
        }
    });

    let dropdown = $('.sidebar-content li.parent > a');

    dropdown.after('<i class="fa fa-angle-down pull-right" aria-hidden="true"></i>');

    let sidebarContent = $('.sidebar-content > li');

    sidebarContent.on('click', function () {

        if (! $(this).hasClass('active')) {
            $('.sidebar-content > li').removeClass('active');
            $(this).addClass('active');
        } else {
            $('.sidebar-content > li').removeClass('active');
        }

        if (! $(this).children('ul').hasClass('open')) {
            $('.sidebar-content .open').removeClass('open').slideUp(300);
            $(this).children('ul').addClass('open').slideDown(300);
        } else {
            $('.sidebar-content .open').removeClass('open').slideUp(300);
        }

    });

    $('.sidebar-content > li > a').on('click', function (e) {
        e.stopPropagation();
    });

    $('.sidebar-content > li > ul').on('click', function (e) {
        e.stopPropagation();
    });

    let submenu = $('.submenu');

    submenu.on('click', function () {

        if (! $(this).hasClass('active')) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }

        $(this).children('ul').slideToggle(300);
    });

    $('.submenu ul').on('click', function (e) {
        e.stopPropagation();
    });

    /*----------------------------------------*/
    /*      dropdown open
    /*----------------------------------------*/

    $('body').on('click', '.dropdown-menu', function (e) {
        $(this).parent().is('.open') && e.stopPropagation();
    });

    /*----------------------------------------*/
    /*      slider animation
    /*----------------------------------------*/

    $('.home-slider').on('init', () => {
        let firstAnimatingElements = $('div.slide:first-child').find('[data-effect]');

        animateSlider(firstAnimatingElements);
    });

    $('.home-slider').on('beforeChange', function (e, slick, currentSlide, nextSlide) {
        let animatingElements = $(`div.slick-slide[data-slick-index=${nextSlide}]`).find('[data-effect]');

        animateSlider(animatingElements);
    });

    function animateSlider(elements) {
        let animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';

        elements.each(function () {
            let element = $(this);
            let animationDelay = element.data('delay');
            let animationEffect = `animated ${element.data('effect')}`;

            element.css({
                'animation-delay': animationDelay,
                '-webkit-animation-delay': animationDelay,
            });

            element.addClass(animationEffect).one(animationEndEvents, () => {
                element.removeClass(animationEffect);
            });
        });
    }

    /*----------------------------------------*/
    /*      home slider
    /*----------------------------------------*/

    let homeSlider = $('.home-slider');

    if (homeSlider.length !== 0) {
        homeSlider.slick({
            autoplay: !! JSON.parse(homeSlider.data('autoplay')),
            autoplaySpeed: parseInt(homeSlider.data('autoplay-speed')),
            arrows: !! JSON.parse(homeSlider.data('arrows')),
            fade: true,
            dots: false,
            pauseOnHover: true,
            pauseOnFocus: false,
            rtl: isRTL,
        });
    }

    /*----------------------------------------*/
    /*      resize slick on active tab
    /*----------------------------------------*/

    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.ebook-slider, .tab-ebook-slider').slick('setPosition');
    });

    /*----------------------------------------*/
    /*      ebook slider
    /*----------------------------------------*/

    let ebookSlider = $('.ebook-slider');
    let ebookSlider2 = $('.ebook-slider-2');

    ebookSlider.slick({
        autoplay: false,
        autoplaySpeed: 10000,
        dots: false,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        rtl: isRTL,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 681,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 501,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });

    ebookSlider2.slick({
        autoplay: false,
        autoplaySpeed: 10000,
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        rtl: isRTL,
        responsive: [
            {
                breakpoint: 681,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 501,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
    
    /*----------------------------------------*/
    /*      tab ebook slider
    /*----------------------------------------*/

    let tabeBookSlider = $('.tab-ebook-slider');

    tabeBookSlider.slick({
        autoplay: false,
        autoplaySpeed: 10000,
        dots: true,
        arrows: false,
        slidesToShow: 4,
        slidesToScroll: 4,
        rtl: isRTL,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                },
            },
            {
                breakpoint: 681,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 501,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
    

    /*----------------------------------------*/
    /*      scroll to top
    /*----------------------------------------*/

    $(window).on('load scroll', function () {
        if ($(this).scrollTop() > 200) {
            $('.scroll-top').addClass('active');
        } else {
            $('.scroll-top').removeClass('active');
        }
    });

    $('.scroll-top').on('click', function () {
        $('html, body').animate({
            scrollTop: 0,
        }, 1000, 'easeInOutQuint');

        return false;
    });

    /*----------------------------------------*/
    /*      tooltip
    /*----------------------------------------*/

    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover',
    });

    
    

    /*----------------------------------------*/
    /*      selectize
    /*----------------------------------------*/

    function selectize() {
        let selects = $('select.selectize').removeClass('custom-select-black');

        for (let select of selects) {
            $(select).selectize({
                delimiter: ',',
                persist: true,
                selectOnTab: true,
                hideSelected: false,
                allowEmptyOption: true,
                plugins: ['remove_button'],
            });
        }
    }

    selectize();
    
    /*----------------------------------------*/
    /*      Select2
    /*----------------------------------------*/

    function createSelect2() {
        
        let $select2 =$('.select2');
        $select2.select2();
    }

    //createSelect2();

    /*----------------------------------------*/
    /*      filter category
    /*----------------------------------------*/

    $('.filter-category li').each((i, li) => {
        if ($(li).children('ul').length > 0) {
            $(li).addClass('parent');
        }
    });

    let categoryDropdown = $('.filter-category li.parent > a');

    categoryDropdown.before('<i class="fa fa-angle-right pull-left" aria-hidden="true"></i>');

    let parentUls = $('.filter-category li.active').parentsUntil('.filter-category', 'ul');

    parentUls.slideDown().addClass('open');

    $('.filter-category ul.open').siblings('i').addClass('open');

    $('.filter-category li i').on('click', (e) => {
        $(e.currentTarget).toggleClass('open').siblings('ul').slideToggle(300);
    });

    /*----------------------------------------*/
    /*      filter options scroll
    /*----------------------------------------*/

    $('.filter-scroll').slimScroll({
        height: '215px',
    });
    
    $(document).ready(function() {
        $('.btn-right-actions').on('click',function(){
            var ele=$(this).attr('data-target');
            if( ele.length ) {
                $('body').append('<div class="right-actions-overlay"></div>');
                $(ele).addClass('open');
                $(".right-actions-overlay").show();
            }
        });
        $('.right-actions .action-toggle').on('click',function(){
            $('.right-actions').removeClass('open');
            $('.right-actions-overlay').hide();
            $('.right-actions-overlay').remove();
        });
        
    });
    
    
});
