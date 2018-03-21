/**
 * @file A Picture carousel plugins
 * @author sameen(sameen916@qq.com)
 * @param {object} options
 * @param {number} options.height 图片高
 * @param {string} options.during 轮播间隔
 * @param {boolean} options.auto 是否自动轮播
 */
(function ($) {
    $.fn.extend({
        zmRotation: function (options) {
            var defaults = {
                height: options.height ? options.height : 'auto',
                during: '3000',
                auto: true
            };
            var o = {};
            $.extend(o, defaults, options);
            $(this).each(function () {
                var $this = $(this);
                var $li = $this.find('li');
                var liCount = $li.length;
                var currIndex = null;
                var alt = '';
                $this.css({height: o.height});
                $li.css({height: o.height}).find('img').css({height: o.height});
                alt = $li.find('img').attr('alt');
                $li.first().show();

                var $text = $('.rotation-text');
                var $focus = $('.rotation-focus');
                $text.text(alt).attr('href', $li.find('a').attr('href'));
                for (var i = 1; i <= liCount; i++) {
                    $focus.append('<span>' + i + '</span>');
                }
                var $span = $focus.children('span');
                $span.first().addClass('hover');
                function loop() {
                    $(this).index() > liCount ? 0 : ++currIndex;
                    if (currIndex >= liCount) {
                        currIndex = 0;
                    }
                    $li.eq(currIndex).fadeIn(200);
                    $li.not($li.eq(currIndex)).fadeOut(200);
                    $span.eq(currIndex).addClass('hover');
                    $span.not($span.eq(currIndex)).removeClass('hover');
                    $text.text(($li.eq(currIndex).find('img').attr('alt')));
                    $text.attr('href', $li.eq(currIndex).find('a').attr('href'));
                }
                $span.bind('mouseover', function () {
                    var mThis = $(this);
                    var i = mThis.index();
                    currIndex = i;
                    var currLi = $li.eq(i);
                    mThis.addClass('hover');
                    $focus.children('span').not(mThis).removeClass('hover');
                    currLi.fadeIn(200);
                    $li.not(currLi).fadeOut(200);
                    $text.text($li.eq(i).find('img').attr('alt'));
                });
                var isLoop = setInterval(loop, o.during);
                $this.hover(function () {
                    if (isLoop) clearInterval(isLoop);
                }, function () {
                    if(o.auto) isLoop = setInterval(loop, o.during);
                });
            });
        }
    });
})(jQuery);

