<?php
    session_start();
    if(!isset($_SESSION['requestID'])){ //If the requestID is not set onto session variable, we go back to DesignerHomepage.php to set it again
        header("Location: DesignerHomepage.php");
        exit;}

    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Design Consultation Page</title>
        <link rel="stylesheet" href="Design consultation page.css">
        <link rel="stylesheet" href="basics.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <header id="Home-header">

        <div class="logo-title">

            <img src="image/logo.jpeg" alt="design mate Logo" id="logo">

            <span></span>

        </div>
        </header>
        <div class="container">

            <h2>Design Consultation</h2>
		
            <!--222 Display Client's Request Information -->
            <div class="client-info">
                <?php
                
                    $requestID = $_SESSION['requestID'];
        
                    $connection = mysqli_connect('localhost', 'root', 'root', 'webproject');
        
                    $error = mysqli_connect_error();
        
                    if($error != null){
                        echo "Database cannot be accessed.";}
                    else{        
                        $sql = "SELECT firstName, lastName FROM client WHERE id = (SELECT clientID FROM designconsultationrequest WHERE id ='$requestID')"; 
                        $sql = "SELECT type FROM roomType WHERE id = (SELECT roomTypeID FROM designconsultationrequest WHERE id ='$requestID')";
                        $sql = "SELECT category FROM designcategory WHERE id = (SELECT designCategoryID FROM designconsultationrequest WHERE id ='$requestID')";
                        $result = mysqli_query($connection, $sql);
            
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<p id='name'><strong>Client :".$row['firstName']." ".$row['lastName']."</strong></p>";
                            echo "<p id='roomT'><strong>Room Type: ".$row['type']."</strong></p>";
                            echo "<p id='room'><strong>Room Dimensions:".$row['roomLength']."x".$row['roomWidth']."m</strong></p>";
                            echo "<p id='designC'><strong>Design Category :".$row['designCategoryID']."</strong></p>";
                            echo "<p id='colorP'><strong>Color Preferences: " .$row['colorPreferences']."</strong></p>";
                            echo "<p id='Date'><strong>Date :".$row['date']."</strong></p>";
                        }    
                    }
                ?>   
            </div>

            <hr>

            <!-- Designer's Consultation Form -->
            <form id="designerConsultationForm" action="addDesignConsultation.php" method="post">
                <h2>Consultation</h2>
                <?php echo "<input type='hidden' name='requestID' value='".$_SESSION['requestID']."'>"; // hidden requestID variable ?>
                <label for="designDescription">Design Consultation:</label>
                <textarea id="designDescription" name="designDescription" rows="4" placeholder="Enter your design consultation here..." required></textarea>
                <label for="designImage">Design Image:</label>
                <input type="file" id="designImage" name="designImage" accept="image/*" required>
                <input id="send" type="submit" class="sbt" value="Send">
            </form>
        </div>
        
        <footer id="Home-footer">

            <!-- Multimedia -->
            <div class="multimedia" >
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
        <script src="Design consultation page.js"></script>
    </body>
</html>
