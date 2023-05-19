let table = new DataTable('#table', {
    lengthChange: false,
    pagingType: 'full_numbers',
    info: false,
    dom: '<"toolbar">frtip',
    // default sort: index 2, asc order
    // index 2 = name
    order: [[1, 'asc'], [2 ,'asc']],
    columnDefs: [
        {
            // first 2 columns cannot be sorted
            targets: "no-sort",
            orderable: false
        }
    ]
});

let url = window.location.pathname;
let route = url.split('/');
let eventId = route[route.length - 2];
let action = route[route.length - 1];

// console.log('event id = ' + eventId);
// console.log('action = ' + action);

let toolbar = $('<div>').addClass('toolbar');
let submitBtn = $('<button>')
    .addClass('btn btn-primary')
    .attr('type', 'submit')
    .text('UPDATE');
let cancelBtn = $('<button>')
    .addClass('btn btn-secondary')
    .attr('type', 'button')
    .click(function() {
        window.location.href = '/view-event/'+ eventId
    })
    .text('BACK');

submitBtn.css('margin-right', '10px');
toolbar.append(submitBtn, cancelBtn);

$('div.toolbar').html(toolbar);
