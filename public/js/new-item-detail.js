let data = {
    'phone_id': null,
    'color': null,
    'memory': null,
    'storage': null,
    'stock': null,
    'price': null,
};

function onClickLogo() {
    window.location.href = '/dashboard';
}

function changePhone() {
    const selectedPhone = JSON.parse(document.getElementById('phone-selector').value);
    data.phone_id = selectedPhone.phone_id;
}

function onClickSubmit() {
    data.color = document.getElementById('color').value;
    data.memory = Number(document.getElementById('memory').value);
    data.storage = Number(document.getElementById('storage').value);
    data.stock = Number(document.getElementById('stock').value);
    data.price = Number(document.getElementById('price').value);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/new-item-detail',
        type: 'POST',
        data: data
    }).done(function (response) {
        alert(response);
        window.location.href = '/dashboard'
    }).fail(function (response) {
        alert(response.statusText);
    });
}
