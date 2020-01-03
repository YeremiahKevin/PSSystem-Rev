let data = {
    'brand_id': null,
    'type': null,
};

function onClickLogo() {
    window.location.href = '/dashboard';
}

function changeBrand() {
    const selectedBrand = JSON.parse(document.getElementById('brand-selector').value);
    data.brand_id = selectedBrand.brand_id;
}

function onClickSubmit() {
    const type = document.getElementById('type').value;
    data.type = type;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/new-item',
        type: 'POST',
        data: data
    }).done(function (response) {
        alert(response);
        window.location.href = '/dashboard'
    }).fail(function (response) {
        alert(response.statusText);
    });
}
