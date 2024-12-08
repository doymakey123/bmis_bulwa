


$(document).ready(function () {
    // Initialize DataTable
    var counter = 0;
    const table = $('#blotterTable').DataTable({
        ajax: {
            url: '../ajax/fetch_blotter.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 
                function(){
                    counter++;
                    return counter;
                }
            },
            { data: null,
                render: function(data, type, row) {
                    return (row.complainant_fname ? row.complainant_fname + ' ' : '') + (row.complainant_mname ? row.complainant_mname + ' ' : '') + (row.complainant_lname ? row.complainant_lname + ' ' : '') + (row.complainant_suffix ? row.complainant_suffix : '')
                }
            },
            { data: null,
                render: function(data, type, row) {
                    return (row.respondent_fname ? row.respondent_fname + ' ' : '') + (row.respondent_mname ? row.respondent_mname + ' ' : '') + (row.respondent_lname ? row.respondent_lname + ' ' : '') + (row.respondent_suffix ? row.respondent_suffix : '')
                }
            },
            { data: 'blotter_type' },
            { data: 'status' },
            { data: 'date_created' },
            {
                
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="info-btn-blotter btn btn-primary btn-sm" 
                            data-id="${row.id}"
                            onclick="window.open('view_blotter.php?id=' + ${(row.id)},'_blank')" >
                            View
                        </button>
                        <button class="edit-btn-blotter btn btn-warning btn-sm"
                            data-id="${row.id}"
                            data-complainant_fname="${row.complainant_fname}" 
                            data-complainant_mname="${row.complainant_mname}" 
                            data-complainant_lname="${row.complainant_lname}" 
                            data-complainant_suffix="${row.complainant_suffix}"
                            data-complainant_address="${row.complainant_address}" 
                            data-complainant_contact="${row.complainant_contact}" 
                            data-respondent_fname="${row.respondent_fname}" 
                            data-respondent_mname="${row.respondent_mname}" 
                            data-respondent_lname="${row.respondent_lname}" 
                            data-respondent_suffix="${row.respondent_suffix}"
                            data-respondent_contact="${row.respondent_contact}"
                            data-blotter_type="${row.blotter_type}" 
                            data-details="${row.details}"
                            data-status="${row.status}" 
                            data-toggle="modal" 
                            data-target="#blotterModal">
                            Edit
                        </button>
                        <button class="delete-btnblotter btn btn-danger btn-sm" 
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
    $(document).on('click', '.edit-btn-blotter', function () {
        const id = $(this).data('id');
        const complainant_fname = $(this).data('complainant_fname');
        const complainant_mname = $(this).data('complainant_mname');
        const complainant_lname = $(this).data('complainant_lname');
        const complainant_suffix = $(this).data('complainant_suffix');
        const complainant_address = $(this).data('complainant_address');
        const complainant_contact = $(this).data('complainant_contact');
        const respondent_fname = $(this).data('respondent_fname');
        const respondent_mname = $(this).data('respondent_mname');
        const respondent_lname = $(this).data('respondent_lname');
        const respondent_suffix = $(this).data('respondent_suffix');
        const respondent_contact = $(this).data('respondent_contact');
        const blotter_type = $(this).data('blotter_type');
        const details = $(this).data('details');
        const status = $(this).data('status');



        // Populate modal fields
        $('#editIdBlotter').val(id);
        $('#complainant_fname').val(complainant_fname);
        $('#complainant_mname').val(complainant_mname);
        $('#complainant_lname').val(complainant_lname);
        $('#complainant_suffix').val(complainant_suffix);
        $('#complainant_address').val(complainant_address);
        $('#complainant_contact').val(complainant_contact);
        $('#respondent_fname').val(respondent_fname);
        $('#respondent_mname').val(respondent_mname);
        $('#respondent_lname').val(respondent_lname);
        $('#respondent_suffix').val(respondent_suffix);
        $('#respondent_contact').val(respondent_contact);
        $('#blotter_type').val(blotter_type);
        $('#details').val(details);
        $('#status').val(status);
    
        // Change modal title and button text
        $('#blotterModalLabel').text('Edit Blotter');
        $('#btn_addUpdateBlotter').text('Update');
    });

    // Reset modal when closing
    $('#blotterModal').on('hidden.bs.modal', function () {
        $('#addBlotterForm')[0].reset(); // Reset the form
        $('#editIdBlotter').val(''); // Clear the hidden field
        $('#blotterModalLabel').text('Add Blotter'); // Reset modal title
        $('#btn_addUpdateBlotter').text('Add'); // Reset button text
    });

    // Add/Edit Blotter Logic
    $('#addBlotterForm').on('submit', function (e) {
        e.preventDefault();

        const id = $('#editIdBlotter').val();
        const formData = {
            id: id || null,
            complainant_fname: $('#complainant_fname').val(),
            complainant_mname: $('#complainant_mname').val(),
            complainant_lname: $('#complainant_lname').val(),
            complainant_suffix: $('#complainant_suffix').val(),
            complainant_address: $('#complainant_address').val(),
            complainant_contact: $('#complainant_contact').val(),
            respondent_fname: $('#respondent_fname').val(),
            respondent_mname: $('#respondent_mname').val(),
            respondent_lname: $('#respondent_lname').val(),
            respondent_suffix: $('#respondent_suffix').val(),
            respondent_contact: $('#respondent_contact').val(),
            blotter_type: $('#blotter_type').val(),
            details: $('#details').val(),
            status: $('#status').val(),
        };

        const url = id ? '../ajax/edit_blotter.php' : '../ajax/add_blotter.php';

        $.post(url, formData, function (response) {
            const result = JSON.parse(response);
            alert(result.message);

            if (result.success) {
                $('#blotterModal').modal('hide');
                table.ajax.reload(); // Reload table
                $('#addBlotterForm')[0].reset();
            }else{
                alert(result.message); //
            }
        });
    });

    // Delete Resident Logic
    $(document).on('click', '.delete-btnblotter', function () {
        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this blotter?')) {
            $.post('../ajax/delete_blotter.php', { id }, function (response) {
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


