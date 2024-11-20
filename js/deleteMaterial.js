function deleteMaterial(button) {
    // Fetch announcement ID from the button's data-* attribute
    var schoolMaterialId = button.getAttribute("data-material-id");
  
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
        xhr.open("POST", "../function/deleteMaterials.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
        // Handle response
        xhr.onload = function () {
          if (xhr.status === 200) {
            // Successfully deleted, now remove the announcement from the DOM
            var materialRow = button.closest(".row");
            materialRow.remove();
  
            // Show success message
            Swal.fire(
              "Deleted!",
              "File has been deleted.",
              "success"
            );
          } else {
            // Show error message
            Swal.fire(
              "Error!",
              "There was an issue deleting the file. Please try again.",
              "error"
            );
          }
        };
  
        // Send the request with the announcement ID
        xhr.send("material_id=" + schoolMaterialId);
      }
    });
  }