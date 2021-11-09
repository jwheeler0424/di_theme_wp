/**
 *  @package diTheme
*/

import { sanitizePhone } from './modules/admin/contactInfo';

ready((event) => {
    
    // Load Contact Info Form JS
    const contactInfo = document.querySelector('#admin-contact-info');
    if (contactInfo) {
        contactInfo.addEventListener('submit', (e) => {
            sanitizePhone(contactInfo);
        });
    }

})


/*
    ##################################################
    |   Document Ready Function                      |
    ##################################################
*/
function ready(callbackFunction){
    if(document.readyState != 'loading') {
        callbackFunction(event);
    } else {
        document.addEventListener("DOMContentLoaded", callbackFunction);
    }
}