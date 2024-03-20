<?php include 'login_producer.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="Consumer/login.css">
</head>
<body>
    <div id="container">
        <div id="left">
            <h1 id="welcome">Welcome</h1>
        </div>
        <div id="right">
            <h1 id="login">Producer LogIn</h1><br>
            <form action="" method="post"> 
                <input type="email" id="email" name="email" class="client-info" required>
                <label for="email">Email</label>
                <input type="password" id="password" name="password" class="client-info" required>
                <label for="password">Password</label>
                <input type="submit" id="submit" name="login" class="client-info" value="LogIn">
            </form>
            <a href="select.php" style="text-decoration: none;">
                <button class="social" id="forgot">change user role</button>
            </a>
        </div>
    </div>
</body>
</html>
