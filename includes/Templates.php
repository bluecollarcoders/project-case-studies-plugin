<?php
/**
 * Class to register Block Templates.
 *
 * @package ProjectPortfolio
 */
declare(strict_types=1);

namespace Projectportfolio\ProjectPortfolio;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

final class Templates {

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
        add_action( 'init', [ $this, 'pcs_register_block_templates' ] );
	}

	/**
	 * Get template file content from the plugin's templates folder.
	 */
    private function pcs_get_template_content( string $template_file ): string {

        $path = plugin_dir_path( __DIR__ ) . "templates/{$template_file}";
        
        if ( file_exists( $path ) ) {
            ob_start();
            include $path;
            return ob_get_clean();
        }

        return '';

    }

	/**
	 * Dynamically registers all block templates found in the templates folder.
	 */
    public function pcs_register_block_templates(): void {

        $template_dir     = plugin_dir_path( __DIR__ ) . 'templates/';
        $plugin_namespace = 'projects-case-studies';

        foreach ( glob( $template_dir . '*.html' ) as $file ) {
            $slug    = basename( $file, '.html' ); // e.g. single-project
            $content = $this->pcs_get_template_content( basename( $file ) );

            $args = [
                'title'      => ucwords( str_replace( '-', ' ', $slug ) ),
                'content'    => $content,
            ];

            // Only assign post_types for single templates.
            if ( str_starts_with( $slug, 'single-' ) ) {
                $args['post_types'] = [ 'project' ];
            }

            register_block_template(
                "{$plugin_namespace}//{$slug}",
                $args
            );

        }

    }
}

// Initialize the class
add_action('plugins_loaded', function() {
	Templates::get_instance();
});
