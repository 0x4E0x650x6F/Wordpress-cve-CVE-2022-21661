<?php
namespace ElementorPro\Modules\Posts\Skins;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
//use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use ElementorPro\Plugin;
use ElementorPro\Modules\ThemeBuilder\Module as ThemeBuilderModule;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Posts_ECS extends Skin_Base {

//	private $template_cache=[];
  private $used_templates=[];
	private $pid;
  public $settings;
  public $conditions;
  public $grid=[];
  public $grid_settings=[
            'length' => 0,
            'current' => 0,
            'allow' => false,
          ];


	
	public function get_id() {
		return 'custom';
	}

	public function get_title() {
		return __( 'Custom', 'ele-custom-skin' );
	}

  private function admin_bar_menu(){
    foreach($this->used_templates as $post_id){
      \ECS_Admin_Bar_Menu::add_document($post_id);
    }
  }

	protected function _register_controls_actions() {
    parent::_register_controls_actions();
    add_action( 'elementor/element/posts/'.$this->get_id().'_section_design_layout/after_section_end', [ $this, 'register_navigation_design_controls' ] );
    add_action( 'elementor/element/posts/section_pagination/after_section_end', [ $this, 'register_navigation_controls' ] );
	}	
	public function register_navigation_controls() {
    do_action( 'ECS_after_pagination_controls', $this );
  }
  public function register_navigation_design_controls() {
    do_action( 'ECS_after_style_controls', $this );
  }
 
	public function register_controls( Widget_Base $widget ) {

		$this->parent = $widget;

    $this->add_control(
			'skin_template',
			[
				'label' => __( 'Select a default template', 'ele-custom-skin' ),
        'description' => '<div style="text-align:center;"><a target="_blank" style="text-align: center;font-style: normal;" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=theme&elementor_library_type=loop' ) ) .
                          '" class="elementor-button elementor-button-default elementor-repeater-add">' . 
                          __( 'Create/edit a Loop Template', 'ele-custom-skin' ) . '</a></div>',
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [],
				'options' => $this->get_skin_template(),
			]
		);
    
		
		$this->add_control(//this would make use of 100% if width
			'view',
			[
				'label' => __( 'View', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::HIDDEN,
				'default' => 'top',
				'prefix_class' => 'elementor-posts--thumbnail-',
			]
		);
    
    $this->add_control(
			'use_custom_grid',
			[
				'label' => __( 'Use custom grid?', 'ele-custom-skin' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'ele-custom-skin' ),
				'label_on' => __( 'Yes', 'ele-custom-skin' ),
        'return_value' => 'yes',
        'separator' => 'before',
				'default' =>'',

			]
		);
  
    $this->add_control(
			'custom_grid',
			[
				'label' => __( 'Select a default template', 'ele-custom-skin' ),
        'description' => '<div style="text-align:center;"><a target="_blank" style="text-align: center;font-style: normal;" href="' . esc_url( admin_url( '/edit.php?post_type=elementor_library&tabs_group=theme&elementor_library_type=custom_grid' ) ) .
                          '" class="elementor-button elementor-button-default elementor-repeater-add">' . 
                          __( 'Create/edit a Custom Grid', 'ele-custom-skin' ) . '</a></div>',
				'type' => Controls_Manager::SELECT2,
				'label_block' => true,
				'default' => [],
				'options' => $this->get_custom_grid(),
        'condition' => [
					$this->get_id().'_use_custom_grid' => 'yes'
				],
			]
		);
    
    do_action( 'ECS_after_control', $this );
   
  $this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
    
    parent::register_controls($widget);

		$this->remove_control( 'img_border_radius' );
		$this->remove_control( 'meta_data' );
		$this->remove_control( 'item_ratio' );
		$this->remove_control( 'image_width' );
		$this->remove_control( 'show_title' );
		$this->remove_control( 'title_tag' );
		$this->remove_control( 'masonry' );
		$this->remove_control( 'thumbnail' );
		$this->remove_control( 'thumbnail_size' );
		$this->remove_control( 'show_read_more' );
		$this->remove_control( 'read_more_text' );
		$this->remove_control( 'show_excerpt' );
		$this->remove_control( 'excerpt_length' );
    $this->remove_control( 'open_new_tab' );
      
	}
	private function get_post_id(){
		return $this->pid;
	}
	public function get_skin_template(){
				global $wpdb;
				$templates = $wpdb->get_results( 
					"SELECT $wpdb->term_relationships.object_id as ID, $wpdb->posts.post_title as post_title FROM $wpdb->term_relationships
						INNER JOIN $wpdb->term_taxonomy ON
							$wpdb->term_relationships.term_taxonomy_id=$wpdb->term_taxonomy.term_taxonomy_id
						INNER JOIN $wpdb->terms ON 
							$wpdb->term_taxonomy.term_id=$wpdb->terms.term_id AND $wpdb->terms.slug='loop'
						INNER JOIN $wpdb->posts ON
							$wpdb->term_relationships.object_id=$wpdb->posts.ID
          WHERE  $wpdb->posts.post_status='publish'"
				);
				$options = [ 0 => 'Select a template' ];
				foreach ( $templates as $template ) {
					$options[ $template->ID ] = $template->post_title;
				}
				return $options;
	}
  
  
  	public function get_custom_grid(){
				global $wpdb;
				$templates = $wpdb->get_results( 
					"SELECT $wpdb->term_relationships.object_id as ID, $wpdb->posts.post_title as post_title FROM $wpdb->term_relationships
						INNER JOIN $wpdb->term_taxonomy ON
							$wpdb->term_relationships.term_taxonomy_id=$wpdb->term_taxonomy.term_taxonomy_id
						INNER JOIN $wpdb->terms ON 
							$wpdb->term_taxonomy.term_id=$wpdb->terms.term_id AND $wpdb->terms.slug='custom_grid'
						INNER JOIN $wpdb->posts ON
							$wpdb->term_relationships.object_id=$wpdb->posts.ID
          WHERE  $wpdb->posts.post_status='publish'"
				);
				$options = [ 0 => 'Select a template' ];
				foreach ( $templates as $template ) {
					$options[ $template->ID ] = $template->post_title;
				}
				return $options;
	}


	public function render_amp() {

	}

	/*protected function set_template($skin){// this is for terms we don't need passid so we can actually add them in cache
		
		if (!$skin) return;
		if (isset($this->template_cache[$skin])) return $this->template_cache[$skin];

		$return = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $skin );
		$this->template_cache[$skin] = $return;

	}*/
  
  protected function set_used_template($skin){// this is for terms we don't need passid so we can actually add them in cache
		
		if (!$skin) return;
		$this->used_templates[$skin]=$skin;

	}
  
  protected function set_custom_grid($grid){// this is for terms we don't need passid so we can actually add them in cache
		
		if (!$grid) return;
    
		$custom_grid = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $grid );
    
    $this->set_used_template($grid);
    
    $this->grid = explode('{{ecs-article}}',$custom_grid);
    $this->grid_settings['length'] = count($this->grid);

	}
  public function get_grid(){
    $grid="<!-- start part [".$this->grid_settings['current']."] -->";
    if($this->grid_settings['current'] >= $this->grid_settings['length']-1){
      $grid.=$this->grid[$this->grid_settings['current']];
      $this->grid_settings['current']=0;
    } 
     //  print_r($this->grid_settings);
    $grid.=$this->grid[$this->grid_settings['current']];
    $grid.="<!-- end part [".$this->grid_settings['current']."] -->";
    $this->grid_settings['current']++;
    return $grid;
  }
  public function end_grid(){

    if($this->grid_settings['current']) for($i = $this->grid_settings['current']; $i < $this->grid_settings['length'];$i++){
      echo "<!-- start part [".$i."] finishing -->";
      echo $this->grid[$i];
      echo "<!-- end part [".$i."] finishing -->";
    }
    $this->grid_settings['current'] = 0;

  }

	protected function get_template(){
    global $ecs_render_loop, $wp_query,$ecs_index;
    $ecs_index++;
    $old_query=$wp_query;
    //\Elementor\Plugin::$instance->documents->switch_to_document( get_the_ID() );
    //\Elementor\Plugin::$instance->db->switch_to_post( get_the_ID() );
    $new_query=new \WP_Query( array( 'p' => get_the_ID(), 'post_type' => get_post_type() ) );
    $wp_query = $new_query;
		$settings = $this->parent->get_settings();
		$this->pid=get_the_ID();//set the current id in private var usefull to passid
    $default_template = $this->get_instance_value( 'skin_template' ) ;
    $template = $default_template;
    /* move to pro */
    //print_r(ThemeBuilderModule::instance()->get_conditions_manager()->get_documents_for_location( 'loop' ));
    
    //print_r($this->conditions->get_template());echo "aici";print_r($template);
    
    $template = apply_filters( 'ECS_action_template', $template,$this,$ecs_index );
    $template = $this->get_current_ID($template);
    
    $ecs_render_loop=get_the_ID().",".$template;
    //echo $ecs_render_loop;
    
  
    /* end pro */
		if (!$template) return;
    
    $this->set_used_template($template);
    
		$return = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $template );
    $ecs_render_loop=false;
    //\Elementor\Plugin::$instance->documents->restore_document();
    $wp_query = $old_query;
		return $return;
	}
  
  //this is for multilang porpouses... curently WPML
  private function get_current_ID($id){
    $newid = apply_filters( 'wpml_object_id', $id, 'elementor_library', TRUE  );
    return $newid ? $newid : $id;
  }

	protected function render_post_header() {
    $classes = 'elementor-post elementor-grid-item ecs-post-loop';
     $parent_settings = $this->parent->get_settings();
    $parent_settings[$this->get_id().'_post_slider'] = isset($parent_settings[$this->get_id().'_post_slider'])? $parent_settings[$this->get_id().'_post_slider'] : "";
     if($parent_settings[$this->get_id().'_post_slider'] == "yes") $classes .= ' swiper-slide';
     if ($this->grid_settings['allow']) {
        echo $this->get_grid();
        ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class( [ $classes ] ); ?>>
		<?php
    }
    else {
    ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( [ $classes ] ); ?>>
		<?php
    }
	}
  
  protected function render_post_footer() {
		if (!$this->grid_settings['allow']){
   ?>
		</article>
		<?php
    }else {
      ?></div><?php
    }
	}
  
	protected function render_post() {
	  do_action( 'ECS_before_render_post_header', $this );
    $this->render_post_header();
    do_action( 'ECS_after_render_post_header', $this );
    
		if ($this->get_instance_value( 'skin_template' )){
      if ($this->get_instance_value( 'use_keywords' ) == "yes") {
        global $post;
        apply_filters( 'ecs_dynamic_filter', "", $post,"",$this->parent->get_settings());//this is for pre-use of custom values
        $template = $this->get_template();
        $new_template = apply_filters( 'ecs_dynamic_filter', $template, $post,"",$this->parent->get_settings());
        echo  $new_template ? $new_template : $template;
      }
        else echo $this->get_template(); 
    }

			else  echo '<div style="display:table;border:1px solid #c6ced5; background:#dde1e5; width:100%; height:100%; min-height:200px;text-align:center; padding:20px;"><span style="vertical-align:middle;display: table-cell;color:#8995a0;">'.
        __( "Please select a default template! ", 'ele-custom-skin').'</span></div>';

    do_action( 'ECS_before_render_post_footer', $this );
		$this->render_post_footer();
    do_action( 'ECS_after_render_post_footer', $this );

	}
  
    protected function ajax_pagination(){
      $settings = $this->parent->get_settings();
      $theme_document = \Elementor\Plugin::$instance->documents->get_current();
      $page_limit = $settings['pagination_page_limit'] ? $settings['pagination_page_limit'] : 999;
      $max_pages = $this->parent->get_query()->max_num_pages;
      $max_num_pages = $page_limit < $max_pages ? $page_limit : $max_pages;
      $args = [ 'current_page'  =>  $this->parent->get_current_page(),
               'max_num_pages' => $max_num_pages,
               'load_method' => $settings['pagination_type'],//or infinitescroll for pro
               'widget_id' => $this->parent->get_id(),
               'post_id' => get_the_id(),
               'theme_id' => is_null($theme_document) ? '' : $theme_document->get_main_id(),
               'change_url' =>  $settings['change_url'],
               'reinit_js' =>  $settings['reinit_js'],
               
      ];

      $pagination=json_encode($args);
      return $pagination;
    }
  
  	protected function render_loop_header() {
      $parent_settings = $this->parent->get_settings();
      $parent_settings[$this->get_id().'_post_slider'] = isset($parent_settings[$this->get_id().'_post_slider'])? $parent_settings[$this->get_id().'_post_slider'] : "";

      if($parent_settings[$this->get_id().'_post_slider'] == "yes") {
        echo '<div class="swiper-container">';
        $this->grid_settings['allow'] = false;
      } else {// we don't use custom grid if slider is activated
        if($parent_settings[$this->get_id().'_use_custom_grid'] == "yes" && $parent_settings[$this->get_id().'_custom_grid'] ){
          $this->set_custom_grid($parent_settings[$this->get_id().'_custom_grid']);
          $this->grid_settings['allow'] = true;
        } else $this->grid_settings['allow'] = false;
      }
      $this->parent->add_render_attribute( 'container', [
        'class' => [
          'ecs-posts',
          'elementor-posts-container',
          'elementor-posts',
           $parent_settings[$this->get_id().'_post_slider'] == "yes" ? 'swiper-wrapper' : "",
           $this->grid_settings['allow'] ? "ecs-custom-grid" : '',
          $parent_settings[$this->get_id().'_post_slider'] != "yes" && !$this->grid_settings['allow'] ? 'elementor-grid':'',
          $this->get_container_class(),
        ],
         'data-settings' => [htmlentities($this->ajax_pagination(), ENT_QUOTES)],
      ] );

      ?>
      <div <?php echo $this->parent->get_render_attribute_string( 'container' ); ?>>
      <?php
	}

	protected function render_loop_footer() {
    
    $this->admin_bar_menu();// let's pass the templates we used so far to tha admin-bar-menu

		$parent_settings = $this->parent->get_settings();
    $parent_settings[$this->get_id().'_post_slider'] = isset($parent_settings[$this->get_id().'_post_slider'])? $parent_settings[$this->get_id().'_post_slider'] : "";
    
    if($this->grid_settings['allow']){
        $this->end_grid();
    }
    
    ?>
		</div>
		<?php
    
    if($parent_settings[$this->get_id().'_post_slider'] == "yes") {
      $this->slider_elements();
      echo '</div>';
  
    }
    if ( '' === $parent_settings['pagination_type'] ) {
			return;
		}

		$page_limit = $this->parent->get_query()->max_num_pages;
		if ( '' !== $parent_settings['pagination_page_limit'] ) {
			$page_limit = min( $parent_settings['pagination_page_limit'], $page_limit );
		}

		if ( 2 > $page_limit ) {
			return;
		}

		$this->parent->add_render_attribute( 'pagination', 'class', 'elementor-pagination' );

		$has_numbers = in_array( $parent_settings['pagination_type'], [ 'numbers', 'numbers_and_prev_next' ] );
		$has_prev_next = in_array( $parent_settings['pagination_type'], [ 'prev_next', 'numbers_and_prev_next' ] );

		$links = [];

		if ( $has_numbers ) {
			$paginate_args = [
				'type' => 'array',
				'current' => $this->parent->get_current_page(),
				'total' => $page_limit,
				'prev_next' => false,
				'show_all' => 'yes' !== $parent_settings['pagination_numbers_shorten'],
				'before_page_number' => '<span class="elementor-screen-only">' . __( 'Page', 'elementor-pro' ) . '</span>',
			];

			if ( is_singular() && ! is_front_page() ) {
				global $wp_rewrite;
				if ( $wp_rewrite->using_permalinks() ) {
					$paginate_args['base'] = trailingslashit( get_permalink() ) . '%_%';
					$paginate_args['format'] = user_trailingslashit( '%#%', 'single_paged' );
				} else {
					$paginate_args['format'] = '?page=%#%';
				}
			}

			$links = paginate_links( $paginate_args );
		}

		if ( $has_prev_next ) {
			$prev_next = $this->parent->get_posts_nav_link( $page_limit );
			array_unshift( $links, $prev_next['prev'] );
			$links[] = $prev_next['next'];
		}

		?>
		<nav class="elementor-pagination" role="navigation" aria-label="<?php esc_attr_e( 'Pagination', 'elementor-pro' ); ?>">
			<?php echo implode( PHP_EOL, $links ); ?>
		</nav>
		<?php

    if ( 'loadmore' === $parent_settings['pagination_type'] ) {
      $this->render_loadmore_button();    
    }
    if ( 'lazyload' === $parent_settings['pagination_type'] ) {
      $this->render_lazyload_animation();
    }
   
	}

  protected function render_lazyload_animation() {
		$settings =  $this->parent->get_settings();
    $next_page = $this->parent->get_current_page()+1;
    $next_page_link = trailingslashit( get_permalink() ) . '?page='.$next_page;
    $animation = \ECS_Loading_Animation::get_lazy_load_animations_html($settings['lazyload_animation']);
    $target= $this->parent->get_id();

		?>
		<nav class="ecs-lazyload elementor-pagination" data-targetid="<?php echo $target; ?>">
            <?php echo $animation; ?>
			<a href="<?php echo $next_page_link; ?>" >
        &gt;
      </a>
		</nav>
		<?php
	}  
  protected function render_loadmore_button() {
		$settings =  $this->parent->get_settings();
    $next_page = $this->parent->get_current_page()+1;
    $next_page_link = trailingslashit( get_permalink() ) . '?page='.$next_page;
    $class='';
    $args = [ 'loading_text'  =>  $settings['loadmore_loading_text'],
         'text' => $settings['loadmore_text'],//or infinitescroll for pro
         'widget_id' => $this->parent->get_id(),

    ];

    $data=htmlentities(json_encode($args), ENT_QUOTES);

		if ( $settings['loadmore_hover_animation'] ) {
			$class = 'elementor-animation-' . $settings['loadmore_hover_animation'];
		}

		?>
		<nav class="elementor-button-wrapper elementor-pagination ecs-load-more-button" data-settings="<?php echo $data; ?>">
			<a href="<?php echo $next_page_link; ?>" class="elementor-button-link elementor-button <?php echo $class; ?>" role="button">
				<span><?php echo $settings['loadmore_text']; ?></span>
			</a>
		</nav>
		<?php
	}
  
  private function slider_elements(){
    $this->settings = $this->parent->get_settings();
    do_action( 'ECS_after_slider_elements', $this );
  }
  
  private function nothing_found(){
      $this->render_loop_header();
      $should_escape = apply_filters( 'elementor_pro/theme_builder/archive/escape_nothing_found_message', true );
      $message = $this->parent->get_settings_for_display( 'nothing_found_message' );
      if ( $should_escape ) {
          $message = esc_html( $message );
      }

      $message = '<div class="elementor-posts-nothing-found">' . $message . '</div>';
      do_action( 'ECS_not_found', $this );
      echo  $message;
      $this->render_loop_footer();
  }
  
  public function render() {
		$this->parent->query_posts();

		/** @var \WP_Query $query */
		$query = $this->parent->get_query();

    do_action("ECS_before_loop_query",$query,$this);
    
    // start de incercat de bagat in action ECS_before_loop_query
    if (class_exists('ECS_Conditions_Manager')) 
      if($this->get_instance_value( 'is_display_conditions' )) $this->conditions = new \ECS_Conditions_Manager();
    
    // end de bagat
    

    if ( ! $query->found_posts ) {
       $this->nothing_found();
			return;
		}

		$this->render_loop_header();

		// It's the global `wp_query` it self. and the loop was started from the theme.
		if ( $query->in_the_loop ) {
			$this->current_permalink = get_permalink();
			$this->render_post();
		} else {
			while ( $query->have_posts() ) {
				$query->the_post();

				$this->current_permalink = get_permalink();
				$this->render_post();
			}
		}
    
    do_action("ECS_after_loop_query",$query,$this);

    wp_reset_postdata();

		$this->render_loop_footer();

	}
  
  	public function get_settings_for_display( $setting_key = null ) {
      //let's position ourselfs inside the loop item
      global $wp_query;
      $old_query=$wp_query;
      $new_query=new \WP_Query( array( 'p' => get_the_ID(), 'post_type' => get_post_type() ) );
      $wp_query = $new_query;
      if ( $setting_key ) {
        $settings = [
          $setting_key => $this->parent->get_settings( $setting_key ),
        ];
      } else {
        $settings = $this->parent->get_active_settings();

      }
      $controls=$this->parent->get_controls();  
      $controls = array_intersect_key($controls,$settings);
      $parsed_settings = $this->parent->parse_dynamic_settings( $settings, $controls );
      $wp_query = $old_query;//get out of loop item
      if ( $setting_key ) {
        return $parsed_settings[ $setting_key ];
      }
      return $parsed_settings;
	}

}


// it seems the same skin brakes if set to 2 widgets in the same time

class Skin_Archive_ECS extends Skin_Posts_ECS {

	private $template_cache=[];
	private $pid;

  protected function _register_controls_actions() {
		add_action( 'elementor/element/archive-posts/section_layout/before_section_end', [ $this, 'register_controls' ] );
		add_action( 'elementor/element/archive-posts/section_layout/after_section_end', [ $this, 'register_style_sections' ] );
  
    add_action( 'elementor/element/archive-posts/'.$this->get_id().'_section_design_layout/after_section_end', [ $this, 'register_navigation_design_controls' ] );
    add_action( 'elementor/element/archive-posts/section_pagination/after_section_end', [ $this, 'register_navigation_controls' ] );
	}
	
	public function get_id() {
		return 'archive_custom';
	}

	public function get_title() {
		return __( 'Custom', 'ele-custom-skin' );
	}
  
 /* Remove `posts_per_page` control */
	protected function register_post_count_control(){}

}

// Add a custom skin for the POSTS widget
    add_action( 'elementor/widget/posts/skins_init', function( $widget ) {
       $widget->add_skin( new Skin_Posts_ECS( $widget ) );
    } );
// Add a custom skin for the POST Archive widget
    add_action( 'elementor/widget/archive-posts/skins_init', function( $widget ) {
       $widget->add_skin( new Skin_Archive_ECS( $widget ) );
    } );
    