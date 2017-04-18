//Muestra un datePicker al dar clic en el campo fecha
$(document).ready(function() {
    $('.js-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:'TRUE',
        autoclose: true,
        defaultViewDate: {year:2000, month:0, day:1},
    });
});