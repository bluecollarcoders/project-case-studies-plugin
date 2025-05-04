<?php
/**
 * Class to register the "Project" Custom Post Type
 *
 * @package ProjectPortfolio
 */

namespace Projectportfolio\ProjectPortfolio\PostTypes;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class ProjectCaseStudies
 */
final class ProjectCaseStudies {

    use Singleton;

    /**
     * Constructor: Register Hooks.
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
        add_action( 'init', [ $this, 'register_project_cpt' ] );
        add_filter( 'enter_title_here', [ $this, 'change_title_placeholder_text' ] );
	}

    /**
     * Registers the "Project" Custom Post Type.
     */
    public function register_project_cpt(): void {
        $labels = [
            'name'                  => _x( 'Projects', 'Post Type General Name', 'projects-case-studies' ),
            'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'projects-case-studies' ),
            'menu_name'             => __( 'Projects', 'projects-case-studies' ),
            'name_admin_bar'        => __( 'Project', 'projects-case-studies' ),
            'archives'              => __( 'Project Archives', 'projects-case-studies' ),
            'attributes'            => __( 'Project Attributes', 'projects-case-studies' ),
            'add_new_item'          => __( 'Add New Project', 'projects-case-studies' ),
            'add_new'               => __( 'Add New', 'projects-case-studies' ),
            'new_item'              => __( 'New Project', 'projects-case-studies' ),
            'edit_item'             => __( 'Edit Project', 'projects-case-studies' ),
            'update_item'           => __( 'Update Project', 'projects-case-studies' ),
            'view_item'             => __( 'View Project', 'projects-case-studies' ),
            'search_items'          => __( 'Search Projects', 'projects-case-studies' ),
            'not_found'             => __( 'No projects found', 'projects-case-studies' ),
            'not_found_in_trash'    => __( 'No projects found in Trash', 'projects-case-studies' ),
            'featured_image'        => __( 'Project Featured Image', 'projects-case-studies' ),
            'set_featured_image'    => __( 'Set project featured image', 'projects-case-studies' ),
            'remove_featured_image' => __( 'Remove project featured image', 'projects-case-studies' ),
            'use_featured_image'    => __( 'Use as project featured image', 'projects-case-studies' ),
            'items_list'            => __( 'Projects list', 'projects-case-studies' ),
            'items_list_navigation' => __( 'Projects list navigation', 'projects-case-studies' ),
            'filter_items_list'     => __( 'Filter projects list', 'projects-case-studies' ),
        ];

        $args = [
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [ 'slug' => 'projects' ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'template'           => [[ 'project-case-studies/timeline-slider', [] ],],
            'menu_position'      => null,
            'taxonomies'         => [ 'business_type' ],
            'menu_icon'          => 'dashicons-portfolio',
            'show_in_rest'       => true,
            'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'sticky' ],
        ];

        register_post_type( 'project', $args );
    }

    /**
	 * Update placeholder text for post titles.
	 * Set posts to have placeholder text of "Enter the Project Case Study".
	 *
	 * @param string $title The placeholder text for the title of the post.
	 *
	 * @return string The filtered placeholder text.
	 */
	public function change_title_placeholder_text( string $title ): string {
		if ( 'project' === get_post_type() ) {
			return esc_html__( 'Enter Project Case Study', 'projects-case-studies' );
		}

		return $title;
	}
}

// Initialize the plugin
add_action( 'init', function() {
    ProjectCaseStudies::get_instance();
} );
