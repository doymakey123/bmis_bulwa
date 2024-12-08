


$(document).ready(function () {
    // Initialize DataTable
    var counter = 0;
    const table = $('#residentTable').DataTable({
        ajax: {
            url: '../ajax/fetch_resident.php', // Backend URL to fetch data
            dataSrc: '',
        },
        columns: [
            { data: 
                function(){
                    counter++;
                    return counter;
                }
            },
            { data: 'household_number' },
            { data: null,
                render: function(data, type, row) {
                    return (row.fname ? row.fname + ' ' : '') + (row.mname ? row.mname + ' ' : '') + (row.lname ? row.lname + ' ' : '') + (row.suffix ? row.suffix : '')
                }
            },
            { data: 'age' },
            { data: 'formatted_birthday' },
            { data: 'purok' },
            { data: 'voter_status' },
            { data: 'employment_status' },
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
                            data-household_number="${row.household_number}" 
                            data-fname="${row.fname}" 
                            data-mname="${row.mname}" 
                            data-lname="${row.lname}" 
                            data-suffix="${row.suffix}"
                            data-gender="${row.gender}" 
                            data-dob="${row.formatted_birthday}" 
                            data-civil_status="${row.civil_status}" 
                            data-nationality="${row.nationality}"
                            data-religion="${row.religion}" 
                            data-purok="${row.purok}" 
                            data-address="${row.address}" 
                            data-mobile="${row.mobile}" 
                            data-email="${row.email}" 
                            data-voter_status="${row.voter_status}" 
                            data-precinct_number="${row.precinct_number}"
                            data-philhealth_number="${row.philhealth_number}" 
                            data-sss_gsis_number="${row.sss_gsis_number}" 
                            data-tin_number="${row.tin_number}" 
                            data-educational_attainment="${row.educational_attainment}"
                            data-employment_status="${row.employment_status}" 
                            data-occupation="${row.occupation}" 
                            data-monthly_annual_income="${row.monthly_annual_income}" 
                            data-pwd_status="${row.pwd_status}"
                            data-solo_parent_status="${row.solo_parent_status}" 
                            data-relationship_household_head="${row.relationship_household_head}" 
                            data-head_of_the_family="${row.head_of_the_family}" 
                            data-type_of_dwelling="${row.type_of_dwelling}"
                             data-health_condition="${row.health_condition}" 
                            data-vaccination_status="${row.vaccination_status}" 
                            data-blood_type="${row.blood_type}" 
                             data-beneficiary_program="${row.beneficiary_program}" 
                            data-emergency_contact_person="${row.emergency_contact_person}" 
                            data-emergency_contact_relationship="${row.emergency_contact_relationship}" 
                            data-emergency_contact_number="${row.emergency_contact_number}"
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
        const household_number = $(this).data('household_number');
        const fname = $(this).data('fname');
        const mname = $(this).data('mname');
        const lname = $(this).data('lname');
        const suffix = $(this).data('suffix');
        const gender = $(this).data('gender');
        const dob = $(this).data('dob');
        const civil_status = $(this).data('civil_status');
        const nationality = $(this).data('nationality');
        const religion = $(this).data('religion');
        const purok = $(this).data('purok');
        const address = $(this).data('address');
        const mobile = $(this).data('mobile');
        const email = $(this).data('email');
        const voter_status = $(this).data('voter_status');
        const precinct_number = $(this).data('precinct_number');
        const philhealth_number = $(this).data('philhealth_number');
        const sss_gsis_number = $(this).data('sss_gsis_number');
        const tin_number = $(this).data('tin_number');
        const educational_attainment = $(this).data('educational_attainment');
        const employment_status = $(this).data('employment_status');
        const occupation = $(this).data('occupation');
        const monthly_annual_income = $(this).data('monthly_annual_income');
        const pwd_status = $(this).data('pwd_status');
        const solo_parent_status = $(this).data('solo_parent_status');
        const relationship_household_head = $(this).data('relationship_household_head');
        const head_of_the_family = $(this).data('head_of_the_family');
        const type_of_dwelling = $(this).data('type_of_dwelling');
        const health_condition = $(this).data('health_condition');
        const vaccination_status = $(this).data('vaccination_status');
        const blood_type = $(this).data('blood_type');
        const beneficiary_program = $(this).data('beneficiary_program');
        const emergency_contact_person = $(this).data('emergency_contact_person');
        const emergency_contact_relationship = $(this).data('emergency_contact_relationship');
        const emergency_contact_number = $(this).data('emergency_contact_number');


        // Populate modal fields
        $('#editId').val(id);
        $('#household_number').val(household_number);
        $('#fname').val(fname);
        $('#mname').val(mname);
        $('#lname').val(lname);
        $('#suffix').val(suffix);
        $('#gender').val(gender);
        $('#dob').val(dob);
        $('#civil_status').val(civil_status);
        $('#nationality').val(nationality);
        $('#religion').val(religion);
        $('#purok').val(purok);
        $('#address').val(address);
        $('#mobile').val(mobile);
        $('#email').val(email);
        $('#voter_status').val(voter_status);
        $('#precinct_number').val(precinct_number);
        $('#philhealth_number').val(philhealth_number);
        $('#sss_gsis_number').val(sss_gsis_number);
        $('#tin_number').val(tin_number);
        $('#educational_attainment').val(educational_attainment);
        $('#employment_status').val(employment_status);
        $('#occupation').val(occupation);
        $('#monthly_annual_income').val(monthly_annual_income);
        $('#pwd_status').val(pwd_status);
        $('#solo_parent_status').val(solo_parent_status);
        $('#relationship_household_head').val(relationship_household_head);
        $('#head_of_the_family').val(head_of_the_family);
        $('#type_of_dwelling').val(type_of_dwelling);
        $('#health_condition').val(health_condition);
        $('#vaccination_status').val(vaccination_status);
        $('#blood_type').val(blood_type);
        $('#beneficiary_program').val(beneficiary_program);
        $('#emergency_contact_person').val(emergency_contact_person);
        $('#emergency_contact_relationship').val(emergency_contact_relationship);
        $('#emergency_contact_number').val(emergency_contact_number);
        // Change modal title and button text
        $('#residentModalLabel').text('Edit Resident');
        $('#btn_addUpdate').text('Update');

        if ($('#voter_status').val() === 'Registered') {
            $('#div_precinct_number').show();
        }else{
            $('#div_precinct_number').hide();
        }

        if ($('#employment_status').val() === 'Employed') {
            $('#div_occupation').show();
        }else{
            $('#occupation').val = ('');
            $('#div_occupation').hide();
        }

        if ($('#relationship_household_head').val() != 'Head') {
            $('#div_head_of_the_family').show();
        }else{
            $('#div_head_of_the_family').hide();
        }


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
            household_number: $('#household_number').val(),
            fname: $('#fname').val(),
            mname: $('#mname').val(),
            lname: $('#lname').val(),
            suffix: $('#suffix').val(),
            gender: $('#gender').val(),
            dob: $('#dob').val(),
            civil_status: $('#civil_status').val(),
            nationality: $('#nationality').val(),
            religion: $('#religion').val(),
            purok: $('#purok').val(),
            address: $('#address').val(),
            mobile: $('#mobile').val(),
            email: $('#email').val(),
            voter_status: $('#voter_status').val(),
            precinct_number: $('#precinct_number').val(),
            philhealth_number: $('#philhealth_number').val(),
            sss_gsis_number: $('#sss_gsis_number').val(),
            tin_number: $('#tin_number').val(),
            educational_attainment: $('#educational_attainment').val(),
            employment_status: $('#employment_status').val(),
            occupation: $('#occupation').val(),
            monthly_annual_income: $('#monthly_annual_income').val(),
            pwd_status: $('#pwd_status').val(),
            solo_parent_status: $('#solo_parent_status').val(),
            relationship_household_head: $('#relationship_household_head').val(),
            head_of_the_family: $('#head_of_the_family').val(),
            type_of_dwelling: $('#type_of_dwelling').val(),
            health_condition: $('#health_condition').val(),
            vaccination_status: $('#vaccination_status').val(),
            blood_type: $('#blood_type').val(),
            beneficiary_program: $('#beneficiary_program').val(),
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

