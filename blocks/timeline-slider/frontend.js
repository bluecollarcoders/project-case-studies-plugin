// blocks/timeline-slider/frontend.js

import './style.css';     // emits style-project-slider-frontend.css
import $ from 'jquery';
import 'slick-carousel';  // slick.js from npm

jQuery( document ).ready( () => {
  jQuery( '.project-timeline-slider' ).slick({
    slidesToShow:   3,
    slidesToScroll: 1,
    infinite:       true,
    arrows:         true,
    autoplay:       jQuery( '.project-timeline-slider' ).data( 'autoplay' ) === 'true',
    responsive: [
      { breakpoint: 768, settings: { slidesToShow: 1 } },
      { breakpoint: 1024, settings: { slidesToShow: 2 } },
    ],
  });
} );
