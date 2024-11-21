$(document).ready(function () {
    // Initialize DataTable
    const table = $('#residentTable').DataTable({
        ajax: {
            url: '../ajax/fetch_resident.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'age' },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="edit-btn btn btn-warning btn-sm" 
                            data-id="${row.id}" 
                            data-name="${row.name}" 
                            data-email="${row.email}" 
                            data-age="${row.age}" 
                            data-toggle="modal" 
                            data-target="#residentModal">
                            Edit
                        </button>
                        <button class="delete-btn btn btn-danger btn-sm" 
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

    // Open modal and populate fields for editing
    $(document).on('click', '.edit-btn', function () {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const email = $(this).data('email');
        const age = $(this).data('age');

        // Populate modal fields
        $('#editId').val(id);
        $('#name').val(name);
        $('#email').val(email);
        $('#age').val(age);

        // Change modal title and button text
        $('#residentModalLabel').text('Edit Resident');
        $('#btn_addUpdate').text('Update');
    });

    // Reset modal when closing
    $('#residentModal').on('hidden.bs.modal', function () {
        $('#addResidentForm')[0].reset(); // Reset the form
        $('#editId').val(''); // Clear the hidden field
        $('#residentModalLabel').text('Add Resident'); // Reset modal title
        $('#btn_addUpdate').text('Add'); // Reset button text
    });

    // Add/Edit Resident Logic
    $('#addResidentForm').on('submit', function (e) {
        e.preventDefault();

        const id = $('#editId').val();
        const formData = {
            id: id || null,
            name: $('#name').val(),
            email: $('#email').val(),
            age: $('#age').val(),
        };

        const url = id ? '../ajax/edit_resident.php' : '../ajax/add_resident.php';

        $.post(url, formData, function (response) {
            const result = JSON.parse(response);
            alert(result.message);

            if (result.success) {
                $('#residentModal').modal('hide');
                table.ajax.reload(); // Reload table
                $('#addResidentForm')[0].reset();
            }
        });
    });

    // Delete Resident Logic
    $(document).on('click', '.delete-btn', function () {
        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this resident?')) {
            $.post('../ajax/delete_resident.php', { id }, function (response) {
                const result = JSON.parse(response);
                alert(result.message);

                if (result.success) {
                    table.ajax.reload();
                }
            });
        }
    });
});
