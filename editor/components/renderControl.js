// renderControl.js

import { TextControl, TextareaControl, Button, PanelBody } from "@wordpress/components";
import { MediaUpload, MediaUploadCheck } from "@wordpress/block-editor";
import { __ } from '@wordpress/i18n';
import { imageFields } from "./meta/imageFields";

/**
 * Generates a form field based on meta type
 */
export const renderControl = ( field, meta, updateMeta ) => {
	const value = meta?.[ field.key ] ?? '';
  
	if ( field.type === 'textarea' ) {
		console.log('Render field:', field.key, '→', value);

	  return (
		<TextareaControl
		  key={ field.key }
		  label={ field.label }
		  value={ value }
		  onChange={ ( newValue ) => updateMeta( field.key, newValue ) }
		/>
	  );
	}
  
	// everything else (url, text, etc)
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
   * Generate media image upload + preview blocks
   */
  export const renderImageControls = ( meta, updateMeta ) => {
  
	return imageFields.map( ( image ) => {
	const imageUrl = meta?.[ image.key ] || image.fallback;
  
	  return (
		<PanelBody
		  key={ image.key }
		  title={ __( image.label, 'projects-case-studies' ) }
		  initialOpen={ false }
		>
		  <MediaUploadCheck>
			<MediaUpload
			  onSelect={ ( media ) => updateMeta( image.key, media?.source_url || media?.url ) }
			  allowedTypes={ [ 'image' ] }
			  value={ imageUrl }
			  render={ ( { open } ) => (
				<Button onClick={ open } variant="primary">
				  { imageUrl
					? __( 'Replace Image', 'projects-case-studies' )
					: __( 'Choose Image',  'projects-case-studies' ) }
				</Button>
			  ) }
			/>
		  </MediaUploadCheck>
		  { imageUrl && (
			<div style={ { marginTop: '1em' } }>
			  <img
				src={ imageUrl }
				alt={ __( `${ image.label } Preview`, 'projects-case-studies' ) }
				style={ { width: '100%', borderRadius: '6px', border: '1px solid #ccc' } }
			  />
			</div>
		  ) }
		</PanelBody>
	  );
	} );
};
