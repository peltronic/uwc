var SiteUtils = {

    // Sticky footer
    // http://foundation.zurb.com/forum/posts/629-sticky-footer
    fixFooter: function(divID)
    {
        var footer = $('footer');
        if (footer.length == 0 ) {
            return;
        }
        var pos = footer.position();
        var height = $(window).height();
        height = height - pos.top;
        height = height - footer.height();
        if (height > 0) {
            footer.css({
                'margin-top': height + 'px'
            });
        }
        footer.css('visibility', 'visible'); // workaround to remove flicker
    },

    init: function() {
    }

} 

