/**
 * Contains layout_user.
 */

/**
 * Contains user methods associated to layout functionality.
 */
var layout_usertoolbar = {
    /**
     * Logs a user in based on the log in form.
     */
    login:function()
    {
        $.ajax(
            {
                type: 'POST',
                url: '/ajax/index',
                dataType: 'text',
                data: {
                    sub : 'user',
                    script : 'login',
                    params : {
                        email : $('#emailLogin').val(),
                        password : $('#passwordLogin').val()
                    }
                }
            }
        ).done(function(response){eval(response);});
    },

    /**
     * Logs the current user out.
     */
    logout:function()
    {
        $.ajax(
            {
                type: 'POST',
                url: '/ajax/index',
                dataType: 'text',
                data: {
                    sub : 'user',
                    script : 'logout'
                }
            }
        ).done(function(response){eval(response);});
    }
}
