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
        $('.layoutBackground')
            .width($('.content')[0].clientWidth - 2)
            .height($('.content')[0].scrollHeight + 50);

        if ($('.layoutMarginImageLeft').length > 0 ) {
            var contentWidth = $('.content')[0].clientWidth;
            
            if (contentWidth >= 950) {
                var imageWidth = ((contentWidth - 745)/2) - 3;
                console.log(imageWidth);
                $('.layoutMarginImageLeft,.layoutMarginImageRight').css('width', imageWidth);
                $('.layoutMarginImageLeft,.layoutMarginImageRight').show();
            
            } else {
                $('.layoutMarginImageLeft,.layoutMarginImageRight').hide();
            }
        }
    }
}
$(window).load(layout_display.resize);
$(window).resize(layout_display.resize);
