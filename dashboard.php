<?php
session_start();
// Assuming the user's first name is stored in the session
$firstName = isset($_SESSION['first_name']) ? $_SESSION['first_name'] : 'Guest';
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
        width: 150px; /* Adjust the width as needed */
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
        background-color: white; /* Set the background color of the side navigation bar to white */
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
        color: black; /* Change the text color to black */
        display: flex;
        align-items: center;
        position: relative;
        padding-left: 16px; /* Adjust padding to make space for the hover tab */
        }

        .sidenav a i {
        font-size: 24px; /* Adjust the icon size as needed */
        margin-right: 10px; /* Space between icon and text */
        }

        .sidenav a:hover {
        background-color: black; /* Change background color to black on hover */
        color: white; /* Change font color to white on hover */
        transform: scale(1.05); /* Add a slight zoom effect */
        transition: transform 0.3s, background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
        }

        .sidenav a:hover i {
        color: white; /* Change icon color to white on hover */
        }

        .sidenav a::before {
        content: '';
        position: absolute;
        left: -10px; /* Adjust the position of the hover tab */
        top: 0;
        bottom: 0;
        width: 5px; /* Width of the hover tab */
        background-color: transparent;
        transition: background-color 0.3s;
        }

        .sidenav a:hover::before {
        background-color: black; /* Change the color of the hover tab */
        }

        .user-name {
        color: #000; /* Change user name color to black */
        text-align: center;
        font-family: 'Roboto', sans-serif;
        font-size: 22px; /* Adjust the font size as needed */
        font-weight: bold; /* Adjust the font weight as needed */
        }

        .container {
        display: inline-block;
        cursor: pointer;
        position: absolute;
        top: 15px; /* Adjust the top position as needed */
        left: 25px; /* Adjust the left position as needed */
        }

        .bar1, .bar2, .bar3 {
        width: 35px;
        height: 5px;
        background-color: black; /* Change the color of the burger menu to black */
        margin: 6px 0;
        transition: 0.4s;
        }

        .closebtn {
            position: absolute;
            top: 0; /* Adjust the top position as needed */
            right: 0; /* Adjust the right position as needed */
            padding: 10px 15px;
            font-size: 36px;
            cursor: pointer;
            color: #818181;
        }

        .closebtn:hover {
            color: #000; /* Change hover color to black */
        }

        .header {
            text-align: center;
            background-color: white; /* Set the background color of the header to white */
            color: black; /* Change the text color to black */
            font-family: 'Roboto', sans-serif;
            font-size: 28px; /* Adjust the font size as needed */
            font-weight: bold; /* Adjust the font weight as needed */
            padding: 10px; /* Add padding to the header */
            border-radius: 10px;
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
            background-color: black; /* Change background color to black on hover */
            color: white; /* Change font color to white on hover */
        }

        .logout-section a:hover i {
            color: white; /* Change icon color to white on hover */
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
        <img src="images/image.jpg" alt="Logo" class="logo">
        <p class="user-name"><?php echo htmlspecialchars($firstName); ?></p>
        <a href="#"><i class="fas fa-home"></i> Home</a>
        <a href="#"><i class="fas fa-user"></i> Profile</a>
        <a href="#"><i class="fas fa-edit"></i> Edit</a>
        <div class="logout-section">
            <a href="login.php"><i class="fas fa-sign-out-alt"></i> Log Out</a>
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