function loginUser() {
    // Use jQuery AJAX to send login data to the server
    $.ajax({
        type: 'POST',
        url: '/assets/php/login.php',
        data: $('#loginForm').serialize(),
        success: function(response) {
            // Handle the response (e.g., redirect to profile page)
            console.log(response);
            if (response.success) {
                window.location.href = '/assets/php/profile.php';
            } else {
                // Handle the case where login is unsuccessful
                console.error(response.message);
            }
        },
        error: function(error) {
            // Handle the error (e.g., show an error message)
            console.error(error);
        }
    });
}
