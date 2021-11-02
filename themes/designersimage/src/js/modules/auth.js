/**
 *  @package diTheme
*/

/*
    ##################################################
    |   LOGIN AUTH FORM                              |
    ##################################################
*/

const loginForm = () => {
    const showAuthBtn = document.querySelector('#di-show-auth-form');
    const authContainer = document.querySelector('#di-auth-container');
    const close = document.querySelector('#di-auth-close');
    const authForm = document.querySelector('#di-auth-form');
    const status = authForm.querySelector('[data-message="status"]');

    showAuthBtn.addEventListener('click', () => {
        authContainer.classList.add('show');
        showAuthBtn.parentElement.classList.add('hide');
    })

    close.addEventListener('click', () => {
        authContainer.classList.remove('show');
        showAuthBtn.parentElement.classList.remove('hide');
    })

    authForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // reset the form messages
        resetMessages();

        // collect all the data
        let data = {
            name: authForm.querySelector('[name="username"]').value,
            password: authForm.querySelector('[name="password"]').value,
            nonce: authForm.querySelector('[name="di_auth"]').value
        }

        // validate everything
        if ( !data.name || !data.password ) {
            status.innerHTML = 'Please fill both username and password.';
            status.classList.add('error');
            return;
        }

        // ajax http post request
        let url = authForm.dataset.url;
        let params = new URLSearchParams( new FormData( authForm ) );
        const fetchData = {
            method: "POST",
            body: params
        };

        authForm.querySelector('[name="submit"]').value = 'Logging in...';
        authForm.querySelector('[name="submit"]').disabled = true;

        fetch( url, fetchData )
            .then( res => res.json() )
            .catch( error => resetMessages() )
            .then( response => {
                resetMessages();

                if ( response === 0 || !response.status ) {
                    status.innerHTML = response.message;
                    status.classList.add('error');
                    return;
                }

                status.innerHTML = response.message;
                status.classList.add('success');
                authForm.reset();

                window.location.reload();
            } )

    })

    const resetMessages = () => {
        status.innerHTML = '';
        status.classList.remove('success', 'error');

        authForm.querySelector('[name="submit"]').value = 'Login';
        authForm.querySelector('[name="submit"]').disabled = false;
        return;
    }
}

export default loginForm;