<?php
/**
 * Class to merge plugin-based theme.json into global context.
 *
 * @package ProjectPortfolio
 */

namespace Projectportfolio\ProjectPortfolio\Assets;

use Projectportfolio\ProjectPortfolio\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class DesignTokenInjector {
	use Singleton;

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	private function setup_hooks(): void {
		/**
		 * Front end: after WP knows what’s being rendered, conditionally attach the filter.
		 */
		add_action( 'wp', [ $this, 'maybe_hook_front_end_tokens' ] );

		/**
		 * Block editor: attach only when editing the Project CPT.
		 */
		add_action( 'current_screen', [ $this, 'maybe_hook_editor_tokens' ] );
	}

	/**
	 * Attach the theme.json filter only on Project front-end views.
	 */
	public function maybe_hook_front_end_tokens(): void {
		if ( is_singular( 'project' ) || is_post_type_archive( 'project' ) ) {
			add_filter( 'wp_theme_json_data_theme', [ $this, 'inject_palette' ], 10 );
		}
	}

	/**
	 * Attach the theme.json filter only when editing a Project in the editor.
	 *
	 * @param \WP_Screen $screen
	 */
	public function maybe_hook_editor_tokens( $screen ): void {
		if ( isset( $screen->post_type ) && 'project' === $screen->post_type ) {
			add_filter( 'wp_theme_json_data_theme', [ $this, 'inject_palette' ], 10 );
		}
	}

	/**
	 * Additive token diff (palette only). Avoid layout/spacing overrides here.
	 *
	 * @param \WP_Theme_JSON $theme_json
	 * @return \WP_Theme_JSON
	 */
	public function inject_palette( $theme_json ) {
		$current  = $theme_json->get_data();
		$existing = $current['settings']['color']['palette']['theme'] ?? [];

		$diff = [
			'version'  => 3,
			'settings' => [
				'color' => [
					'palette' => [
						'theme' => array_merge(
							$existing,
							[
								[
									'slug'  => 'main-accent',
									'color' => '#d4d4ec',
									'name'  => __( 'Contrast Accent', 'project-case-studies' ),
								],
								[
									'slug'  => 'base',
									'color' => '#ffffff',
									'name'  => __( 'Base', 'project-case-studies' ),
								],
								[
									'slug'  => 'secondary',
									'color' => '#545473',
									'name'  => __( 'Base Accent', 'project-case-studies' ),
								],
								[
									'slug'  => 'tertiary',
									'color' => '#f8f7fc',
									'name'  => __( 'Tint', 'project-case-studies' ),
								],
								[
									'slug'  => 'border-light',
									'color' => '#E3E3F0',
									'name'  => __( 'Border Base', 'project-case-studies' ),
								],
								[
									'slug'  => 'border-dark',
									'color' => '#4E4E60',
									'name'  => __( 'Border Contrast', 'project-case-studies' ),
								],
							]
						),
					],
				],
			],
		];

		$theme_json->update_with( $diff );
		return $theme_json;
	}
}
