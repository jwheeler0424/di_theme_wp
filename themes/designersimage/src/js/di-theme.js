/**
 *  @package diTheme
*/

import { menuToggle, pageTop } from './modules/frontend/menu';
import slider from './modules/frontend/slider';

ready((event) => {

    // Load Menu Toggle
    menuToggle();

    // Load Top of Page
    pageTop();

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