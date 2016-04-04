$( document ).ready(function() {

    $(document).on('mouseenter','nav ul.top-menu li.menu-item', function(e) {
        e.preventDefault();
        var context = $(this);

        // if menu is already open and we enter again, do nothing
        var menuname = context.data('menuname');
        if ( $('#submenu-'+menuname).is(':visible') ) {
            return false;
        }

        if ( $('.crate-submenu:visible').length > 0 ) {
            $('.crate-submenu:visible').slideUp('fast', function() {
                $('#submenu-'+menuname).slideDown();
            });
        } else {
            $('#submenu-'+menuname).slideDown();
        }
        return false;
    });

    $(document).on('click','#mobile-nav-icon.tag-open_from_right', function(e) {
        e.preventDefault();
        var menu = $(this).data('menu'); // nav menu element to display
        var position = $(menu).css('position');
        if ($(menu).css('right') == '0px') {
            $(menu).animate({ right: '-220px' }, 250);
        } else {
            $(menu).animate({ right: '0px' }, 250);
        }
        return false;
    });

    $(document).on('click','.mobile-menu a.tag-clickme_to_close', function(e) {
        var menu = $('#mobile-nav-menu');
        e.preventDefault();
        $(menu).animate({ right: '-220px' }, 250);
        return false;
    });

    $(document).on('click','#mobile-nav-icon.tag-open_fullwidth', function(e) {
        e.preventDefault();
        var menu = $(this).data('menu'); // nav menu element to display
        $(menu).fadeIn();
        return false;
    });

    $(document).on('click','.box-nav_mobileicon a.tag-clickme_to_open', function(e) {
        e.preventDefault();
        var context = $(this);
        var menu = context.data('menu'); // nav menu element to display
        $(menu).fadeIn();
        context.removeClass('tag-clickme_to_open');
        context.addClass('tag-clickme_to_close');
        return false;
    });
    $(document).on('click','.box-nav_mobileicon a.tag-clickme_to_close', function(e) {
        e.preventDefault();
        var context = $(this);
        var menu = context.data('menu'); // nav menu element to display
        $(menu).fadeOut();
        context.removeClass('tag-clickme_to_close');
        context.addClass('tag-clickme_to_open');
        return false;
    });

});
