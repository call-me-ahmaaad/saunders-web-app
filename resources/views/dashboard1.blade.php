<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saunders Robot Company</title>
    <link rel="shortcut icon" href="{{ URL::asset('/images/favicon/Saunders_Favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ URL::asset('/css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <style>
        /* Custom CSS to remove background color */
        table.dataTable tbody {
            font-size: 13px;
        }

        table.dataTable thead th {
            background-color: transparent !important;
            color: #333;
            font-weight: 600;
            text-align: center;
            font-size: 14px;
        }

        .tanggal {
            width: 30%;
        }

        .nomor {
            width: 10%;
        }

        .kehadiran {
            width: 10%;
        }

        .status {
            width: 50px;
        }

        .memo-memo {
            width: 60%;
        }

        .task-tugas {
            width: 30%;
        }

        table.dataTable tbody td {
            padding: 8px;
            background-color: transparent !important;
            height: 30px;
            /* vertical-align: middle; */
            /* Ensure vertical alignment to middle */
        }

        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }

        table.dataTable thead {
            border-top: 2px solid rgb(0, 65, 211);
            border-bottom: 2px solid rgb(0, 65, 211);
            background-color: transparent !important;
        }

        table.dataTable tbody tr {
            background-color: transparent !important;
        }

        table.dataTable tbody tr:hover {
            background-color: transparent !important;
        }

        /* Status color boxes */
        .status-tepat-waktu {
            background-color: #20fe33d8;
            color: white;
            padding: 5px;
            border-radius: 4px;
            display: inline-block;
        }

        .status-terlambat {
            background-color: #f94449;
            color: white;
            padding: 5px;
            border-radius: 4px;
            display: inline-block;
        }
    </style>
</head>

<body>
    {{-- Navigation Bar --}}
    <nav class="nav welcome">
        <ul>
            <li>
                <a href="#" class="nav-logo"><img src="{{ URL::asset('/images/welcome_page/Saunders Logo.png') }}"
                        alt="Saunders Co." height="40"></a>
            </li>
            <div class="nav-center">
                <li><a href="#">Beranda</a></li>
                <li><a href="#">Berita</a></li>
                <li><a href="#">Inspirasi</a></li>
                <li><a href="#">Finansial</a></li>
                <li><a href="#">Survei</a></li>
                <li><a href="#">WFH</a></li>
                <li><a href="#">Info IT</a></li>
            </div>
            <li>
                <div class="dropdown">
                    <a class="nav-login">{{ Auth::user()->name }}</a>
                    <div class="dropdown-content">
                        <a href={{ route('profile.edit') }} class="list first">Profile</a>
                        <a href={{ route('logout') }} class="list last"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            id="logout">Log Out</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const dropdown = document.querySelector('.dropdown');
                        const dropdownContent = document.querySelector('.dropdown-content');

                        dropdown.addEventListener('mouseover', () => {
                            dropdownContent.classList.remove('hide');
                            dropdownContent.classList.add('show');
                        });

                        dropdown.addEventListener('mouseout', () => {
                            dropdownContent.classList.remove('show');
                            dropdownContent.classList.add('hide');
                        });
                    });
                </script>
            </li>
        </ul>
    </nav>

    <div class="info user">
        <h3 class="sectionTitle">User Info</h3>
        <div class="row first">
            <div class="card data">
                <div class="content">
                    @php
                        $defaultPhoto = 'images/default_profile.png';
                        if (Auth::user()->gender == 'Male') {
                            $defaultPhoto = 'images/user_profile/Default Male Photo Profile.jpg';
                        } elseif (Auth::user()->gender == 'Female') {
                            $defaultPhoto = 'images/user_profile/Default Female Photo Profile.jpg';
                        }
                    @endphp
                    <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset($defaultPhoto) }}"
                        alt="User Profile" height="100px">
                    <div class="profile">
                        <h2 class="name">{{ Auth::user()->name }}</h2>
                        <p class="departement">{{ Auth::user()->department }} Departement</p>
                        <p class="position">{{ Auth::user()->position }}</p>
                    </div>
                </div>
                <div class="leave">
                    <div class="remaining">
                        <h5>Sisa Cuti</h5>
                        <p>3</p>
                    </div>
                    <div class="requested">
                        <h5>Cuti Diajukan</h5>
                        <p>3</p>
                    </div>
                    <div class="used">
                        <h5>Cuti Terpakai</h5>
                        <p>3</p>
                    </div>
                </div>
                <div class="button">
                    <a href="{{ route('profile.edit') }}" id="profile">Profile</a>
                    <a href="" id="presensi">Presensi</a>
                </div>
            </div>
            <div class="card attendance">
                <h4>Daftar Kehadiran</h4>
                <table id="attendance" class="display">
                    <thead>
                        <tr>
                            <th class="attend-nomor">Nomor</th>
                            <th class="attend-tanggal">Tanggal</th>
                            <th class="attend-kehadiran">Kehadiran</th>
                            <th class="attend-status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="attend-nomor">1</td>
                            <td class="attend-tanggal">2024-06-15 08:00:00</td>
                            <td class="attend-kehadiran">Masuk</td>
                            <td class="attend-status"><span class="status-tepat-waktu">Tepat Waktu</span></td>
                        </tr>
                        <tr>
                            <td class="attend-nomor">2</td>
                            <td class="attend-tanggal">2024-06-16 08:15:00</td>
                            <td class="attend-kehadiran">Masuk</td>
                            <td class="attend-status"><span class="status-terlambat">Terlambat</span></td>
                        </tr>
                        <tr>
                            <td class="attend-nomor">3</td>
                            <td class="attend-tanggal">2024-06-17</td>
                            <td class="attend-kehadiran">Alfa</td>
                            <td class="attend-status"></td>
                        </tr>
                        <tr>
                            <td class="attend-nomor">4</td>
                            <td class="attend-tanggal">2024-06-18</td>
                            <td class="attend-kehadiran">Cuti</td>
                            <td class="attend-status"></td>
                        </tr>
                        <tr>
                            <td class="attend-nomor">5</td>
                            <td class="attend-tanggal">2024-06-19 07:55:00</td>
                            <td class="attend-kehadiran">Masuk</td>
                            <td class="attend-status"><span class="status-tepat-waktu">Tepat Waktu</span></td>
                        </tr>
                        <tr>
                            <td class="attend-nomor">6</td>
                            <td class="attend-tanggal">2024-06-20 08:20:00</td>
                            <td class="attend-kehadiran">Masuk</td>
                            <td class="attend-status"><span class="status-terlambat">Terlambat</span></td>
                        </tr>
                    </tbody>
                </table>
                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#attendance').DataTable({
                            paging: false, // Disable paging
                            searching: false, // Disable searching
                            info: false, // Disable info text
                            lengthChange: false // Disable the "Show x entries" dropdown
                        });
                    });
                </script>
            </div>
        </div>
        <div class="row second">
            <div class="card task">
                <h4>Daftar Tugas</h4>
                <table id="task" class="display">
                    <thead>
                        <tr>
                            <th class="task-nomor">Nomor</th>
                            <th class="task-tugas">Tugas</th>
                            <th class="task-deadline">Deadline</th>
                            <th class="task-contactPerson">Contact Person</th>
                            <th class="task-status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="task-nomor">1</td>
                            <td class="task-tugas">Kerjakan Invoice No. 1 - 50</td>
                            <td class="task-deadline">2024-06-15 10:00:00</td>
                            <td class="task-contactPerson">John Doe</td>
                            <td class="task-status">Not Taken</td>
                        </tr>
                        <tr>
                            <td class="task-nomor">2</td>
                            <td class="task-tugas">Tanda Tangan Invoice PT Anker</td>
                            <td class="task-deadline">2024-06-16 12:00:00</td>
                            <td class="task-contactPerson">Jane Smith</td>
                            <td class="task-status">On Progress</td>
                        </tr>
                        <tr>
                            <td class="task-nomor">3</td>
                            <td class="task-tugas">Bertemu Jajaran Direksi PT Furin</td>
                            <td class="task-deadline">2024-06-17 14:00:00</td>
                            <td class="task-contactPerson">Mike Johnson</td>
                            <td class="task-status">Pending</td>
                        </tr>
                        <tr>
                            <td class="task-nomor">4</td>
                            <td class="task-tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="task-deadline">2024-06-18 16:00:00</td>
                            <td class="task-contactPerson">Emily Davis</td>
                            <td class="task-status">Done</td>
                        </tr>
                        <tr>
                            <td class="task-nomor">5</td>
                            <td class="task-tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="task-deadline">2024-06-18 16:00:00</td>
                            <td class="task-contactPerson">Emily Davis</td>
                            <td class="task-status">Done</td>
                        </tr>
                        <tr>
                            <td class="task-nomor">4</td>
                            <td class="task-tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="task-deadline">2024-06-18 16:00:00</td>
                            <td class="task-contactPerson">Emily Davis</td>
                            <td class="task-status">Done</td>
                        </tr>
                    </tbody>
                </table>

                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#task').DataTable({
                            paging: false, // Disable paging
                            searching: false, // Disable searching
                            info: false, // Disable info text
                            lengthChange: false // Disable the "Show x entries" dropdown
                        });
                    });
                </script>
            </div>
            <div class="card memo">
                <h4>Daftar Memo</h4>
                <table id="memo" class="display">
                    <thead>
                        <tr>
                            <th class="memo-nomor">Nomor</th>
                            <th class="memo-memo">Memo</th>
                            <th class="memo-tanggal">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="memo-nomor">1</td>
                            <td class="memo-memo">Meeting dengan tim marketing untuk membahas strategi Q3.</textarea>
                            </td>
                            <td class="memo-tanggal">2024-06-15 10:00:00</td>
                        </tr>
                        <tr>
                            <td class="memo-nomor">2</td>
                            <td class="memo-memo">Mengirim laporan bulanan ke manajemen.</textarea></td>
                            <td class="memo-tanggal">2024-06-16 15:00:00</td>
                        </tr>
                        <tr>
                            <td class="memo-nomor">3</td>
                            <td class="memo-memo">Review anggaran untuk proyek baru.</textarea></td>
                            <td class="memo-tanggal">2024-06-17 09:00:00</td>
                        </tr>
                        <tr>
                            <td class="memo-nomor">4</td>
                            <td class="memo-memo">Mengadakan workshop pengembangan keterampilan.</textarea></td>
                            <td class="memo-tanggal">2024-06-18 14:00:00</td>
                        </tr>
                        <tr>
                            <td class="memo-nomor">5</td>
                            <td class="memo-memo">Menyelesaikan audit internal.</textarea></td>
                            <td class="memo-tanggal">2024-06-19 11:00:00</td>
                        </tr>
                        <tr>
                            <td class="memo-nomor">6</td>
                            <td class="memo-memo">Meninjau proposal dari vendor baru.</textarea></td>
                            <td class="memo-tanggal">2024-06-20 16:00:00</td>
                        </tr>
                    </tbody>
                </table>

                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#memo').DataTable({
                            paging: false, // Disable paging
                            searching: false, // Disable searching
                            info: false, // Disable info text
                            lengthChange: false // Disable the "Show x entries" dropdown
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    @if (Auth::user()->position == 'Manager')
        <div class="info employees">
            <h3 class="sectionTitle">Employees Info</h3>
            <div class="row">
                <div class="card list">
                    <div class="cardHeader">
                        <h4>Info User</h4>
                        <div>
                            <a href="{{ route('create') }}">Add User</a>
                            <a href="{{ route('create') }}">Lainnya</a>
                        </div>
                    </div>
                    <table id="list" class="display">
                        <thead>
                            <tr>
                                <th class="list-id">ID</th>
                                <th class="list-nama">Nama</th>
                                <th class="list-email">Email</th>
                                <th class="list-gender">Gender</th>
                                <th class="list-department">Department</th>
                                <th class="list-position">Position</th>
                                <th class="list-phone_number">Phone Number</th>
                                <th class="list-actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            @foreach ($employees as $employee)
                                <tr data-id="{{ $employee->id }}">
                                    <td class="list-id">{{ $employee->id }}</td>
                                    <td class="list-nama">
                                        <span>
                                            @if ($employee->profile_photo_path)
                                                <img class="employeeProfile"
                                                    src="{{ asset('storage/' . $employee->profile_photo_path) }}"
                                                    alt="{{ $employee->name }}" height="45px">
                                            @else
                                                @php
                                                    $defaultPhoto = 'images/default_profile.png';
                                                    if ($employee->gender == 'Male') {
                                                        $defaultPhoto =
                                                            'images/user_profile/Default Male Photo Profile.jpg';
                                                    } elseif ($employee->gender == 'Female') {
                                                        $defaultPhoto =
                                                            'images/user_profile/Default Female Photo Profile.jpg';
                                                    }
                                                @endphp
                                                <img class="employeeProfile" src="{{ URL::asset($defaultPhoto) }}"
                                                    alt="Default Profile" height="45px">
                                            @endif
                                        </span>
                                        <span>{{ $employee['name'] }}</span>
                                    </td>
                                    <td class="list-email">{{ $employee->email }}</td>
                                    <td class="list-gender">{{ $employee->gender }}</td>
                                    <td class="list-department">{{ $employee->department }}</td>
                                    <td class="list-position">{{ $employee->position }}</td>
                                    <td class="list-phone_number">
                                        {{ \App\Helpers\PhoneNumberHelper::format($employee->phone_number) }}</td>
                                    <td class="list-actions">
                                        <button class="deleteBtn" data-id="{{ $employee->id }}"
                                            data-name="{{ $employee->name }}" data-email="{{ $employee->email }}"
                                            data-gender="{{ $employee->gender }}"
                                            data-department="{{ $employee->department }}"
                                            data-position="{{ $employee->position }}"
                                            data-phone_number="{{ $employee->phone_number }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pop Up Form -->
                    <div id="formPopup" class="popup">
                        <div class="popup-content">
                            <span class="close-btn" id="closeFormBtn">&times;</span>
                            <form id="confirmDeleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <h2>Delete Employee</h2>
                                <p>Are you sure you want to delete this employee?</p>
                                <div id="employeeInfo">
                                    <p><strong>Name:</strong> <span id="employeeName"></span></p>
                                    <p><strong>Email:</strong> <span id="employeeEmail"></span></p>
                                    <p><strong>Gender:</strong> <span id="employeeGender"></span></p>
                                    <p><strong>Department:</strong> <span id="employeeDepartment"></span></p>
                                    <p><strong>Position:</strong> <span id="employeePosition"></span></p>
                                    <p><strong>Phone Number:</strong> <span id="employeePhoneNumber"></span></p>
                                </div>
                                <button type="submit" id="confirmDeleteBtn">Delete</button>
                            </form>
                        </div>
                    </div>

                    <!-- Pop Up Message -->
                    <div id="messagePopup" class="popup">
                        <div class="popup-content">
                            <span class="close-btn" id="closeMessageBtn">&times;</span>
                            <p id="messageText"></p>
                        </div>
                    </div>

                    <script>
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
                                    url: '{{ route('employees.list') }}', // Add a route that returns employee data as JSON
                                    method: 'GET',
                                    success: function(response) {
                                        // Save the current pagination state
                                        var currentPage = table.page();

                                        table.clear(); // Clear the current data in the table
                                        response.employees.forEach(function(employee) {
                                            let defaultPhoto = 'images/default_profile.png';
                                            if (employee.gender == 'Male') {
                                                defaultPhoto =
                                                    'images/user_profile/Default Male Photo Profile.jpg';
                                            } else if (employee.gender == 'Female') {
                                                defaultPhoto =
                                                    'images/user_profile/Default Female Photo Profile.jpg';
                                            }

                                            let profilePhoto = employee.profile_photo_path ?
                                                '{{ asset('storage') }}/' + employee.profile_photo_path :
                                                '{{ URL::asset('') }}' + defaultPhoto;

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

                                    var deleteUrl = '{{ route('employees.destroy', ':id') }}';
                                    deleteUrl = deleteUrl.replace(':id', employeeId);
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
                    </script>
                </div>

            </div>
        </div>
    @endif
</body>

</html>
