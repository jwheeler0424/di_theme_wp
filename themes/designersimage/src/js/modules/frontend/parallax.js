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

        bg7.style.transform = `translateY(${distance * 0}px)`;
        bg6.style.transform = `translateY(${distance * .2}px)`;
        bg5.style.transform = `translateY(${distance * .3}px)`;
        bg4.style.transform = `translateY(${distance * .4}px)`;
        bg3.style.transform = `translateY(${distance * .5}px)`;
        bg2.style.transform = `translateY(${distance * .6}px)`;
        bg1.style.transform = `translateY(${distance * .7}px)`;
        // h2.style.transform = `translateY(${distance * .5}px)`;
        
    });

}