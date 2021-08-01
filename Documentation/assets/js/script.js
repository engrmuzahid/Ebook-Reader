
$(document).ready(function () {
    var li_a = $('#ci_nav li a');
    var nav = $('#ci_nav');
    var doc_li = $('#ci_content section');
    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();
        var current = $(this);
        var parent = current.parent().parent();
        var next = current.next();
        var hasSub = next.is('ul');
        var isSub = !parent.is('#ci_nav');
        doc_li.each(function () {
            var top = $(this).offset().top,
                    bottom = top + $(this).outerHeight();
            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('ul').each(function () {
                    if ($(this).is(":visible"))
                    {
                        // $(this).stop().slideUp();
                    }
                });
                nav.find('a[href="#' + $(this).attr('id') + '"]').next().slideDown('fast');
            }
        });
    });
    $('a.scroll-a[href^="#"]').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = $(target);
        var current = $(this);
        var parent = current.parent().parent();
        var next = current.next();
        var hasSub = next.is('ul');
        var isSub = !parent.is('#ci_nav');
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
        if (isSub) {
            parent.stop().slideDown('fast');
        } else if (hasSub) {
            next.stop().slideDown('fast');
        }
    });
});
