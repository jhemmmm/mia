$(document).on('click', '.number-spinner button', function () {
    var btn = $(this),
        oldValue = btn.closest('.number-spinner').find('input').val().trim(),
        newVal = 0,
        minVal = btn.closest('.number-spinner').find('input').attr('min'),
        maxVal = btn.closest('.number-spinner').find('input').attr('max');

    if (btn.attr('data-dir') == 'up') {
        if (parseInt(maxVal) > parseInt(oldValue))
            newVal = parseInt(oldValue) + 1;
        else
            newVal = parseInt(oldValue);
    } else {
        if (parseInt(minVal) != parseInt(oldValue))
            newVal = parseInt(oldValue) - 1;
        else
            newVal = parseInt(minVal);
    }
    btn.closest('.number-spinner').find('input').val(newVal);
});
