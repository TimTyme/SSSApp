
$(document).ready(function() {
    $('#timepicker').timepicker({
        showPeriodLabel: true,
        showLeadingZero: true,
        hours: { starts: 8, ends: 16},
        minutes: { interval: 30},
        showCloseButton: true,
        closeButtonText: 'Done',
        rows: 2
    });
});