/**
 *  @package diTheme
*/

/*
    ##################################################
    |   PAGE ADJUSTMENT FUNCTIONS                    |
    ##################################################
*/

export const adjustHeight = () => {
    const header = document.querySelector('.di-header__main');
    const homeHero = document.querySelector('.home-hero');
    const main = document.querySelector('main');

    if ( homeHero ) {
        let height = window.innerHeight,
            width = window.innerWidth,
            prevOrientation = (width > height) ? 'landscape' : 'portrait',
            landscape = false,
            portrait = false;

        homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
        main.style.height = height;

        window.addEventListener('resize', () => {
            
            setTimeout(() => {
                height = window.innerHeight;
                width = window.innerWidth;
                landscape = width > height;
                portrait = width <= height;

                if (landscape & prevOrientation === 'portrait' || portrait & prevOrientation === 'landscape') {
                    homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
                    main.style.height = height;
                }

                prevOrientation = (width > height) ? 'landscape' : 'portrait';
                
            }, 100);

        });
        
    }
}