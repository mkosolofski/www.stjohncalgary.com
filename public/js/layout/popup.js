/**
 * Contains Layout_Pop
 */

/**
 * Controls for the layout pop up.
 */
var layout_popup = {
    /**
     * Shows the popup with the given html.
     *
     * @param string html The html to display in the popup.
     */
    show:function(html)
    {
        $('#popupContent').html(html);
        $('#popupMask, #popupContainer').show();
    },

    /**
     * Hides and then clears the popup. 
     */
    hide:function()
    {
        $('#popupMask, #popupContainer').hide();
        $('#popupContent').html('');
    }
}
