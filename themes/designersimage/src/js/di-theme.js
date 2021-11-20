/**
 *  @package diTheme
*/

import { carousel, slider } from './modules/frontend/animations';
import { adjustHeight } from './modules/frontend/pages';
import { menuToggle, pageTop, titleHover } from './modules/frontend/menu';


ready((event) => {

    // Load Menu Toggle
    menuToggle();

    // Load Title Rollover
    titleHover();

    // Adjust Page Height on load and rotate
    adjustHeight();

    // Load Top of Page Action
    pageTop();

    // Load carousel JS
    carousel();

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