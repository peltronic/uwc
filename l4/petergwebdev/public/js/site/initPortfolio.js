$( document ).ready(function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( ".accordion" ).accordion({
      collapsible: true,
      active: 'none',
      heightStyle: "content",
      icons: icons
    });
    $( "#toggle" ).button().click(function() {
      if ( $( ".accordion" ).accordion( "option", "icons" ) ) {
        $( ".accordion" ).accordion( "option", "icons", null );
      } else {
        $( ".accordion" ).accordion( "option", "icons", icons );
      }
    });

    //$( ".accordion" ).accordion( "option", "active", 0 ); // open first tab
});
