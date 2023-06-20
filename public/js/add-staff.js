$(document).ready(function () {
    $('#create-event').click(function () {
        $('form').submit();
    });

    let role;
    $('.add-staff button').click(function() {
        role = $(this).attr('data-role');
    });
    
    $('.staff-list button').click(function () {
        let staffId = $(this).attr('data-staffid');
        let staffName = $(this).attr('data-staffname');
        let listItem = $('<li>').addClass('list-group-item align-items-center li-categ');

        let input = $('<input>').attr({
            type: 'hidden',
            name: 'event-role[' + role + '][]',
            value: staffId
        });
        listItem.append(input).append(staffName);
        let removeButton = $('<button>').text('X');
        listItem.append(removeButton);
        $('#' + role).append(listItem);
        $('#staffs').modal('hide');

        removeButton.on('click', function() {
            $(this).parent().remove();
        });
        // Bandaid solution
        return false;
    });
});
