(function ($) {

  $('.card-slider-wrap').slick({
    infinite: true,
    autoplay: true,
    arrows: false,
    dots: true,
    slidesToShow: 3,
    pauseOnHover: false,
    centerMode: false,
    responsive: [
      {
        breakpoint: 990,
        settings: {
          slidesToShow: 2,
          autoplay: true,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          autoplay: true,
          slidesToScroll: 1,
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 1,
          autoplay: true,
          slidesToScroll: 1,
        }
      }
    ]
  });


  $(".wprm-recipe-template-snippet-basic-buttons").insertAfter(".single .entry-header");

})(jQuery);


const  focusableElements =
    'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';
const modal = document.querySelector('#mobile-menu-wrap'); // select the modal by it's id

const firstFocusableElement = modal.querySelectorAll(focusableElements)[0]; // get first element to be focused inside modal
const focusableContent = modal.querySelectorAll(focusableElements);
const lastFocusableElement = focusableContent[focusableContent.length - 1]; // get last element to be focused inside modal


document.addEventListener('keydown', function(e) {
  let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

  if (!isTabPressed) {
    return;
  }

  if (e.shiftKey) { // if shift key pressed for shift + tab combination
    if (document.activeElement === firstFocusableElement) {
      lastFocusableElement.focus(); // add focus for the last focusable element
      e.preventDefault();
    }
  } else { // if tab key is pressed
    if (document.activeElement === lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
      firstFocusableElement.focus(); // add focus for the first focusable element
      e.preventDefault();
    }
  }
});

firstFocusableElement.focus();