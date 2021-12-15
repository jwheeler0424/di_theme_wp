/**
 *  @package diTheme
*/

/*
    ##################################################
    |   USER AUTHENTICATION AJAX & VALIDATION        |
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
        e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
        resetMessages();
        showModal( 'loading', 'Validating...', '' );

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
                    e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
                    resetMessages();
                    response.message.forEach(error => {
                        errorHTML += errorMsg.getError( error ) + `\n\n`;
                    });
                    
                    showModal( 'error', 'Error!', errorHTML );
                    e.target.querySelector('[name="submit"]').innerHTML = 'Sign In';
                    e.target.querySelector('[name="submit"]').disabled = false;
                    return;
                }
                
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
    const requiredInputs = document.querySelectorAll('[required]');
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

    register.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        e.target.querySelector('[name="submit"]').innerHTML = 'Register';
        resetMessages();
        showModal( 'loading', 'Processing...', '' );

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        // Collect all the form data
        const data = {
            username: e.target.querySelector('[name="username"]').value,
            email: e.target.querySelector('[name="email"]').value,
            firstName: e.target.querySelector('[name="first"]').value,
            lastName: e.target.querySelector('[name="last"]').value,
            nonce: e.target.querySelector('[name="di_register"]').value
        }
        let formInvalid = false;
        let errorHTML = '';

        // Validate Data
        if ( !data.username ) {
            e.target.querySelector('[data-error="username"]').classList.add('error');
            errorHTML += errorMsg.getError( 'empty_username' ) + `\n\n`;
            formInvalid = true;
        }

        if ( !data.email ) {
            e.target.querySelector('[data-error="email"]').classList.add('error');
            errorHTML += errorMsg.getError( 'empty_email' ) + `\n\n`;
            formInvalid = true;
        }

        if ( !data.firstName ) {
            e.target.querySelector('[data-error="first"]').classList.add('error');
            errorHTML += errorMsg.getError( 'empty_first' ) + `\n\n`;
            formInvalid = true;
        }

        if ( !data.lastName ) {
            e.target.querySelector('[data-error="last"]').classList.add('error');
            errorHTML += errorMsg.getError( 'empty_last' );
            formInvalid = true;
        }

        if ( formInvalid ) {
            showModal( 'error', 'Error!', errorHTML );
            e.target.querySelector('[name="submit"]').innerHTML = 'Register';
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
                e.target.querySelector('[name="submit"]').innerHTML = 'Register';
                e.target.querySelector('[name="submit"]').disabled = false;
                grecaptcha.reset();
            } )
            .then( response => {
                showModal( 'loading', 'Processing...', '' );
                if ( response === 0 || response.status === 'error' ) {
                    e.target.querySelector('[name="submit"]').innerHTML = 'Register';
                    resetMessages();
                    response.message.forEach(error => {
                        errorHTML += errorMsg.getError( error ) + `\n\n`;
                    });
                    
                    showModal( 'error', 'Error!', errorHTML );
                    e.target.querySelector('[name="submit"]').innerHTML = 'Register';
                    e.target.querySelector('[name="submit"]').disabled = false;
                    grecaptcha.reset();
                    return;
                }
                
                window.location = baseUrl + 'member-login/?registered=' + data.username;

            } )

    });
}

export const lostPasswordForm = () => {
    const lostPassword = document.getElementById('di-lost-password-form');
    const requiredInputs = document.querySelectorAll('[required]');
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

    lostPassword.addEventListener('submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
        resetMessages();
        showModal( 'loading', 'Processing...', '' );

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        // Collect all the form data
        const data = {
            email: e.target.querySelector('[name="email"]').value,
            nonce: e.target.querySelector('[name="di_lost_password"]').value
        }
        let formInvalid = false;
        let errorHTML = '';

        // Validate Data
        if ( !data.email ) {
            e.target.querySelector('[data-error="email"]').classList.add('error');
            errorHTML += errorMsg.getError( 'empty_email' );
            formInvalid = true;
        }

        if ( formInvalid ) {
            showModal( 'error', 'Error!', errorHTML );
            e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
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
                e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                e.target.querySelector('[name="submit"]').disabled = false;
            } )
            .then( response => {
                console.log(response);
                if ( response === 0 || response.status === 'error' ) {
                    e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                    resetMessages();
                    response.message.forEach(error => {
                        errorHTML += errorMsg.getError( error ) + `\n\n`;
                    });
                    
                    showModal( 'error', 'Error!', errorHTML );
                    e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                    e.target.querySelector('[name="submit"]').disabled = false;
                    return;
                }
                
                window.location = baseUrl + 'member-login/?checkmail=confirm';

            } )

    });
}

export const resetPasswordForm = () => {
    const resetPassword = document.getElementById( 'di-reset-password-form' );
    const requiredInputs = document.querySelectorAll('[required]');
    const errorMsg = new Error();
    const pass1 = document.querySelector( '[name="pass1"]' );
    const pass2 = document.querySelector( '[name="pass2"]' );
    const submitBtn = document.querySelector( '[name="submit"]' );
    const visibleBtn = document.querySelector( 'button.visible' );
    
    const blackListAr = [];

    // If javascript enabled, Disable HTML5 required
    requiredInputs.forEach(input => {
        input.required = false;
    });

    document.querySelectorAll('[data-error]').forEach( field => {
        field.addEventListener('click', function() {
            this.classList.remove('error');
        })
    });

    resetPassword.addEventListener( 'submit', (e) => {
        e.preventDefault();

        // Reset the form messages
        e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
        resetMessages();
        showModal( 'loading', 'Processing...', '' );

        e.target.querySelector('[name="submit"]').innerHTML = 'Processing...';
        e.target.querySelector('[name="submit"]').disabled = true;

        // Collect all the form data
        const data = {
            pass1:  e.target.querySelector('[name="pass1"]').value,
            pass2:  e.target.querySelector('[name="pass2"]').value,
            rp_key: e.target.querySelector('[name="rp_key"]').value,
            rp_login: e.target.querySelector('[name="rp_login"]').value,
            nonce: e.target.querySelector('[name="di_reset_password"]').value
        }
        let formInvalid = false;
        let errorHTML = '';

        // Validate Data
        if ( !data.pass1 ) {
            e.target.querySelector('[data-error="pass1"]').classList.add('error');
            errorHTML += errorMsg.getError( 'password_reset_empty' ) + `\n\n`;
            formInvalid = true;
        }

        if ( checkPasswordStrength(pass1).score <=2 ) {
            e.target.querySelector('[data-error="pass1"]').classList.add('error');
            errorHTML += errorMsg.getError( 'weak_password' ) + `\n\n`;
            formInvalid = true;
        }

        if ( data.pass1 !== data.pass2 ) {
            e.target.querySelector('[data-error="pass2"]').classList.add('error');
            errorHTML += errorMsg.getError( 'password_reset_mismatch' ) + `\n\n`;
            formInvalid = true;
        }

        if ( formInvalid ) {
            showModal( 'error', 'Error!', errorHTML );
            e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
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
                e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                e.target.querySelector('[name="submit"]').disabled = false;
            } )
            .then( response => {
                if ( response === 0 || response.status === 'error' ) {
                    e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                    resetMessages();
                    response.message.forEach(error => {
                        errorHTML += errorMsg.getError( error ) + `\n\n`;
                    });
                    
                    showModal( 'error', 'Error!', errorHTML );
                    e.target.querySelector('[name="submit"]').innerHTML = 'Reset Password';
                    e.target.querySelector('[name="submit"]').disabled = false;
                    console.log(response.message);
                    if ( response.message.includes('expiredkey') || response.message.includes('invalidkey') ) {
                        window.location = baseUrl + 'member-password-lost/?errors=' + response.message.join(',')
                    }
                    return;
                }
                
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

const resetMessages = () => {
    // Reset all the messages
    document.querySelector('[name="submit"]').disabled = false;
    document.querySelectorAll('[data-error]').forEach( field => field.classList.remove('error') );
    document.querySelector('.js-form-submission').classList.remove('show');
    closeModal();
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
    pass2.classList.remove( 'bad', 'weak', 'warning', 'strong' );
            
    if ( pass1.value !== pass2.value ) {
        pass2.classList.add( 'bad' );
        return strength;
    }
    
    switch ( strength.score) {

        case 1:
            pass2.classList.add( 'bad' );
            break;

        case 2:
            pass2.classList.add( 'weak' );
            break;
        
        case 3:
            pass2.classList.add( 'warning' );
            break;
        
        case 4:
            pass2.classList.add( 'strong' );
            break;
    
        default:
            pass2.classList.add( 'bad' );
            break;

    }

    return strength;
}