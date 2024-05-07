<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Company Information</title>
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
            display: inline-block;
            width: 100px;
            text-align: right;
            margin-right: 20px;
            margin-bottom: 10px; 
            font-weight: bold; 
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="email"],
        form input[type="tel"],
        form input[type="password"],
        form textarea {
            width: calc(100% - 150px);
            padding: 8px; 
            margin-bottom: 10px; 
            box-sizing: border-box;  
        }

        form input[type="submit"] {
            margin-left: 120px; 
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
    </style>
</head>
<body>
    <header>
        <h1>Header</h1>
        <div class="user-icon">
            <img src="https://cdn-icons-png.freepik.com/512/1144/1144760.png" alt="User Icon"> 
        </div>
    </header>
    <div class="container">
        <aside>
            <h2>Sidebar</h2>
            <ul>
                <li><a href="producer_products.php">Products</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="add_product.php">Add Product</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="company_info.php">Homepage Settings</a></li>
            </ul>
        </aside>
        <main>
            <form action="update_company_info.php" method="POST" enctype="multipart/form-data">
                <h2>Update Company Information</h2>
                <label for="about_us" style="vertical-align: top;">About Us:</label>
                <textarea name="about_us" id="about_us"></textarea><br><br>
                
                <label for="address">Address:</label>
                <input type="text" id="address" name="address"><br><br>
                
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone"><br><br>
                
                <label for="fax">Fax:</label>
                <input type="tel" id="fax" name="fax"><br><br>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>
                
                <label for="facebook">Facebook:</label>
                <input type="text" id="facebook" name="facebook"><br><br>
                
                <label for="instagram">Instagram:</label>
                <input type="text" id="instagram" name="instagram"><br><br>
                
                <label for="linkedin">Linkedin:</label>
                <input type="text" id="linkedin" name="linkedin"><br><br>
                
                <input type="submit" name="update_company_info" value="Update Information">
            </form>
        </main>
    </div>
</body>
</html>


