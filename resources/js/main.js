$(document).ready(function(){

    console.log('[Ecomobilis loading - mix compile it... ]');

   /* NAVIGATION */
  $('.m-menu').click(function(){
    $('html, body').toggleClass('noscroll');
    $('body').toggleClass('m-menu-open');
  });


  /* MODAL */
  $('.js-open-modal').click(function(){
    id = $(this).attr('data-modal');
    $('#'+id).show();
  });

  $('.js-close-modal').click(function(){
    var id = $(this).closest('.modal').attr('id');
    $('#'+id).hide();
  });


  /* TABS */
  $('.js-tabs li a').click(function(){
    event.preventDefault();
    var tab = $(this).parent().attr('data-tab');
    // switch tab
    $('.tabular-style ul li').each(function(element){
      console.log($(this));
        if($(this).attr("data-tab") == tab){
          $(this).addClass('active');
        } else {
          $(this).removeClass('active');
        }
    });
    // show content
    $('.tabular-content').each(function(element){
       if($(this).attr("data-content") == tab){
          $(this).show();
        } else {
          $(this).hide();
        }
    });
  });



});
