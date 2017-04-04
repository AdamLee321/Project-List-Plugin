<?php
//https://codex.wordpress.org/Function_Reference/register_post_type
function alwp_register_post_type() {
	
        //post type labels
	$singular = 'Project';
	$plural   = 'Projects';
	$slug = str_replace( ' ', '_', strtolower( $singular ) );
	$labels = array(
                //label names came directly from the codex
		'name' 			=> $plural,
		'singular_name' 	=> $singular,
		'add_new' 		=> 'Add New',
		'add_new_item'  	=> 'Add New ' . $singular,
		'edit'		        => 'Edit',
		'edit_item'	        => 'Edit ' . $singular,
		'new_item'	        => 'New ' . $singular,
		'view' 			=> 'View ' . $singular,
		'view_item' 		=> 'View ' . $singular,
		'search_term'   	=> 'Search ' . $plural,
		'parent' 		=> 'Parent ' . $singular,
		'not_found' 		=> 'No ' . $plural .' found',
		'not_found_in_trash' 	=> 'No ' . $plural .' in Trash'
		);
	$args = array(

		'labels'              => $labels,
	        'public'              => true,
	        'publicly_queryable'  => true,
	        'exclude_from_search' => false,
	        'show_in_nav_menus'   => true,
	        'show_ui'             => true,
	        'show_in_menu'        => true,
	        'show_in_admin_bar'   => true,
	        'menu_position'       => 10,
	        'menu_icon'           => 'dashicons-admin-site', //https://developer.wordpress.org/resource/dashicons/#admin-site
	        'can_export'          => true,
	        'delete_with_user'    => false,
                //true act like a page, false like a post
	        'hierarchical'        => false,
	        'has_archive'         => true,
                //allows you to create a custom url
	        'query_var'           => true,
	        'capability_type'     => 'post',
                // 'capabilitities'   => array(), <= custom capabilities
	        'map_meta_cap'        => true,
	        'rewrite'             => array( 
                        //sets pretty permalinks
	        	'slug'       => $slug,
	        	'with_front' => true,
	        	'pages'      => true,
	        	'feeds'      => true,
	        ),
	        'supports' => array( 
	        	'title', 
	        	'editor', 
	        	'author', 
	        	'custom-fields',
                        'thumbnail',
                        'revisions'
	        )
	);
	register_post_type( $slug, $args );
}
add_action( 'init', 'alwp_register_post_type' );
//https://codex.wordpress.org/Function_Reference/register_taxonomy
function alwp_register_taxonomy() {
	$plural = __( 'Locations' );
	$singular = __( 'Location' );
	$labels = array(
		'name'                       => $plural,
        'singular_name'              => $singular,
        'search_items'               => 'Search ' . $plural,
        'popular_items'              => 'Popular ' . $plural,
        'all_items'                  => 'All ' . $plural,
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit ' . $singular,
        'update_item'                => 'Update ' . $singular,
        'add_new_item'               => 'Add New ' . $singular,
        'new_item_name'              => 'New ' . $singular . ' Name',
        'separate_items_with_commas' => 'Separate ' . $plural . ' with commas',
        'add_or_remove_items'        => 'Add or remove ' . $plural,
        'choose_from_most_used'      => 'Choose from the most used ' . $plural,
        'not_found'                  => 'No ' . $plural . ' found.',
        'menu_name'                  => $plural,
	);
	$args = array(
		'hierarchical'          => true,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => strtolower( $singular ) ),
	);
	register_taxonomy( strtolower( $singular ), 'project', $args );
}
add_action( 'init', 'alwp_register_taxonomy' );
