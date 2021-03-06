/**
 *  @package diTheme
*/

/*
    ##################################################
    |   PAGE ADJUSTMENT FUNCTIONS                    |
    ##################################################
*/

export const adjustHeight = () => {
    const header = document.querySelector('.di-header__main'),
          contactMain = document.querySelector('.contact-main'),
          homeHero = document.querySelector('.home-hero'),
          main = document.querySelector('main');

    if ( homeHero ) {
        let height = window.innerHeight,
            width = window.innerWidth,
            prevHeight = height,
            prevLandscape = width > height,
            landscape = false,
            portrait = false;

        homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
        main.style.height = height;
        main.style.top = '0';

        window.addEventListener('resize', () => {
            height = window.innerHeight;
            width = window.innerWidth;

            landscape = width > height;
            portrait = width <= height;

            if (landscape & !prevLandscape || portrait & prevLandscape || Math.abs(prevHeight - height) > 60) {
                homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
                main.style.height = height;
                main.style.top = '0';
            }

            prevLandscape = width > height;
            prevHeight = height;

        });
        
    }

    if ( contactMain ) {
        let height = window.innerHeight,
            width = window.innerWidth,
            prevHeight = height,
            prevLandscape = width > height,
            landscape = false,
            portrait = false;

        contactMain.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
        main.style.height = height;
        main.style.top = '0';

        window.addEventListener('resize', () => {
            height = window.innerHeight;
            width = window.innerWidth;

            landscape = width > height;
            portrait = width <= height;

            if (landscape & !prevLandscape || portrait & prevLandscape || Math.abs(prevHeight - height) > 60) {
                contactMain.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
                main.style.height = height;
                main.style.top = '0';
            }

            prevLandscape = width > height;
            prevHeight = height;

        });
        
    }
}
