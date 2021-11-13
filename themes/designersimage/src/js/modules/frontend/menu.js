/**
 *  @package diTheme
*/

/*
    ##################################################
    |   MENU FUNCTIONS                               |
    ##################################################
*/

export const menuToggle = () => {

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

export const pageTop = () => {
    const top_btn = document.querySelector('.di-menu__footer-nav li:last-child a');

    top_btn.addEventListener('click', (e) => {
        e.preventDefault();
        window.scroll({
            top: 0, 
            left: 0, 
            behavior: 'smooth' 
        });
    });

}