function onClickSubmit() {
    const fullName = document.getElementById("fullName").value;
    const gender = document.getElementById("gender").value;
    const nik = document.getElementById("nik").value;
    const address = document.getElementById("address").value;
    const phone = document.getElementById("phone").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const hashPassword = md5(password);

    const data = {
        'fullName': fullName,
        'gender': gender,
        'nik': nik,
        'address': address,
        'phone': phone,
        'email': email,
        'password': hashPassword
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const storeStaffData = $.ajax({
        url: '/api/register',
        type: 'POST',
        data: data
    }).done(function () {
        alert('Success !');
        window.location.href = '/';
    }).fail(function () {
        alert('Failed to save data !');
    });

}