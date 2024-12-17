// Wait for the document to be ready before executing the code
$(document).ready(function () {

  // Handle form submission for the navigation form (grade selection)
  $('#navform').submit(function (e) {
    e.preventDefault(); // Prevent default form submission

    var className = $('#classname').val(); // Get the selected class name value
    var termName = $('#termname').val(); // Get the selected term name value
    var subject = $('#subject').val(); // Get the selected subject value
    var assessment = $('#assessment').val(); // Get the selected assessment value
    var year = $('#year').val(); // Get the entered year value

    // Regular expression to validate the year format (four digits)
    var yearRegex = /^\d{4}$/;

    // Check if any field is empty or the year format is invalid
    if (className === '' || termName === '' || subject === '' || assessment === '' || year === '') {
      Swal.fire({
        icon: 'error',
        title: 'Sorry...',
        text: 'Please fill in all fields!' // Show error message if any field is empty
      });
      return; // Exit the function if any field is empty
    } else if (!yearRegex.test(year)) {
      // If the year format is not valid
      Swal.fire({
        icon: 'error',
        title: 'Invalid Year',
        text: 'Please enter a valid year (YYYY format).' // Show error message for invalid year format
      });
      return; // Exit the function if year format is invalid
    }

    // Get the current year
    var currentYear = new Date().getFullYear();

    // Check if the entered year is not greater than the current year
    if (parseInt(year) > currentYear) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid Year',
        text: 'Please enter a year in the past or current year.' // Show error message for future years
      });
      return; // Exit the function if the year is greater than the current year
    }

    // Perform an AJAX request to submit the form data
    $.ajax({
      url: '../view/preview_grade.php', // The target URL for the request
      type: 'POST', // Method type POST
      data: $(this).serialize(), // Serialize the form data

      success: function (response) {
        $('.content').html(response); // Replace content with the response (next form)
      },
      error: function (xhr, status, error) {
        console.error('Error submitting second form via AJAX: ' + error); // Log any errors
      }
    });
  });
});













$(document).ready(function () {
    $(document).on("click", ".edit", function (e) {
      e.preventDefault();
  
      var studentID = $(this).data("grade-id");
  
      $.ajax({
        url: "../view/edit_grade_view.php",
        type: "GET",
        data: { id: studentID},
        success: function (response) {
          $(".content").html(response);
  
          $(".editgradeForm").submit(function (e) {
            e.preventDefault();
            var formData = $(this).serialize();
  
            $.ajax({
              url: "../action/edit_grade action.php",
              type: "POST",
              data: formData,
              dataType: "json",
              success: function (response) {
                if (response.success) {
                  Swal.fire({
                    title: "Saved",
                    text: response.message,
                    icon: "success",
                    onClose: function () {
  
                      window.location.href='../view/student_grades_recodedview.php';
  
                    },
                  });
                } else {
                  Swal.fire({
                    title: "Error",
                    text: response.message,
                    icon: "error",
                  });
                }
              },
              error: function (xhr, status, error) {
                console.error("Error performing edit action: " + error);
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
          console.error("Error performing edit action: " + error);
        },
      });
    });
  });
  


$(document).on("click", ".delete", function (e) {
    e.preventDefault();
  
    var gradeID = $(this).data("grade-id");
  
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
       
        $.ajax({
          url: "../action/delete grade action.php",
          type: "GET",
          data: { id: gradeID },
          dataType: "json",
          success: function (response) {
            if (response.success) {
             
              $('[data-grade-id="' + gradeID + '"]')
                .closest("tr")
                .remove();
              Swal.fire({
                title: "Deleted!",
                text: response.message,
                icon: "success",
              });
            } else {
             
              Swal.fire({
                title: "Error!",
                text: response.message,
                icon: "error",
              });
            }
          },
          error: function (xhr, status, error) {
            console.error("Error performing delete action: " + error);
           
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
  