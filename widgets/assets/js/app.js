/* Blob */

jQuery(function ($) {

    $.fn.extend({
        animateBlob: function (scaleX = 1, scaleY = 1, elasticity = 400, rotate = 0, translateX = 0, translateY = 0, paths, begin, complete) {
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
                direction: 'normal',
                begin: function (anim) {
                    begin(anim);
                },
                complete: function (anim) {
                    complete(anim);
                }
            });
            return $(this);
        },
        animateBlobPassive: function () {
            var animationTargetBlob = $(this).find('.item .item__clippath')[0];
            anime.remove(animationTargetBlob);
            anime({
                targets: animationTargetBlob,
                keyframes: [
                    {
                        scaleX: 1.05,
                        scaleY: 1.05,
                        rotate: 2,
                        translateX: '5px',
                        transleteY: '5px'
                    },
                    {
                        scaleX: 0.95,
                        scaleY: 1.05,
                        rotate: -2,
                        translateX: '-10px',
                        transleteY: '0px'
                    },
                    {
                        scaleX: 1.05,
                        scaleY: 0.95,
                        rotate: 3,
                        translateX: '5px',
                        transleteY: '-10px'
                    },
                    {
                        scaleX: 1.05,
                        scaleY: 1.05,
                        rotate: 2,
                        translateX: '5px',
                        transleteY: '5px'
                    }
                ],
                elasticity: 400,
                duration: 10000,
                loop: true,
                autoplay: true,
                easing: 'easeInOutQuad',
                direction: 'alternate'
            });
            return $(this);
        }
    });

    $('.blob-container .blob-wrapper').each(
        function () {
            var $this = $(this);
            $this.animateBlobPassive();
            $this.hover(
                function () {

                    var endPath = $(this).attr('morphed-path');
                    $this.animateBlob(1, 1, 400, 0, 0, 0,
                        [
                            endPath
                        ],
                        function (anim) {
                        },
                        function (anim) {
                            $this.animateBlobPassive();
                        }
                    );
                },
                function () {
                    var $this = $(this);
                    var startPath = $(this).attr('unmorphed-path');
                    $this.animateBlob(1, 1, 400, 0, 0, 0,
                        [
                            startPath
                        ],
                        function (anim) {
                        },
                        function (anim) {
                            $this.animateBlobPassive();
                        }
                    );
                }
            );
        }
    )


})
;

/* End blob */

/* Sideways scrolling text */

jQuery(function ($) {

    //Initial setup
    $('.designsivu-elementor-sideways').each(function () {
        $(this).css({
            'height': $(this).height()
        });

        var $text = $(this).find('.designsivu-elementor-sideways-text');

        $text.css({
            'position': 'absolute'
        });
    });

    var d = $(document).height(),
        c = $(window).height(),
        w = $(document).width();

    $(window).on('scroll', function () {

        $('.designsivu-elementor-sideways:visible').each(function () {
            var s = $(window).scrollTop() - $(this).offset().top + c;
            var $text = $(this).find('.designsivu-elementor-sideways-text');
            var speed = parseInt($(this).attr('sideways-speed') / 12.0);
            var isLeftDirection = $(this).attr('scroll-direction') === 'left';

            scrollPercent = (s / (d - c)) * speed;
            var position = (scrollPercent * w);

            if (isLeftDirection) {
                $text.css({
                    'left': -position
                });
            } else {
                $text.css({
                    'right': -position
                });
            }
        });
    });
});

/* End sideways scrolling text */