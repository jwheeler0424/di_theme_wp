ready((event) => {
    const phone_field = document.querySelector('#di_contact_phone_field');
    const phone_format = '(   )    -    '; // 14
    let phone_num;
    //alert(phone_format.length);
    phone_field.addEventListener('keyup', () => {
        phone_num = phone_field.value;

    })

})


/*
    ========================================
    |   Document Ready Function            |
    ========================================
*/
function ready(callbackFunction){
    if(document.readyState != 'loading') {
        callbackFunction(event);
    } else {
        document.addEventListener("DOMContentLoaded", callbackFunction);
    }
}