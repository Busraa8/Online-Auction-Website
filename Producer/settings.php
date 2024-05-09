<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="stylesheet" href="style.css">
    <style>
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 80%; 
            max-width: 600px; 
            padding: 20px; 
            background-color: #f9f9f9; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        form label {
            display: block; 
            margin-bottom: 10px; 
            font-weight: bold; 
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="password"],
        form textarea {
            width: calc(100% - 16px);
            padding: 8px; 
            margin-bottom: 10px; 
            box-sizing: border-box;  
        }

        form input[type="file"] {
            margin-bottom: 20px; 
        }

        form input[type="submit"] {
            padding: 10px 20px; 
            background-color: #4CAF50;
            color: white; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
        }

        form input[type="submit"]:hover {
            background-color: #45a049; 
        }
        .user-icon {
            position: relative;
            display: inline-block;
        }
        .logout-text {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background-color: #000;
            color: #fff;
            border: 1px solid #fff;
            padding: 5px;
            z-index: 1;
            font-weight: bold;
        }
        .user-icon:hover .logout-text {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <h1>Online Auction Website</h1>
        <div class="user-icon">
            <img src="https://cdn-icons-png.freepik.com/512/1144/1144760.png" alt="User Icon">
            <!-- Çıkış yap metni -->
            <div class="logout-text">
                <form action="logout.php" method="post">
                    <button type="submit" name="logout">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container">
        <aside>
            <h2>Menu</h2>
            <ul>
                <li><a href="producer_products.php">Products</a></li><br>
                <li><a href="users.php">Users</a></li><br>
                <li><a href="add_product.php">Add Product</a></li><br>
                <li><a href="settings.php">Settings</a></li><br>
                <li><a href="company_info.php">Homepage Settings</a></li><br>
            </ul>
        </aside>
        <main>
            <form action="update_user.php" method="POST" enctype="multipart/form-data">
                <h2>Update User Information</h2> 
                <input type="hidden" name="id" value="2">
                
                <label for="name">Name:</label>
                <input type="text" id="name" name="name"><br><br>
                
                <label for="surname">Surname:</label>
                <input type="text" id="surname" name="surname"><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" style="width: calc(100% - 16px);"><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password"><br><br>
                
                <input type="submit" name="update_user" value="Update Information">
            </form>
        </main>
    </div>
</body>
</html>

