function confirmSignOut() {
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you really want to sign out?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sign Out'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form if confirmed
            document.getElementById('signOutForm').submit();
        }
    });
}