


$(document).ready(function () {
    // Initialize DataTable
    const table = $('#activitylogTable').DataTable({
        scrollX: true, // Enable horizontal scrolling
        ajax: {
            url: '../ajax/fetch_activitylog.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 'id' },
            { data: 'user_id' },
            { data: 'user_type' },
            { data: 'activity_type' },
            { data: 'description' },
            { data: 'date_created' },
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

