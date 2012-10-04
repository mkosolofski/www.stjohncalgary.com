/**
 * Contains Form_Register
 */

/**
 * Contains methods for adding interactivity to the register form.
 */
var Form_Register = {
    /**
     * Initialize the register form.
     */
    initialize:function()
    {
        $('#submitButton').click(
            function(){
                if (Form_Register.validate() == true) {
                    $.ajax(
                        {
                            type: 'POST',
                            url: '/ajax/index',
                            dataType: 'text',
                            data: {
                                sub : 'user',
                                script : 'register',
                                params : {
                                    email : $('#email').val(),
                                    password : $('#password').val()
                                }
                            }
                        }
                    ).done(function(response){eval(response);});
                }
            }
        );

        $('#email').focus();
    },

    /**
     * Validates the register form. 
     */
    validate:function()
    {
        $('#emailMessage, #passwordMessage').html('');

        // Email address
        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
        if (pattern.test($('#email').val()) == false) {
            $('#emailMessage').html('Invalid email address<br/>Ex: yourname@domain.com');
        }

        // Password
        var password = $('#password').val();
        if (password.length < 5 || password.length > 32 || /(\d)/.test(password) == false) {
            $('#passwordMessage').html('Please specify a password beween 5 and 32 characters<br/>long containing at least one number');

        } else if (password != $('#passwordConfirm').val()) {
            $('#passwordMessage').html('The confirm password does not match');
        }

        return ($('#emailMessage').html() == '' && $('#passwordMessage').html() == '');
    }
}

$(document).ready(function(){Form_Register.initialize()});
