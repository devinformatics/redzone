<?php

/**************************************
INDEX

REGISTER CUSTOM POST TYPE: pb_template
CUSTOM MESSAGES: pb_template

***************************************/


/**************************************
REGISTER CUSTOM POST TYPE: pb_template
***************************************/

add_action( 'init', 'register_cpt_pb_template' );

function register_cpt_pb_template() {

	$labels = array(
		'name'               => _x( 'Templates', 'post type general name', 'loc_timedrop' ),
		'singular_name'      => _x( 'Template', 'post type singular name', 'loc_timedrop' ),
		'add_new'            => _x( 'Add New', 'book', 'loc_timedrop' ),
		'add_new_item'       => __( 'Add New Template', 'loc_timedrop' ),
		'edit_item'          => __( 'Edit Template', 'loc_timedrop' ),
		'new_item'           => __( 'New Template', 'loc_timedrop' ),
		'all_items'          => __( 'All Templates', 'loc_timedrop' ),
		'view_item'          => __( 'View Template', 'loc_timedrop' ),
		'search_items'       => __( 'Search Templates', 'loc_timedrop' ),
		'not_found'          => __( 'No Templates found', 'loc_timedrop' ),
		'not_found_in_trash' => __( 'No Templates found in the Trash', 'loc_timedrop' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Pagebuilder Templates'
	);

	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Templates and Template specific data',
		'public'        => false,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor'),
		'has_archive'   => true,
		'rewrite' 		=> array('slug' => 'Templates'),
	);

	register_post_type( 'pb_template', $args );	
}

/**************************************
CUSTOM MESSAGES: pb_template
***************************************/

add_filter( 'post_updated_messages', 'messages_cpt_pb_template' );

function messages_cpt_pb_template($messages) {
	global $post, $post_ID;

	$messages['pb_template'] = array(
		0 => '', 
		1 => sprintf( __('Template updated. <a href="%s">View Template</a>', 'loc_timedrop'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.', 'loc_timedrop'),
		3 => __('Custom field deleted.', 'loc_timedrop'),
		4 => __('Template updated.', 'loc_timedrop'),
		5 => isset($_GET['revision']) ? sprintf( __('Template restored to revision from %s', 'loc_timedrop'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Template published. <a href="%s">View Template</a>', 'loc_timedrop'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Template saved.', 'loc_timedrop'),
		8 => sprintf( __('Template submitted. <a target="_blank" href="%s">Preview Template</a>', 'loc_timedrop'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Template scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Template</a>', 'loc_timedrop'), date_i18n( __( 'M j, Y @ G:i' , 'loc_timedrop'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Template draft updated. <a target="_blank" href="%s">Preview Template</a>', 'loc_timedrop'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);

	return $messages;
}

