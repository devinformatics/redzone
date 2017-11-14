<?php

/**************************************
INDEX

REGISTER CUSTOM POST FORMAT: PROJECT
CUSTOM MESSAGES: PROJECT
CUSTOM TAXONOMIES: PROJECT CATEGORY
CUSTOM EDIT.PHP COLUMNS

***************************************/


/**************************************
REGISTER CUSTOM POST FORMAT: PROJECT
***************************************/

add_action( 'init', 'canon_register_cpt_project' );

function canon_register_cpt_project() {

	$labels = array(
		'name'               => __( 'Projects', 'loc_sport_core_plugin' ),
		'singular_name'      => __( 'Project', 'loc_sport_core_plugin' ),
		'add_new'            => __( 'Add New', 'loc_sport_core_plugin' ),
		'add_new_item'       => __( 'Add New Project', 'loc_sport_core_plugin' ),
		'edit_item'          => __( 'Edit Project', 'loc_sport_core_plugin' ),
		'new_item'           => __( 'New Project', 'loc_sport_core_plugin' ),
		'all_items'          => __( 'All Projects', 'loc_sport_core_plugin' ),
		'view_item'          => __( 'View Project', 'loc_sport_core_plugin' ),
		'search_items'       => __( 'Search Projects', 'loc_sport_core_plugin' ),
		'not_found'          => __( 'No projects found', 'loc_sport_core_plugin' ),
		'not_found_in_trash' => __( 'No projects found in the Trash', 'loc_sport_core_plugin' ), 
		'parent_item_colon'  => '',
		'menu_name'          => __('Projects', 'loc_sport_core_plugin'),
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our projects and project specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
		'rewrite' 		=> array('slug' => 'projects'),
	);

	register_post_type( 'cpt_project', $args );	
}

/**************************************
CUSTOM MESSAGES:PROJECT
***************************************/

add_filter( 'post_updated_messages', 'canon_cpt_project_messages' );

function canon_cpt_project_messages($messages) {
	global $post, $post_ID;

	$messages['cpt_project'] = array(
		0 => '', 
		1 => sprintf( __('Project updated. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID), 'loc_sport_core_plugin' ) ),
		2 => __('Custom field updated.', 'loc_sport_core_plugin'),
		3 => __('Custom field deleted.', 'loc_sport_core_plugin'),
		4 => __('Project updated.', 'loc_sport_core_plugin'),
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s', 'loc_sport_core_plugin'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>'), esc_url( get_permalink($post_ID) ), 'loc_sport_core_plugin' ),
		7 => __('Project saved.', 'loc_sport_core_plugin'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>', 'loc_sport_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>', 'loc_sport_core_plugin'), date_i18n( __( 'M j, Y @ G:i', 'loc_sport_core_plugin' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>', 'loc_sport_core_plugin'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

/**************************************
CUSTOM TAXONOMIES: PROJECT CATEGORY
***************************************/

add_action( 'init', 'canon_register_taxonomy_project_category', 0 );

function canon_register_taxonomy_project_category() {
	$labels = array(
		'name'              => __( 'Project Categories', 'loc_sport_core_plugin' ),
		'singular_name'     => __( 'Project Category', 'loc_sport_core_plugin' ),
		'search_items'      => __( 'Search Project Categories', 'loc_sport_core_plugin' ),
		'all_items'         => __( 'All Project Categories', 'loc_sport_core_plugin' ),
		'parent_item'       => __( 'Parent Project Category', 'loc_sport_core_plugin' ),
		'parent_item_colon' => __( 'Parent Project Category:', 'loc_sport_core_plugin' ),
		'edit_item'         => __( 'Edit Project Category', 'loc_sport_core_plugin' ), 
		'update_item'       => __( 'Update Project Category', 'loc_sport_core_plugin' ),
		'add_new_item'      => __( 'Add New Project Category', 'loc_sport_core_plugin' ),
		'new_item_name'     => __( 'New Project Category', 'loc_sport_core_plugin' ),
		'menu_name'         => __( 'Project Categories', 'loc_sport_core_plugin' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'project_category', 'cpt_project', $args );
}

/**************************************
CUSTOM EDIT.PHP COLUMNS
***************************************/


// first add the custom columns
add_filter('manage_edit-cpt_project_columns', 'add_cpt_project_columns', 4);
function add_cpt_project_columns($defaults){

	$defaults['project_category'] = __('Project Categories', 'loc_sport_core_plugin');
	return $defaults;

}

// now fill custom columns with actual data
add_action('manage_posts_custom_column', 'fill_cpt_project_columns', 4, 2);
function fill_cpt_project_columns($column, $post_id){

	if($column === 'project_category'){
		// get terms and sort
		$terms = get_the_terms($post_id, 'project_category');
		if ($terms) {
			$terms = array_values($terms);
			// output terms with links
			for ($i = 0; $i < count($terms); $i++) {  
				printf('<a href="?post_type=cpt_project&project_category=%s">%s</a>', $terms[$i]->slug, $terms[$i]->name);
				if ($i !== count($terms)-1 ) { echo ", "; }	// add comma separator unless it is the last item
			}
		}
	}

}
