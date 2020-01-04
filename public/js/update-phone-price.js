let data = {
    'phone_detail_id': null,
    'price': null,
};

function onClickLogo() {
    window.location.href = '/dashboard';
}

function changePhone() {
    const selectedPhone = JSON.parse(document.getElementById('phone-selector').value);
    data.phone_detail_id = selectedPhone.phone_detail_id;

    document.getElementById('previous-price').innerHTML =
        '<div class="col-md-12 mt-3">\n' +
        '<span class="font-weight-bold">Previous Price</span>\n' +
        '</div>\n' +
        '<div class="col-md-12">\n' +
        '<input disabled="true" type="text" id="input-previous-price" placeholder="phone previous price">\n' +
        '</div>';

    const inputPreviousPrice = document.getElementById('input-previous-price');
    inputPreviousPrice.value = selectedPhone.price;
}

function onClickSubmit() {
    data.price = document.getElementById('new-price').value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/update-phone-price',
        type: 'POST',
        data: data
    }).done(function (response) {
        alert(response);
        window.location.href = '/dashboard'
    }).fail(function (response) {
        alert(response.statusText);
    });
}
