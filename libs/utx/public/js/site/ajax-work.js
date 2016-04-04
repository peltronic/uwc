// observe : bind or on

$( document ).ready(function() {

    //Slide request 
    if (SiteUtils.checkIt('lets-talk-button')) {
        $(document).on('click','#lets-talk-button', function(e) {
            e.preventDefault();
            moreThanH = "1000px";
            form = document.getElementById("consult-form");
            maxH = form.style.maxHeight;
            if(maxH == 0 || maxH == '0px') {
                form.style.maxHeight = moreThanH;
            } else {
                form.style.maxHeight = 0;
            }
            return false;
        });
    }

    //Support form
    if (SiteUtils.checkIt('support-form')) {
        $(document).on('submit','#support-form', function(e) {
            e.preventDefault();
            var context = $(this);
            if (SiteUtils.checkemail()) {
                //formAjax( 'support-form' );
                SiteUtils.formAjax(context, function() {
                    $('#error-form-wrap').html(response.html);  
                });
                
            }
            return false;
        });
    } else if(SiteUtils.checkIt('consult-form')) {
        //Services forms
        $(document).on('submit','#consult-form', function(e) {
            e.preventDefault();
            var context = $(this);
            if (SiteUtils.checkemail()) {
                //formAjax( 'consult-form' );
                SiteUtils.formAjax(context, function() {
                    $('#error-form-wrap').html(response.html);  
                });
            }
            return false;
        });
    }

    if ( SiteUtils.checkIt('newsletter-form') ) {
        //Services forms
        $(document).on('submit','#newsletter-form', function(e) {
            e.preventDefault();
            var context = $(this);
            if ( SiteUtils.checkemailNews() ) {
                //formAjaxNews( 'newsletter-form' );
                SiteUtils.formAjax(context, function() {
                    $('#news-form-wrap').html(response.html);
                });
            }
            return false;
        });
    }
});
