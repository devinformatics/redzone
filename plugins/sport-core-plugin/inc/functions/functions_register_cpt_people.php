<?php

/**************************************
INDEX

REGISTER CUSTOM POST FORMAT: PEOPLE
CUSTOM MESSAGES: PEOPLE
CUSTOM TAXONOMIES: PEOPLE CATEGORY
CUSTOM EDIT.PHP COLUMNS

***************************************/


/**************************************
REGISTER CUSTOM POST FORMAT: PEOPLE
***************************************/

add_action( 'init', 'canon_register_cpt_people' );

function canon_register_cpt_people() {

	$labels = array(
		'name'               => __( 'People', 'loc_sport_core_plugin' ),
		'singular_name'      => __( 'People', 'loc_sport_core_plugin' ),
		'add_new'            => __( 'Add New', 'loc_sport_core_plugin' ),
		'add_new_item'       => __( 'Add New People', 'loc_sport_core_plugin' ),
		'edit_item'          => __( 'Edit People', 'loc_sport_core_plugin' ),
		'new_item'           => __( 'New People', 'loc_sport_core_plugin' ),
		'all_items'          => __( 'All People', 'loc_sport_core_plugin' ),
		'view_item'          => __( 'View People', 'loc_sport_core_plugin' ),
		'search_items'       => __( 'Search People', 'loc_sport_core_plugin' ),
		'not_found'          => __( 'No people found', 'loc_sport_core_plugin' ),
		'not_found_in_trash' => __( 'No people found in the Trash', 'loc_sport_core_plugin' ), 
		'parent_item_colon'  => '',
		'menu_name'          => __('People', 'loc_sport_core_plugin'),
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our people and people specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' 		=> array('slug' => 'people'),
	);

	register_post_type( 'cpt_people', $args );	
}

/**************************************
CUSTOM MESSAGES:PEOPLE
***************************************/

add_filter( 'post_updated_messages', 'canon_cpt_people_messages' );

function canon_cpt_people_messages($messages) {
	global $post, $post_ID;

	$messages['cpt_people'] = array(
		0 => '', 
		1 => sprintf( __('People updated. <a href="%s">View people</a>'), esc_url( get_permalink($post_ID), 'loc_sport_core_plugin' ) ),
		2 => __('Custom field updated.', 'loc_sport_core_plugin'),
		3 => __('Custom field deleted.', 'loc_sport_core_plugin'),
		4 => __('People updated.', 'loc_sport_core_plugin'),
		5 => isset($_GET['revision']) ? sprintf( __('People restored to revision from %s', 'loc_sport_core_plugin'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('People published. <a href="%s">View people</a>'), esc_url( get_permalink($post_ID) ), 'loc_sport_core_plugin' ),
		7 => __('People saved.', 'loc_sport_core_plugin'),
		8 => sprintf( __('People submitted. <a target="_blank" href="%s">Preview people</a>', 'loc_sport_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('People scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview people</a>', 'loc_sport_core_plugin'), date_i18n( __( 'M j, Y @ G:i', 'loc_sport_core_plugin' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('People draft updated. <a target="_blank" href="%s">Preview people</a>', 'loc_sport_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/**************************************
CUSTOM TAXONOMIES: PEOPLE CATEGORY
***************************************/

add_action( 'init', 'canon_cpt_people_taxonomy_category', 0 );

function canon_cpt_people_taxonomy_category() {
	$labels = array(
		'name'              => __( 'People Categories', 'loc_sport_core_plugin' ),
		'singular_name'     => __( 'People Category', 'loc_sport_core_plugin' ),
		'search_items'      => __( 'Search People Categories', 'loc_sport_core_plugin' ),
		'all_items'         => __( 'All People Categories', 'loc_sport_core_plugin' ),
		'parent_item'       => __( 'Parent People Category', 'loc_sport_core_plugin' ),
		'parent_item_colon' => __( 'Parent People Category:', 'loc_sport_core_plugin' ),
		'edit_item'         => __( 'Edit People Category', 'loc_sport_core_plugin' ), 
		'update_item'       => __( 'Update People Category', 'loc_sport_core_plugin' ),
		'add_new_item'      => __( 'Add New People Category', 'loc_sport_core_plugin' ),
		'new_item_name'     => __( 'New People Category', 'loc_sport_core_plugin' ),
		'menu_name'         => __( 'People Categories', 'loc_sport_core_plugin' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'people_category', 'cpt_people', $args );
}

/**************************************
CUSTOM EDIT.PHP COLUMNS
***************************************/


// first add the custom columns
add_filter('manage_edit-cpt_people_columns', 'add_cpt_people_columns', 4);
function add_cpt_people_columns($defaults){

	$defaults['people_category'] = __('People Categories', 'loc_sport_core_plugin');
	return $defaults;

}

// now fill custom columns with actual data
add_action('manage_posts_custom_column', 'fill_cpt_people_columns', 4, 2);
function fill_cpt_people_columns($column, $post_id){

	if($column === 'people_category'){
		// get terms and sort
		$terms = get_the_terms($post_id, 'people_category');
		if ($terms) {
			$terms = array_values($terms);
			// output terms with links
			for ($i = 0; $i < count($terms); $i++) {  
				printf('<a href="?post_type=cpt_people&people_category=%s">%s</a>', $terms[$i]->slug, $terms[$i]->name);
				if ($i !== count($terms)-1 ) { echo ", "; }	// add comma separator unless it is the last item
			}
		}
	}

}
