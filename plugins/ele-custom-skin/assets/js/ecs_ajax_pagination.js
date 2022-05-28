jQuery( document ).ready(function() {
  jQuery( ".ecs-load-more-button" ).each(function() {
    widget=jQuery(this);
    settings = widget.attr("data-settings");
    args = JSON.parse(settings);
    widget.children( ".elementor-button" ).attr("href", "javascript:ECS_load_next_page('"+ args.widget_id +"');");
  });
});
var canBeLoaded = true; // this param allows to initiate the AJAX call only if necessary


function ECS_load_next_page(id){

  widget = jQuery(".elementor-element[data-id='" + id + "'] .ecs-posts");
  settings = widget.attr("data-settings");
  args = JSON.parse(settings);
  
  posts = jQuery(".elementor-element[data-id='" + args.widget_id + "'] .ecs-posts");
  
  if(args.load_method == 'loadmore'){
    button_text = jQuery(".elementor-element[data-id='" + args.widget_id + "'] .ecs-load-more-button .elementor-button");// add this .elementor-element[data-id='" + args.widget_id + "']
    button = jQuery(".elementor-element[data-id='" + args.widget_id + "'] .ecs-load-more-button");
    attb = JSON.parse(button.attr("data-settings"));
  }
  if(args.load_method == 'lazyload'){
    animation = jQuery(".elementor-element[data-id='" + args.widget_id + "'] .ecs-lazyload");
  }
  data = {
    'action': 'ecsload',
    'query': ecs_ajax_params.posts,
    'ecs_ajax_settings': settings,
  };

  jQuery.ajax({
    url : ecs_ajax_params.ajaxurl, // AJAX handler
    data : data,
    type : 'POST',
    beforeSend : function ( xhr ) {
      if(args.load_method == 'loadmore') button_text.html(attb.loading_text); // change the button text, you can also add a preloader image
      canBeLoaded = false;
    },
    success : function( data ){
      if( data ) { 
        posts.append(data); // insert new posts
        args.current_page++;
        if(args.load_method == 'loadmore'){
          button_text.html( attb.text );
          button_text.blur();
        }
        newsettings = JSON.stringify(args);
        widget.attr("data-settings",newsettings);
        
        
        if(args.load_method == 'lazyload') {jQuery(animation).addClass("animation-hidden");}
        //here you need to take care of linkable items and masonry !!!!!!!!!!!!!!!!!
        ECS_do_action('ajax',args);

        if ( args.current_page == args.max_num_pages ) {
          if(args.load_method == 'loadmore') button.remove(); // if last page, remove the button
          if(args.load_method == 'lazyload') animation.remove();
        }
        canBeLoaded = true;

        if (typeof ECScheckInView !== 'undefined') ECScheckInView();
        // you can also fire the "post-load" event here if you use a plugin that requires it
        // $( document.body ).trigger( 'post-load' );
      } else {
        if(args.load_method == 'loadmore') {button.remove();} // if no data, remove the button as well
        if(args.load_method == 'lazyload') {animation.remove();}
      }
    }
  });
  
}


jQuery(function($){
  $('.ecs-lazyload').addClass("animation-hidden");
  $('.ecs-lazyload a').css("display", "none"); 
});

function EleCustomSkinChangeUrlPage(args){
  if(!args.change_url) return;
  regex = /\/page\/[0-9]+\//gm;
  currenturl = window.location.pathname;
  newurl = currenturl.replace(regex, '/');
  newurl = newurl + 'page/' + args.current_page +'/';
  console.log(newurl);
  history.pushState({urlPath:newurl},"",newurl);
}

function EleCustomSkinReInitJs(args){
  if(!args.reinit_js) return;
  jQuery('.elementor-element-' + args.widget_id + ' .elementor-element').each(function() { elementorFrontend.elementsHandler.runReadyTrigger( jQuery( this ) ); });console.log(args.reinit_js);
}

jQuery( document ).ready(function() {

  ECS_add_action("ajax", function(args){EleCustomSkinChangeUrlPage(args)});
  ECS_add_action("ajax", function(args){EleCustomSkinReInitJs(args)});

});