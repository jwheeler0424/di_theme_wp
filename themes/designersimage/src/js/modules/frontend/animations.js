/**
 *  @package diTheme
*/

/*
    ##################################################
    |   THEME PAGE ANIMATIONS                        |
    ##################################################
*/

export const carousel = () => {
    const carousel = document.querySelector('.portfolio-carousel');
    if ( carousel ) {
        const cards = document.querySelectorAll('.portfolio-carousel > .card'),
            cardsCount = cards.length,
            arrowLeft = document.querySelector('.portfolio-carousel >button.left'),
            arrowRight = document.querySelector('.portfolio-carousel >button.right')

        // cards.forEach((card, index) => {
        //     if ( !card.classList.contains('front') ) {
        //         card.querySelector('.card-info').style.opacity = '0';
        //     }
        // });
        
        arrowRight.addEventListener('click', () => {
            arrowRight.disabled = true;
            const frontCard = document.querySelector('.portfolio-carousel > .card.front'),
                frontIndex = Array.prototype.indexOf.call(cards, frontCard);
            
            if ( frontIndex < 1 ) {

                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === cardsCount - 1 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === cardsCount - 2 ) {
                        card.classList.add('left');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === 0 ) {
                        card.classList.add('right');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                });

            } else if ( frontIndex - 1 < 1 ) {
                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === 0 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === cardsCount - 1 ) {
                        card.classList.add('left');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === 1 ) {
                        card.classList.add('right');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                });
                
            } else {
                
                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === frontIndex - 1 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === frontIndex - 2 ) {
                        card.classList.add('left');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === frontIndex ) {
                        card.classList.add('right');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                })

            }

            setTimeout(() => {
                arrowRight.disabled = false;
            }, 300);
            
        });

        arrowLeft.addEventListener('click', () => {
            arrowLeft.disabled = true;
            const frontCard = document.querySelector('.portfolio-carousel > .card.front'),
                frontIndex = Array.prototype.indexOf.call(cards, frontCard);

            if ( frontIndex >= cardsCount - 1 ) {
                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === 0 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === cardsCount - 1 ) {
                        card.classList.add('left');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === 1 ) {
                        card.classList.add('right');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                });
                
            } else if ( frontIndex + 2 > cardsCount - 1 ) {
                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === frontIndex + 1 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === cardsCount - 2 ) {
                        card.classList.add('left');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === 0 ) {
                        card.classList.add('right');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                });
                
            } else {

                cards.forEach((card, index) => {
                    // card.querySelector('.card-info').style.opacity = '0';
                    if ( index === frontIndex + 1 ) {
                        card.classList.add('front');
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // setTimeout(() => {
                        //     card.querySelector('.card-info').style.opacity = '100';
                        // }, 200 );
                    } else if ( index === frontIndex ) {
                        card.classList.add('left');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else if ( index === frontIndex + 2 ) {
                        card.classList.add('right');
                        if ( card.classList.contains('back') ) { card.classList.remove('back') };
                        if ( card.classList.contains('hidden') ) { card.classList.remove('hidden') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    } else {
                        card.classList.add('back');
                        card.classList.add('hidden');
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        // card.querySelector('.card-info').style.opacity = '0';
                    }

                })
            }

            setTimeout(() => {
                arrowLeft.disabled = false;
            }, 300);

        });
    }
}

export const slider = () => {
    const slider = document.querySelector('.testimonial-slider');
    if ( slider ) {
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
            let leftCount = document.querySelectorAll('.testimonial-slider > figure.left').length,
                rightCount = document.querySelectorAll('.testimonial-slider > figure.right').length,
                frontCard = document.querySelector('.testimonial-slider > figure.front'),
                frontIndex = Array.prototype.indexOf.call(cards, frontCard);
            
            if ( frontIndex < cardsCount - 1 ) {
                cards.forEach((card, index) => {
                    if ( index === frontIndex + 1 ) {
                        card.classList.add('front')
                        if ( card.classList.contains('right') ) { card.classList.remove('right') };
                        rightCount --;
                    } else if ( index === frontIndex ) {
                        card.classList.add('left')
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        leftCount ++;
                    }
                })
            }

            if (leftCount <= 0) {
                arrowRight.disabled = true;
                if ( !arrowRight.classList.contains('disabled') ) { arrowRight.classList.add('disabled') };
            } else {
                arrowRight.disabled = false;
                if ( arrowRight.classList.contains('disabled') ) { arrowRight.classList.remove('disabled') };
            }

            if (rightCount <= 0) {
                arrowLeft.disabled = true;
                if ( !arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.add('disabled') };
            } else {
                arrowLeft.disabled = false;
                if ( arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.remove('disabled') };
            }
        })

        arrowRight.addEventListener('click', () => {
            arrowRight.disabled = true;
            let leftCount = document.querySelectorAll('.testimonial-slider > figure.left').length,
                rightCount = document.querySelectorAll('.testimonial-slider > figure.right').length,
                frontCard = document.querySelector('.testimonial-slider > figure.front'),
                frontIndex = Array.prototype.indexOf.call(cards, frontCard);

            if ( frontIndex >= 0 ) {
                cards.forEach((card, index) => {
                    if ( index === frontIndex - 1 ) {
                        card.classList.add('front')
                        if ( card.classList.contains('left') ) { card.classList.remove('left') };
                        leftCount --;
                    } else if ( index === frontIndex ) {
                        card.classList.add('right')
                        if ( card.classList.contains('front') ) { card.classList.remove('front') };
                        rightCount ++;
                    }
                })
            }

            if (leftCount <= 0) {
                arrowRight.disabled = true;
                if ( !arrowRight.classList.contains('disabled') ) { arrowRight.classList.add('disabled') };
            } else {
                arrowRight.disabled = false;
                if ( arrowRight.classList.contains('disabled') ) { arrowRight.classList.remove('disabled') };
            }

            if (rightCount <= 0) {
                arrowLeft.disabled = true;
                if ( !arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.add('disabled') };
            } else {
                arrowLeft.disabled = false;
                if ( arrowLeft.classList.contains('disabled') ) { arrowLeft.classList.remove('disabled') };
            }

        })
    }
}