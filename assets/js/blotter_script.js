


$(document).ready(function () {
    // Initialize DataTable
    const table = $('#blotterTable').DataTable({
        ajax: {
            url: '../ajax/fetch_blotter.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 'id' },
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
                        <button class="info-btn btn btn-primary btn-sm" 
                            data-id="${row.id}"
                            onclick="window.open('view_blotter.php?id=' + ${(row.id)},'_blank')" >
                            View
                        </button>
                        <button class="edit-btn btn btn-warning btn-sm" 
                            data-id="${row.id}" 
                            data-toggle="modal" 
                            data-target="#blotterModal">
                            Edit
                        </button>
                        <button class="delete-btn-blotter btn btn-danger btn-sm" 
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

   
    
});


