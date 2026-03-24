// renderControl.js

import { TextControl, TextareaControl, Button, PanelBody } from "@wordpress/components";
import { MediaUpload, MediaUploadCheck } from "@wordpress/block-editor";
import { __ } from '@wordpress/i18n';
import { imageFields } from "./meta/imageFields";

/**
 * Generates a form field based on meta field configuration
 * @param {Object} field - Meta field configuration object
 * @param {Object} meta - Current meta values
 * @param {Function} updateMeta - Meta update callback
 * @returns {JSX.Element} Rendered form control
 */
export const renderControl = ( field, meta, updateMeta ) => {
	const value = meta?.[ field.key ] ?? '';

	if ( field.type === 'textarea' ) {
	  return (
		<TextareaControl
		  key={ field.key }
		  label={ field.label }
		  value={ value }
		  onChange={ ( newValue ) => updateMeta( field.key, newValue ) }
		/>
	  );
	}

	// Handle text, url, and other single-line input types
	return (
	  <TextControl
		key={ field.key }
		label={ field.label }
		value={ value }
		onChange={ ( newValue ) => updateMeta( field.key, newValue ) }
	  />
	);
  };
  
/**
 * Handles media selection with proper error handling
 * @param {string} key - Meta field key
 * @param {Object} media - WordPress media object
 * @param {Function} updateMeta - Meta update callback
 */
const handleMediaSelect = ( key, media, updateMeta ) => {
	try {
		// Prioritize source_url for full resolution, fallback to url
		const imageUrl = media?.source_url || media?.url;

		if ( ! imageUrl || typeof imageUrl !== 'string' ) {
			console.warn( `Invalid media selection for field: ${key}` );
			return;
		}

		updateMeta( key, imageUrl );
	} catch ( error ) {
		console.error( `Media upload failed for field ${key}:`, error );
	}
};

/**
 * Generate media image upload controls with preview functionality
 * @param {Object} meta - Current meta values
 * @param {Function} updateMeta - Meta update callback
 * @returns {Array<JSX.Element>} Array of image control panels
 */
export const renderImageControls = ( meta, updateMeta ) => {
	return imageFields.map( ( image ) => {
		const imageUrl = meta?.[ image.key ] || image.fallback;
		const hasImage = imageUrl && imageUrl !== image.fallback;

		return (
			<PanelBody
				key={ image.key }
				title={ __( image.label, 'projects-case-studies' ) }
				initialOpen={ false }
			>
				<MediaUploadCheck>
					<MediaUpload
						onSelect={ ( media ) => handleMediaSelect( image.key, media, updateMeta ) }
						allowedTypes={ [ 'image' ] }
						value={ imageUrl }
						render={ ( { open } ) => (
							<Button
								onClick={ open }
								variant="primary"
								className="image-upload-button"
							>
								{ hasImage
									? __( 'Replace Image', 'projects-case-studies' )
									: __( 'Choose Image', 'projects-case-studies' ) }
							</Button>
						) }
					/>
				</MediaUploadCheck>
				{ hasImage && (
					<div className="image-preview-container">
						<img
							src={ imageUrl }
							alt={ __( `${image.label} Preview`, 'projects-case-studies' ) }
							className="image-preview"
						/>
					</div>
				) }
			</PanelBody>
		);
	} );
};
