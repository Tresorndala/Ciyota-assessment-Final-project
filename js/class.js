// Wait for the document to be ready before executing the code
$(document).ready(function () {
  
  // Handle form submission for changing class
  $("#classform").submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    var classname = $("#student_class").val(); // Get selected class value

    // If no class is selected, show an error message using SweetAlert
    if (classname === "") {
      Swal.fire({
        icon: "error",
        title: "Sorry..",
        text: "please select a class",
      });
      return; // Exit the function if no class is selected
    }

    // Perform an AJAX request to submit the form data
    $.ajax({
      url: "../view/view_class.php", // The target URL for the request
      type: "POST", // Method type POST
      data: $(this).serialize(), // Serialize the form data
      success: function (response) {
        $(".content").html(response); // Replace content with response data
      },
    });
  });
});

// Wait for the document to be ready before executing the code
$(document).ready(function () {
  
  // Handle click event on elements with class 'edit'
  $(document).on("click", ".edit", function (e) {
    e.preventDefault(); // Prevent default behavior of the click event

    var studentID = $(this).data("student-id"); // Get student ID from data attribute
    var actionName = $(this).data("action-name"); // Get action name from data attribute

    // Perform an AJAX request to fetch the edit form for the student
    $.ajax({
      url: "../view/edit_Name_view.php", // The target URL for the request
      type: "GET", // Method type GET
      data: { id: studentID, name: actionName }, // Send student ID and action name as data
      success: function (response) {
        $(".content").html(response); // Replace content with the response (edit form)

        // Handle form submission for editing the student name
        $(".editnameForm").submit(function (e) {
          e.preventDefault(); // Prevent default form submission
          var formData = $(this).serialize(); // Serialize the form data

          // Perform an AJAX request to submit the form data
          $.ajax({
            url: "../action/edit action.php", // The target URL for the request
            type: "POST", // Method type POST
            data: formData, // Send the form data
            dataType: "json", // Expect JSON response
            success: function (response) {
              // Check if the update was successful
              if (response.success) {
                Swal.fire({
                  title: "Saved",
                  text: response.message,
                  icon: "success",
                  onClose: function () {
                    window.location.href = '../view/class_view.php'; // Redirect on success
                  },
                });
              } else {
                // Show error message if update failed
                Swal.fire({
                  title: "Error",
                  text: response.message,
                  icon: "error",
                });
              }
            },
            error: function (xhr, status, error) {
              console.error("Error performing edit action: " + error); // Log error
              Swal.fire({
                title: "Error",
                text: "Failed to save changes.",
                icon: "error",
              });
            },
          });
        });
      },
      error: function (xhr, status, error) {
        console.error("Error performing edit action: " + error); // Log error if request fails
      },
    });
  });
});

// Handle student deletion when an element with class 'delete' is clicked
$(document).on("click", ".delete", function (e) {
  e.preventDefault(); // Prevent default behavior of the click event

  var studentID = $(this).data("student-id"); // Get student ID from data attribute

  // Show a confirmation dialog before deletion using SweetAlert
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true, // Show cancel button
    confirmButtonColor: "#3085d6", // Set confirm button color
    cancelButtonColor: "#d33", // Set cancel button color
    confirmButtonText: "Yes, delete it!", // Confirm button text
  }).then((result) => {
    if (result.isConfirmed) { // If confirmed, proceed with deletion

      // Perform an AJAX request to delete the student
      $.ajax({
        url: "../action/delete action.php", // The target URL for the request
        type: "GET", // Method type GET
        data: { id: studentID }, // Send student ID as data
        dataType: "json", // Expect JSON response
        success: function (response) {
          // If deletion was successful, remove the student from the table
          if (response.success) {
            $('[data-student-id="' + studentID + '"]')
              .closest("tr") // Find the table row containing the student
              .remove(); // Remove the row from the table
            Swal.fire({
              title: "Deleted!",
              text: response.message,
              icon: "success",
            });
          } else {
            // Show error message if deletion failed
            Swal.fire({
              title: "Error!",
              text: response.message,
              icon: "error",
            });
          }
        },
        error: function (xhr, status, error) {
          console.error("Error performing delete action: " + error); // Log error if request fails
          Swal.fire({
            title: "Error!",
            text: "Failed to delete the student.",
            icon: "error",
          });
        },
      });
    }
  });
});
