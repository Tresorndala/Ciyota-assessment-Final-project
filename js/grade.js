// Wait for the document to be ready before executing the code
$(document).ready(function () {
  
  // Handle form submission for the navigation form (grade selection)
  $('#navform').submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    var className = $('#classname').val(); // Get the selected class name value
    var termName = $('#termname').val(); // Get the selected term name value
    var subject = $('#subject').val(); // Get the selected subject value
    var assessment = $('#assessment').val(); // Get the selected assessment value

    // Check if any of the fields are empty and show an error message if so
    if (className === '' || termName === '' || subject === '' || assessment === '') {
      Swal.fire({
        icon: 'error',
        title: 'Sorry...',
        text: 'Please fill in all fields!' // Show error message using SweetAlert
      });
      return; // Exit the function if any field is empty
    }

    // Perform an AJAX request to submit the form data
    $.ajax({
      url: '../view/grade_form_action.php', // The target URL for the request
      type: 'POST', // Method type POST
      data: $(this).serialize(), // Serialize the form data

      success: function (response) {
        $('.content').html(response); // Replace content with the response (next form)

        // Handle form submission for the grade form
        $('#gradeForm').submit(function (e) {
          e.preventDefault(); // Prevent default form submission
          var formData = $(this).serialize(); // Serialize the grade form data

          // Perform an AJAX request to submit the grade form data
          $.ajax({
            url: '../action/grade_action.php', // The target URL for the request
            type: 'POST', // Method type POST
            data: formData, // Send the form data
            dataType: 'json', // Expect JSON response
            success: function (response) {
              // Check if the grade submission was successful
              if (response.success) {
                Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: response.message, // Show success message
                  onClose: () => {
                    $('.content').empty(); // Clear the content after successful submission
                  }
                });
              } else {
                // Show error message if grade submission failed
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: response.message,
                });
              }
            },
            error: function (xhr, status, error) {
              console.error('Error submitting second form via AJAX: ' + error); // Log any errors
            }
          });
        });
      }
    });
  });
});

