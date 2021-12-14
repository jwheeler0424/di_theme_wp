/**
 *  @package diTheme
*/

/*
    ##################################################
    |   LOGIN FORM                                   |
    ##################################################
*/
import { Error } from './errorMessages';
import { showModal, closeModal } from './modal';

export const loginForm = () => {
    const login = document.getElementById('di-login-form');
    const requiredInputs = document.querySelectorAll('[required]');
    const pass1 = document.querySelector( '[name="password"]' );
    const visibleBtn = document.querySelector( 'button.visible' );
    const errorMsg = new Error();

    // If javascript enabled, Disable HTML5 required
    requiredInputs.forEach(input => {
        input.required = false;
    });

    document.querySelectorAll('[data-error]').forEach( field => {
        field.addEventListener('click', function() {
            this.classList.remove('error');
        })
    });

    login.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        resetLogin();

        e.target.querySelector('[name="submit"]').innerHTML = 'Validating...';
        e.target.querySelector('[name="submit"]').disabled = true;

        // Collect all the form data
        const data = {
            username: e.target.querySelector('[name="username"]').value,
            password: e.target.querySelector('[name="password"]').value,
            remember: e.target.querySelector('[name="remember"]').value,
            nonce: e.target.querySelector('[name="di_auth"]').value
        }
        let formInvalid = false;
        let errorHTML = '';

        // Validate Data
        if ( !data.username ) {
            e.target.querySelector('[data-error="username"]').classList.add('error');
            formInvalid = true;
        }

        if ( !data.password ) {
            e.target.querySelector('[data-error="password"]').classList.add('error');
            formInvalid = true;
        }

        if ( formInvalid ) {
            showModal( 'error', 'Error!', errorMsg.getError( 'empty_combo' ) );
            e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
            e.target.querySelector('[name="submit"]').disabled = false;
            return;
        }

        // AJAX http post request
        const url = e.target.dataset.url;
        const params = new URLSearchParams(new FormData(e.target));

        let fetchData = {
            method: "POST",
            body: params
        };

        fetch( url, fetchData )
            .then( res => res.json() )
            .catch( error => { 
                showModal( 'error', 'Error!', errorMsg.getError( 'error' ) );
                e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
                e.target.querySelector('[name="submit"]').disabled = false;
            } )
            .then( response => {
                if ( response === 0 || response.status === 'error' ) {
                    resetLogin();
                    response.message.forEach(error => {
                        errorHTML += errorMsg.getError( error ) + `\n`;
                    });
                    
                    showModal( 'error', 'Error!', errorHTML );
                    e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
                    e.target.querySelector('[name="submit"]').disabled = false;
                    e.target.reset();

                    return;
                }

                showModal( 'success', 'Success!', response.message );
                e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
                e.target.querySelector('[name="submit"]').disabled = false;
                // e.target.reset();
                
                switch (response.user.roles[0]) {
                    case 'administrator':
                        window.location = baseUrl + 'wp-admin/';
                        break;

                    case 'client':
                        window.location = baseUrl + 'client-account/';
                        break;

                    case 'member':
                        window.location = baseUrl + 'member-account/';
                        break;
                }

            } )

    })

    visibleBtn.addEventListener( 'click', (e) => {
        e.preventDefault();
        const visIcon = document.querySelector( 'svg.visible' );
        const nonVisIcon = document.querySelector( 'svg.non-visible' );

        visIcon.classList.toggle( 'hide' );
        nonVisIcon.classList.toggle( 'hide' );

        if ( !visIcon.classList.contains('hide') ) {
            pass1.type = 'text'
            return;
        }

        pass1.type = 'password'

    } );

}

export const registerForm = () => {
    const register = document.getElementById('di-register-form');
    const authInfo = document.querySelector('.auth-info');
    const errorMsg = new Error();

    register.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        resetRegister();

        // Collect all the form data
        const data = {
            username: e.target.querySelector('[name="username"]').value,
            email: e.target.querySelector('[name="email"]').value,
            firstName: e.target.querySelector('[name="first"]').value,
            lastName: e.target.querySelector('[name="last"]').value,
            nonce: e.target.querySelector('[name="di_register"]').value
        }

        // Validate Data

        // AJAX http post request
        const url = e.target.dataset.url;
        const params = new URLSearchParams(new FormData(e.target));

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        let fetchData = {
            method: "POST",
            body: params
        };

        fetch( url, fetchData )
            .then( res => res.json() )
            .catch( error => { 
                authInfo.innerHTML = errorMsg.getError( 'error' );
            } )
            .then( response => {
                if ( response === 0 || response.status === 'error' ) {
                    resetRegister();
                    response.message.forEach(error => {
                        authInfo.innerHTML += errorMsg.getError( error ) + `\n`;
                    });
                    
                    authInfo.classList.add( 'error' );
                    return;
                }
                
                authInfo.innerHTML = response.message;
                window.location = baseUrl + 'member-login/?registered=' + data.username;

            } )

    });
}

export const lostPasswordForm = () => {
    const lostPassword = document.getElementById('di-lost-password-form');
    const authInfo = document.querySelector('.auth-info');
    const errorMsg = new Error();

    lostPassword.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        resetLostPassword();

        // Collect all the form data
        const data = {
            email: e.target.querySelector('[name="email"]').value,
            nonce: e.target.querySelector('[name="di_lost_password"]').value
        }

        // Validate Data

        // AJAX http post request
        const url = e.target.dataset.url;
        const params = new URLSearchParams(new FormData(e.target));

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        let fetchData = {
            method: "POST",
            body: params
        };

        fetch( url, fetchData )
            .then( res => res.json() )
            .catch( error => { 
                authInfo.innerHTML = errorMsg.getError( 'error' );
            } )
            .then( response => {
                console.log(response);
                if ( response === 0 || response.status === 'error' ) {
                    resetLostPassword();
                    response.message.forEach(error => {
                        authInfo.innerHTML += errorMsg.getError( error ) + `\n`;
                    });
                    
                    authInfo.classList.add( 'error' );
                    return;
                }
                
                authInfo.innerHTML = response.message;
                window.location = baseUrl + 'member-login/?checkmail=confirm';

            } )

    });
}

export const resetPasswordForm = () => {
    const resetPassword = document.getElementById( 'di-reset-password-form' );
    const authInfo = document.querySelector( '.auth-info' );
    const errorMsg = new Error();
    const pass1 = document.querySelector( '[name="pass1"]' );
    const pass2 = document.querySelector( '[name="pass2"]' );
    const submitBtn = document.querySelector( '[name="submit"]' );
    const visibleBtn = document.querySelector( 'button.visible' );
    
    submitBtn.disabled = true;
    const blackListAr = [];

    resetPassword.addEventListener( 'submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        resetResetPassword();

        // Collect all the form data
        const data = {
            pass1:  e.target.querySelector('[name="pass1"]').value,
            pass2:  e.target.querySelector('[name="pass2"]').value,
            rp_key: e.target.querySelector('[name="rp_key"]').value,
            rp_login: e.target.querySelector('[name="rp_login"]').value,
            nonce: e.target.querySelector('[name="di_reset_password"]').value
        }

        // Validate Data

        // AJAX http post request
        const url = e.target.dataset.url;
        const params = new URLSearchParams(new FormData(e.target));

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        let fetchData = {
            method: "POST",
            body: params
        };

        fetch( url, fetchData )
            .then( res => res.json() )
            .catch( error => { 
                authInfo.innerHTML = errorMsg.getError( 'error' );
            } )
            .then( response => {
                console.log(response);
                if ( response === 0 || response.status === 'error' ) {
                    resetResetPassword();
                    response.message.forEach(error => {
                        authInfo.innerHTML += errorMsg.getError( error ) + `\n`;
                    });
                    
                    authInfo.classList.add( 'error' );
                    return;
                }
                
                authInfo.innerHTML = response.message;
                window.location = baseUrl + 'member-login/?password=changed';

            } )

    } );

    
    pass1.addEventListener( 'keyup', (e) => {
        checkPasswordStrength( pass1, blackListAr );
    } );

    pass2.addEventListener( 'keyup', (e) => {
        checkPasswordMatch( pass1, pass2, blackListAr );
    } );

    visibleBtn.addEventListener( 'click', (e) => {
        e.preventDefault();
        const visIcon = document.querySelector( 'svg.visible' );
        const nonVisIcon = document.querySelector( 'svg.non-visible' );

        visIcon.classList.toggle( 'hide' );
        nonVisIcon.classList.toggle( 'hide' );

        if ( !visIcon.classList.contains('hide') ) {
            pass1.type = 'text'
            return;
        }

        pass1.type = 'password'

    } );

}

const getUrl = window.location;
const baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

const resetLogin = () => {
    // Reset all the messages
    document.querySelector('[name="submit"]').innerHTML = 'Sign In';
    document.querySelector('[name="submit"]').disabled = false;
    document.querySelectorAll('[data-error]').forEach( field => field.classList.remove('error') );
    document.querySelector('.js-form-submission').classList.remove('show');
    closeModal();
}

const resetRegister = () => {
    // Reset all the messages
    const register = document.getElementById('di-register-form');
    const authInfo = document.querySelector('.auth-info');
    authInfo.innerHTML = '';
    register.querySelector('[name="submit"]').innerHTML = 'Register';
    register.querySelector('[name="submit"]').disabled = false;
}

const resetLostPassword = () => {
    // Reset all the messages
    const lostPassword = document.getElementById('di-lost-password-form');
    const authInfo = document.querySelector('.auth-info');
    authInfo.innerHTML = '';
    lostPassword.querySelector('[name="submit"]').innerHTML = 'Reset Password';
    lostPassword.querySelector('[name="submit"]').disabled = false;
}

const resetResetPassword = () => {
    // Reset all the messages
    const resetPassword = document.getElementById('di-reset-password-form');
    const authInfo = document.querySelector('.auth-info');
    authInfo.innerHTML = '';
    resetPassword.querySelector('[name="submit"]').innerHTML = 'Reset Password';
    resetPassword.querySelector('[name="submit"]').disabled = false;
}

const checkPasswordStrength = ( pass, blackListAr ) => {
    const strength = zxcvbn(pass.value, blackListAr);
    const strengthMeter = document.querySelector( '#password-strength' );
    pass.classList.remove( 'bad', 'weak', 'warning', 'strong' );
    strengthMeter.classList.remove( 'bad', 'weak', 'warning', 'strong' );

    if ( pass.value === '' ) {
        strengthMeter.style.display = 'none';
        strengthMeter.innerHTML = '';
        return strength;
    }
            
    switch ( strength.score) {

        case 1:
            pass.classList.add( 'bad' );
            strengthMeter.classList.add( 'bad' );
            strengthMeter.innerHTML = 'Unacceptable';
            strengthMeter.style.display = 'block';
            break;

        case 2:
            pass.classList.add( 'weak' );
            strengthMeter.classList.add( 'weak' );
            strengthMeter.innerHTML = 'Weak';
            strengthMeter.style.display = 'block';
            break;
        
        case 3:
            pass.classList.add( 'warning' );
            strengthMeter.classList.add( 'warning' );
            strengthMeter.innerHTML = 'Acceptable';
            strengthMeter.style.display = 'block';
            break;
        
        case 4:
            pass.classList.add( 'strong' );
            strengthMeter.classList.add( 'strong' );
            strengthMeter.innerHTML = 'Strong';
            strengthMeter.style.display = 'block';
            break;
    
        default:
            pass.classList.add( 'bad' );
            strengthMeter.classList.add( 'bad' );
            strengthMeter.innerHTML = 'Unacceptable';
            strengthMeter.style.display = 'block';
            break;

    }

    return strength;
}

const checkPasswordMatch = ( pass1, pass2, blackListAr ) => {
    const strength = zxcvbn(pass2.value, blackListAr);
    const submitBtn = document.querySelector( '[name="submit"]' );
    pass2.classList.remove( 'bad', 'weak', 'warning', 'strong' );
            
    if ( pass1.value !== pass2.value ) {
        pass2.classList.add( 'bad' );
        submitBtn.disabled = true;
        return strength;
    }

    if ( pass2.value === '' ) {
        return strength;
    }

    switch ( strength.score) {

        case 1:
            pass2.classList.add( 'bad' );
            submitBtn.disabled = true;
            break;

        case 2:
            pass2.classList.add( 'weak' );
            submitBtn.disabled = false;
            break;
        
        case 3:
            pass2.classList.add( 'warning' );
            submitBtn.disabled = false;
            break;
        
        case 4:
            pass2.classList.add( 'strong' );
            submitBtn.disabled = false;
            break;
    
        default:
            pass2.classList.add( 'bad' );
            submitBtn.disabled = true;
            break;

    }

    return strength;
}