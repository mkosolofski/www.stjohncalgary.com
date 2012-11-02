/**
 * Adds dynamics to the admin news page.
 */
var Admin_Home_News = {
    /**
     * Confirmation pop up when a user tries to delete a news item.
     *
     * @param int newsId The news item id.
     * @param int archivedFlag 1 if in archive mode, 0 otherwise.
     */
    deleteNews:function(newsId, archivedFlag)
    {
        if (confirm('Are you sure you want to delete this news item?')) {
            window.location = '/admin/home_news/delete?id=' + newsId + '&archived=' + archivedFlag;
        }
    },

    /**
     * Displays the news body preview 
     */
    showPreview:function()
    {
        var content = $('#newsBody').val();
        if (content == '') {
            $('#newsBodyPreview,#editButton').show();
            $('#newsBody,#previewButton').hide();
            $('#newsBody').html('');
            return;
        }

        $.ajax(
            {
                type: "POST",
                url: "/admin/ajax/index",
                data: {
                    sub : 'news',
                    script: 'preview',
                    params: {
                        'content' : content
                    }
                }
            }
        ).done(
            function(response)
            {
                $('#newsBodyPreview,#editButton').show();
                $('#newsBody,#previewButton').hide();
                $('#newsBodyPreview').html(response);
            }
        );
    },

    /**
     * Hides the news body preview.
     */
    hidePreview:function()
    {
        $('#newsBodyPreview,#editButton').hide();
        $('#newsBody,#previewButton').show();
    }
}

$(window).ready(Admin_Home_News.initialize);
