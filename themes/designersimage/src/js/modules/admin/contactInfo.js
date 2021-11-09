/**
 *  @package diTheme
*/

/*
    ##################################################
    |   CONTACT FORM                                 |
    ##################################################
*/

export const sanitizePhone = (contactInfo) => {
    
    // collect all the data
    let phone = contactInfo.querySelector('[name="di_theme_ci[contact_phone]"]').value;

    phone = phone.replace(/[^\d]/g,'');

    // sanitize the phone number
    contactInfo.querySelector('[name="di_theme_ci[contact_phone]"]').value = phone;

}

/*
formData = {
    phone: contactForm.querySelector('[name="contact_phone"]').value,
    email: contactForm.querySelector('[name="contact_email"]').value,
    website: contactForm.querySelector('[name="contact_website"]').value,
    location: contactForm.querySelector('[name="contact_location"]').value,
    facebook: contactForm.querySelector('[name="contact_facebook"]').value,
    instagram: contactForm.querySelector('[name="contact_instagram"]').value,
    twitter: contactForm.querySelector('[name="contact_twitter"]').value,
    youtube: contactForm.querySelector('[name="contact_youtube"]').value,
    github: contactForm.querySelector('[name="contact_github"]').value,
    linkedin: contactForm.querySelector('[name="contact_linkedin"]').value
}
*/