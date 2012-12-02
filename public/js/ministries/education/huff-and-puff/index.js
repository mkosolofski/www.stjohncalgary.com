/**
*   initialize the slide show for the huff and puff page
*/
var Index_Index = {
    /**
     * Initialize dynamics.
     */
    initialize:function()
    {
        $(
            function()
            {
                $("#slides").slides(
                    {
                        play : 5000,
                        effect : 'slide',
                        preload: true,
                        generateNextPrev: true,
                        generatePagination: false
                    }
                )
            }
        );
    }
}

$(document).ready(Index_Index.initialize);
