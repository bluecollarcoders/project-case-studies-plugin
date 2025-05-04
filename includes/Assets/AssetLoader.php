<?php
/**
 * Class to register the Enqueue Script.
 *
 * @package ProjectPortfolio
 */

 namespace Projectportfolio\ProjectPortfolio\Assets;

 use Projectportfolio\ProjectPortfolio\Traits\Singleton;
 
 if ( ! defined( 'ABSPATH' ) ) {
	 exit; // Exit if accessed directly.
}

/**
 * Class ProjectCaseStudies
 */
final class AssetLoader {

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
		add_action( 'enqueue_block_editor_assets', [ $this, 'pcs_enqueue_editor_assets' ] );
	}

	/**
	 * Enqueue editor script only for 'project' post type.
	 *
	 * @param string $hook Current admin screen.
	 */
	public function pcs_enqueue_editor_assets(): void {

		if ( ! $this->is_project_post_type() ) {
			return;
		}

		$plugin_url  = plugin_dir_url( dirname( __DIR__ ) );
		$plugin_path = plugin_dir_path( dirname( __DIR__ ) );

		wp_enqueue_script(
			'pcs-editor-sidebar',
			$plugin_url . 'build/sidebar-panel.js',
			[
				'wp-plugins',
				'wp-edit-post',
				'wp-element',
				'wp-components',
				'wp-data',
				'wp-core-data',
				'wp-media-utils',
				'wp-block-editor',
				'wp-i18n',
			],
			filemtime( $plugin_path . 'build/sidebar-panel.js' ),
			true
		);
	}

	/**
	 * Helper function for post type.
	 *
	 * @return boolean
	 */
	private function is_project_post_type(): bool {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		return $screen && 'project' === $screen->post_type;
	}
}
 
// Initialize the plugin
add_action( 'plugins_loaded', function() {
	AssetLoader::get_instance();
} );
