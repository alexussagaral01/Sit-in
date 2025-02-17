<?php
session_start();
require 'db.php';

$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Guest';
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($userId) {
    $stmt = $conn->prepare("SELECT UPLOAD_IMAGE FROM users WHERE STUD_NUM = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($userImage);
    $stmt->fetch();
    $stmt->close();
    
    $profileImage = !empty($userImage) ? $userImage : "images/image.jpg";
} else {
    $profileImage = "images/image.jpg";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Dashboard</title>
    <style>
        body {
        background-image: linear-gradient(104.1deg, rgba(0,61,100,1) 13.6%, rgba(47,127,164,1) 49.4%, rgba(30,198,198,1) 93.3%);
        background-attachment: fixed;
        }

        .logo {
        width: 150px; 
        height: auto;
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 1px solid black;
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
        font-size: 20px;
        color: black; 
        display: flex;
        align-items: center;
        position: relative;
        padding-left: 16px; 
        }

        .sidenav a i {
        font-size: 24px; 
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
            font-size: 28px; 
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

        .rules-container {
            background-color: white;
            width: 80%;
            max-width: 500px;
            margin: 30px 30px 30px auto; /* Changed from 'margin: 30px auto' to align to right */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            font-family: 'Roboto', sans-serif;
            max-height: 70vh;
            overflow-y: auto;
            position: relative; /* Added for better positioning */
            right: 20px; /* Added to give some space from the right edge */
        }

        .rules-title {
            background-color: #003d64;
            color: white;
            padding: 15px;
            margin: -20px -20px 20px -20px;
            border-radius: 10px 10px 0 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .rules-header {
            text-align: center;
            margin-bottom: 20px;
            padding-top: 20px;
        }

        .rules-content {
            line-height: 1.6;
        }

        .rules-content h2 {
            color: #003d64;
            margin-top: 20px;
        }

        .rules-content ol {
            padding-left: 20px;
        }

        .rules-content li {
            margin-bottom: 10px;
        }

        .disciplinary-action {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 5px solid #003d64;
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
        <a href="dashboard.php"><i class="fas fa-home"></i> HOME</a>
        <a href="profile.php"><i class="fas fa-user"></i> PROFILE</a>
        <a href="edit.php"><i class="fas fa-edit"></i> EDIT</a>
        <a href="#"><i class="fas fa-history"></i> HISTORY</a>
        <a href="#"><i class="fas fa-calendar-alt"></i> RESERVATION</a>

        <div class="logout-section">
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> LOG OUT</a>
        </div>
    </div>
    
    <div class="rules-container">
        <div class="rules-title">
            Rules and Regulations
        </div>
        <div class="rules-header">
            <h1>University of Cebu</h1>
            <h2>COLLEGE OF INFORMATION & COMPUTER STUDIES</h2>
            <h3>LABORATORY RULES AND REGULATIONS</h3>
        </div>
        <div class="rules-content">
            <p>To avoid embarrassment and maintain camaraderie with your friends and superiors at our laboratories, please observe the following:</p>
            
            <ol>
                <li>Maintain silence, proper decorum, and discipline inside the laboratory. Mobile phones, walkmans and other personal pieces of equipment must be switched off.</li>
                <li>Games are not allowed inside the lab. This includes computer-related games, card games and other games that may disturb the operation of the lab.</li>
                <li>Surfing the Internet is allowed only with the permission of the instructor. Downloading and installing of software are strictly prohibited.</li>
                <li>Getting access to other websites not related to the course (especially pornographic and illicit sites) is strictly prohibited.</li>
                <li>Deleting computer files and changing the set-up of the computer is a major offense.</li>
                <li>Observe computer time usage carefully. A fifteen-minute allowance is given for each use. Otherwise, the unit will be given to those who wish to "sit-in".</li>
                <li>Observe proper decorum while inside the laboratory.
                    <ul>
                        <li>Do not get inside the lab unless the instructor is present.</li>
                        <li>All bags, knapsacks, and the likes must be deposited at the counter.</li>
                        <li>Follow the seating arrangement of your instructor.</li>
                        <li>At the end of class, all software programs must be closed.</li>
                        <li>Return all chairs to their proper places after using.</li>
                    </ul>
                </li>
                <li>Chewing gum, eating, drinking, smoking, and other forms of vandalism are prohibited inside the lab.</li>
                <li>Anyone causing a continual disturbance will be asked to leave the lab. Acts or gestures offensive to the members of the community, including public display of physical intimacy, are not tolerated.</li>
                <li>Persons exhibiting hostile or threatening behavior such as yelling, swearing, or disregarding requests made by lab personnel will be asked to leave the lab.</li>
                <li>For serious offense, the lab personnel may call the Civil Security Office (CSU) for assistance.</li>
                <li>Any technical problem or difficulty must be addressed to the laboratory supervisor, student assistant or instructor immediately.</li>
            </ol>

            <div class="disciplinary-action">
                <h2>DISCIPLINARY ACTION</h2>
                <p><strong>First Offense</strong> - The Head or the Dean or OIC recommends to the Guidance Center for a suspension from classes for each offender.</p>
                <p><strong>Second and Subsequent Offenses</strong> - A recommendation for a heavier sanction will be endorsed to the Guidance Center.</p>
            </div>
        </div>
    </div>

    <script>
        function toggleNav(x) {
        x.classList.toggle("change");
        document.getElementById("mySidenav").classList.toggle("show");
        }

        function closeNav() {
            document.getElementById("mySidenav").classList.remove("show");
            document.querySelector(".container").classList.remove("change");
        }
    </script>
</body>
</html>