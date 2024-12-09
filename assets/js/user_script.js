


$(document).ready(function () {
    // Initialize DataTable
    var counter = 0;
    const table = $('#userTable').DataTable({
        ajax: {
            url: '../ajax/fetch_user.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 
                function(){
                    counter++;
                    return counter;
                }
            },
            { data: 'email' },
            { data: 'username' },
            { data: 'role' },
            { data: 'date_created' },
            {
                
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="edit-btn-userpass btn btn-warning btn-sm"
                            data-id="${row.id}"
                            data-toggle="modal" 
                            data-target="#userpassModal">
                            Edit
                        </button>
                        <button class="delete-btnuser btn btn-danger btn-sm" 
                            data-id="${row.id}">
                            Delete
                        </button>
                    `;
                },
            },
        ],
        dom: '<"row"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6 text-right"l>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
        },
        pagingType: "full_numbers", // Better pagination styling
        responsive: true, // Make it responsive
    });



    // Add user account
    $('#addUserForm').on('submit', function (e) {
        e.preventDefault();

        const password1 = $('#first_pwd').val();
        const password2 = $('#second_pwd').val();
        if (password1 !== password2) {
            alert('Passwords do not match!');
            return;
        }

        const formData = {
            email: $('#email').val(),
            username: $('#username').val(),
            first_pwd: password1,
            second_pwd: password2,
            role: $('#role').val(),
        };

        $.ajax({
            type: 'POST',
            url: '../ajax/add_user.php',
            data: formData,
            success: function (response) {
                const result = JSON.parse(response);
                alert(result.message);
                if (result.success) {
                    $('#userModal').modal('hide');
                    table.ajax.reload();
                    $('#addUserForm')[0].reset();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while adding the user.');
            },
        });
    });


    // Open modal and populate fields for editing
    $(document).on('click', '.edit-btn-userpass', function () {
        const id = $(this).data('id');


        // Populate modal fields
        $('#editIdUserpass').val(id);

    });

    // Reset modal when closing
    $('#userpassModal').on('hidden.bs.modal', function () {
        $('#updateUserpassForm')[0].reset(); // Reset the form
        $('#editIdUserpass').val(''); // Clear the hidden field
    });


    // Update  user account password
    // $('#updateUserpassForm').on('submit', function (e) {
    //     e.preventDefault();

    //     const id = $('#editIdUserpass').val();
    //     const current_password = $('#current_password').val();
    //     const password1 = $('#first_pwd_update').val();
    //     const password2 = $('#second_pwd_update').val();

    //     if (password1 !== password2) {
    //         alert('Passwords do not match!');
    //         return;
    //     }

    //     const formData = {
    //         id: id,
    //         current_password: current_password,
    //         password1: password1,
    //         password2: password2,
    //     };

    //     $.ajax({
    //         type: 'POST',
    //         url: '../ajax/edit_user.php',
    //         data: formData,
    //         success: function (response) {
    //             const result = JSON.parse(response);
    //             alert(result.message);
    //             if (result.success) {
    //                 $('#userpassModal').modal('hide');
    //                 table.ajax.reload();
    //                 $('#updateUserpassForm')[0].reset();
    //             }
    //         },
    //         error: function (xhr, status, error) {
    //             console.error('Error:', error);
    //             alert('An error occurred while updating password.');
    //         },
    //     });
    // });



    // Update user account password
$('#updateUserpassForm').on('submit', function (e) {
    e.preventDefault();

    const id = $('#editIdUserpass').val();
    const current_password = $('#current_password').val();
    const new_password = $('#first_pwd_update').val();
    const confirm_password = $('#second_pwd_update').val();

    if (new_password !== confirm_password) {
        alert('Passwords do not match!');
        return;
    }

    const formData = {
        id: id,
        current_password: current_password,
        first_pwd_update: new_password,
        second_pwd_update: confirm_password
    };

    $.ajax({
        type: 'POST',
        url: '../ajax/edit_user.php',
        data: formData,
        success: function (response) {
            const result = JSON.parse(response);
            alert(result.message);
            if (result.success) {
                $('#userpassModal').modal('hide'); // Close modal
                table.ajax.reload(); // Reload DataTable
                $('#updateUserpassForm')[0].reset(); // Reset form
            }
        },
        error: function (xhr, status, error) {
            console.error('Error:', error);
            alert('An error occurred while updating the password.');
        },
    });
});


    // Delete Resident Logic
    $(document).on('click', '.delete-btnuser', function () {
        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this User account?')) {
            $.post('../ajax/delete_user.php', { id }, function (response) {
                const result = JSON.parse(response);
                alert(result.message);

                if (result.success) {
                    table.ajax.reload();
                    console.log('deleted'); //
                }
            });
        }
    });

   
    
});


