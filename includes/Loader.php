<?php
/**
 * Class to handle class initialization.
 *
 * @package ProjectPortfolio
 */

namespace Projectportfolio\ProjectPortfolio;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Loader {

    use Singleton;

	/**
	 * Loader Constructor.
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
		add_action( 'plugins_loaded', [ $this, 'load_classes' ] );
	}

    /**
     * Get all class names dynamically from the `includes` and `sub` folders.
     *
     * @return array
     */
	private function get_classes(): array {
		$classes = [];

		$iterator = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator( __DIR__ )
		);

		foreach ( $iterator as $file ) {
			if ( $file->isFile() && $file->getExtension() === 'php' ) {

				$relative_path = str_replace( [ __DIR__ . '/', '.php'], '', $file->getPathname() );
				$relative_path = str_replace( '/', '\\', $relative_path );
				$class         = __NAMESPACE__ . '\\' . $relative_path;

				if ( class_exists( $class ) ) {
				$classes[] = $class;
			   }

			}
		}

		return $classes;
	}

	/**
	 * Load and instantiate classes.
	 *
	 * @return void
	 */
	public function load_classes(): void {
	
		foreach ( $this->get_classes() as $class ) {
			if ( ! class_exists( $class ) ) {
				continue;
			}

			$class::get_instance();
		}
	}
}

// Initialize the class
add_action( 'init', function() {
    Loader::get_instance();
});
