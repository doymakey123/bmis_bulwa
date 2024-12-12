


$(document).ready(function () {
    // Initialize DataTable
    var counter = 0;
    const table = $('#skTable').DataTable({
        scrollX: true, // Enable horizontal scrolling
        ajax: {
            url: '../ajax/fetch_sk_official.php', // Backend URL to fetch data
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
                    return (row.fname ? row.fname + ' ' : '') + (row.mname ? row.mname + ' ' : '') + (row.lname ? row.lname + ' ' : '') + (row.suffix ? row.suffix : '')
                }
            },
            { data: 'position' },
            { data: 'rank' },
            { data: 'assign_area' },
            { data: 'committee' },
            { data: 'term' },
            { data: 'year_elected' },
            { data: 'status' },
            {
                
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="edit-btn-sk btn btn-warning btn-sm"
                            data-id="${row.id}"
                            data-fname="${row.fname}" 
                            data-mname="${row.mname}" 
                            data-lname="${row.lname}" 
                            data-suffix="${row.suffix}"
                            data-position="${row.position}" 
                            data-rank="${row.rank}" 
                            data-assign_area="${row.assign_area}" 
                            data-committee="${row.committee}"
                            data-term="${row.term}" 
                            data-year_elected="${row.year_elected}" 
                            data-status="${row.status}"
                            data-toggle="modal" 
                            data-target="#skModal">
                            Edit
                        </button>
                        <button class="delete-btnsk btn btn-danger btn-sm" 
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
    $(document).on('click', '.edit-btn-sk', function () {
        const id = $(this).data('id');
        const fname = $(this).data('fname');
        const mname = $(this).data('mname');
        const lname = $(this).data('lname');
        const suffix = $(this).data('suffix');
        const position = $(this).data('position');
        const rank = $(this).data('rank');
        const assign_area = $(this).data('assign_area');
        const committee = $(this).data('committee');
        const term = $(this).data('term');
        const year_elected = $(this).data('year_elected');
        const status = $(this).data('status');


        // Populate modal fields
        $('#editIdSk').val(id);
        $('#fname').val(fname);
        $('#mname').val(mname);
        $('#lname').val(lname);
        $('#suffix').val(suffix);
        $('#position').val(position);
        $('#rank').val(rank);
        $('#assign_area').val(assign_area);
        $('#committee').val(committee);
        $('#term').val(term);
        $('#year_elected').val(year_elected);
        $('#status').val(status);
       
        // Change modal title and button text
        $('#skModalLabel').text('Edit SK');
        $('#btn_addUpdateSk').text('Update');
    });

    // Reset modal when closing
    $('#skModal').on('hidden.bs.modal', function () {
        $('#addSkForm')[0].reset(); // Reset the form
        $('#editIdSk').val(''); // Clear the hidden field
        $('#skModalLabel').text('Add SK'); // Reset modal title
        $('#btn_addUpdateSk').text('Add'); // Reset button text
    });

    // Add/Edit Blotter Logic
    $('#addSkForm').on('submit', function (e) {
        e.preventDefault();

        const id = $('#editIdSk').val();
        const formData = {
            id: id || null,
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
            suffix: $('#suffix').val(),
            position: $('#position').val(),
            rank: $('#rank').val(),
            assign_area: $('#assign_area').val(),
            committee: $('#committee').val(),
            term: $('#term').val(),
            year_elected: $('#year_elected').val(),
            status: $('#status').val(),
        };

        const url = id ? '../ajax/edit_sk_official.php' : '../ajax/add_sk_official.php';

        $.post(url, formData, function (response) {
            const result = JSON.parse(response);
            alert(result.message);

            if (result.success) {
                $('#skModal').modal('hide');
                table.ajax.reload(); // Reload table
                $('#addSkForm')[0].reset();
            }else{
                alert(result.message); //
            }
        });
    });

    // Delete Resident Logic
    $(document).on('click', '.delete-btnsk', function () {
        const id = $(this).data('id');

        if (confirm('Are you sure you want to delete this SK official?')) {
            $.post('../ajax/delete_sk_official.php', { id }, function (response) {
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


