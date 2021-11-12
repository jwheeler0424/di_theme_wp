/**
 *  @package diTheme
*/

import loginForm from './modules/frontend/auth';
import menuToggle from './modules/frontend/menu';
import slider from './modules/frontend/slider';

ready((event) => {

    // Load Menu Toggle
    menuToggle();

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