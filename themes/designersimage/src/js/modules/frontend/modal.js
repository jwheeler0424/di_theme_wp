/**
 *  @package diTheme
*/

/*
    ##################################################
    |   MODAL FUNCTION                               |
    ##################################################
*/
export function modal() {
    
    const okayBtn = document.querySelector('.modal > .modal-content > .btn-submit');
    const cancelBtn = document.querySelector('.modal > .modal-content > .btn-cancel');
    const closeBtn = document.querySelector('.modal > .modal-content > .close');

    if ( okayBtn ) {
        okayBtn.addEventListener('click', () => {
            closeModal();
            return true;
        });
    }

    if ( cancelBtn ) {
        cancelBtn.addEventListener('click', () => {
            closeModal();
            return false;
        });
    }

    if ( closeBtn ) {
        closeBtn.addEventListener('click', () => {
            closeModal();
            return false;
        });
    }

}


/*
    ##################################################
    |   SHOW ERROR MODAL FUNCTION                    |
    ##################################################
*/
export function showModal( type, title, message ) {
    const modal = document.querySelector('.modal');

    modal.querySelector('h3').innerText = `${title}`;
    modal.querySelector('main').innerText = `${message}`;
    modal.classList.add(`${type}`);
    modal.classList.add('show');
    
} 


/*
    ##################################################
    |   CLOSE MODAL FUNCTION                         |
    ##################################################
*/
export function closeModal() {
    const modal = document.querySelector('.modal');
    
    if ( modal.classList.contains('show') ) modal.classList.remove('show');
    if ( modal.classList.contains('error') ) modal.classList.remove('error');
    if ( modal.classList.contains('success') ) modal.classList.remove('success');
    if ( modal.classList.contains('warning') ) modal.classList.remove('warning');

    modal.querySelector('h3').innerText = '';
    modal.querySelector('main').innerText = '';
    
}