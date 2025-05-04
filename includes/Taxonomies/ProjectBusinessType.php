<?php
/**
 * Class to register the "Business Type" taxonomy.
 *
 * @package ProjectPortfolio
 */

declare( strict_types=1 );

namespace Projectportfolio\ProjectPortfolio\Taxonomies;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class ProjectBusinessType
 */
final class ProjectBusinessType {

	use Singleton;

	/**
	 * Constructor: Register Hooks
	 */
	private function __construct() {
		$this ->_setup_hooks();
	}

	/**
	 * To setup actions/filters.
	 *
	 * @return void
	 */
	private function _setup_hooks() {
		add_action( 'init', [ $this, 'register_taxonomy' ] );
	}

	/**
	 * Registers the "Business Type" taxonomy
	 */
	public function register_taxonomy(): void {
		
        $labels = [
            'name'              => _x( 'Business Types', 'taxonomy general name', 'projects-case-studies' ),
            'singular_name'     => _x( 'Business Type', 'taxonomy singular name', 'projects-case-studies' ),
            'search_items'      => __( 'Search Business Types', 'projects-case-studies' ),
            'all_items'         => __( 'All Business Types', 'projects-case-studies' ),
            'parent_item'       => __( 'Parent Business Type', 'projects-case-studies' ),
            'parent_item_colon' => __( 'Parent Business Type:', 'projects-case-studies' ),
            'edit_item'         => __( 'Edit Business Type', 'projects-case-studies' ),
            'update_item'       => __( 'Update Business Type', 'projects-case-studies' ),
            'add_new_item'      => __( 'Add New Business Type', 'projects-case-studies' ),
            'new_item_name'     => __( 'New Business Type Name', 'projects-case-studies' ),
            'menu_name'         => __( 'Business Types', 'projects-case-studies' ),
        ];

        $args = [
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'business-type' ],
            'show_in_rest'      => true,
        ];

        register_taxonomy( 'business_type', [ 'project' ], $args );
	}
}
