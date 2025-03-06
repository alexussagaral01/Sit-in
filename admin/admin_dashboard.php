<?php
session_start();
$firstName = isset($_SESSION['admin']) && $_SESSION['admin'] === true ? 'Admin' : (isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Guest');
$profileImage = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : '../images/image.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="logo/ccs.png" type="image/x-icon">
    <title>Admin Dashboard</title>
    <style>
        body {
        background-image: linear-gradient(104.1deg, rgba(0,61,100,1) 13.6%, rgba(47,127,164,1) 49.4%, rgba(30,198,198,1) 93.3%);
        background-attachment: fixed;
        }

        .logo, .student-info img {
        width: 150px; 
        height: 150px; 
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
        border-radius: 50%; 
        object-fit: cover; 
        }

        .sidenav {
        height: 100%;
        width: 250px;
        position: fixed;
        z-index: 1;
        top: 0;
        left: -250px;
        background-color: white; 
        overflow-x: hidden;
        padding-top: 20px;
        font-family: 'Roboto', sans-serif;
        font-size: 18px;
        transition: 0.3s;
        }

        .sidenav.show {
        left: 0;
        }

        .sidenav a {
        padding: 8px 8px 8px 16px;
        text-decoration: none;
        font-size: 15px;
        color: black; 
        display: flex;
        align-items: center;
        position: relative;
        padding-left: 16px; 
        }

        .sidenav a i {
        font-size: 15px; 
        margin-right: 10px; 
        }

        .sidenav a:hover {
        background-color: black; 
        color: white; 
        transform: scale(1.05); 
        transition: transform 0.3s, background-color 0.3s, color 0.3s; 
        }

        .sidenav a:hover i {
        color: white; 
        }

        .sidenav a::before {
        content: '';
        position: absolute;
        left: -10px; 
        top: 0;
        bottom: 0;
        width: 5px; 
        background-color: transparent;
        transition: background-color 0.3s;
        }

        .sidenav a:hover::before {
        background-color: black; 
        }

        .user-name {
        color: #000; 
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-size: 22px;
        font-weight: bold; 
        }

        .container {
        display: inline-block;
        cursor: pointer;
        position: absolute;
        top: 15px; 
        left: 25px; 
        }

        .bar1, .bar2, .bar3 {
        width: 35px;
        height: 5px;
        background-color: black; 
        margin: 6px 0;
        transition: 0.4s;
        }

        .closebtn {
            position: absolute;
            top: 0; 
            right: 0; 
            padding: 10px 15px;
            font-size: 36px;
            cursor: pointer;
            color: #818181;
        }

        .closebtn:hover {
            color: #000; 
        }

        .header {
            text-align: center;
            background-color: white; 
            color: black; 
            font-family: 'Roboto', sans-serif;
            font-size: 25px; 
            font-weight: bold; 
            padding: 10px; 
        }

        .logout-section {
            position: absolute;
            bottom: 20px;
            width: 100%;
            text-align: center;
        }

        .logout-section a {
            color:  black;
        }

        .logout-section a:hover {
            background-color: black; 
            color: white; 
        }

        .logout-section a:hover i {
            color: white; 
        }

        /* New styles for dashboard content */
        .dashboard-content {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .dashboard-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            width: 48%;
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            font-family: 'Roboto', sans-serif;
            font-weight: bold;
            display: flex;
            align-items: center;
        }

        .card-header i {
            margin-right: 10px;
        }

        .card-body {
            padding: 15px;
        }

        .stats-item {
            margin-bottom: 10px;
            font-family: 'Roboto', sans-serif;
        }

        .chart-container {
            width: 100%;
            height: 300px;
        }

        .announcement-form {
            margin-bottom: 20px;
        }

        .announcement-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
            font-family: 'Roboto', sans-serif;
        }

        .announcement-form .btn-submit {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Roboto', sans-serif;
            margin-top: 10px;
        }

        .announcement-list {
            max-height: 300px;
            overflow-y: auto;
        }

        .announcement-item {
            border-bottom: 1px solid #eee;
            padding: 10px 0;
        }

        .announcement-header {
            font-weight: bold;
            margin-bottom: 5px;
            font-family: 'Roboto', sans-serif;
        }

        .announcement-text {
            font-family: 'Roboto', sans-serif;
        }

        @media (max-width: 768px) {
            .dashboard-card {
                width: 100%;
            }
        }
    </style>
</head>   
<body>
    <div class="header">
        CCS SIT-IN MONITORING SYSTEM
    </div>
    <div class="container" onclick="toggleNav(this)">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </div>
    <div class="sidenav" id="mySidenav">
        <span class="closebtn" onclick="closeNav()">&times;</span>
        <img src="<?php echo htmlspecialchars($profileImage); ?>" alt="Logo" class="logo">
        <p class="user-name"><?php echo htmlspecialchars($firstName); ?></p>
        <a href="#"><i class="fas fa-home"></i> HOME</a>
        <a href="#"><i class="fas fa-search"></i> SEARCH</a>
        <a href="#"><i class="fas fa-edit"></i> VIEW SIT-IN RECORDS</a>
        <a href="#"><i class="fas fa-list"></i> VIEW LIST OF STUDENT</a>
        <a href="#"><i class="fas fa-chart-line"></i> SIT-IN REPORT</a>
        <a href="#"><i class="fas fa-comments"></i> VIEW FEEDBACKS</a>
        <a href="#"><i class="fas fa-chart-pie"></i> VIEW DAILY ANALYTICS</a>
        <a href="#"><i class="fas fa-calendar-check"></i> RESERVATION/APPROVAL</a>

        <div class="logout-section">
          <a href="../login.php"><i class="fas fa-sign-out-alt"></i> LOG OUT</a>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="dashboard-content">
        <!-- Statistics Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <i class="fas fa-chart-bar"></i> Statistics
            </div>
            <div class="card-body">
                <div class="stats-item">
                    <strong>Students Registered:</strong> 272
                </div>
                <div class="stats-item">
                    <strong>Currently Sit-in:</strong> 3
                </div>
                <div class="stats-item">
                    <strong>Total Sit-in:</strong> 195
                </div>
                <div class="chart-container">
                    <canvas id="languageChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Announcements Card -->
        <div class="dashboard-card">
            <div class="card-header">
                <i class="fas fa-bullhorn"></i> Announcement
            </div>
            <div class="card-body">
                <div class="announcement-form">
                    <form action="" method="post">
                        <textarea name="new_announcement" placeholder="New Announcement"></textarea>
                        <button type="submit" class="btn-submit">Submit</button>
                    </form>
                </div>

                <h3>Posted Announcement</h3>
                <div class="announcement-list">
                    <div class="announcement-item">
                        <div class="announcement-header">CCS Admin | 2025-Mar-05</div>
                        <div class="announcement-text">dasdasd</div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-header">CCS Admin | 2025-Mar-05</div>
                        <div class="announcement-text">dasdasd</div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-header">CCS Admin | 2025-Feb-25</div>
                        <div class="announcement-text">UC did it again.</div>
                    </div>
                    <div class="announcement-item">
                        <div class="announcement-header">CCS Admin | 2025-Feb-03</div>
                        <div class="announcement-text">The College of Computer Studies will open the registration of students for the Sit-in privilege starting tomorrow. Thank you! Lab Supervisor</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        function toggleNav(x) {
            x.classList.toggle("change");
            document.getElementById("mySidenav").classList.toggle("show");
        }

        function closeNav() {
            document.getElementById("mySidenav").classList.remove("show");
            document.querySelector(".container").classList.remove("change");
        }

        // Chart.js code for the pie chart
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('languageChart').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['C#', 'C', 'Java', 'ASP.Net', 'PHP'],
                    datasets: [{
                        data: [10, 60, 15, 10, 5],
                        backgroundColor: [
                            '#36a2eb',
                            '#ff6384',
                            '#ffcd56',
                            '#ff9f40',
                            '#4bc0c0'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>