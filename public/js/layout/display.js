/**
 * Contains layout_display.
 */

/**
 * Object for managing the display of the layout.
 */
var layout_display = {
    /**
     * Manipulates layout based on sizing of user browser.
     */
    resize:function(event)
    {
        if ($('.contentLeft').length > 0) {
            if ($('.content').width() > 980) {
                $('.contentLeft, .contentRight').css(
                    'width',
                    ($('.content').width() - $('.contentCenter').width()) / 2
                );
            } else {
                $('.contentLeft, .contentRight').css('width', '');
            }
        }

        // If the content does not fit in the browser.
        if ($(window).height() < $(document).height()) {
            $('.layoutBackground').width($('.content')[0].clientWidth - 2)
            if (event.type == 'load') {
                $('.layoutBackground').height(($(document).height() - $('header').height()) + 35);
            }
        
        // Else if the content fits in the browser.
        } else {
            $('.layoutBackground').width($('.content')[0].clientWidth - 2)
            if (event.type == 'load') {
                $('.layoutBackground').height($('.content')[0].scrollHeight + 50);
            }
        }
    }
}
$(window).load(layout_display.resize);
$(window).resize(layout_display.resize);
