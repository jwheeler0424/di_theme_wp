/**
 *  @package diTheme
*/

/*
    ##################################################
    |   PARALLAX FUNCTIONS                           |
    ##################################################
*/

export const homeParallax = () => {

    const h2 = document.querySelector('.home-hero .container h2')
    const bg1 = document.querySelector('.bg-city1');
    const bg2 = document.querySelector('.bg-city2');
    const bg3 = document.querySelector('.bg-city3');
    const bg4 = document.querySelector('.bg-city4');
    const bg5 = document.querySelector('.bg-city5');
    const bg6 = document.querySelector('.bg-city6');
    const bg7 = document.querySelector('.bg-city7');
    
    document.addEventListener('scroll', () => {
        const distance = window.pageYOffset;

        bg7.style.transform = `translate3d(0, ${distance * 0}px, 0)`;
        bg6.style.transform = `translate3d(0, ${distance * .2}px, 0)`;
        bg5.style.transform = `translate3d(0, ${distance * .3}px, 0)`;
        bg4.style.transform = `translate3d(0, ${distance * .4}px, 0)`;
        bg3.style.transform = `translate3d(0, ${distance * .5}px, 0)`;
        bg2.style.transform = `translate3d(0, ${distance * .6}px, 0)`;
        bg1.style.transform = `translate3d(0, ${distance * .7}px, 0)`;
        h2.style.transform = `translate3d(0, ${distance * 1.2}px, 0)`;
        
    });

}