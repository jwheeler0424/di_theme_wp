/**
 *  @package diTheme
*/

import { modal } from './modules/frontend/modal';
import { adjustHeight } from './modules/frontend/pages';
import { carousel, slider } from './modules/frontend/animations';
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

    // Load Modal JS
    modal();

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