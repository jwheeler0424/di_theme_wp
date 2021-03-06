/**
 *  @package diTheme
*/

/*
    ##################################################
    |   CONTACT FORM                                 |
    ##################################################
*/
import { Select } from './formElements';
import { showModal, closeModal } from './modal';

const contactForm = () => {
    const url = new URL( window.location.href );
    const searchParams = new URLSearchParams(url.search);
    const reason = searchParams.get('r');

    const contact = document.querySelector('#di-contact-form');
    const requiredInputs = document.querySelectorAll('[required]');
    const selectElements = document.querySelectorAll('[data-custom]');
    setSelectValue(reason);

    selectElements.forEach(selectElement => {
        new Select(selectElement);
    })
    
    // If javascript enabled, Disable HTML5 required
    requiredInputs.forEach(input => {
        input.required = false;
    });

    document.querySelectorAll('[data-error]').forEach( field => {
        field.addEventListener('click', function() {
            this.classList.remove('error');
        })
    });

    contact.addEventListener('submit', (e) => {
        e.preventDefault();
        e.target.querySelector('button[type="submit"]').disabled = true;

        // reset the form messages
        resetMessages();
        showModal( 'loading', 'Processing...', '' );
        
        // collect all the data
        let formData = {
            subject: e.target.querySelector('[name="subject"]').value,
            first: e.target.querySelector('[name="first"]').value,
            last: e.target.querySelector('[name="last"]').value,
            company: e.target.querySelector('[name="company"]').value,
            email: e.target.querySelector('[name="email"]').value,
            phone: e.target.querySelector('[name="phone"]').value,
            message: e.target.querySelector('[name="message"]').value,
            nonce: e.target.querySelector('[name="nonce"]').value
        };
        let formInvalid = false;

        // validate the form fields
        if ( !formData.subject ) {
            e.target.querySelector('[data-error="subject"]').classList.add('error');
            formInvalid = true;
        }

        if ( !formData.first ) {
            e.target.querySelector('[data-error="first"]').classList.add('error');
            formInvalid = true;
        }

        if ( !formData.last ) {
            e.target.querySelector('[data-error="last"]').classList.add('error');
            formInvalid = true;
        }

        if ( !validateEmail(formData.email) ) {
            e.target.querySelector('[data-error="email"]').classList.add('error');
            formInvalid = true;
        }

        if ( !formData.phone ) {
            e.target.querySelector('[data-error="phone"]').classList.add('error');
            formInvalid = true;
        }

        if ( !formData.message ) {
            e.target.querySelector('[data-error="message"]').classList.add('error');
            formInvalid = true;
        }

        if ( formInvalid ) {
            showModal( 'error', 'Error!', 'There was a problem with the Contact Form, please try again!');
            e.target.querySelector('button[type="submit"]').disabled = false;
            return;
        }

        // ajax http post request
        let url = e.target.dataset.url;
        let params = new URLSearchParams(new FormData(e.target));
        
        const fetchData = {
            method: "POST",
            body: params
        };
        
        e.target.querySelector('.js-form-submission').classList.add('show');
        
        fetch( url, fetchData)
            .then(res => res.json())
            .catch(error => {
                resetMessages();
                showModal( 'error', 'Error!', 'There was a problem with the Contact Form, please try again!');
                e.target.querySelector('button[type="submit"]').disabled = false;
            })
            .then(response => {
                
                resetMessages();
                // deal with the response
                if ( response === 0 || response.status === 'error' ) {
                    showModal( 'error', 'Error!', 'There was a problem with the Contact Form, please try again!');
                    e.target.querySelector('button[type="submit"]').disabled = false;
                    return;
                }
                
                showModal( 'success', 'Success!', 'Message Successfully submitted, thank you! We will be in contact with you shortly.');
                e.target.querySelector('button[type="submit"]').disabled = false;
                e.target.querySelector('.di-select-container > .di-select-value').innerText = 'Select a reason...';
                e.target.querySelector('.di-select-container > .di-select-value').classList.add('placeholder');
                e.target.reset();
            });
        
    });
}   

/*
    ##################################################
    |   RESET FORM ERROR MESSAGES FUNCTION           |
    ##################################################
*/
function resetMessages() {
    document.querySelectorAll('[data-error]').forEach( field => field.classList.remove('error') );
    document.querySelector('.js-form-submission').classList.remove('show');
    closeModal();
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

/*
    ##################################################
    |   URL PARAMETER SELECT VALUE FUNCTION          |
    ##################################################
*/
function setSelectValue(reason) {
    const selectElements = document.querySelectorAll('[data-custom]');
    const subjectSelect = selectElements[0];
    switch ( reason ) {
        case 'general':
            subjectSelect.value = 'General Inquiry';
            break;
        case 'quote':
            subjectSelect.value = 'Get Quote';
            break;
        case 'network':
            subjectSelect.value = 'Network Setup';
            break;
        case 'diagnostic':
            subjectSelect.value = 'Computer Diagnostic';
            break;
        case 'upgrade':
            subjectSelect.value = 'Computer Upgrades';
            break;
        case 'backup':
            subjectSelect.value = 'File Backup & Migration';
            break;
        case 'optimize':
            subjectSelect.value = 'Virus Scan / Cleanup';
            break;
        case 'new':
            subjectSelect.value = 'New Website';
            break;
        case 'existing':
            subjectSelect.value = 'Existing Website';
            break;
        case 'logo':
            subjectSelect.value = 'Logo Design';
            break;
        case 'bc':
            subjectSelect.value = 'Business Cards';
            break;
        case 'uiux':
            subjectSelect.value = 'UI/UX Design';
            break;           
        case 'win11':
            subjectSelect.value = 'Windows 11 Upgrade';
            break;
        default:
            subjectSelect.value = '';
            break;
    }
}


export default contactForm;