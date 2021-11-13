/**
 *  @package diTheme
*/

import { menuToggle, pageTop, titleHover } from './modules/frontend/menu';
import slider from './modules/frontend/slider';

ready((event) => {

    // Load Menu Toggle
    menuToggle();

    // Load Title Rollover
    titleHover();

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