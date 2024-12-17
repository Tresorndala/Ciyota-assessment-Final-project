$(document).ready(function () {
  
    // Form submission for selecting class and number of students
    $('#registerform').submit(function (e) {
      e.preventDefault(); // Prevent the default form submission
  
      var className = $('#student_class').val(); // Get the selected class name
      var classNumber = $('#student').val(); // Get the number of students
  
      // Validation: Ensure no fields are empty
      if (className === '' || classNumber === '') {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please fill in all fields!' // Show error message if fields are empty
        });
        return; // Exit the function if validation fails
      }
  
      // Validate the class number to ensure it contains only digits
      var classNumberPattern = /^\d+$/;
      if (!classNumberPattern.test(classNumber)) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please enter a valid number for the class!' // Show error message for invalid number
        });
        return; // Exit the function if class number is invalid
      }
  
      // Proceed with submitting the form data via AJAX
      $.ajax({
        url: "../view/registerform.php", // The target URL for the form data
        type: "POST", // HTTP method type (POST)
        data: $(this).serialize(), // Serialize the form data
  
        success: function (response) {
          $(".content").html(response); // Update the content with the response
        },
        error: function (xhr, status, error) {
          console.error("Error:", error); // Log any errors in the AJAX request
        }
      });
    });
  
    // Event delegation for student registration form submission
    $(document).on('submit', '#formsubmit', function (e) {
      e.preventDefault(); // Prevent the default form submission
  
      var formData = $(this).serialize(); // Serialize the form data
      var isValid = true;
  
      // Validate student names: Check if each name contains only letters and spaces
      $(this).find('input[type="text"]').each(function() {
        var studentName = $(this).val().trim(); // Get the student name value and trim spaces
        var studentNamePattern = /^[a-zA-Z\s]+$/; // Pattern to allow only letters and spaces
  
        if (!studentNamePattern.test(studentName)) {
          isValid = false; // Set isValid to false if any name is invalid
          return false; // Exit the loop early if any name is invalid
        }
      });
  
      // If any name is invalid, show an error message
      if (!isValid) {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Please enter valid names for all students (letters and spaces only)!'
        });
        return; // Exit the function if name validation fails
      }
  
      // Proceed with submitting the form data via AJAX
      $.ajax({
        url: "../action/register_student_action.php", // The target URL for student registration
        type: "POST", // HTTP method type (POST)
        data: formData, // Send the form data
        dataType: "json", // Expect a JSON response from the server
  
        success: function (response) {
          if (response.success) {
            // If registration is successful, show success message
            Swal.fire({
              icon: "success",
              title: "Success!",
              text: response.message, // Display the success message
              onClose: () => {
                goBack(); // Go back to the previous page when closing the success message
              },
            });
          } else {
            // If registration fails, show error message
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: response.message, // Display the error message
            });
          }
        },
        error: function (xhr, status, error) {
          console.error('Error submitting form via AJAX: ' + error); // Log any AJAX errors
        }
      });
    });
  });
  
  // Function to go back to the previous page
  function goBack() {
    window.history.back();
  }
  
