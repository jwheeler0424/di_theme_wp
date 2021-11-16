/**
 *  @package diTheme
*/

import slider from './modules/frontend/slider';
import { homeParallax } from './modules/frontend/parallax'
import { menuToggle, pageTop, titleHover } from './modules/frontend/menu';


ready((event) => {

    // Load Menu Toggle
    menuToggle();

    // Load Title Rollover
    titleHover();

    // Load Home Parallax
    homeParallax();

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