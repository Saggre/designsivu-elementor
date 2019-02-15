/* Blob */

jQuery(function ($) {

    $.fn.extend({
        animateBlob: function (scaleX = 1, scaleY = 1, elasticity = 400, rotate = 0, translateX = 0, translateY = 0, paths) {
            var animationTargetBlob = $(this).find('.item .item__clippath')[0];
            anime.remove(animationTargetBlob);
            anime({
                targets: animationTargetBlob,
                scaleX: scaleX,
                scaleY: scaleY,
                rotate: rotate,
                translateX: translateX,
                transleteY: translateY,
                elasticity: elasticity,
                duration: 800,
                loop: false,
                autoplay: true,
                d: [
                    {value: paths},
                ],
                easing: 'easeInOutQuad',
                direction: 'normal'
            });
            return $(this);
        }
    });
    
    $('.blob-container').hover(
        function () {
            var endPath = $(this).attr('morphed-path');
            $(this).animateBlob(1, 1, 400, 0, 0, 0,
                [
                    endPath
                ]
            );
        },
        function () {
            var startPath = $(this).attr('unmorphed-path');
            $(this).animateBlob(1, 1, 400, 0, 0, 0,
                [
                    startPath
                ]
            );
        }
    );


})
;


/* End blob */