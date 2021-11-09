/**
 *  @package diTheme
*/

import loginForm from './modules/frontend/auth';
import slider from './modules/frontend/slider';

ready((event) => {

    // Load Login Auth Form
    loginForm();

    // Load slider JS
    slider();
    
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