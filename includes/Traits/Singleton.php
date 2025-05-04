<?php
/**
 * Singleton Trait for WordPress Plugins
 *
 * @package Project Case Studies
 */

namespace Projectportfolio\ProjectPortfolio\Traits;

 if ( ! defined( 'ABSPATH') ) {
    exit;
}

trait Singleton {

    /**
     * Store the class instance
     */
    private static $instance = null;

    /**
     * Get the singleton instance
     */
    public static function get_instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

	/**
	 * Prevent object cloning
	 */
	private function __clone() {}

	/**
	 * Prevent object unserialization
	 */
	private function __wakeup() {
        throw new \Exception( "Cannot unserialize singleton" );
    }

}
