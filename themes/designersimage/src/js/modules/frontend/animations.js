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
          buttonLeft = document.querySelector('.portfolio-carousel >button.left'),
          buttonRight = document.querySelector('.portfolio-carousel >button.right'),
          cardInfo = document.querySelector('.portfolio-carousel > .card-info');
    
    buttonLeft.addEventListener('click', () => {
        buttonLeft.disabled = true;
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else if ( index === 0 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else if ( index === 1 ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else if ( index === frontIndex ) {
                    card.classList.add('right');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            })

        }

        setTimeout(() => {
            cardInfo.style.opacity = '100';
        }, 200 );
        setTimeout(() => {
            buttonLeft.disabled = false;
        }, 300);
        
    });

    buttonRight.addEventListener('click', () => {
        buttonRight.disabled = true;
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
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
                    if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                } else {
                    card.classList.add('back');
                    card.classList.add('hidden');
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                }

            })
        }

        setTimeout(() => {
            cardInfo.style.opacity = '100';
        }, 200 );
        setTimeout(() => {
            buttonRight.disabled = false;
        }, 300);

    });

}

export const slider = () => {

    const arrowLeft = document.querySelector('.testimonial-slider > button.left'),
          leftCount = document.querySelector('.testimonial-slider > figure.left'),
          arrowRight = document.querySelector('.testimonial-slider > button.right'),
          rightCount = document.querySelector('.testimonial-slider > figure.right'),
          cards = document.querySelectorAll('.testimonial-slider > figure'),
          cardsCount = cards.length;

    if ( rightCount <= 0) {
        arrowLeft.disabled = true;
        arrowLeft.classList.add('disabled');
    }

    if ( leftCount <= 0 ) {
        arrowRight.disabled = true;
        arrowRight.classList.add('disabled');
    }

    arrowLeft.addEventListener('click', () => {
        arrowLeft.disabled = true;
        const rightCount = document.querySelectorAll('.testimonial-slider > figure.right').length,
              frontCard = document.querySelector('.testimonial-slider > figure.front'),
              frontIndex = Array.prototype.indexOf.call(cards, frontCard);
        
        if ( frontIndex < cardsCount - 1 ) {
            cards.forEach((card, index) => {
                if ( index === frontIndex + 1 ) {
                    card.classList.add('front')
                    if ( card.classList.contains('right') ) { card.classList.remove('right') };
                } else if ( index === frontIndex ) {
                    card.classList.add('left')
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                }
            })
        }
        
        if (rightCount > 0) {
            setTimeout(() => {
                arrowRight.disabled = false;
            }, 500);
        }
        
        if (leftCount <= 0) {
            arrowLeft.disabled = true;
            if ( !arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.add('disabled') };
        } else {
            arrowLeft.disabled = false;
            if ( arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.remove('disabled') };
        }
    })

    arrowRight.addEventListener('click', () => {
        arrowRight.disabled = true;
        const leftCount = document.querySelectorAll('.testimonial-slider > figure.left').length,
              frontCard = document.querySelector('.testimonial-slider > figure.front'),
              frontIndex = Array.prototype.indexOf.call(cards, frontCard);

        if ( frontIndex >= 0 ) {
            cards.forEach((card, index) => {
                if ( index === frontIndex - 1 ) {
                    card.classList.add('front')
                    if ( card.classList.contains('left') ) { card.classList.remove('left') };
                } else if ( index === frontIndex ) {
                    card.classList.add('right')
                    if ( card.classList.contains('front') ) { card.classList.remove('front') };
                }
            })
        }
        
        if (leftCount > 0) {
            setTimeout(() => {
                arrowRight.disabled = false;
            }, 500);
        }
    })

}