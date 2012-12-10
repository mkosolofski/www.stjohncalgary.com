/**
 * Contains Admin_Content_Index.
 */

/**
 * Adds dynamics to the content admin page.
 */
var Admin_Content_Index = {
    
    /**
     * Initializes the page with dynamics. 
     */
    initialize:function()
    {
        $('#file').change(Admin_Content_Index.getContent);
        $('#saveButton').click(Admin_Content_Index.saveContent);
        $('#editContent').keyup(Admin_Content_Index.updatePreview);
    },

    /**
     * Displays the contents for selected file.
     */
    getContent:function()
    {
        $('#saveButton').removeAttr('disabled');

        $.ajax(
            {
                type: 'POST',
                url: '/admin/ajax/index',
                data: {
                    sub: 'content/index',
                    script: 'getcontent',
                    params: {filePath : $(this).val()}
                }
            }
        ).done(
            function(response)
            {
                $('#editContent').val(response);
                Admin_Content_Index.updatePreview();
            }
        );
    },

    /**
     * Saves the content that is currently being edited.
     */
    saveContent:function()
    {
        if ($('#editContent').val() == '') {
            alert('There is no content to save');
            return;
        }
       
        if (confirm('Are you sure you want to save this file? This will overwrite the existing contents of the live file!')) {
            $.ajax(
                {
                  type: 'POST',
                  url: '/admin/ajax/index',
                    data: {
                        sub: 'content/index',
                        script: 'savecontent',
                        params: {
                            filePath : $('#file').val(),
                            content : $('#editContent').val()
                        }
                    }
                }
            ).done(
                function(response) {
                    window.location.reload();
                }
            );
        }
    },

    /**
     * Updates the preview with what is currently in the edit box. 
     */
    updatePreview:function()
    {
        setTimeout(
            function()
            {
                $('#preview-iframe').contents().find('body').html($('#editContent').val());
            },
            100
        );
    }
}

$(window).load(Admin_Content_Index.initialize);
