$( document ).ready(function() {


    $(document).on('click', '.tag-landing_page a.tag-clickme_to_show_register_form', function(e) {
        e.preventDefault();
        $('.tag-landing_page .tag-formwrap-login').hide();
        $('.tag-landing_page .tag-formwrap-register').fadeIn();
        return false;
    });

    $(document).on('click', '.tag-landing_page a.tag-clickme_to_show_login_form', function(e) {
        e.preventDefault();
        $('.tag-landing_page .tag-formwrap-register').hide();
        $('.tag-landing_page .tag-formwrap-login').fadeIn();
        return false;
    });

    $(window).scroll(function () {
        ClSiteUtils.setLandingPageNavigation();
    });

    $(window).load(function () {
        ClSiteUtils.setLandingPageNavigation();
    });

    $(document).on('click', 'a.tag-clickme_to_slide', function(e) {
        var divID = '#slide-'+$(this).data('topage');
        ClSiteUtils.scrollToPosition(divID);
    });

});
