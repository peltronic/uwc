$( document ).ready(function() {

    $(document).on('submit', 'form.form-register', function(e) {
        e.preventDefault();
        var context = $(this);
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
        $('ul.err-meta').remove();
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data: context.serialize(),
            success: function( response ) {
                if (!response.is_ok) {
                    $.each( response.messages, function(key, value) {
                        var classStr = 'tag-'+key+'_verr';
                        context.find('.'+classStr).html(value);
                        console.log(key+': '+value);
                    });
                    var metaList = $('<ul></ul>').addClass('err-meta');
                    $.each( response.meta_errors, function(key, value) {
                        var li = $('<li/>').text(value).appendTo(metaList);
                    });
                    context.append(metaList);
                } else {
                    if ( ClSiteUtils.mixpanelIgnore(response.obj.email) ) {
                        window.location = response.redirect_url;
                    } else {
                        var cb = ClSiteUtils.clRedirect(response.redirect_url); // do it cheap for now
                        if (response.is_business) {
                            mixpanel.track('Registered New Business Account',{});
                        } else {
                            mixpanel.track('Registered New Account',{});
                        }
                        mixpanel.register({"username":response.obj.username});
                        mixpanel.alias(response.obj.username);
                        setTimeout(cb, 500);
                    }
                }
            }
        });    
        return false;
    }); // submit .form-register

    $(document).on('submit', 'form.form-login', function(e) {
        e.preventDefault();
        var context = $(this);
        context.find('.tag-verr').html(''); // clear any validation err messages on submit
        $('ul.err-meta').remove();
        $.ajax({
            url     : context.attr('action'),
            type    : $(this).attr('method'),
            dataType: 'json',
            data: context.serialize(),
            success: function( response ) {
                if (!response.is_ok) {
                    $.each( response.messages, function(key, value) {
                        var classStr = 'tag-'+key+'_verr';
                        context.find('.'+classStr).html(value);
                        console.log(key+': '+value);
                    });
                    var metaList = $('<ul></ul>').addClass('err-meta');
                    $.each( response.meta_errors, function(key, value) {
                        var li = $('<li/>').text(value).appendTo(metaList);
                    });
                    context.append(metaList);
                } else {
                    if ( ClSiteUtils.mixpanelIgnore(response.obj.email) ) {
                        window.location = response.redirect_url;
                    } else {
                        var cb = ClSiteUtils.clRedirect(response.redirect_url); // do it cheap for now
                        mixpanel.track('Logged In');
                        mixpanel.identify(response.obj.username);
                        mixpanel.people.set({
                            "$created": response.obj.created_at,
                            "$email": response.obj.email,
                            "username": response.obj.username
                        });
                        setTimeout(cb, 500);
                    }
                }
            }
        });    
        return false;
    });

});
