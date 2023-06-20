$(document).ready(function () {
	let datePicker = document.querySelectorAll('.datepicker');

	$('.datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		maxDate: '+1Y',
		showOn: 'focus',
		onSelect: function(dateText, inst) {
			sessionStorage.setItem(inst.id, dateText);
		}
	});

	datePicker.forEach(function (input) {
		let savedValue = sessionStorage.getItem(input.id);
		if (savedValue) {
			$(input).val(savedValue);
		}
	});

});
