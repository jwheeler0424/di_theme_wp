/**
 *  @package diTheme
*/

ready((event) => {

});

// global variables
const sliderView = document.querySelector('.di-slider--view > ul');
const sliderViewSlides = document.querySelectorAll('.di-slider--view__slides');
const arrowLeft = document.querySelector('.di-slider--arrows__left');
const arrowRight = document.querySelector('.di-slider--arrows__right');
const sliderLength = sliderViewSlides.length;

// sliding function
const slider = ( sliderViewItems, isActiveItem ) => {
    // update the classes
    isActiveItem.classList.remove('is-active');
    sliderViewItems.classList.add('is-active');

    // css transform the active slide position
    sliderView.setAttribute('style', `transform:translateX(-${sliderViewItems.offsetLeft}px)`)
}

// before sliding function
const beforeSliding = (i) => {
    let isActiveItem = document.querySelector('.di-slider--view__slides.is-active');
    let currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i;
    let nextItem = currentItem + i;
    let sliderViewItems = document.querySelector(`.di-slider--view__slides:nth-child(${nextItem})`);

    if (nextItem > sliderLength) {
        sliderViewItems = document.querySelector('.di-slider--view__slides:nth-child(1)');
    }

    if (nextItem == 0) {
        sliderViewItems = document.querySelector(`.di-slider--view__slides:nth-child(${sliderLength})`);
    }

    slider( sliderViewItems, isActiveItem );
}

// triggers arrows
arrowRight.addEventListener( 'click', () => beforeSliding(1) );
arrowLeft.addEventListener( 'click', () => beforeSliding(0) );

/*
    ##################################################
    |   DOCUMENT READY FUNCTION                      |
    ##################################################
*/
function ready(callbackFunction) {
    if(document.readyState != 'loading') {
        callbackFunction(event);
    } else {
        document.addEventListener("DOMContentLoaded", callbackFunction);
    }
}