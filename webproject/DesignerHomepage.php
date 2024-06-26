<?php
        session_start();
include 'session_check.php';
        // Error reporting
            error_reporting(E_ALL);
            ini_set('log_errors', '1');
            ini_set('display_errors', '1');

        $connection = mysqli_connect("localhost","root","root","webproject", "3306");
if(mysqli_connect_error()){
        echo '<p> Sorry can not connect to Data Base </p><br>';
        die(mysqli_connect_error());
    }
    else{
        
            if (!isset($_SESSION['id'])) {
            echo("<script>alert('You are not logged in, please login or sign up first");
            header("Location: index.php");
            exit();
    }
    
    if(!isset($_SESSION['userType']) || $_SESSION['userType']=="client") {
        echo 'You do not have access to this page';
        header("Location: Clinet.php");
        exit();
    }

        if (isset($_SESSION['id'])) { // Check if userID exists in session

            $designerID = $_SESSION['id'];
            $sql = "SELECT id, firstName, lastName, emailAddress, brandName FROM designer WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $designerID);
            $stmt->execute();
            $stmt->bind_result($designerID, $firstName, $lastName, $emailAddress, $brandName);
            $stmt->fetch();

            // Close statement
            $stmt->close();
        }

    }
    
?>


<!DOCTYPE html>
<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title> Designer Homepage </title>
                        <style>
                            /* Style for designer information */
                            ul.designer-info {
                                list-style-type: none;
                                padding: 0;
                            }

                            ul.designer-info li {
                                margin-bottom: 10px;
                            }

                            ul.designer-info li span {
                                font-weight: bold;
                            }

                            .logo-container {
                                display: flex; /* Use flexbox */
                                align-items: center; /* Center the content vertically */
                            }

                            .logo-container img {
                                max-width: 100px; /* Limit the maximum width of the logo */
                                max-height: 100px; /* Limit the maximum height of the logo */
                                margin-left: 10px; /* Add some spacing between the logo and the other information */
                                border-radius: 20%; /* Make the image rounded */
                            }
                        </style>
			<link rel="stylesheet" href="Designer.css">
			<link rel="stylesheet" href="basics.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--			<script src="Designerjs.js"></script>-->
		</head>
		
		<body>
			<header id="Home-header">

				<div class="logo-title">
		
					<img src="image/logo.jpeg" alt="design mate Logo" id="logo">
		
					<span></span>
		
				</div>
			</header>
                   

			<section id="userInfo">
				<div id="tableHeadr-1"> <!-- Update the comment to reflect the correct ID -->
                                    <h3 id="welcomeText">Welcome <?php echo $firstName;?> !</h3>                                   
                                    <a href="index.php" id="logout"> 
                                        <strong> Log-out</strong>
                                    </a>
                                </div>



				<div id="designerInfo">
                                    
                                    <ul class="designer-info">
                                        <li>Designer Name: <span><?php echo $firstName . " " . $lastName;?></span></li>
                                        <li>Email Address: <span><?php echo $emailAddress;?></span></li>
                                        <li>Brand Name: <span><?php echo $brandName;?></span></li>
                                        <li><span>
                                            <?php    
                                            $sqlspec = "SELECT dc.category
                                                 FROM designerspeciality ds
                                                 INNER JOIN designcategory dc ON ds.designCategoryID = dc.id
                                                 WHERE ds.designerID = '$designerID'";
                                         $resultspec = mysqli_query($connection, $sqlspec);

                                         $specialties = array(); // Initialize an empty array to store specialties

                                         if (mysqli_num_rows($resultspec) > 0) {
                                             while ($row = mysqli_fetch_assoc($resultspec)) {
                                                 $specialties[] = $row['category']; // Add each specialty to the array
                                             }
                                             // Join specialties array elements with comma and display
                                             echo "Specialties: " . implode(", ", $specialties);
                                         } else {
                                             echo "No specialties found for this designer.";
                                         }
                                         ?></span></li>
                                        <li class="logo-container"> <!-- Add a class to the logo container -->
                                            Logo: <span><?php
                                                        $sqlForImg= "SELECT logoImgFileName FROM designer WHERE id=$designerID";
                                                        if($resultForImg = mysqli_query($connection, $sqlForImg)){
                                                            while ($rowFORImg = mysqli_fetch_assoc($resultForImg)) {
                                                                echo "<img src='uploads/" . $rowFORImg['logoImgFileName'] . "' alt='designer\'s logo'>";
                                                           }
                                                        }
                                                    ?>
                                            </span>
                                        </li>
                                    </ul>


                                    
				</div>
			
			</section>
                    
                    
                        <section id="2tables">
                                <section id="table1">
                                        <div id="tableHeadr-2">
                                                <h1>Design Portfolio</h1>
                                                <a href="ProjectAdditionPage.php" id="addProject">
                                                    <strong style="font-size: 1.25em;">Add New Project</strong>
                                                </a>
                                        </div>

                                        <table class="table1">
                                            <thead>
                                                <tr>
                                                    <th>Project Name</th>
                                                    <th>Image</th>
                                                    <th>Design Category</th>
                                                    <th>Description</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <?php                        
                                                        $sql = "SELECT * FROM designportfolioproject WHERE designerID = '$designerID'";
                                                        //echo "SQL Query: $sql";
                                                        $result = mysqli_query($connection, $sql);
                                                        if (!$result) {
                                                            die('Error in executing SQL query: ' . mysqli_error($connection));
                                                        }
                                                        if (mysqli_num_rows($result) > 0) {
//                                                            echo "No rows returned from the query."; // Check if any rows are returned
                                                        
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                              echo "<tr>";
                                                        echo "<td>" . $row['projectName'] . "</td>";
                                                        echo "<td><img style='width:50%;hight:50%'src='uploads/" . $row['projectImgFileName'] . "' alt='" . $row['projectName'] . "'></td>";

                                                        // Query to fetch design category for the current project
                                                        $sql2 = 'SELECT category FROM DesignCategory WHERE id = ' . $row["designCategoryID"];
                                                        if ($result2 = mysqli_query($connection, $sql2)) {
                                                            if ($row2 = mysqli_fetch_assoc($result2)) {
                                                                echo "<td>" . $row2['category'] . "</td>";
                                                            } else {
                                                                echo '<td>No category found</td>'; // If no category found for the project
                                                            }
                                                        } else {
                                                            echo '<td>No category found</td>'; // If no category found for the project
                                                        }

                                                        echo "<td>" . $row['description'] . "</td>";
                                                        echo "<td><a href='UpdatePage.php?projectId=" . $row['id'] . "'><strong>Edit</strong></a></td>";
                                                        echo "<td><a href='javascript:void(0);' onclick='deleteProject({$row['id']}, this)'><strong>Delete</strong></a></td>";
                                                        echo "</tr>";

                                                            }
                                                        }else{
                                                       echo "<tr><td colspan='8' style='text-align: center;'><strong style='font-size: 40px; color:#801e00; padding: 20px;'> No project has been added yet.</strong></td></tr>";}

                                                        
                                                    ?>   
  
                                            </tbody>
                                        </table>
                        </section>
			
                            <section id="table2">
                            <h1>Design Consultation Requests</h1>

                           
                                          <?php
                                 include_once 'DB.php';
                                 include_once 'fileUpload.php';
                                $sql = "SELECT * FROM `designconsultationrequest` WHERE `designerID`=".$designerID; //edit 
                                $result = mysqli_query($conn, $sql);
                                
                                
                                 echo "<table class='table2'>";
                                 echo "   <thead>";
                                  echo "  <tr>";
                                      echo "  <th>Clint</th>";
                                      echo "  <th>Room</th>";
                                      echo "  <th>Dimension</th>";
                                      echo "  <th>Design Category</th>";
                                      echo "  <th>Color Preferences</th>";
                                      echo "  <th>Date</th>  ";          
                                   echo " </tr>";
                              echo "  </thead>	";
                                    
                                  echo "  <tbody>";
                                
                                
                                      if(mysqli_num_rows($result) > 0) {
                                          
                                          
                                          
                                          while ($row = mysqli_fetch_assoc($result)){
                                           echo "<tr>";
                                           echo "<td>".getClientNameById($row['clientID'],$conn)."</td>"; // Client name
                                           echo "<td>".getroomTypeOrId($row['roomTypeID'],$conn)."</td>"; // Room type
                                           echo "<td>".$row['roomWidth']."x".$row['roomLength']."m</td>"; // Room dimensions
                                           echo "<td>".getCategoryOrId($row['designCategoryID'],$conn)."</td>"; // Design category
                                           echo "<td>".$row['colorPreferences']."</td>"; // Color preferences
                                           echo "<td>".$row['date']."</td>"; // Date
                                           $_SESSION['requestID']=$row['id'] ;
                                           
                                           echo "<td><a href='DesignConsultationPage.php?requestID=" . $row['id'] . "'><strong>Provide Consultation</strong></a></td>";
                                           echo "<td><a href='javascript:void(0);' onclick='declineConsultation({$row['id']}, this)'><strong>Decline Consultation</strong></a></td>";                                           
                                           echo "</tr>";
                                      }
                                          
                                     }else{ 
                                     echo "<tr><td colspan='8' style='text-align: center;'><strong style='font-size: 40px; color:#801e00; padding: 20px;'> No consultation request.</strong></td></tr>";}
                                                     
                                ?>
                            
                            
                            
                                <script> 
                                    function deleteProject(projectID, link) {
                                        // Perform the AJAX request
                                        const xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'DeletePage.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    const response = JSON.parse(xhr.responseText);
                                                    if (response === true) {
                                                        // Remove the row from the table
                                                        link.closest('tr').remove();
                                                    } else {
                                                        console.error('Failed to delete project');
                                                    }
                                                }
                                            }
                                        };
                                        // Send the request with the project ID
                                        xhr.send('projectID=' + projectID);
                                    }

                                    
                                    
                                    function declineConsultation(requestID, link) {
                                        // Perform the AJAX request
                                        const xhr = new XMLHttpRequest();
                                        xhr.open('POST', 'DeclineConsultationPage.php', true);
                                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                                        xhr.onreadystatechange = function() {
                                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                                if (xhr.status === 200) {
                                                    const response = JSON.parse(xhr.responseText);
                                                    if (response === true) {
                                                        // Remove the row from the table
                                                        link.closest('tr').remove();
                                                    } else {
                                                        console.error('Failed to decline consultation');
                                                    }
                                                }
                                            }
                                        };
                                        // Send the request with the request ID
                                        xhr.send('requestID=' + requestID);
                                    }

                                </script>
                                </tbody>    

                                </table>
                            </section>
                        </section>	
			
			<footer id="Home-footer">
                                <div class="multimedia" ><br>
                                    <div class="icons">
                                         <i class="fa-solid fa-envelope">   </i>

                                         <i class="fa-solid fa-phone">   </i>
                                         <i class="fa-brands fa-twitter icons">   </i>
                                         <i class="fa-brands fa-instagram">   </i>
                                    </div>
                                <p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>
                                </div>
			</footer>
		</body>
</html>