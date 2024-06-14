<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saunders Robot Company</title>
    <link rel="shortcut icon" href="{{URL::asset("/images/favicon/Saunders_Favicon.ico")}}" type="image/x-icon">
    <link rel="stylesheet" href="{{URL::asset("/css/dashboard.css")}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <style>
        /* Custom CSS to remove background color */
        table.dataTable tbody{
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

        .memo{
            width: 50px;
        }

        .tugas{
            width: 30%;
        }

        table.dataTable tbody td {
            padding: 8px;
            background-color: transparent !important;
            height: 30px;
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
                <a href="#" class="nav-logo"><img src="{{ URL::asset('/images/welcome_page/Saunders Logo.png') }}" alt="Saunders Co." height="40"></a>
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
                        <a href={{route('profile.edit')}} class="list first">Profile</a>
                        <a href={{ route('logout') }} class="list last" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="logout">Log Out</a>
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
                    <img src="{{ URL::asset('/images/user_profile/Ranmaru Mori.jpg') }}" alt="Ranmaru Mori" height="100px">
                    <div class="profile">
                        <h2 class="name">{{ Auth::user()->name }}</h2>
                        <p class="departement">Human Resource Departement</p>
                        <p class="position">Manager</p>
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
                    <a href="{{route('profile.edit')}}" id="profile">Profile</a>
                    <a href="" id="presensi">Presensi</a>
                </div>
            </div>
            <div class="card attendance">
                <h4>Daftar Kehadiran</h4>
                <table id="attendance" class="display">
                    <thead>
                        <tr>
                            <th class="nomor">Nomor</th>
                            <th class="tanggal">Tanggal</th>
                            <th class="kehadiran">Kehadiran</th>
                            <th class="status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nomor">1</td>
                            <td class="tanggal">2024-06-15 08:00:00</td>
                            <td class="kehadiran">Masuk</td>
                            <td class="status"><span class="status-tepat-waktu">Tepat Waktu</span></td>
                        </tr>
                        <tr>
                            <td class="nomor">2</td>
                            <td class="tanggal">2024-06-16 08:15:00</td>
                            <td class="kehadiran">Masuk</td>
                            <td class="status"><span class="status-terlambat">Terlambat</span></td>
                        </tr>
                        <tr>
                            <td class="nomor">3</td>
                            <td class="tanggal">2024-06-17</td>
                            <td class="kehadiran">Alfa</td>
                            <td class="status"></td>
                        </tr>
                        <tr>
                            <td class="nomor">4</td>
                            <td class="tanggal">2024-06-18</td>
                            <td class="kehadiran">Cuti</td>
                            <td class="status"></td>
                        </tr>
                        <tr>
                            <td class="nomor">5</td>
                            <td class="tanggal">2024-06-19 07:55:00</td>
                            <td class="kehadiran">Masuk</td>
                            <td class="status"><span class="status-tepat-waktu">Tepat Waktu</span></td>
                        </tr>
                        <tr>
                            <td class="nomor">6</td>
                            <td class="tanggal">2024-06-20 08:20:00</td>
                            <td class="kehadiran">Masuk</td>
                            <td class="status"><span class="status-terlambat">Terlambat</span></td>
                        </tr>
                    </tbody>
                </table>
                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#attendance').DataTable({
                            paging: false,         // Disable paging
                            searching: false,      // Disable searching
                            info: false,           // Disable info text
                            lengthChange: false    // Disable the "Show x entries" dropdown
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
                            <th class="nomor">Nomor</th>
                            <th class="tugas">Tugas</th>
                            <th class="deadline">Deadline</th>
                            <th class="contactPerson">Contact Person</th>
                            <th class="status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nomor">1</td>
                            <td class="tugas">Kerjakan Invoice No. 1 - 50</td>
                            <td class="deadline">2024-06-15 10:00:00</td>
                            <td class="contactPerson">John Doe</td>
                            <td class="status">Not Taken</td>
                        </tr>
                        <tr>
                            <td class="nomor">2</td>
                            <td class="tugas">Tanda Tangan Invoice PT Anker</td>
                            <td class="deadline">2024-06-16 12:00:00</td>
                            <td class="contactPerson">Jane Smith</td>
                            <td class="status">On Progress</td>
                        </tr>
                        <tr>
                            <td class="nomor">3</td>
                            <td class="tugas">Bertemu Jajaran Direksi PT Furin</td>
                            <td class="deadline">2024-06-17 14:00:00</td>
                            <td class="contactPerson">Mike Johnson</td>
                            <td class="status">Pending</td>
                        </tr>
                        <tr>
                            <td class="nomor">4</td>
                            <td class="tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="deadline">2024-06-18 16:00:00</td>
                            <td class="contactPerson">Emily Davis</td>
                            <td class="status">Done</td>
                        </tr>
                        <tr>
                            <td class="nomor">5</td>
                            <td class="tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="deadline">2024-06-18 16:00:00</td>
                            <td class="contactPerson">Emily Davis</td>
                            <td class="status">Done</td>
                        </tr>
                        <tr>
                            <td class="nomor">4</td>
                            <td class="tugas">Jemput Direktur Perusahaan di Stasiun Cawang</td>
                            <td class="deadline">2024-06-18 16:00:00</td>
                            <td class="contactPerson">Emily Davis</td>
                            <td class="status">Done</td>
                        </tr>
                    </tbody>
                </table>

                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#task').DataTable({
                            paging: false,         // Disable paging
                            searching: false,      // Disable searching
                            info: false,           // Disable info text
                            lengthChange: false    // Disable the "Show x entries" dropdown
                        });
                    });
                </script>
            </div>
            <div class="card memo">
                <h4>Daftar Memo</h4>
                <table id="memo" class="display">
                    <thead>
                        <tr>
                            <th class="nomor">Nomor</th>
                            <th class="memo">Memo</th>
                            <th class="tanggal">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="nomor">1</td>
                            <td class="memo">Meeting dengan tim marketing untuk membahas strategi Q3.</textarea></td>
                            <td class="tanggal">2024-06-15 10:00:00</td>
                        </tr>
                        <tr>
                            <td class="nomor">2</td>
                            <td class="memo">Mengirim laporan bulanan ke manajemen.</textarea></td>
                            <td class="tanggal">2024-06-16 15:00:00</td>
                        </tr>
                        <tr>
                            <td class="nomor">3</td>
                            <td class="memo">Review anggaran untuk proyek baru.</textarea></td>
                            <td class="tanggal">2024-06-17 09:00:00</td>
                        </tr>
                        <tr>
                            <td class="nomor">4</td>
                            <td class="memo">Mengadakan workshop pengembangan keterampilan.</textarea></td>
                            <td class="tanggal">2024-06-18 14:00:00</td>
                        </tr>
                        <tr>
                            <td class="nomor">5</td>
                            <td class="memo">Menyelesaikan audit internal.</textarea></td>
                            <td class="tanggal">2024-06-19 11:00:00</td>
                        </tr>
                        <tr>
                            <td class="nomor">6</td>
                            <td class="memo">Meninjau proposal dari vendor baru.</textarea></td>
                            <td class="tanggal">2024-06-20 16:00:00</td>
                        </tr>
                    </tbody>
                </table>

                <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
                <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#memo').DataTable({
                            paging: false,         // Disable paging
                            searching: false,      // Disable searching
                            info: false,           // Disable info text
                            lengthChange: false    // Disable the "Show x entries" dropdown
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</body>
</html>
