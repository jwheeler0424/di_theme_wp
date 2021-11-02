/**
 *  @package diTheme
*/

import contactForm from './modules/contact';
import testimonialForm from './modules/testimonial';

ready((event) => {
    
    // Load Contact Form JS
    const contact = document.querySelector('#di-contact-form');
    if (contact) {
        contact.addEventListener('submit', (e) => {
            contactForm(e, contact);
        });
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