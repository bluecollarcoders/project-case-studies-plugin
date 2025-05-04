<?php
/**
 * Class to register the Meta Data for block binding API.
 *
 * @package ProjectPortfolio
 */

declare(strict_types=1);

namespace Projectportfolio\ProjectPortfolio\Meta;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class ProjectCaseStudiesMeta {

    use Singleton;

    /**
     * Constructor: Hooks into WordPress.
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
        add_action( 'init', [ $this, 'register_project_post_meta' ], 20 );
	}

    /**
     * Register post meta for the Project Case Studies CPT.
     */
    public function register_project_post_meta(): void {
        $this->register_post_meta(
            'project',
			[
				[
					'meta_key' => 'pcs_client_name',
					'label'    => __( 'Client Name', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_industry',
					'label'    => __( 'Industry', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_summary',
					'label'    => __( 'Project Summary', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_problem',
					'label'    => __( 'Challenge', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_heading',
					'label'    => __( 'Solution / Title', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_summary',
					'label'    => __( 'Solution / Summary', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_one',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_two',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_three',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_four',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_five',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_solution_six',
					'label'    => __( 'Solution / Approach', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_results_subheading',
					'label'    => __( 'Results / Outcomes', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_results_heading',
					'label'    => __( 'Results / Outcomes', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_results_summary',
					'label'    => __( 'Results / Outcomes', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_results_image_one',
					'label'    => __( 'Results Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_results_image_two',
					'label'    => __( 'Results Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_results_image_three',
					'label'    => __( 'Results Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_results_image_four',
					'label'    => __( 'Results Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_details_subheading',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_heading',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_summary',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_description_headline_one',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_description_headline_two',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_description_headline_three',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_description_paragraph_one',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_details_description_paragraph_two',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_details_description_paragraph_three',
					'label'    => __( 'Details Of Services', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_quote_subheading',
					'label'    => __( 'Client Testimonial Subheading', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_quote_heading',
					'label'    => __( 'Client Testimonial Heading', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_quote_description',
					'label'    => __( 'Client Testimonial Description', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_quote_name',
					'label'    => __( 'Client Testimonial Name', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_quote_title',
					'label'    => __( 'Client Testimonial Title', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_kses_post',
				],
				[
					'meta_key' => 'pcs_cta_heading',
					'label'    => __( 'Call-to-Action', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_cta_byline',
					'label'    => __( 'Call-to-Action-Byline', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_cta_link',
					'label'    => __( 'Call-to-Action URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_timeline_subheadline',
					'label'    => __( 'Timeline', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_timeline_headline',
					'label'    => __( 'Timeline', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_timeline_paragraph',
					'label'    => __( 'Timeline', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'wp_strip_all_tags',
				],
				[
					'meta_key' => 'pcs_live_link',
					'label'    => __( 'Live Site URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_hero_image',
					'label'    => __( 'Hero Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
				[
					'meta_key' => 'pcs_challenge_image',
					'label'    => __( 'Challenge Image URL', 'project-case-studies' ),
					'type'     => 'string',
					'sanitize' => 'esc_url_raw',
				],
			]
        );
    }

    /**
     * Register custom post meta for a post type.
     *
     * @param string $post_type Post type to register meta for.
     * @param array  $meta_fields Array of meta field configurations.
     */
    private function register_post_meta( string $post_type, array $meta_fields ): void {
        foreach ( $meta_fields as $field ) {
            register_post_meta(
                $post_type,
                $field['meta_key'],
                [
                    'show_in_rest'      => true, // Enables Block Binding API
                    'single'            => true,
                    'type'              => $field['type'],
                    'sanitize_callback' => $field['sanitize'],
					'auth_callback'     => '__return_true',
                ]
            );
        }
    }
}

// Initialize the class.
add_action( 'init', function() {
    ProjectCaseStudiesMeta::get_instance();
} );
