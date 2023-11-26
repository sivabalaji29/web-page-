function registerUser() {
    // Use jQuery AJAX to send registration data to the server
    $.ajax({
        type: 'POST',
        url: '/assets/php/register.php',
        data: $('#registerForm').serialize(),
        success: function(response) {
            // Handle the response (e.g., show a success message)
            console.log(response);

            // Redirect to the register.html page
            window.location.href = '/assets/html/login.html';
        },
        error: function(error) {
            // Handle the error (e.g., show an error message)
            console.error(error);
        }
    });
}
