<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="basics.css">
    <link rel="stylesheet" href="styles.css">
    <script src="scriptlog.js" defer></script>
    <title>DesignConnect - Login</title>
</head>
<body>

    <div id="container">

        <!-- Header -->

        <header id="Home-header">

            <div class="logo-title">

                <img src="image/logo.jpeg" alt="design mate Logo" id="logo">

                <span></span>

            </div>

            <div class="navbar">
            </div>

        </header>
    <div class="login-page">
        <h2>Login</h2>
        <form id="loginForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="userType">User Type:</label>
            <select id="userType" name="userType" required>
                <option value="designer">Designer</option>
                <option value="client">Client</option>
            </select>

            <input type="submit" value="Login">
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
            <i class="fa-brands fa-instagram">   </i></div>
<p>© 2024 - DESIGN MATE ALL RIGHTS RESERVED. | 55 RUE GABRIEL LIPPMANN, L-6947, NIEDERANVEN, LUXEMBOURG</p>

        </div>
    </footer>
</body>
</html>