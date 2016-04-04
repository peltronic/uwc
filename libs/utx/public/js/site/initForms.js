$( document ).ready(function() {

    $('.open-popup-link').magnificPopup({
        type:'inline',
        midClick: true, // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
        alignTop: false,
        closeBtnInside: true,
        callbacks: {
            open: function(e) {
                console.log('opened');
                var el = $(this)[0]._lastFocusedEl;
                var videoID = $(el).data('videoid');
                var vid = document.getElementById(videoID);
                $(vid).trigger('play');
            },
            close: function(e) {
                console.log('closed');
                var el = $(this)[0]._lastFocusedEl;
                var videoID = $(el).data('videoid');
                var vid = document.getElementById(videoID);
                $(vid).trigger('pause');
            }
        }
    });

    $(document).on('submit', 'form#support-form', function(e) {
        e.preventDefault();
        var context = $(this);
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data: context.serialize(),
            success: function( response ) {
                if (!response.is_ok) {
                    SiteUtils.renderFormErrors(context,response);
                } else {
                    $('#support-form-wrap').html(response.html);
                }
            }
        });    
        return false;
    });

    $(document).on('click', 'a.tag-lets_talk_button', function(e) {
        e.preventDefault();
        $('.crate-lets_talk_button').fadeOut('slow', function() {
            $('.crate-consult_form').show('slow');
        });
        return false;
    });

    $(document).on('submit', 'form#consult-form', function(e) {
        e.preventDefault();
        var context = $(this);
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data: context.serialize(),
            success: function( response ) {
                if (!response.is_ok) {
                    SiteUtils.renderFormErrors(context,response);
                } else {
                    $('.crate-consult_form').html(response.html);
                }
            }
        });    
        return false;
    });

    $(document).on('submit', 'form#newsletter-form', function(e) {
        e.preventDefault();
        var context = $(this);
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data: context.serialize(),
            success: function( response ) {
                if (!response.is_ok) {
                    SiteUtils.renderFormErrors(context,response);
                } else {
                    $('.crate-newsletter_form').html(response.html);
                    // %FIXME: what happens here?
                    //$('#newsletter-form-wrap').html(response.html);
                }
            }
        });    
        return false;
    });


});
