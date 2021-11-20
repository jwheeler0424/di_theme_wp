/**
 *  @package diTheme
*/

/*
    ##################################################
    |   THEME PAGE ANIMATIONS                        |
    ##################################################
*/

export const carousel = () => {
    const cards = document.querySelectorAll('.portfolio-carousel > .card'),
          cardsCount = cards.length,
          buttonLeft = document.querySelector('button.left'),
          buttonRight = document.querySelector('button.right'),
          cardInfo = document.querySelector('.card-info');
    
    buttonLeft.addEventListener('click', () => {
        const frontCard = document.querySelector('.portfolio-carousel > .card.front'),
              frontIndex = Array.prototype.indexOf.call(cards, frontCard);
        
        cardInfo.style.opacity = '0';

        if ( frontIndex < 1 ) {

            cards.forEach((card, index) => {
                
                if ( index === cardsCount - 1 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                } else if ( index === cardsCount - 2 ) {
                    card.classList.add('left');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else if ( index === 0 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            });

        } else if ( frontIndex - 1 < 1 ) {
            cards.forEach((card, index) => {
                
                if ( index === 0 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                } else if ( index === cardsCount - 1 ) {
                    card.classList.add('left');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else if ( index === 1 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            });
            
        } else {

            cards.forEach((card, index) => {
                
                if ( index === frontIndex - 1 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                } else if ( index === frontIndex - 2 ) {
                    card.classList.add('left');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else if ( index === frontIndex ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            })

        }

        setTimeout(() => {
            cardInfo.style.opacity = '100';
        }, 200 );
        
    });

    buttonRight.addEventListener('click', () => {
        const frontCard = document.querySelector('.portfolio-carousel > .card.front'),
              frontIndex = Array.prototype.indexOf.call(cards, frontCard);

        cardInfo.style.opacity = '0';

        if ( frontIndex >= cardsCount - 1 ) {
            cards.forEach((card, index) => {
                
                if ( index === 0 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                } else if ( index === cardsCount - 1 ) {
                    card.classList.add('left');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else if ( index === 1 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            });
            
        } else if ( frontIndex + 2 > cardsCount - 1 ) {
            cards.forEach((card, index) => {
                
                if ( index === frontIndex + 1 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                } else if ( index === cardsCount - 2 ) {
                    card.classList.add('left');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else if ( index === 0 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            });
            
        } else {

            cards.forEach((card, index) => {
                
                if ( index === frontIndex + 1 ) {
                    card.classList.add('front');
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                } else if ( index === frontIndex ) {
                    card.classList.add('left');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else if ( index === frontIndex + 2 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('back') ) { card.classList.remove('back') };
                } else {
                    card.classList.add('back');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            })
        }

        setTimeout(() => {
            cardInfo.style.opacity = '100';
        }, 200 );

    });

}

export const slider = () => {

    // global variables
    const sliderView = document.querySelector('.di-slider--view > ul');
    const sliderViewSlides = document.querySelectorAll('.di-slider--view__slides');
    const arrowLeft = document.querySelector('.di-slider--arrows__left');
    const arrowRight = document.querySelector('.di-slider--arrows__right');
    const sliderLength = sliderViewSlides.length;

    // sliding function
    const slider = ( sliderViewItems, isActiveItem ) => {
        // update the classes
        isActiveItem.classList.remove('is-active');
        sliderViewItems.classList.add('is-active');

        // css transform the active slide position
        sliderView.setAttribute('style', `transform:translateX(-${sliderViewItems.offsetLeft}px)`)
    }

    // before sliding function
    const beforeSliding = (i) => {
        let isActiveItem = document.querySelector('.di-slider--view__slides.is-active');
        let currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i;
        let nextItem = currentItem + i;
        let sliderViewItems = document.querySelector(`.di-slider--view__slides:nth-child(${nextItem})`);

        if (nextItem > sliderLength) {
            sliderViewItems = document.querySelector('.di-slider--view__slides:nth-child(1)');
        }

        if (nextItem == 0) {
            sliderViewItems = document.querySelector(`.di-slider--view__slides:nth-child(${sliderLength})`);
        }

        slider( sliderViewItems, isActiveItem );
    }

    // triggers arrows
    arrowRight.addEventListener( 'click', () => beforeSliding(1) );
    arrowLeft.addEventListener( 'click', () => beforeSliding(0) );
}