// profile.js

$(document).ready(function() {
    // Assume you have a PHP file that fetches user details from both MySQL and MongoDB
    $.ajax({
        type: 'GET',
        url: '/assets/php/profile.php',  // Replace with the actual path to your PHP file
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                // Display user profile details
                displayUserProfile(response.userDetails);
            } else {
                // Handle error, e.g., show an error message
                console.error(response.message);
            }
        },
        error: function(error) {
            // Handle AJAX error, e.g., show an error message
            console.error("AJAX Error:", error);
        }
    });

    function displayUserProfile(userDetails) {
        // Insert user profile details into the HTML
        var profileDetails = $('#profileDetails');
        profileDetails.append("<p>Username: " + userDetails.username + "</p>");
        profileDetails.append("<p>Age: " + userDetails.age + "</p>");
        profileDetails.append("<p>DOB: " + userDetails.dob + "</p>");
        profileDetails.append("<p>Contact: " + userDetails.contact + "</p>");
        // Add other fields as needed
    }
});
