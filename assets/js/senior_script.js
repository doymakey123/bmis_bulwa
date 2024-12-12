$(document).ready(function () {
    var counter = 0;
    const table = $('#seniorTable').DataTable({
        scrollX: true, // Enable horizontal scrolling
        ajax: {
            url: '../ajax/fetch_all_senior_citizen.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            {
                data: function () {
                    counter++;
                    return counter;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    return (
                        (row.fname ? row.fname + ' ' : '') +
                        (row.mname ? row.mname + ' ' : '') +
                        (row.lname ? row.lname + ' ' : '') +
                        (row.suffix ? row.suffix : '')
                    );
                }
            },
            { data: 'age' },
            { data: 'formatted_birthday' },
            { data: 'gender' },
            { data: 'employment_status' },
            { data: 'civil_status' },
            { data: 'type_of_dwelling' },
            { data: 'beneficiary_program' },
        ],
        dom: '<"row"<"col-sm-12 col-md-5"B><"col-sm-12 col-md-7 text-right"l>>' +
        '<"row"<"col-sm-12 col-md-7 text-right"f>>' +
        '<"row"<"col-sm-12"tr>>' +
        '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        buttons: [
            {
                extend: 'excelHtml5',
                title: 'List of Senior Citizens',
                text: 'Export to Excel',
                className: 'btn btn-success' // Optional styling
            },
            {
                extend: 'print',
                title: 'List of Senior Citizens',
                text: 'Print',
                className: 'btn btn-primary' // Optional styling
            }
        ],
        language: {
            search: "Search:",
            lengthMenu: "Show _MENU_ entries",
        },
        pagingType: "full_numbers",
        responsive: true,
    });
});
