$(document).ready(function() {
    // Initialize DataTables with pagination settings
    var table = $('#list').DataTable({
        "pageLength": 5, // Set maximum 5 rows per page
        "lengthChange": false, // Disable the "Show x entries" dropdown
        "paging": true, // Enable pagination
        "ordering": true, // Enable column ordering
        "info": true, // Show information about the table
        "searching": true // Enable searching/filtering
    });

    function fetchEmployeeData() {
        $.ajax({
            url: fetchUrl, // Use the URL from the template
            method: 'GET',
            success: function(response) {
                // Save the current pagination state
                var currentPage = table.page();

                table.clear(); // Clear the current data in the table
                response.employees.forEach(function(employee) {
                    let profilePhoto = determineProfilePhoto(employee);

                    let employeeRow = `
                        <tr data-id="${employee.id}">
                            <td class="list-id">${employee.id}</td>
                            <td class="list-nama">
                                <span>
                                    <img class="employeeProfile" src="${profilePhoto}" alt="${employee.name}" height="45px">
                                </span>
                                <span>${employee.name}</span>
                            </td>
                            <td class="list-email">${employee.email}</td>
                            <td class="list-gender">${employee.gender}</td>
                            <td class="list-department">${employee.department}</td>
                            <td class="list-position">${employee.position}</td>
                            <td class="list-phone_number">${employee.formatted_phone_number}</td>
                            <td class="list-actions">
                                <button class="deleteBtn" data-id="${employee.id}"
                                    data-name="${employee.name}" data-email="${employee.email}"
                                    data-gender="${employee.gender}"
                                    data-department="${employee.department}"
                                    data-position="${employee.position}"
                                    data-phone_number="${employee.phone_number}">Delete</button>
                            </td>
                        </tr>`;
                    table.row.add($(employeeRow)); // Add the new row to the DataTable
                });
                table.draw(); // Redraw the DataTable with the new data

                // Restore the pagination state
                table.page(currentPage).draw(false);
                initializeDeleteButtons(); // Reinitialize delete button event listeners
            },
            error: function(xhr, status, error) {
                console.error('Error fetching employee data:', error);
            }
        });
    }

    function determineProfilePhoto(employee) {
        if (employee.profile_photo_path) {
            // Assuming the server provides the full URL for the profile photo
            return employee.profile_photo_path;
        } else if (employee.gender == 'Male') {
            return defaultMalePhoto; // Use default male photo
        } else if (employee.gender == 'Female') {
            return defaultFemalePhoto; // Use default female photo
        } else {
            return defaultPhoto; // Use default photo if no specific condition matches
        }
    }


    function initializeDeleteButtons() {
        $('.deleteBtn').on('click', function() {
            var employeeId = $(this).data('id');
            var employeeName = $(this).data('name');
            var employeeEmail = $(this).data('email');
            var employeeGender = $(this).data('gender');
            var employeeDepartment = $(this).data('department');
            var employeePosition = $(this).data('position');
            var employeePhoneNumber = $(this).data('phone_number');

            $('#employeeName').text(employeeName);
            $('#employeeEmail').text(employeeEmail);
            $('#employeeGender').text(employeeGender);
            $('#employeeDepartment').text(employeeDepartment);
            $('#employeePosition').text(employeePosition);
            $('#employeePhoneNumber').text(employeePhoneNumber);

            var deleteUrl = deleteUrlTemplate.replace(':id', employeeId);
            $('#confirmDeleteForm').attr('action', deleteUrl);

            // Show the popup with animation
            $('#formPopup').fadeIn();
            $('#formPopup').css('display', 'flex'); // Use flex to position

            // Add 'active' class for CSS animation
            setTimeout(function() {
                $('#formPopup .popup-content').addClass('active');
            }, 50); // Slight delay to ensure CSS transition applies
        });

        $('#closeFormBtn').on('click', function() {
            // Remove 'active' class for CSS animation
            $('#formPopup .popup-content').removeClass('active');

            // Wait a bit before hiding the popup
            setTimeout(function() {
                $('#formPopup').fadeOut();
            }, 300); // Adjust to match CSS transition duration
        });

        $(window).on('click', function(event) {
            if (event.target == $('#formPopup')[0]) {
                // Remove 'active' class for CSS animation
                $('#formPopup .popup-content').removeClass('active');

                // Wait a bit before hiding the popup
                setTimeout(function() {
                    $('#formPopup').fadeOut();
                }, 300); // Adjust to match CSS transition duration
            }
        });

        $('#confirmDeleteForm').on('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: 'POST',
                url: url,
                data: form.serialize(),
                success: function(response) {
                    // Hide the form popup
                    $('#formPopup .popup-content').removeClass('active');
                    setTimeout(function() {
                        $('#formPopup').fadeOut();
                    }, 300);

                    // Show the message popup
                    $('#messageText').text('Employee has been successfully deleted.');
                    $('#messagePopup').fadeIn();
                    $('#messagePopup').css('display', 'flex');

                    // Add 'active' class for CSS animation
                    setTimeout(function() {
                        $('#messagePopup .popup-content').addClass('active');
                    }, 50);

                    // Hide the message after a few seconds
                    setTimeout(function() {
                        $('#messagePopup .popup-content').removeClass('active');
                        setTimeout(function() {
                            $('#messagePopup').fadeOut();
                        }, 300);
                    }, 3000); // Adjust the timing as needed

                    // Fetch updated data
                    fetchEmployeeData();
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error('Error deleting employee:', error);
                }
            });
        });

        $('#closeMessageBtn').on('click', function() {
            // Remove 'active' class for CSS animation
            $('#messagePopup .popup-content').removeClass('active');

            // Wait a bit before hiding the popup
            setTimeout(function() {
                $('#messagePopup').fadeOut();
            }, 300); // Adjust to match CSS transition duration
        });

        $(window).on('click', function(event) {
            if (event.target == $('#messagePopup')[0]) {
                // Remove 'active' class for CSS animation
                $('#messagePopup .popup-content').removeClass('active');

                // Wait a bit before hiding the popup
                setTimeout(function() {
                    $('#messagePopup').fadeOut();
                }, 300); // Adjust to match CSS transition duration
            }
        });
    }

    // Initial call to fetch data
    fetchEmployeeData();

    // Polling data every 1 second
    setInterval(fetchEmployeeData, 1000);

    // Initial setup of delete button event listeners
    initializeDeleteButtons();
});
