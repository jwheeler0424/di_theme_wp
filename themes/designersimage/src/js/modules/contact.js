/**
 *  @package diTheme
*/

/*
    ##################################################
    |   CONTACT FORM                                 |
    ##################################################
*/

const contactForm = (e, contactForm) => {

    e.preventDefault();
    
    // reset the form messages
    resetMessages();

    // collect all the data
    let formData = {
        subject: contactForm.querySelector('[name="subject"]').value,
        name: contactForm.querySelector('[name="name"]').value,
        company: contactForm.querySelector('[name="company"]').value,
        email: contactForm.querySelector('[name="email"]').value,
        phone: contactForm.querySelector('[name="phone"]').value,
        message: contactForm.querySelector('[name="message"]').value,
        nonce: contactForm.querySelector('[name="nonce"]').value
    };

    // validate the form fields
    if ( !formData.subject ) {
        contactForm.querySelector('[data-error="subject"]').classList.add('show');
        return;
    }

    if ( !formData.name ) {
        contactForm.querySelector('[data-error="name"]').classList.add('show');
        return;
    }

    if ( !validateEmail(formData.email) ) {
        contactForm.querySelector('[data-error="email"]').classList.add('show');
        return;
    }

    if ( !formData.phone ) {
        contactForm.querySelector('[data-error="phone"]').classList.add('show');
        return;
    }

    if ( !formData.message ) {
        contactForm.querySelector('[data-error="message"]').classList.add('show');
        return;
    }

    // ajax http post request
    let url = contactForm.dataset.url;
    let params = new URLSearchParams(new FormData(contactForm));
    const fetchData = {
        method: "POST",
        body: params
    };
    
    contactForm.querySelector('.js-form-submission').classList.add('show');
    
    fetch( url, fetchData)
        .then(res => res.json())
        .catch(error => {
            resetMessages();
            contactForm.querySelector('.js-form-error').classList.add('show');
        })
        .then(response => {
            
            resetMessages();
            // deal with the response
            if ( response === 0 || response.status === 'error' ) {
                contactForm.querySelector('.js-form-error').classList.add('show');
                
                return;
            }
            
            contactForm.querySelector('.js-form-success').classList.add('show');
            contactForm.reset();
        })

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


export default contactForm;