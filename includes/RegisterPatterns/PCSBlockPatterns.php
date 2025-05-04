<?php
/**
 * Registers block patterns for Project Case Studies
 *
 * @package Project Case Studies
 */

namespace Projectportfolio\ProjectPortfolio\RegisterPatterns;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

 if ( ! defined( 'ABSPATH') ) {
	exit;
}

final class PCSBlockPatterns {

	use Singleton;

   /**
	* Constructor: Hooks into WordPress
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
		add_action( 'init', [ $this, 'register_patterns' ] );
	}


	/**
	 * Register all block patterns.
	 */
	public function register_patterns(): void {

	  // Register pattern category.
	  register_block_pattern_category(
		  'project-case-studies',
		  ['label' => __( 'Project Case Studies', 'project-case-studies' ) ]
	  );

	  $base_path = plugin_dir_path( dirname( __DIR__ ) ) . 'patterns/';

	  $patterns = [
		[
			'slug'        => 'archive-hero-pattern',
			'title'       => 'Archive Hero Section',
			'description' => 'A grid layout for displaying project case studies.',
			'keywords'    => [ 'projects', 'archive', 'grid' ],
		],
		[
			'slug'        => 'single-hero-pattern',
			'title'       => 'Single Project Hero Section',
			'description' => 'A detailed template for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'challenge-pattern',
			'title'       => 'Challenge Pattern',
			'description' => 'A pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'solution-pattern',
			'title'       => 'Solution Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'results-pattern',
			'title'       => 'Results Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'details-pattern',
			'title'       => 'Details Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'testimonial-pattern',
			'title'       => 'Testimonial Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'call-to-action-pattern',
			'title'       => 'Call to action Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'query-loop-pattern',
			'title'       => 'Query Loop Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
		[
			'slug'        => 'timeline-pattern',
			'title'       => 'Time Line Pattern',
			'description' => 'A detailed pattern for a single project case study.',
			'keywords'    => [ 'project', 'case study', 'details' ],
		],
	  ];

	  foreach ( $patterns as $pattern ) {
		$this->register_single_pattern(
			$pattern['slug'],
			$pattern['title'],
			$pattern['description'],
			$base_path . $pattern['slug'] . '.html',
			$pattern['keywords']
		);
	  }

	}

	/**
	 * Helper method to register a single block pattern.
	 *
	 * @param string $slug Block pattern slug.
	 * @param string $title Block pattern title.
	 * @param string $description Block pattern description.
	 * @param string $file_path Path to the pattern HTML file.
	 * @param array  $keywords Keywords associated with the pattern.
	 */
	private function register_single_pattern( string $slug, string $title, string $description, string $file_path, array $keywords ): void {

		if ( ! file_exists( $file_path ) ) {
			error_log( "[PCS] Pattern file not found: $file_path" );
		}

		register_block_pattern(
			'project-case-studies/' . $slug,
			[
				'title'       => __( $title, 'project-case-studies' ),
				'description' => __( $description, 'project-case-studies' ),
				'content'     => file_get_contents( $file_path ),
				'categories'  => [ 'project-case-studies' ],
				'keywords'    => $keywords,
			]
		);

	}

}

// Initialize the class
add_action('plugins_loaded', function() {
	PCSBlockPatterns::get_instance();
});
