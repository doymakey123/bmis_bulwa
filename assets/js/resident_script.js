


$(document).ready(function () {
    // Initialize DataTable
    const table = $('#residentTable').DataTable({
        ajax: {
            url: '../ajax/fetch_resident.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 'id' },
            { data: 'fname' },
            { data: 'mname' },
            { data: 'lname' },
            { data: 'suffix' },
            { data: 'age' },
            { data: 'dob' },
            { data: 'purok' },
            { data: 'occupation' },
            {
                
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="info-btn btn btn-primary btn-sm" 
                            data-id="${row.id}"
                            onclick="window.open('view_resident.php?id=' + ${(row.id)},'_blank')" >
                            View
                        </button>
                        <button class="edit-btn btn btn-warning btn-sm" 
                            data-id="${row.id}" 
                            data-fname="${row.fname}" 
                            data-mname="${row.mname}" 
                            data-lname="${row.lname}" 
                            data-suffix="${row.suffix}" 
                            data-gender="${row.gender}"
                            data-dob="${row.dob}" 
                            data-civil_status="${row.civil_status}" 
                            data-nationality="${row.nationality}" 
                            data-religion="${row.religion}" 
                            data-mobile="${row.mobile}" 
                            data-email="${row.email}" 
                            data-house_number="${row.house_number}" 
                            data-purok="${row.purok}" 
                            data-brgy="${row.brgy}" 
                            data-head_of_family="${row.head_of_family}" 
                            data-household_composition="${row.household_composition}" 
                            data-educational_attainment="${row.educational_attainment}" 
                            data-occupation="${row.occupation}" 
                            data-type_of_residency="${row.type_of_residency}" 
                            data-blood_type="${row.blood_type}" 
                            data-disabilities="${row.disabilities}" 
                            data-beneficiary_status="${row.beneficiary_status}" 
                            data-precinct_number="${row.precinct_number}" 
                            data-voter_status="${row.voter_status}" 
                            data-emergency_contact_person="${row.emergency_contact_person}" 
                            data-emergency_contact_relationship="${row.emergency_contact_relationship}" 
                            data-emergency_contact_number="${row.emergency_contact_number}" 
                            data-toggle="modal" 
                            data-target="#residentModal">
                            Edit
                        </button>
                        <button class="delete-btn btn btn-danger btn-sm" 
                            data-id="${row.id}"
                            data-fnamed="${row.fname}" 
                            data-mnamed="${row.mname}" 
                            data-lnamed="${row.lname}" 
                            data-suffixd="${row.suffix}" >
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
        const fname = $(this).data('fname');
        const mname = $(this).data('mname');
        const lname = $(this).data('lname');
        const suffix = $(this).data('suffix');
        const gender = $(this).data('gender');
        const dob = $(this).data('dob');
        const civil_status = $(this).data('civil_status');
        const nationality = $(this).data('nationality');
        const religion = $(this).data('religion');
        const mobile = $(this).data('mobile');
        const email = $(this).data('email');
        const house_number = $(this).data('house_number');
        const purok = $(this).data('purok');
        const brgy = $(this).data('brgy');
        const head_of_family = $(this).data('head_of_family');
        const household_composition = $(this).data('household_composition');
        const educational_attainment = $(this).data('educational_attainment');
        const occupation = $(this).data('occupation');
        const type_of_residency = $(this).data('type_of_residency');
        const blood_type = $(this).data('blood_type');
        const disabilities = $(this).data('disabilities');
        const beneficiary_status = $(this).data('beneficiary_status');
        const precinct_number = $(this).data('precinct_number');
        const voter_status = $(this).data('voter_status');
        const emergency_contact_person = $(this).data('emergency_contact_person');
        const emergency_contact_relationship = $(this).data('emergency_contact_relationship');
        const emergency_contact_number = $(this).data('emergency_contact_number');


        // Populate modal fields
        $('#editId').val(id);
        $('#fname').val(fname);
        $('#mname').val(mname);
        $('#lname').val(lname);
        $('#suffix').val(suffix);
        $('#gender').val(gender);
        $('#dob').val(dob);
        $('#civil_status').val(civil_status);
        $('#nationality').val(nationality);
        $('#religion').val(religion);
        $('#mobile').val(mobile);
        $('#email').val(email);
        $('#house_number').val(house_number);
        $('#purok').val(purok);
        $('#brgy').val(brgy);
        $('#head_of_family').val(head_of_family);
        $('#household_composition').val(household_composition);
        $('#educational_attainment').val(educational_attainment);
        $('#occupation').val(occupation);
        $('#type_of_residency').val(type_of_residency);
        $('#blood_type').val(blood_type);
        $('#disabilities').val(disabilities);
        $('#beneficiary_status').val(beneficiary_status);
        $('#precinct_number').val(precinct_number);
        $('#voter_status').val(voter_status);
        $('#emergency_contact_person').val(emergency_contact_person);
        $('#emergency_contact_relationship').val(emergency_contact_relationship);
        $('#emergency_contact_number').val(emergency_contact_number);
    
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
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
            suffix: $('#suffix').val(),
            gender: $('#gender').val(),
            dob: $('#dob').val(),
            civil_status: $('#civil_status').val(),
            nationality: $('#nationality').val(),
            religion: $('#religion').val(),
            mobile: $('#mobile').val(),
            email: $('#email').val(),
            house_number: $('#house_number').val(),
            purok: $('#purok').val(),
            brgy: $('#brgy').val(),
            head_of_family: $('#head_of_family').val(),
            household_composition: $('#household_composition').val(),
            educational_attainment: $('#educational_attainment').val(),
            occupation: $('#occupation').val(),
            type_of_residency: $('#type_of_residency').val(),
            blood_type: $('#blood_type').val(),
            disabilities: $('#disabilities').val(),
            beneficiary_status: $('#beneficiary_status').val(),
            precinct_number: $('#precinct_number').val(),
            voter_status: $('#voter_status').val(),
            emergency_contact_person: $('#emergency_contact_person').val(),
            emergency_contact_relationship: $('#emergency_contact_relationship').val(),
            emergency_contact_number: $('#emergency_contact_number').val(),
        };

        const url = id ? '../ajax/edit_resident.php' : '../ajax/add_resident.php';

        $.post(url, formData, function (response) {
            const result = JSON.parse(response);
            alert(result.message);

            if (result.success) {
                $('#residentModal').modal('hide');
                table.ajax.reload(); // Reload table
                $('#addResidentForm')[0].reset();
                console.log(dob); //
            }else{
                alert(result.message); //
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
                    //console.log(fnamed); //
                }
            });
        }
    });
});

