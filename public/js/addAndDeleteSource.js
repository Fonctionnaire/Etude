
jQuery(document).ready(function () {


    jQuery('.etude-add-source-link').click(function (e) {
        e.preventDefault();
        var list = jQuery(jQuery(this).attr('data-list'));
        // Try to find the counter of the list
        var counter = list.data('widget-counter') | list.children().length;
        // If the counter does not exist, use the length of the list
        if (!counter) { counter = list.children().length; }

        // grab the prototype template
        var newWidget = list.attr('data-prototype');
        // replace the "__name__" used in the id and name of the prototype
        // with a number that's unique to your emails
        // end name attribute looks like name="contact[emails][2]"
        newWidget = newWidget.replace(/__name__/g, counter);
        // Increase the counter
        counter++;
        // And store it, the length cannot be used if deleting widgets is allowed
        list.data(' widget-counter', counter);

        // create a new list element and add it to the list
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.css('height', '0px');
        newElem.appendTo(list).animate({height: '100px'}, "slow");

        if(counter >= 3)
        {
            $('.etude-add-source-link').hide();
        }

        if (counter >= 2){
            addDeleteLink(newElem);
        }
    });
    function addDeleteLink(newElem) {

        var $deleteLink = $('<a href="#" class="etude-delete-source-link red-text">Supprimer la source</a>');

        newElem.append($deleteLink);

        $deleteLink.click(function(e) {
            newElem.remove();
            $('.etude-add-source-link').show();
            e.preventDefault();
            return false;
        });
    }
});