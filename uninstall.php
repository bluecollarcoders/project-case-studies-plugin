<?php
/**
 * Uninstall script for the Projects Case Studies plugin.
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

// Delete all post meta fields used by this plugin
global $wpdb;

$meta_keys = [
	'pcs_client_name',
	'pcs_industry',
	'pcs_summary',
	'pcs_problem',
	'pcs_solution_heading',
	'pcs_solution_summary',
	'pcs_solution_one',
	'pcs_solution_two',
	'pcs_solution_three',
	'pcs_solution_four',
	'pcs_solution_five',
	'pcs_solution_six',
	'pcs_results_subheading',
	'pcs_results_heading',
	'pcs_results_summary',
	'pcs_results_image_one',
	'pcs_results_image_two',
	'pcs_results_image_three',
	'pcs_results_image_four',
	'pcs_details_subheading',
	'pcs_details_heading',
	'pcs_details_summary',
	'pcs_details_description_headline_one',
	'pcs_details_description_headline_two',
	'pcs_details_description_headline_three',
	'pcs_details_description_paragraph_one',
	'pcs_details_description_paragraph_two',
	'pcs_details_description_paragraph_three',
	'pcs_quote_subheading',
	'pcs_quote_heading',
	'pcs_quote_description',
	'pcs_quote_name',
	'pcs_quote_title',
	'pcs_cta_heading',
	'pcs_cta_byline',
	'pcs_cta_link',
	'pcs_timeline',
	'pcs_live_link',
	'pcs_hero_image',
	'pcs_challenge_image'
];

// Run deletion for all meta keys
foreach ( $meta_keys as $meta_key ) {
	$wpdb->query(
		$wpdb->prepare(
			"DELETE FROM {$wpdb->postmeta} WHERE meta_key = %s",
			$meta_key
		)
	);
}

// (Optional) Delete all `project` posts
$projects = get_posts([
	'post_type'   => 'project',
	'numberposts' => -1,
	'post_status' => 'any',
	'fields'      => 'ids',
]);

foreach ( $projects as $project_id ) {
	wp_delete_post( $project_id, true ); // true = force delete (bypass trash)
}
