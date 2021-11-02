/**
 *  @package diTheme
*/

/*
    ##################################################
    |   TESTIMONIAL FORM                             |
    ##################################################
*/
const testimonialForm = () => {
    let testimonialForm = document.querySelector('#di-testimonial-form');
    
    testimonialForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // reset the form messages
        resetMessages();
    
        // collect all the data
        let formData = {
            name: testimonialForm.querySelector('[name="name"]').value,
            email: testimonialForm.querySelector('[name="email"]').value,
            message: testimonialForm.querySelector('[name="message"]').value,
            nonce: testimonialForm.querySelector('[name="nonce"]').value
        };
    
        // validate the form fields
        if ( !formData.name ) {
            testimonialForm.querySelector('[data-error="name"]').classList.add('show');
            return;
        }
    
        if ( !validateEmail(formData.email) ) {
            testimonialForm.querySelector('[data-error="email"]').classList.add('show');
            return;
        }
    
        if ( !formData.message ) {
            testimonialForm.querySelector('[data-error="message"]').classList.add('show');
            return;
        }
    
        // ajax http post request
        let url = testimonialForm.dataset.url;
        let params = new URLSearchParams(new FormData(testimonialForm));
        const fetchData = {
            method: "POST",
            body: params
        };
    
        testimonialForm.querySelector('.js-form-submission').classList.add('show');
        
        fetch( url, fetchData)
            .then(res => res.json())
            .catch(error => {
                resetMessages();
                testimonialForm.querySelector('.js-form-error').classList.add('show');
            })
            .then(response => {
                resetMessages();
                // deal with the response
                if ( response === 0 || response.status === 'error' ) {
                    testimonialForm.querySelector('.js-form-error').classList.add('show');
                    return;
                }
    
                testimonialForm.querySelector('.js-form-success').classList.add('show');
                testimonialForm.reset();
            })
    
    });
}

/*
    ##################################################
    |   RESET FORM ERROR MESSAGES FUNCTION           |
    ##################################################
*/
function resetMessages() {
    document.querySelectorAll('.field-msg').forEach( field => field.classList.remove('show') );
} 

/*
    ##################################################
    |   VALIDATE EMAIL ADDRESS FUNCTION              |
    ##################################################
*/
function validateEmail(email) {
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regex.test(String(email).toLowerCase());
}


export default testimonialForm;