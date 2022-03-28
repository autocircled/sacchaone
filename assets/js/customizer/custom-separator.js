(function ($) {

    $( 'body' ).on( 'click', '.sacchaone-toggle-control', function(){
        // console.log($(this).attr('target_ids'));
        let $this = $(this);
        var raw_ids = $(this).attr('target_ids').split(" ");
        if( $($this).hasClass('showing') ){
            $($this).removeClass('showing');
            $(raw_ids).each(function(i,v){
                $( "#customize-control-" + v ).hide();
            });
        }else{
            $($this).addClass('showing');
            $(raw_ids).each(function(i,v){
                $( "#customize-control-" + v ).show();
            });
        }
    });
})(jQuery);