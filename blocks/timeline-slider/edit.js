import { __ } from '@wordpress/i18n';
import {
  useBlockProps,
  MediaUpload,
  MediaUploadCheck,
  InspectorControls,
  RichText,
  PanelColorSettings,
} from '@wordpress/block-editor';
import {
  PanelBody,
  ToggleControl,
  SelectControl,
  Button,
} from '@wordpress/components';

export default function Edit( { attributes, setAttributes } ) {
  const { slides, autoplay } = attributes;
  const blockProps = useBlockProps({
    className: 'project-timeline-slider-editor',
  });

  const updateSlideField = ( index, field, value ) => {
    const newSlides = [ ...slides ];
    newSlides[ index ] = { ...newSlides[ index ], [ field ]: value };
    setAttributes({ slides: newSlides });
  };

  return (
    <>
      <InspectorControls>
        <PanelBody title={ __( 'Carousel Settings', 'project-case-studies' ) }>
          <ToggleControl
            label={ __( 'Autoplay', 'project-case-studies' ) }
            checked={ autoplay }
            onChange={ ( val ) => setAttributes({ autoplay: val }) }
          />
        </PanelBody>
        <PanelColorSettings
          title={ __( 'Text Color', 'project-case-studies' ) }
          initialOpen
          colorSettings={[
            {
              value: attributes.textColor,
              onChange: (color) => setAttributes({ textColor: color}),
              label: __( 'Slider Title Color', 'project-case-studies' ),
            }
          ]}
        />
        <PanelBody title="Text Transform" initialOpen={ false }>
          <SelectControl
            label="Title Transform"
            value={ attributes.titleTransform }
            options={[
              { label: 'None',       value: 'none' },
              { label: 'Uppercase',  value: 'uppercase' },
              { label: 'Lowercase',  value: 'lowercase' },
            ]}
            onChange={ (val) => setAttributes({ titleTransform: val }) }
          />
        </PanelBody>
      </InspectorControls>

      <div { ...blockProps }>
        { slides.map( ( slide, i ) => (
          <div className="timeline-slide-editor" key={ i }>
            <MediaUploadCheck>
              <MediaUpload
                allowedTypes={ [ 'image' ] }
                value={ slide.imageId }
                onSelect={ ( media ) => {
                  const newSlides = [ ...slides ];
                  newSlides[ i ] = {
                    ...newSlides[ i ],
                    imageUrl: media.url,
                    imageId:  media.id,
                  };
                  setAttributes({ slides: newSlides });
                } }
                render={ ( { open } ) => (
                  <Button onClick={ open } isSecondary>
                    { slide.imageUrl
                      ? <img
                          src={ slide.imageUrl }
                          alt={ __( 'Slide image', 'project-case-studies' ) }
                          style={ { maxWidth: '100%' } }
                        />
                      : __( 'Select Image', 'project-case-studies' )
                    }
                  </Button>
                ) }
              />
            </MediaUploadCheck>

            <RichText
              tagName="h3"
              placeholder={ __( 'Slide Title...', 'project-case-studies' ) }
              value={ slide.title }
              onChange={ ( val ) => updateSlideField( i, 'title', val ) }
              allowedFormats={ ['core/bold', 'core/italic', 'core/text-color'] }
              style={{
                color: attributes.textColor,
                textTransform: attributes.titleTransform
              }}
            />
            <RichText
              tagName="p"
              placeholder={ __( 'Slide Copy...', 'project-case-studies' ) }
              value={ slide.copy }
              onChange={ ( val ) => updateSlideField( i, 'copy', val ) }
              allowedFormats={ ['core/bold', 'core/italic', 'core/text-color'] }
              style={{
                color: attributes.textColor,
                textTransform: attributes.titleTransform
              }}
            />
          </div>
        ) ) }
      </div>
    </>
  );
}
