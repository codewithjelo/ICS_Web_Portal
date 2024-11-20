function deleteCertificate(button) {
    // Fetch announcement ID from the button's data-* attribute
    var certificateId = button.getAttribute("data-certificate-id");
  
    // SweetAlert2 confirmation before deletion
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
        // Create AJAX request to delete the announcement
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../function/deleteCertificate.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
        // Handle response
        xhr.onload = function () {
          if (xhr.status === 200) {
            // Successfully deleted, now remove the announcement from the DOM
            var certificateRow = button.closest(".row");
            certificateRow.remove();
  
            // Show success message
            Swal.fire(
              "Deleted!",
              "Certificate has been deleted.",
              "success"
            );
          } else {
            // Show error message
            Swal.fire(
              "Error!",
              "There was an issue deleting the Certificate. Please try again.",
              "error"
            );
          }
        };
  
        // Send the request with the announcement ID
        xhr.send("certificate_id=" + certificateId);
      }
    });
  }