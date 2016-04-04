$( document ).ready(function() {

    if ( $('form.form-reward input:checkbox[name=is_restricted]').is(':checked') ) {
        $('form.form-reward .formelem-period_type').fadeIn();
        if ( $('form.form-reward input:radio[name=period_type]:checked').val() === 'set_period' ) {
            $('form.form-reward .formelem-period_length').fadeIn();
        } else {
            $('form.form-reward .formelem-period_length').hide();
        }
    } else {
        $('form.form-reward .formelem-period_type').hide();
        $('form.form-reward .formelem-period_length').hide();
    }

    $('form.form-reward input:checkbox[name=is_restricted]').change(function() {
        var context = $(this);
        if (context.is(':checked')) {
            $('form.form-reward .formelem-period_type').fadeIn();
        } else {
            $('form.form-reward .formelem-period_length').fadeOut();
            $('form.form-reward .formelem-period_type').fadeOut();
        }
    });

    $(document).on('change', 'form.form-reward input:radio[name=period_type]', function(e) {
        var context = $(this);
        var checked = $('form.form-reward input:radio[name=period_type]:checked');
        var periodType = checked.val();
        if (periodType === 'set_period') {
            $('form.form-reward .formelem-period_length').fadeIn();
        } else {
            $('form.form-reward .formelem-period_length').fadeOut();
        }
    });

    if ( document.getElementById("input-startdate") ) {
        $('#input-startdate').fdatepicker({
            format: 'yyyy-mm-dd',
            disableDblClickSelection: true
        });
    }

    if ( document.getElementById("input-enddate") ) {
        $('#input-enddate').fdatepicker({
            format: 'yyyy-mm-dd',
            disableDblClickSelection: true
        });
    }


}); 
