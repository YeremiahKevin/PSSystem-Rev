let data = {
    'brand_id': null,
    'phone_id': null,
    'phone_detail_id': null,
    'quantity': null
};

function onClickLogo() {
    window.location.href = '/dashboard';
}

function changeBrand() {
    const selectedBrand = JSON.parse(document.getElementById('brand-selector').value);
    data.brand_id = selectedBrand.brand_id;

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    //
    // $.ajax({
    //     url: '/api/parameter/select-phone',
    //     type: 'POST',
    //     data: data
    // }).done(function (response) {
    //     // View phone selector by selected brand
    //     let phones = '';
    //     response.forEach(phone => {
    //         phones += '<option>' + phone.phone_name + ' ' + phone.color + ' ' + phone.memory + '/' + phone.storage + 'GB' + '</option>';
    //     });
    //     $('#phone-selector').html(phones);
    //     console.log(response);
    // }).fail(function (response) {
    //     alert(response.statusText);
    // });
}

function changePhone() {
    const selectedPhone = JSON.parse(document.getElementById('phone-selector').value);
    data.phone_id = selectedPhone.phone_id;
    data.phone_detail_id = selectedPhone.phone_detail_id;
}

function changeQuantity() {
    data.quantity = Number(document.getElementById('quantity').value);
}

function onSubmit() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/transaction',
        type: 'POST',
        data: data
    }).done(function (response) {
        alert(response);
        window.location.href = '/dashboard'
    }).fail(function (response) {
        alert(response.statusText);
    });
}
