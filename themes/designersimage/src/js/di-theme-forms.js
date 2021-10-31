/**
 *  @package diTheme
*/

ready((event) => {

    let testimonialForm = document.querySelector('#di-testimonial-form');
    console.log('loaded.')
    testimonialForm.addEventListener('submit', (e) => {
        e.preventDefault();
        
        // reset the form messages
        resetMessages();

        // collect all the data
        let data = {
            name: testimonialForm.querySelector('[name="name"]').value,
            email: testimonialForm.querySelector('[name="email"]').value,
            message: testimonialForm.querySelector('[name="message"]').value
        };
        console.log(data);

        // validate the email
        // ajax http post request

    });

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


/*
    ##################################################
    |   RESET FORM ERROR MESSAGES FUNCTION           |
    ##################################################
*/
function resetMessages() {
    document.querySelectorAll('.field-msg').forEach( field => field.classList.remove('show') );
} 