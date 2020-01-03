function onClickLogo() {
    window.location.href = '/dashboard';
}

function changeMonth() {
    const month_number = document.getElementById('month-selector').value;
    console.log(month_number);

    const data = {
        month_number: month_number
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const url = '/api/report/' + month_number;
    window.open(url);
}
