/**
 *  @package diTheme
*/

import contactForm from './modules/frontend/contact';
import testimonialForm from './modules/frontend/testimonial';
import { loginForm, lostPasswordForm, registerForm, resetPasswordForm } from './modules/frontend/auth';

ready((event) => {
    
    // Load Contact Form JS
    const contact = document.querySelector('#di-contact-form');
    if (contact) {
        contactForm();
    }

    // Load Login Form JS
    const login = document.querySelector('#di-login-form');
    if (login) {
        loginForm();
    }
    
    // Load Lost Password Form JS
    const lostPassword = document.querySelector('#di-lost-password-form');
    if (lostPassword) {
        lostPasswordForm();
    }
    
    // Load Registration Form JS
    const register = document.querySelector('#di-register-form');
    if (register) {
        registerForm();
    }
    
    // Load Reset Password Form JS
    const resetPassword = document.querySelector('#di-reset-password-form');
    if (resetPassword) {
        resetPasswordForm();
    }
    
    // Load Testimonial Form JS
    const testimonial = document.querySelector('#di-testimonial-form');
    if (testimonial) {
        testimonialForm();
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