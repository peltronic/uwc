var ClSiteUtils = {

    scrollToPosition: function(divID)
    {
         $('html, body').animate({scrollTop:$(divID).position().top - 0 }, 'slow');
    },

    setLandingPageNavigation: function()
    {
        var client_height = document.body.clientHeight;
        var scroll_top = document.body.scrollTop;
        var slideNum = Math.floor(scroll_top/client_height) + 1;
        var activeSlide = $('.container-pagination ul li.active').data('page');
        if (activeSlide != slideNum) {
            $('.container-pagination ul li').removeClass('active');
            $('.container-pagination ul li[data-page="'+slideNum+'"]').addClass('active');
        }
    },

    // see  http://stackoverflow.com/questions/1703228/how-to-clear-file-input-with-javascript
    clearFileInput: function(inputElem)
    {
        try{
            inputElem.value = '';
            if(inputElem.value){
                inputElem.type = "text";
                inputElem.type = "file";
            }
        }catch(e){}
    },

    // assumes response of form:
    //   reponse.is_ok
    //   reponse.messsages
    //   reponse.partial_html
    submitGenericFormAjax: function(url,type,sdata,renderCallback)
    {
        var context = $(this);
        $.ajax({
            url     : url, // $(this).attr('action'),
            type    : type, // $(this).attr('method'),
            dataType: 'json',
            data    : sdata, // $(this).serialize(),
            success : function( response ) {
                console.log('OK Submitted');
                if (!response.is_ok) {
                    // error reporting
                    // %TODO: add hook for 'generic-form-errbox', OR pass a callback
                    var html = 'ERROR: ';
                    for (m in response.messages) {
                         if (response.messages.hasOwnProperty(m)) {
                            html += ' '+response.messages[m];
                         }
                    }
                } else {
                    if (renderCallback!=='undefined') {
                        renderCallback(response.renderCallbackArg1);
                    }
                }
            },
            error   : function( xhr, err ) {
                console.log('ERROR');
            }
        });    
    },


    //http://jsfiddle.net/cgSj3/
    texteditor: function(textarea,initRows,limitRows) 
    {
        // %FIXME: rewrite: this doesn't work for pasting because it's all one line
        textarea.setAttribute("rows", initRows);
        return {
            resize: function() {
                var rows = parseInt(this.elem.getAttribute("rows"));
                if (rows < this.limitRows && this.elem.scrollHeight > (this.lastScrollHeight+1)) {
                    rows++;
                } else if (rows > 1 && this.elem.scrollHeight < this.lastScrollHeight) {
                    //rows--; // only expand
                }
        
                this.lastScrollHeight = this.elem.scrollHeight;
                this.elem.setAttribute("rows", rows);
                return rows;
            },
            initRows: initRows,
            limitRows: limitRows,
            lastScrollHeight: textarea.scrollHeight,
            elem: textarea
        }
    },

    formatAjaxErrors: function(messages) {
        var html = 'ERROR: ';
        for (m in messages) {
             if (messages.hasOwnProperty(m)) {
                html += ' '+messages[m];
             }
        }
        return html;
    },

    // for mixpanel, see: 
    // https://mixpanel.com/help/reference/javascript#sending-events
    clRedirect: function(url) {
        return function() {
            window.location = url;
            //window.location.replace(url);
        }
    },
    clReload: function() {
        return function() {
            window.location.reload();
        }
    },

    mixpanelIgnore: function(email)
    {
        var ignore = 0;

        var serverName = window.location.hostname;

        switch (serverName) {
            case 'www.dev-clssfy.com':
            case 'staging.clssfy.com':
                ignore = 1;
                break;
        }

        switch (email) {
            case 'peter@peltronic.com':
            case 'peter@ucla.edu':
            case 'kevin1@ucsd.edu':
            case 'kky005@ucsd.edu':
            case 'thunderkate@ucsd.edu':
            case 'admin@ucsd.edu':
                ignore = 1;
                break;
        }
        return ignore;
    },

    init: function() {
    }

} 

