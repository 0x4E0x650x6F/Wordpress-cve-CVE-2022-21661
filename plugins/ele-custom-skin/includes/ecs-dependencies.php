<?php 
//check if Elementor is installed

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function ecs_dependencies(){
  $ecs_elementor = true;
  
  if ( !ecs_is_plugin_active('elementor.php') ) $ecs_elementor=false;
  if ( !ecs_is_plugin_active('elementor-pro.php') ) $ecs_elementor=false;
  
  return $ecs_elementor;
}  

function ecs_clean_plugins($ecs_plugins){
  $results=[];
  foreach($ecs_plugins as $ecs_plugin){
    $folder="";
    $file="";
    list($folder,$file)=array_pad(explode('/',$ecs_plugin),2,"");
    if(!$file)  list($folder,$file)=array_pad(explode('\\',$ecs_plugin),2,""); // for windows
    $results[]=$file;
  }
  return $results;
}

function ecs_get_all_active_plugins(){

  if(function_exists('get_blog_option')){
    $ecs_multi_site = get_blog_option(get_current_blog_id(), 'active_plugins');
    $ecs_multi_site = isset($ecs_multi_site) ? $ecs_multi_site : [];
    $ecs_multi_sitewide=get_site_option( 'active_sitewide_plugins') ;
    if (is_array($ecs_multi_sitewide)) foreach($ecs_multi_sitewide as $ecs_key => $ecs_value){
      $ecs_multi_site[] = $ecs_key;  
    }
    $ecs_plugins = $ecs_multi_site;
  }
  else{
    $ecs_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
  }
  
  return  ecs_clean_plugins($ecs_plugins);
}

function ecs_is_plugin_active($plugin){
  $ecs_plugins = ecs_get_all_active_plugins();
  if ( in_array( $plugin ,$ecs_plugins) ) return true;
  return false;
}