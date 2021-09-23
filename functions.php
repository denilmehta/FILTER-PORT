<?php
/*This file is part of astra-child, astra child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/
wp_enqueue_script( 'custom-js', get_theme_file_uri( '/js/custom.js' ), array(), '', true );

if ( ! function_exists( 'suffice_child_enqueue_child_styles' ) ) {
	function astra_child_enqueue_child_styles() {
	    // loading parent style
	    wp_register_style(
	      'parente2-style',
	      get_template_directory_uri() . '/style.css'
	    );

	    wp_enqueue_style( 'parente2-style' );
	    // loading child style
	    wp_register_style(
	      'childe2-style',
	      get_stylesheet_directory_uri() . '/style.css'
	    );
	    wp_enqueue_style( 'childe2-style');
	 }
}
add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_child_styles' );

/*Write here your own functions */
function teams(){

    

    $args = array(

        'post_type'=> 'team'

    );              



    $the_query = new WP_Query( $args );

    if($the_query->have_posts() ) : 

    
		echo '	<div class="elementor-widget-wrap elementor-element-populated">';
		echo '  <div class="elementor-element elementor-element-7da6c6c elementor-widget elementor-widget-image" data-id="7da6c6c" data-element_type="widget" data-widget_type="image.default">';
		echo '   <div class="elementor-widget-container">';

        while ( $the_query->have_posts() ) : $the_query->the_post(); 



        $thumb = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(  )), 'thumbnail' );

        // content goes here

        $yrs = get_field('test_name',get_the_ID());

        $profile = get_field('test_last_name',get_the_ID());
		$profile1 = get_field('message',get_the_ID());
		// $profile = get_field('test_last_name',get_the_ID());
		// $profile = get_field('test_last_name',get_the_ID());
		// $profile = get_field('test_last_name',get_the_ID());

        ?>


         <img width="644" height="402" src="<?php echo $thumb;?>" class="attachment-full size-full" alt="" loading="lazy" srcset="http://192.168.8.119:8080/ted/wp-content/uploads/2020/01/hiking-v1.jpg 644w, http://192.168.8.119:8080/ted/wp-content/uploads/2020/01/hiking-v1-300x187.jpg 300w" sizes="(max-width: 644px) 100vw, 644px">															
      </div>
   </div>
   <div class="elementor-element elementor-element-ba141ea elementor-position-top elementor-vertical-align-top elementor-widget elementor-widget-image-box" data-id="ba141ea" data-element_type="widget" data-widget_type="image-box.default">
      <div class="elementor-widget-container">
         <div class="elementor-image-box-wrapper">
            <div class="elementor-image-box-content">
		
               <h5 class="elementor-image-box-title"><?=$yrs?></h5>
			  
               <p class="elementor-image-box-description"><?=$profile?></p>
            </div>
         </div>
      </div>
   </div>
   <div class="elementor-element elementor-element-4cc62c7 elementor-align-center elementor-widget elementor-widget-button" data-id="4cc62c7" data-element_type="widget" data-widget_type="button.default">
      <div class="elementor-widget-container">
         <div class="elementor-button-wrapper">
            <a href="#" class="elementor-button-link elementor-button elementor-size-sm" role="button">
            <span class="elementor-button-content-wrapper">
            <span class="elementor-button-icon elementor-align-icon-right">
            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
            </span>
            <span class="elementor-button-text"><?=$profile1?></span>
            </span>
            </a>
         </div>


        </div>

            </div>

        </div>

        <?php

        endwhile; 

        echo '</div>';

        echo '</div>';
		echo '</div>';

        wp_reset_postdata(); 

    else: 

    endif;



}

add_shortcode( 'teams', 'teams' );
add_action( 'init', 'addfeaturecustom_post_custom_Team' );



function addfeaturecustom_post_custom_Team() {

    // Creating a Deals Custom Post Type

	$labels = array(

		'name'                => __( 'Teams' ),

		'singular_name'       => __( 'Team'),

		'menu_name'           => __( 'Teams'),

		'parent_item_colon'   => __( 'Parent Team'),

		'all_items'           => __( 'All Teams'),

		'view_item'           => __( 'View Team'),

		'add_new_item'        => __( 'Add New Team'),

		'add_new'             => __( 'Add New'),

		'edit_item'           => __( 'Edit Team'),

		'update_item'         => __( 'Update Team'),

		'search_items'        => __( 'Search Team'),

		'not_found'           => __( 'Not Found'),

		'not_found_in_trash'  => __( 'Not found in Trash')

	);

	$args = array(

		'label'               => __( 'Teams'),

		'description'         => __( '  Teams'),

		'labels'              => $labels,

		'supports'            => array( 'title',  'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),

		'public'              => true,

		'hierarchical'        => false,

		'show_ui'             => true,

		'show_in_menu'        => true,

		'show_in_nav_menus'   => true,

		'show_in_admin_bar'   => true,

		'has_archive'         => true,

		'can_export'          => true,

		'exclude_from_search' => false,

	    'yarpp_support'       => true,

		'taxonomies' 	      => array('post_tag'),

		'publicly_queryable'  => true,

		'capability_type'     => 'page'

);

register_post_type( 'Team', $args);

}
function filterable_portfolio(){

	$queried_object = get_queried_object();
	$term_id = $queried_object->term_id[0];
	$terms = get_terms('product_categories');
	// print_r($terms);
	?>
	<div class="btn-wrap">
	  <a href="javascript:;" data-slug="" class="all active">All</a>
	  <?php
	  foreach($terms as $cat)
	  {
		$cat_name =  $cat ->name;
		$cat_slug =   $cat -> slug;
	  ?>
		<a href="javascript:;" data-slug="<?php echo $cat_slug ?>"> <?php echo $cat_name ?> </a>
	  <?php 
	  }
	  ?>
	</div>
	<div class="blog-post-main">
	<?php 
	$args = array(
		  'post_type'   => 'products',
		  'post_status'   => 'publish',
		  'orderby'      => 'title',
		  'order'     => 'asc',
		  'field' => 'slug'
		);
	$the_query = new WP_Query( $args );
	
	while ($the_query -> have_posts()) : $the_query -> the_post(); 
	
	// print_r($cat_slug);
	 
	 $term_obj_list = get_the_terms( $post->ID, 'product_categories' );

$cat_slug = $term_obj_list[0] ->slug;
	?>
	<div class="blog-post-wrap" data-slug="<?php echo $cat_slug ?>">
	<div class="blog-thumb"><a href="<?php the_permalink() ?>"><?php the_post_thumbnail('medium'); ?></a></div>
	<div class="blog-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div>
	</div>
	<?php 
	endwhile;
	wp_reset_postdata();
	?>
	</div><?php
	}
	add_shortcode('blog-post', 'filterable_portfolio');
	
	
	
	
	
	
	
	$labels = array(
		'name' => _x( 'Product Categories', 'taxonomy general name' ),
		'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Product Categories' ),
		'all_items' => __( 'All Product Categories' ),
		'parent_item' => __( 'Parent Category' ),
		'parent_item_colon' => __( 'Parent Category:' ),
		'edit_item' => __( 'Edit Product Category' ), 
		'update_item' => __( 'Update Product Category' ),
		'add_new_item' => __( 'Add Product Category' ),
		'new_item_name' => __( 'New Product Category' ),
		'rewrite'            => array( 'slug' => 'product_categories' ),
		'menu_name' => __( 'Product Categories' )
	  ); 	
	
	register_taxonomy('product_categories',array('products'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'query_var' => true,
		'show_ui' => true
	 ));
	
	 add_action( 'init', 'product_register' );
	 function product_register() {
	   $labels = array(
		 'name' => _x('Products', 'post type general name'),
		 'singular_name' => _x('Product', 'post type singular name'),
		 'add_new' => _x('Add New', 'Product'),
		 'add_new_item' => __('Add New Product'),
		 'edit_item' => __('Edit Product'),
		 'new_item' => __('New Product'),
		 'all_items' => __('All Products'),
		 'view_item' => __('View Products'),
		 'search_items' => __('Search Products'),
		 'not_found' =>  __('No products found'),
		 'not_found_in_trash' => __('No products found in Trash'), 
		 'parent_item_colon' => '',
		 'menu_name' => 'Products'
	 
	   );
	   $args = array(
		 'labels' => $labels,
		 'public' => true,
		 'publicly_queryable' => true,
		 'show_ui' => true, 
		 'show_in_menu' => true, 
		 'query_var' => true,
		 'rewrite' => true,
		 'capability_type' => 'post',
		 'hierarchical' => false,
		 'supports' => array( 'title', 'editor', 'thumbnail', 'page-attributes' )
	   ); 
	   register_post_type('products',$args);
	 }
	
	
	
	
	?>
	
	