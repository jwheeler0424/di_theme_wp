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
        if(document.location.pathname === "/") {
            document.querySelector('main').scroll({
                top: 0, 
                left: 0, 
                behavior: 'smooth' 
            });
            return;
        }
        window.scroll({
            top: 0, 
            left: 0, 
            behavior: 'smooth' 
        });
    });

}

export const titleHover = () => {
    const title = document.querySelector('.di-header__title');
    const logo = document.querySelector('.di-header__logo');

    logo.addEventListener('mouseover', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    logo.addEventListener('mouseout', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });
    logo.addEventListener('mousedown', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    logo.addEventListener('mouseup', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });
    logo.addEventListener('touchstart', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    logo.addEventListener('touchend', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });

    title.addEventListener('mouseover', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    title.addEventListener('mouseout', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });
    title.addEventListener('mousedown', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    title.addEventListener('mouseup', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });
    title.addEventListener('touchstart', (e) => {
        logo.classList.add('hover');
        title.classList.add('hover');
    });
    title.addEventListener('touchend', (e) => {
        logo.classList.remove('hover');
        title.classList.remove('hover');
    });
}