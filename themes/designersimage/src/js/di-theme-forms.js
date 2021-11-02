/**
 *  @package diTheme
*/
import testimonialForm from './modules/testimonial';

ready((event) => {

    // Load Testimonial Form JS
    testimonialForm();

})

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