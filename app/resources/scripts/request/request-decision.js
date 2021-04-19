$(document).ready(function() {
    if($('#executive-decision-form')) {
        $( "#executive-decision-form" ).submit(function( event ) {
            $('#decisionSubmit').attr('disabled', 'disabled');
            $('#decisionSubmit').fadeOut();
          });
    }
});