var SiteUtils = {

    renderFormErrors: function(context,response) {
        $.each( response.messages, function(key, value) {
            var classStr = 'tag-'+key+'_verr';
            context.find('.'+classStr).html(value);
            console.log(key+': '+value);
        });
    },

    formAjax: function( context, cbfunc ) 
    {
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            data: context.serialize(),
            dataType: 'json',
            success: function( response ) {
                if (cbfunc!=='undefined') {
                    cbfunc();
                }
            }
        });

    }, // formAjax()

    checkemail: function() {
        var contact_email = document.getElementById('id_contact_email');
        var str=contact_email.value;
        var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (filter.test(str)) {;
            testresults=true;
        } else{
            alert("Please input a valid email address!"); // %FIXME
            testresults=false;
        }
        return (testresults)
    },

    checkemailNews: function() {
        var contact_email = document.getElementById('email-input');
        var str=contact_email.value;
        var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        if (filter.test(str)) {
            testresults=true;
        }
        else{
            alert("Please input a valid email address!");
            testresults=false;
        }
        return (testresults)
    },

    checkIt: function(idExist) {
        if( document.getElementById(idExist) ) {
            return true;
        } else {
            return false;
        }
    },

        /*
    slideUp: function(el) {
        el.slideUp();
        element = document.querySelector(el);
        element.className = "animate row";
        element.style.display="none";
        SiteUtils.resetClass(element);
        SiteUtils.addClass(element,"slideup");
    },
            
    slideDown: function(el) {
        element = document.querySelector(el);
        element.style.display="block";
        element.className = "animate row";
        SiteUtils.resetClass(element);
        SiteUtils.addClass(element,"slidedown");
    },
        */

    /*
    resetClass: function(el) {
        var class_to_remove = ['slideup','slidedown','facein','fadeout'];
        var each_class = el.className.split(" ");
        newclass = [];
        for (i=0 ; i < each_class.length ; i++) {
            if(class_to_remove.indexOf(each_class[i]) >= 0){
                continue;
            }
            newclass.push(each_class[i]);
        }
        el.className = newclass.join(" ");
    },
             
    addClass: function(el,cl){
        el.className = el.className + " " + cl;
    },
    */

    init: function() {
    }

}


/*
function formAjax( whichFormId ) {

    postValues = $(whichFormId).serialize(true);
    console.log('post values are '+JSON.stringify(postValues));
    $(whichFormId).request({ // %%% ajax post
        parameters: $(whichFormId).serialize(true),
        onComplete: function(t){ 
            $('error-form-wrap').html(t.responseText);  
        }
    })
}

function formAjaxNews( whichFormId ) {

    postValues = $(whichFormId).serialize(true);
    console.log('post values are '+JSON.stringify(postValues));
    $(whichFormId).request({
        parameters: $(whichFormId).serialize(true),
        onComplete: function(t){ 
            $('news-form-wrap').html(t.responseText);   
        }
    })
}
*/
            /*
            function showMenu() {
            var bar_nation  = document.getElementById('bar-nation');
                if (bar_nation.classList.contains('hide')) {
                bar_nation.classList.remove('hide');
                
                }
                 bar_nation.classList.toggle("show");
            }
            function reverseReverse() {
            var bar_nation  = document.getElementById('bar-nation');
                if (bar_nation.classList.contains('show')) {
                bar_nation.classList.remove('show');
                
                }
                bar_nation.classList.toggle("hide");
            }
            */
