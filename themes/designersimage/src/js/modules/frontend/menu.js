/**
 *  @package diTheme
*/

/*
    ##################################################
    |   GALLERY SLIDER                               |
    ##################################################
*/

const menuToggle = () => {

    const menu = document.querySelector('#di-menu');
    const menu_btn = document.querySelector('#di-menu-toggle');

    menu_btn.addEventListener('click', (e) => {
        if ( menu_btn.classList.contains('closed') ) {
            menu.classList.remove('closed');
            menu.classList.add('open');

            menu_btn.classList.remove('closed');
            menu_btn.classList.add('open');

            return;
        }

        menu.classList.remove('open');
        menu.classList.add('closed')

        menu_btn.classList.remove('open');
        menu_btn.classList.add('closed');
        return;
    })

}

export default menuToggle;