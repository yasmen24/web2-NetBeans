<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update project page</title>
    <link rel="stylesheet" href="Updatepage.css">
    <link rel="stylesheet" href="basics.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

    <header id="Home-header">

        <div class="logo-title">

            <img src="image/logo.jpeg" alt="design mate Logo" id="logo">

            <span></span>

        </div>
        <?php

      include 'DB.php';

     if(isset($_GET['projectId'])) {
        $projectId = $_GET['projectId'];

        // Fetch project details from the database based on the project ID
        $sql = "SELECT * FROM designportfolioproject WHERE Id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $result = $stmt->get_result();
        // Check if the project exists
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Assign retrieved data to variables
                $projn = $row['projectName'];                
               $image = $row['projectImgFileName'];
                $description = $row['description'];
                $category = getCategoryOrId( $row['designCategoryID'], $conn);

        }  else {
                // Handle case when project is not found
                echo "Project not found!";
                exit();
            }
     }else {
    // Handle case when project ID is not provided in the URL
    echo "Project ID not provided!";
    exit();
     }

           
        ?>

    </header>    
    <section>
        <form action="updateHandelrPage.php" method="POST" name="ProjectUpdateForm" enctype="multipart/form-data"  >
        <h1> Edit Project </h1>
        
                <!-- Hidden input field to store project ID -->
                <input type="hidden" name="projectId" value="<?php echo $projectId ?>">
                
            <!--project name-->
            <div class="Pname">
                <label for="ProjectName" >Project Name:</label>
                <input type="text" id="ProjectName"name='ProjectName' value="<?php echo $projn ?> ">
            </div>
            
            <!--project logo-->
            <div class="Plogo">
                <label for="image">Insert logo brand:</label>
               <input type="file" id="image" name="image"   ><br>
               
            </div>

            <!--drop down menue-->
            <div class="Pmenue">
           <label for="drop-downMenue">Select Category:</label>
            <select name="drop-downMenue" class="drop-downMenue">
                <option value="Minimalist" <?php if($category == "Minimalist") echo "selected"; ?>>Minimalist</option>
                <option value="Modern" <?php if($category == "Modern") echo "selected"; ?>>Modern</option>
                <option value="Country" <?php if($category == "Country") echo "selected"; ?>>Country</option>
                <option value="Coastal" <?php if($category == "Coastal") echo "selected"; ?>>Coastal</option>
                <option value="Bohemian" <?php if($category == "Bohemian") echo "selected"; ?>>Bohemian</option>
            </select><br>

                    </div>        
<!--            description (text area)-->
            <div class="Pdescription">
            <textarea  name='desc' placeholder="design description..." cols="30%" rows="5%"  ><?php echo $description ?></textarea><br>
            </div>
                <!--submit button-->

                <input type="submit" id="btn" name="btn" value="Submit" style="width:25%; align-self: center;margin:5px; height:25px" />

       
        </form>
        
    </section>
 

<!--    <script src="UpdatePage.js"></script>-->
    <footer id="Home-footer">


        <div class="multimedia" >

            <br>
       <div class="icons">
            <i class="fa-solid fa-envelope">   </i>

            <i class="fa-solid fa-phone">   </i>
            <i class="fa-brands fa-twitter icons">   </i>
            <i class="fa-brands fa-instagram">   </i></div>
<p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>

        </div>
    </footer>
</body>

</html>
   
   <?php

include 'fileUpload.php';

    
     function getCategoryOrId($input, $conn) {
    // Check if the input is numeric or a string
    if (is_numeric($input)) {
        // Input is numeric, so retrieve the corresponding category
        $sql = "SELECT category FROM designcategory WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $input); // Assuming input is an integer (ID)
        $stmt->execute();
        $stmt->bind_result($category);
        $stmt->fetch();
        return $category;
    } else {
        // Input is a string, so retrieve the corresponding ID
        $sql = "SELECT id FROM designcategory WHERE category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $input); // Assuming input is a string (category)
        $stmt->execute();
        $stmt->bind_result($id);
        $stmt->fetch();
        return $id;
    }
}

  


?>
