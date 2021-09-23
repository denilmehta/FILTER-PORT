jQuery(document).ready(function() {
  jQuery( '.btn-wrap a' ).click(function(){
    jQuery( '.btn-wrap a' ).removeClass('active');
    jQuery( this ).addClass('active');
    var btn = jQuery(this).data('slug');
    console.log (btn);
    jQuery( '.blog-post-wrap' ).hide();
    jQuery( '.blog-post-wrap' ).each(function(){
      if(jQuery(this).data('slug') == btn )
      {
        jQuery(this).show();
      }
    });  
  });
  jQuery( '.btn-wrap a.all' ).click(function(){ 
    jQuery( '.blog-post-wrap' ).show().animate({});
  });
});