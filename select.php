<?php
if (isset($_POST['consumer_login'])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST['producer_login'])) {
    header("Location: index_producer.php");
    exit;
}
?>
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
        <div id="right"><br><br><br><br>
            <h1 id="login">LogIn</h1><br><br>
            <form method="POST" action="">
                <button class="social" id="forgot" name="consumer_login">Consumer</button>
            </form>
            <form method="POST" action="">
                <button class="social" id="forgot" name="producer_login">Producer</button>
            </form>
        </div>
    </div>
</body>
</html>