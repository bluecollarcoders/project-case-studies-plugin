// blocks/timeline-slider/save.js
import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function Save({ attributes }) {
  const { slides, autoplay, textColor, titleTransform } = attributes;
  const blockProps = useBlockProps.save({
    className: 'project-timeline-slider',
    'data-autoplay': autoplay ? 'true' : 'false',
  });

  return (
    <div { ...blockProps }>
      { slides.map( ( slide, i ) => (
        <div className="timeline-slide" key={ i }>
          { slide.imageUrl && (
            <img
              className="timeline-slide__image"
              src={ slide.imageUrl }
              alt={ slide.title || '' }
            />
          ) }

          <RichText.Content
            tagName="h3"
            className="timeline-slide__title"
            value={ slide.title }
            style={{
              color: textColor,
              textTransform: titleTransform,
            }}
          />

          <RichText.Content
            tagName="p"
            className="timeline-slide__copy"
            value={ slide.copy }
          />
        </div>
      ) ) }
    </div>
  );
}
