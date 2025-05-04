<?php
/**
 * Class to add admin columns for Business Type taxonomy.
 *
 * @package ProjectPortfolio
 */

declare( strict_types=1 );

namespace Projectportfolio\ProjectPortfolio\Admin;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class AdminColumns
 */
final class AdminColumns {

	use Singleton;

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->_setup_hooks();
	}

	/**
	 * To setup actions/filters.
	 *
	 * @return void
	 */
	private function _setup_hooks(): void {

		add_filter( 'manage_project_posts_columns', [ $this, 'add_business_type_column' ] );
		add_action( 'manage_project_posts_custom_column', [ $this, 'populate_business_type_column' ], 10, 2 );
		add_action( 'restrict_manage_posts', [ $this, 'add_business_type_filter' ] );

	}

	/**
     * Add a new column for Business Type
     */
    public function add_business_type_column( $columns ) {

        $columns['business_type'] = __( 'Business Type', 'projects-case-studies' );
        return $columns;

    }

	/**
	 * Populate Business Type column with taxonomy terms.
	 */
	public function populate_business_type_column( $column, $post_id ) {

		if ( 'business_type' === $column ) {
			$terms = get_term( $post_id, 'business_type' );

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$terms_names = wp_list_pluck( $terms, 'name' );
				echo implode( ', ', $terms_names );
			} else {
				echo __( '-', 'projects-case-studies' );
			}
		}
		
	}

	/**
	 * Add a filter dropdown for Business Type
	 */
	public function add_business_type_filter() {

		global $typenow;

        if ( 'project' === $typenow ) {
            $taxonomy = 'business_type';
            $selected = isset( $_GET[$taxonomy] ) ? $_GET[$taxonomy] : '';
            $info_label = __( 'Filter by Business Type', 'projects-case-studies' );
            wp_dropdown_categories([
                'show_option_all' => $info_label,
                'taxonomy'        => $taxonomy,
                'name'            => $taxonomy,
                'orderby'         => 'name',
                'selected'        => $selected,
                'show_count'      => true,
                'hide_empty'      => true,
            ]);
        }
	}

}

// Initialize the class
add_action( 'plugins_loaded', function() {
    AdminColumns::get_instance();
} );
