$(document).ready(function () {
    $('#create-event').click(function () {
        $('form').submit();
    });
    
    $('.categories button').click(function () {
        let category = $(this).attr('data');
        let listItem = $('<li>').addClass('list-group-item align-items-center li-categ');

        let input = $('<input>').attr({
            type: 'hidden',
            name: 'category[event-categories][]',
            value: category
        });
        listItem.append(input).append(category);
        let removeButton = $('<button>').text('X');
        listItem.append(removeButton);
        $('#category').append(listItem);
        $('#categories').modal('hide');

        removeButton.on('click', function() {
            $(this).parent().remove();
        });
        // Bandaid solution
        return false;
    });
});
