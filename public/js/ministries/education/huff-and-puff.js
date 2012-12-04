/**
 * Initialize the slide show for the huff and puff page
 */
var Ministries_Education_HuffAndPuff = {
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

$(document).ready(Ministries_Education_HuffAndPuff.initialize);
