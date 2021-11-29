/**
 *  @package diTheme
*/

/*
    ##################################################
    |   MODAL FUNCTION                               |
    ##################################################
*/
export function modal() {
    const modal = document.querySelector('.modal > .modal-content');
    const okayBtn = document.querySelector('.modal > .modal-content > .btn-submit');
    const cancelBtn = document.querySelector('.modal > .modal-content > .btn-cancel');
    const closeBtn = document.querySelector('.modal > .modal-content > .close');
    modal.tabIndex = -1;
    
    okayBtn.addEventListener('click', () => {
        closeModal();
        return true;
    });
    cancelBtn.addEventListener('click', () => {
        closeModal();
        return false;
    });
    closeBtn.addEventListener('click', () => {
        closeModal();
        return false;
    });

}


/*
    ##################################################
    |   SHOW ERROR MODAL FUNCTION                    |
    ##################################################
*/
export function showModal( type, title, message ) {
    const modal = document.querySelector('.modal');
    const modalContent = document.querySelector('.modal-content');
    
    modal.querySelector('h3').innerText = `${title}`;
    modal.querySelector('main').innerText = `${message}`;
    modal.classList.add(`${type}`);
    modal.classList.add('show');
    modalContent.focus();
    
    modalContent.addEventListener('keydown', handleKeyDown);
    modalContent.addEventListener('blur', () => {
        closeModal();
        return false;
    })
    
} 


/*
    ##################################################
    |   CLOSE MODAL FUNCTION                         |
    ##################################################
*/
export function closeModal() {
    const modal = document.querySelector('.modal');
    const modalContent = document.querySelector('.modal-content');
    
    if ( modal.classList.contains('show') ) modal.classList.remove('show');
    if ( modal.classList.contains('error') ) modal.classList.remove('error');
    if ( modal.classList.contains('success') ) modal.classList.remove('success');
    if ( modal.classList.contains('warning') ) modal.classList.remove('warning');

    modal.querySelector('h3').innerText = '';
    modal.querySelector('main').innerText = '';
    modalContent.removeEventListener('keydown', handleKeyDown);
    modalContent.blur();
    
}

function handleKeyDown(e) {
    switch (e.code) {
        case "Enter":
            closeModal();
            return true;
        case "Escape":
            closeModal();
            return false;
        default:
            return;
    }
}