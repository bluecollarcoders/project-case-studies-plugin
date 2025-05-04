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
		add_filter( 'wp_theme_json_data_theme', [ $this, 'pcs_inject_json' ] );
	}

	/**
	 * Merge the plugin's theme.json into the theme context.
	 *
	 * @param \WP_Theme_JSON $theme_json Theme JSON object.
	 * @return \WP_Theme_JSON
	 */
	public function pcs_inject_json( $theme_json ) {
		$current_data     = $theme_json->get_data();
		$existing_palette = $current_data['settings']['color']['palette']['theme'] ?? [];
	
		$new_data = [
			'version'  => 3,
			'settings' => [
				'layout'  => [
					'contentSize' => '800px',
					'wideSize'    => '1200px',
				],
				'spacing' => [
					'spacingScale' => [ 'steps' => 10 ],
					'units'        => [ 'rem', 'px' ],
					'blockGap'     => true,
				],
				'color'   => [
					'palette' => [
						'theme' => array_merge(
							$existing_palette,
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
	
		$theme_json->update_with( $new_data );
		return $theme_json;
	}
}
