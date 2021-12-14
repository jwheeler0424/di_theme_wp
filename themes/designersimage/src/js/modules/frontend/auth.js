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
    const authInfo = document.querySelector('.auth-info');
    const errorMsg = new Error();

    login.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        resetLogin();

        // Collect all the form data
        const data = {
            username: e.target.querySelector('[name="username"]').value,
            password: e.target.querySelector('[name="password"]').value,
            remember: e.target.querySelector('[name="remember"]').value,
            nonce: e.target.querySelector('[name="di_auth"]').value
        }

        // Validate Data
        if ( !data.username || !data.password ) {
            authInfo.innerHTML = errorMsg.getError( 'empty-combo' );
            authInfo.classList.add( 'error' );
            return;
        }

        // AJAX http post request
        const url = e.target.dataset.url;
        const params = new URLSearchParams(new FormData(e.target));

        e.target.querySelector('[name="submit"]').innerHTML = 'Validating...';
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
                    resetLogin();
                    response.message.forEach(error => {
                        authInfo.innerHTML += errorMsg.getError( error ) + `\n`;
                    });
                    
                    authInfo.classList.add( 'error' );
                    e.target.reset();

                    return;
                }
                
                authInfo.innerHTML = response.message;
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
        checkPasswordStrength( pass1, pass2, blackListAr );
    } );


}

const getUrl = window.location;
const baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

const resetLogin = () => {
    // Reset all the messages
    const login = document.getElementById('di-login-form');
    const authInfo = document.querySelector('.auth-info');
    authInfo.innerHTML = '';
    login.querySelector('[name="submit"]').innerHTML = 'Sign In';
    login.querySelector('[name="submit"]').disabled = false;
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

const checkPasswordStrength = ( pass1, blackListAr ) => {
    // blackListAr.concat(  );
    const strength = zxcvbn(pass1.value);
    const strengthMeter = document.querySelector( '#password-strength' );
    strengthMeter.classList.remove( 'short', 'bad', 'good', 'strong' );
    console.log(strength);

    switch ( strength.score) {

        case 1:
            strengthMeter.classList.add( 'bad' );
            strengthMeter.innerHTML = 'Bad';
            break;

        case 2:
            strengthMeter.classList.add( 'weak' );
            strengthMeter.innerHTML = 'Weak';
            break;
        
        case 3:
            strengthMeter.classList.add( 'good' );
            strengthMeter.innerHTML = 'Good';
            break;
        
        case 4:
            strengthMeter.classList.add( 'strong' );
            strengthMeter.innerHTML = 'Strong';
            break;
    
        default:
            strengthMeter.classList.add( 'bad' );
            strengthMeter.innerHTML = 'Bad';
            break;

    }

    return strength;

}