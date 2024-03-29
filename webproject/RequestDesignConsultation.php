<?php
    session_start();
    
    if(!isset($_SESSION['designerID'])){ //If the designerID is not set onto session variable, we go back to Clinet.php to set it again
        header("Location: Clinet.php");
        exit;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Design Consultation</title>
	<link rel="stylesheet" href="Request design consultation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="basics.css">
</head>
<body>
    <header id="Home-header">

        <div class="logo-title">

            <img src="image/logo.jpeg" alt="design mate Logo" id="logo">

            <span></span>

        </div>
    </header>
    <h2>Request Design Consultation</h2>

    <form id="consultationForm" action="addToDatabase.php" method="POST">

        <?php echo "<input type='hidden' name='designerID' value='".$_SESSION['designerID']."'>"; // hidden designerID variable ?>
        <label for="roomType">Room Type:</label>
        <select id="roomType" name="roomType">
            <option value="livingRoom">Living Room</option>
            <option value="bedroom">Bedroom</option>
            <option value="kitchen">Kitchen</option>
            <!-- Add more room types as needed -->
        </select><br>

        <label for="width">Room Width (meters):</label>
        <input type="text" id="width" name="width" placeholder="Enter width" required><br>

        <label for="length">Room Length (meters):</label>
        <input type="text" id="length" name="length" placeholder="Enter length" required><br>

        <label for="designCategory">Design Category:</label>
        <select id="designCategory" name="designCategory">
            <option value="modern">Modern</option>
            <option value="vintage">Vintage</option>
            <option value="minimalist">Minimalist</option>          
        </select><br>
        <label for="colorPreferences">Color Preferences:</label>
        <input type="text" id="colorPreferences" name="colorPreferences" placeholder="Enter color preferences"><br>
        <input type="submit" id="btn" value="Submit">
        </form>
        <footer id="Home-footer">
        
            <!-- Multimedia -->
            <div class="multimedia">
                <br>
                <div class="icons">
                    <i class="fa-solid fa-envelope">   </i>
                    <i class="fa-solid fa-phone">   </i>
                    <i class="fa-brands fa-twitter icons">   </i>
                    <i class="fa-brands fa-instagram">   </i>
                </div>
                <p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>
            </div>
        </footer>
        <script src="Request design consultation.js"></script>
    </body>
</html>