// Wait for the document to be ready before executing the code
$(document).ready(function () {

  // Handle form submission for the navigation form (report generation)
  $("#navform").submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    var className = $("#classname").val(); // Get the selected class name value
    var termName = $("#termname").val(); // Get the selected term name value
    var year = $("#year").val(); // Get the entered year value

    // Regular expression to validate the year format (four digits)
    var yearRegex = /^\d{4}$/;

    // Check if any field is empty or the year format is invalid
    if (className === "" || termName === "" || year === "") {
      Swal.fire({
        icon: "error",
        title: "Sorry...",
        text: "Please fill in all fields!" // Show error message if any field is empty
      });
      return; // Exit the function if any field is empty
    } else if (!yearRegex.test(year)) {
      // If the year format is not valid
      Swal.fire({
        icon: "error",
        title: "Invalid Year",
        text: "Please enter a valid year (YYYY format)." // Show error message for invalid year format
      });
      return; // Exit the function if year format is invalid
    }

    // Get the current year
    var currentYear = new Date().getFullYear();

    // Check if the entered year is not greater than the current year
    if (parseInt(year) > currentYear) {
      Swal.fire({
        icon: "error",
        title: "Invalid Year",
        text: "Please enter a year in the past or current year." // Show error message for future years
      });
      return; // Exit the function if the year is greater than the current year
    }

    // Perform an AJAX request to submit the form data
    $.ajax({
      url: "../view/report_view.php", // The target URL for the request
      type: "POST", // Method type POST
      data: $(this).serialize(), // Serialize the form data

      success: function (response) {
        $(".content").html(response); // Replace content with the response (generated report)
      },
      error: function (xhr, status, error) {
        console.error("Error submitting form via AJAX: " + error); // Log any errors
      }
    });
  });
});

// Handle click event for promoting a student
$(document).on("click", ".promoted", function (e) {
  e.preventDefault(); // Prevent default action of the click event

  var StudentID = $(this).data("student-id"); // Get the student ID from the clicked element
  var name = $(this).data("student-name"); // Get the student name from the clicked element

  // Display confirmation popup using SweetAlert
  Swal.fire({
    title: "Are you sure you want to promote " + name + " ?", // Title with student's name
    text: "You won't be able to revert this!", // Warning text
    icon: "warning", // Warning icon
    showCancelButton: true, // Show cancel button
    confirmButtonColor: "#3085d6", // Confirm button color
    cancelButtonColor: "#d33", // Cancel button color
    confirmButtonText: "Yes!" // Confirm button text
  }).then((result) => {
    // If user confirms the promotion
    if (result.isConfirmed) {
      $.ajax({
        url: "../action/promote action.php", // The target URL for the promotion action
        type: "GET", // Method type GET
        data: { id: StudentID }, // Send the student ID as data
        dataType: "json", // Expect a JSON response
        success: function (response) {
          // If the promotion is successful
          if (response.success) {
            Swal.fire({
              title: "Promoted!", // Success title
              text: response.message, // Display success message from server
              icon: "success" // Success icon
            });
          } else {
            // If there is an error in the promotion process
            Swal.fire({
              title: "Error!", // Error title
              text: response.message, // Display error message from server
              icon: "error" // Error icon
            });
          }
        },
        error: function (xhr, status, error) {
          console.error("Error performing promotion action: " + error); // Log any errors

          // If AJAX request fails
          Swal.fire({
            title: "Error!", // Error title
            text: "Failed to promote the student.", // Error message
            icon: "error" // Error icon
          });
        }
      });
    }
  });
});


