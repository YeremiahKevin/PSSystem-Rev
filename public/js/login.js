function onClickLogin() {
    // Get user email and password
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Hash user password
    const hashPassword = md5(password);

    const data = {
        'email': email,
        'password': hashPassword
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/login',
        type: 'POST',
        data: data
    }).done(function (response) {
        if (response === 'Success') {
            window.location.href = '/dashboard';
        } else if (response === 'Wrong Email') {
            alert(response);
        } else if (response === 'Wrong Password') {
            alert(response);
        } else {
            alert('Error!');
        }
    }).fail(function (response) {
        alert(response.statusText);
    });
}

function onClickRegister() {
    window.location.href = '/register';
}