/**
 * Adds dynamics to the admin event page.
 */
var Admin_Home_Event = {
    /**
     * Initializes the date time picker for the admin page.
     */
    initialize:function()
    {
        // Initialize date/time picker
        $('#eventDate').datetimepicker(
            {
                minDateTime : new Date(),
                ampm : true
            }
        );
    },

    /**
     * Confirmation pop up when a user tries to delete an event. 
     *
     * @param int eventId The event id.
     * @param int expiredFlag 1 if in expired mode, 0 otherwise.
     */
    deleteEvent:function(eventId, expiredFlag)
    {
        if (confirm('Are you sure you want to delete this event?')) {
            window.location = '/admin/home_event/delete?id=' + eventId + '&expired=' + expiredFlag;
        }
    }
}

$(window).ready(Admin_Home_Event.initialize);
