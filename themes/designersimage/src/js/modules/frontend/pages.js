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
            prevHeight = height,
            prevOrientation = (width > height) ? 'landscape' : 'portrait',
            landscape = false,
            portrait = false;

        homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
        main.style.minHeight = height;

        window.addEventListener('resize', () => {
            height = window.innerHeight;
            width = window.innerWidth;

            setTimeout(() => {
                landscape = width > height;
                portrait = width <= height;

                if (landscape & prevOrientation === 'portrait' || portrait & prevOrientation === 'landscape' || Math.abs(prevHeight - height) > 50) {
                    homeHero.style.height = main.offsetHeight - header.clientHeight - (main.clientHeight - window.innerHeight);
                    main.style.minHeight = height;
                }

                prevOrientation = (width > height) ? 'landscape' : 'portrait';
                prevHeight = height;
                
            }, 100);

        });
        
    }
}