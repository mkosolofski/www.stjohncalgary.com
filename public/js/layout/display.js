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
    resize:function()
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
        
        $('.layoutBackground')
            .width($('.content')[0].clientWidth - 2)
            .height($('.content')[0].scrollHeight + 50);
    }
}
$(window).load(layout_display.resize);
$(window).resize(layout_display.resize);
