function ECS_update_admin_bar_menu(items){
  
  for (i = 0; i < items.length; i++) {
    if ( !jQuery( "#"+items[i].id ).length ) {
 
        itemtemplate='<li id="'+items[i].id+'"><a class="ab-item" href="'+items[i].href+'">'+items[i].title+'</a></li>';
        jQuery( "#"+items[i].parent).append( itemtemplate );
       
    }
  }
}