/**
 *  @package diTheme
*/

import contactForm from './modules/frontend/contact';
import testimonialForm from './modules/frontend/testimonial';

ready((event) => {
    
    // Load Contact Form JS
    const contact = document.querySelector('#di-contact-form');
    if (contact) {
        contactForm();
    }
    
    // Load Testimonial Form JS
    const testimonial = document.querySelector('#di-testimonial-form');
    
    if (testimonial) {
        
        testimonial.addEventListener('submit', (e) => {
            testimonialForm(e, testimonial);
        });
    } 

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