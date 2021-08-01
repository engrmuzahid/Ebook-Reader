$(function () {
    
    if($('.sidebar').is('[data-background-color]')) { 
		$('html').addClass('sidebar-color');
	} else {
		$('html').removeClass('sidebar-color');
	}

	if($('body').is('[data-image]')) {
		$('body').css('background-image', 'url("' + $('body').attr('data-image') + '")');
	} else {
		$('body').css('background-image', '');
	}
    
    var scrollbarDashboard = $('.sidebar .scrollbar');
	if (scrollbarDashboard.length > 0) {
		scrollbarDashboard.scrollbar();
	}
    
    var contentScrollbar = $('.main-panel .content-scroll');
	if (contentScrollbar.length > 0) {
		contentScrollbar.scrollbar();
	}
    
    var userScrollbar = $('.dropdown-user-scroll');
	if (userScrollbar.length > 0) {
		userScrollbar.scrollbar();
	}
    
    var toggle_sidebar = false,
	toggle_quick_sidebar = false,
	toggle_topbar = false,
	minimize_sidebar = false,
	toggle_page_sidebar = false,
	toggle_overlay_sidebar = false,
	nav_open = 0,
	quick_sidebar_open = 0,
	topbar_open = 0,
	mini_sidebar = 0,
	page_sidebar_open = 0,
	overlay_sidebar_open = 0;


	if(!toggle_sidebar) {
		var toggle = $('.sidenav-toggler');

		toggle.on('click', function(){
			if (nav_open == 1){
				$('html').removeClass('nav_open');
				toggle.removeClass('toggled');
				nav_open = 0;
			}  else {
				$('html').addClass('nav_open');
				toggle.addClass('toggled');
				nav_open = 1;
			}
		});
		toggle_sidebar = true;
	}

	if(!quick_sidebar_open) {
		var toggle = $('.quick-sidebar-toggler');

		toggle.on('click', function(){
			if (nav_open == 1){
				$('html').removeClass('quick_sidebar_open');
				$('.quick-sidebar-overlay').remove();
				toggle.removeClass('toggled');
				quick_sidebar_open = 0;
			}  else {
				$('html').addClass('quick_sidebar_open');
				toggle.addClass('toggled');
				$('<div class="quick-sidebar-overlay"></div>').insertAfter('.quick-sidebar');
				quick_sidebar_open = 1;
			}
		});

		$('.wrapper').mouseup(function(e)
		{
			var subject = $('.quick-sidebar'); 

			if(e.target.className != subject.attr('class') && !subject.has(e.target).length)
			{
				$('html').removeClass('quick_sidebar_open');
				$('.quick-sidebar-toggler').removeClass('toggled');
				$('.quick-sidebar-overlay').remove();
				quick_sidebar_open = 0;
			}
		});

		$(".close-quick-sidebar").on('click', function(){
			$('html').removeClass('quick_sidebar_open');
			$('.quick-sidebar-toggler').removeClass('toggled');
			$('.quick-sidebar-overlay').remove();
			quick_sidebar_open = 0;
		});

		quick_sidebar_open = true;
	}

	if(!toggle_topbar) {
		var topbar = $('.topbar-toggler');

		topbar.on('click', function() {
			if (topbar_open == 1) {
				$('html').removeClass('topbar_open');
				topbar.removeClass('toggled');
				topbar_open = 0;
			} else {
				$('html').addClass('topbar_open');
				topbar.addClass('toggled');
				topbar_open = 1;
			}
		});
		toggle_topbar = true;
	}

	if(!minimize_sidebar){
		var minibutton = $('.toggle-sidebar');
		if($('.wrapper').hasClass('sidebar_minimize')){
			mini_sidebar = 1;
			minibutton.addClass('toggled');
			minibutton.html('<i class="icon-options-vertical"></i>');
		}

		minibutton.on('click', function() {
			if (mini_sidebar == 1) {
				$('.wrapper').removeClass('sidebar_minimize');
				minibutton.removeClass('toggled');
				minibutton.html('<i class="icon-menu"></i>');
				mini_sidebar = 0;
			} else {
				$('.wrapper').addClass('sidebar_minimize');
				minibutton.addClass('toggled');
				minibutton.html('<i class="icon-options-vertical"></i>');
				mini_sidebar = 1;
			}
			$(window).resize();
		});
		minimize_sidebar = true;
	}

	if(!toggle_page_sidebar) {
		var pageSidebarToggler = $('.page-sidebar-toggler');

		pageSidebarToggler.on('click', function() {
			if (page_sidebar_open == 1) {
				$('html').removeClass('pagesidebar_open');
				pageSidebarToggler.removeClass('toggled');
				page_sidebar_open = 0;
			} else {
				$('html').addClass('pagesidebar_open');
				pageSidebarToggler.addClass('toggled');
				page_sidebar_open = 1;
			}
		});

		var pageSidebarClose = $('.page-sidebar .back');

		pageSidebarClose.on('click', function() {
			$('html').removeClass('pagesidebar_open');
			pageSidebarToggler.removeClass('toggled');
			page_sidebar_open = 0;
		});
		
		toggle_page_sidebar = true;
	}

	if(!toggle_overlay_sidebar){
		var overlaybutton = $('.sidenav-overlay-toggler');
		if($('.wrapper').hasClass('is-show')){
			overlay_sidebar_open = 1;
			overlaybutton.addClass('toggled');
			overlaybutton.html('<i class="icon-options-vertical"></i>');
		}

		overlaybutton.on('click', function() {
			if (overlay_sidebar_open == 1) {
				$('.wrapper').removeClass('is-show');
				overlaybutton.removeClass('toggled');
				overlaybutton.html('<i class="icon-menu"></i>');
				overlay_sidebar_open = 0;
			} else {
				$('.wrapper').addClass('is-show');
				overlaybutton.addClass('toggled');
				overlaybutton.html('<i class="icon-options-vertical"></i>');
				overlay_sidebar_open = 1;
			}
			$(window).resize();
		});
		minimize_sidebar = true;
	}

	$('.sidebar').hover(function() {
		if ($('.wrapper').hasClass('sidebar_minimize')){
			$('.wrapper').addClass('sidebar_minimize_hover');
		}
	}, function(){
		if ($('.wrapper').hasClass('sidebar_minimize')){
			$('.wrapper').removeClass('sidebar_minimize_hover');
		}
	});
    
    $(".nav-item a").on('click', (function(){
		if ( $(this).parent().find('.collapse').hasClass("show") ) {
			$(this).parent().removeClass('submenu');
		} else {
			$(this).parent().addClass('submenu');
		}
	}));
    
    //select all
	$('[data-select="checkbox"]').change(function(){
		var target = $(this).attr('data-target');
		$(target).prop('checked', $(this).prop("checked"));
	})
    
    $(".form-group-default .form-control").focus(function(){
		$(this).parent().addClass("active");
	}).blur(function(){
		$(this).parent().removeClass("active");
	})
    
    // Input File Image
    
    $('.input-file-image input[type="file"').change(function () {
        var input=this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(input).parent('.input-file-image').find('.img-upload-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
        
    });
    
    // Show Password

    $('.show-password').on('click', function(){
        button=this;
        var inputPassword = $(button).parent().find('input');
        if (inputPassword.attr('type') === "password") {
            inputPassword.attr('type', 'text');
        } else {
            inputPassword.attr('type','password');
        }
    })
    
    $('.form-floating-label .form-control').keyup(function(){
        if($(this).val() !== '') {
            $(this).addClass('filled');
        } else {
            $(this).removeClass('filled');
        }
    })
    
});