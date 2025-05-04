<?php
/**
 * Class to register the Timeline Block.
 *
 * @package ProjectPortfolio
 */
namespace Projectportfolio\ProjectPortfolio\Blocks;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class TimelineSliderBlock
 *
 * Registers and enqueues assets for the Timeline Slider block.
 */
final class TimelineSliderBlock {
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
        add_action( 'init',                     [ $this, 'register_block_assets' ] );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_editor_assets' ] );
        add_action( 'wp_enqueue_scripts',        [ $this, 'enqueue_frontend_assets' ] );
	}

    /**
     * Register block scripts and styles (editor bundle, frontend init bundle, and Slick assets).
     *
     * @return void
     */
    public function register_block_assets(): void {
        $root      = dirname( __DIR__, 2 );
        $build_dir = "$root/build";

        // ——— Editor bundle ———
        $editor_asset = require_once "$build_dir/project-slider-block.asset.php";
        wp_register_script(
            'project-slider-block',
            plugins_url( 'build/project-slider-block.js', "$root/index.php" ),
            $editor_asset['dependencies'],
            $editor_asset['version'],
            true
        );
        wp_register_style(
            'project-slider-block',
            plugins_url( 'build/project-slider-block.css', "$root/index.php" ),
            [],
            $editor_asset['version']
        );

        // ——— Slick CSS from CDN ———
        wp_register_style(
            'slick-css',
            '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
            [],
            '1.8.1'
        );
        wp_register_style(
            'slick-theme-css',
            '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css',
            [ 'slick-css' ],
            '1.8.1'
        );

        // ——— Slick JS from CDN ———
        wp_register_script(
            'slick-js',
            '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
            [ 'jquery' ],
            '1.8.1',
            true
        );

        // ——— Front‑end init bundle ———
        $frontend_asset = require_once "$build_dir/project-slider-frontend.asset.php";
        wp_register_script(
            'project-slider-frontend',
            plugins_url( 'build/project-slider-frontend.js', "$root/index.php" ),
            array_merge( [ 'jquery', 'slick-js' ], $frontend_asset['dependencies'] ),
            $frontend_asset['version'],
            true
        );
        wp_register_style(
            'project-slider-frontend',
            plugins_url( 'build/style-project-slider-frontend.css', "$root/index.php" ),
            [ 'slick-css','slick-theme-css' ],
            $frontend_asset['version']
        );

        // ——— Finally, register the block.json ———
        register_block_type( "$root/blocks/timeline-slider/block.json" );
    }

    /**
     * Enqueue the scripts and styles for the block editor.
     *
     * @return void
     */
    public function enqueue_editor_assets(): void {
        wp_enqueue_script( 'project-slider-block' );
        wp_enqueue_style(  'project-slider-block' );
    }

    /**
     * Enqueue the front-end scripts and styles when the slider block is present.
     *
     * @return void
     */
    public function enqueue_frontend_assets(): void {
        if ( ! has_block( 'project-case-studies/timeline-slider' ) ) {
            return;
        }

        // 1) Slick CSS
        wp_enqueue_style( 'slick-css' );
        wp_enqueue_style( 'slick-theme-css' );
        // 2) our overrides
        wp_enqueue_style( 'project-slider-frontend' );
        // 3) Slick JS + init
        wp_enqueue_script( 'slick-js' );
        wp_enqueue_script( 'project-slider-frontend' );
    }
}

add_action( 'plugins_loaded', [ TimelineSliderBlock::class, 'get_instance' ] );
