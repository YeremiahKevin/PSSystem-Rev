let data = {
    'phone_detail_id': null,
    'stock': null,
};

function onClickLogo() {
    window.location.href = '/dashboard';
}

function changePhone() {
    const phoneSelected = JSON.parse(document.getElementById('phone-selector').value);

    if (!phoneSelected) {
        document.getElementById('current-stock').innerHTML = '';
    } else {
        data.phone_detail_id = phoneSelected.phone_detail_id;
        document.getElementById('current-stock').innerHTML =
            '<div class="col-md-12 mt-3">\n' +
            '<span class="font-weight-bold">Current Stock</span>\n' +
            '</div>\n' +
            '<div class="col-md-12">\n' +
            '<input disabled="true" type="text" id="input-current-stock" placeholder="phone current stock">\n' +
            '</div>';

        const inputCurrentStock = document.getElementById('input-current-stock');
        inputCurrentStock.value = phoneSelected.stock;
    }
}

function onClickSubmit() {
    data.stock = Number(document.getElementById('stock').value);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/add-phone-stock',
        type: 'POST',
        data: data
    }).done(function (response) {
        alert(response);
        window.location.href = '/dashboard'
    }).fail(function (response) {
        alert(response.statusText);
    });
}
