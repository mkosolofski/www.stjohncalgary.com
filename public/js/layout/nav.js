/**
 * Contains layout_nav.
 */

/**
 * Controlling logic for the top nav.
 */
var layout_nav = {
    /**
     * Id of the timer that unselects all nav items.
     */
    timerId:null,

    /**
     * Initializes the top nav with controlling logic. 
     */
    initialize:function()
    {
        // Set mouseover observers on each top nav item.
        $('.navTopItem').each(
            function(index, element)
            {
                $(element).mouseover(layout_nav.selectTopItem);
            }
        );

        // Set mouseover observers on each sub menu item.
        // Fix submenu widths.
        var widths = [];
        $('nav dt').each(
            function(index, element)
            {
                $(element).mouseover(layout_nav.selectSubItem);

                var parent = $(element).parent(),
                    parentId = parent.attr('id');

                if (!(parentId in widths)) widths[parentId] = 0;

                parent.show().css('visibility','hidden');
                
                if (widths[parentId] < $(element).width()) {
                    widths[parentId] = $(element).width();
                    parent.css('width', widths[parentId])
                }
            }
        );

        // Remove added visibility tags from submenu width fix.
        $('nav dt').parent().hide().css('visibility', '');

        // Set observer to focus away from the menu when clicked away from.
        $(document).click(
            function() {
                $('nav *').each(
                    function(index, element)
                    {
                        if (!$(element).is(':hover')) {
                            window.clearTimeout(layout_nav.timerId); 
                            layout_nav.unselectAll();
                        }
                    }
                );
            } 
        );
    },

    /**
     * Initializes timer that unselects all nav elements
     * when the user is no longer interacting with the nav.
     */
    initTimer:function()
    {
        window.clearTimeout(layout_nav.timerId); 
        layout_nav.timerId = window.setTimeout(
            function() {
                var unselectAll = true;
                $('nav *').each(
                    function(index, element)
                    {
                        if ($(element).is(':hover')) {
                            layout_nav.initTimer();
                            unselectAll = false;
                        }
                    }
                );

                if (unselectAll) {
                    layout_nav.unselectAll();
                }
            },
            3000
        );
    },

    /**
     * Unselects all nav items. 
     */
    unselectAll:function()
    {
        // Hide sub menus
        $('.navTopItemSelect').parent().find('dl').each(
            function()
            {
                $(this).fadeOut(150);
            }
        );
        
        // Unselect sub-menu items.
        $('.navSelectItem').each(
            function()
            {
                $(this).removeClass('navSelectItem')
            }
        );

        // Unselect top item.
        $('.navTopItemSelect').first().removeClass('navTopItemSelect')
    },

    /**
     * Selects the given top nav item.
     *
     * @param object event The event object that triggerred this method.
     */
    selectTopItem:function(event)
    {
        layout_nav.initTimer();

        var target = $(event.target);
        var subMenu = target.next('dl');

        // Display sub menu item if one exists.
        if (subMenu.html() != null) {
            if (subMenu.is(':visible')) {
                return;
            }
            subMenu.fadeIn(100);
        }

        layout_nav.unselectAll();

        // Select current top item.
        target.addClass('navTopItemSelect');
    },

    /**
     * Selects the given sub menu item.
     *
     * @param object event The event that triggerred this method.
     */
    selectSubItem:function(event)
    {
        layout_nav.initTimer();

        var target = $(event.currentTarget);
        var submenu = null;

        if (target.next() != null && target.next().is('dd')) {
            submenu = target.next().children('dl').first();
        }

        // Hide all sub menus of this menu except for the selected item.
        target.parent().find('dl').each(
            function()
            {
                if (submenu == null || submenu.attr('id') != this.id) {
                    $(this).fadeOut(150);
                }
            }
        );
        
        // Remove all sub menu item selections.
        target.parent()
            .find('.navSelectItem')
            .each(
                function()
                {
                    $(this).removeClass('navSelectItem')
                }
            );

        // Select the target menu item.
        target.children('div').first().addClass('navSelectItem');

        // Display the associated sub menu (if one exists).
        if (submenu != null && !submenu.is(':visible')) {
            submenu.fadeIn(150);
        }
    }
}

$(document).ready(layout_nav.initialize);
