/**
 *  @package diTheme
*/

/*
    ##################################################
    |   ERROR MESSAGE CLASS                          |
    ##################################################
*/

const getUrl = window.location;
const baseUrl = getUrl.protocol + "//" + getUrl.host + "/";

export class Error 
{
    constructor() {
        this.errors = [
            {
                code: 'captcha',
                message: 'The Google reCAPTCHA check failed. Are you a robot?'
            },
            {
                code: 'closed',
                message: 'Registering new users is currently not allowed.'
            },
            {
                code: 'email',
                message: 'The email address you entered is not valid.'
            },
            {
                code: 'email_exists',
                message: 'An account already exists with this email address.'
            },
            {
                code: 'empty_combo',
                message: 'You must provide a username and password.'
            },
            {
                code: 'empty_email',
                message: 'You must provide a valid email address.'
            },
            {
                code: 'empty_first',
                message: 'You must provide a first name.'
            },
            {
                code: 'empty_last',
                message: 'You must provide a last name.'
            },
            {
                code: 'empty_password',
                message: 'You need to enter a password to continue.'
            },
            {
                code: 'empty_username',
                message: 'You must provide a unique username.'
            },
            {
                code: 'error',
                message: 'There is currently an unknown error. Please try again later.'
            },
            {
                code: 'expiredkey',
                message: 'The password reset link you used is no longer valid.'
            },
            {
                code: 'invalidkey',
                message: 'The password reset link you used is no longer valid.'
            },
            {
                code: 'invalid_email',
                message: 'There are no users registered with this email address.'
            },
            {
                code: 'invalid_combo',
                message: 'There are no users registered with this email address.'
            },
            {
                code: 'invalid_login',
                message: 'Incorrect username and/or password.'
            },
            {
                code: 'invalid_request',
                message: 'You must provide a password with matching confirmation.'
            },
            {
                code: 'invalid_username',
                message: 'We don\'t have any users with that username.'
            },
            {
                code: 'incorrect_password',
                message: `The password you entered was invalid. <a href="${baseUrl + 'member-password-lost/'}">Did you forget your password?</a>`
            },
            {
                code: 'password_reset_empty',
                message: 'You need to enter a password to continue.'
            },
            {
                code: 'password_reset_mismatch',
                message: 'The two passwords you entered don\'t match.'
            },
            {
                code: 'retrieve_password_email_failure',
                message: 'The email could not be sent. Your site may not be correctly configured to send emails.'
            },
            {
                code: 'username',
                message: 'The username you entered is not valid.'
            },
            {
                code: 'username_exists',
                message: 'An account already exists with this username.'
            },
            {
                code: 'weak_password',
                message: 'The password you entered is not strong enough.'
            }
        ];
    }

    getError( error ) {
        const result = this.errors.find( ({ code }) => code === error );
        return result.message;
    }
}