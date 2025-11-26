<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>

    <style>
        body {
            background-color: #a9c9fc;
            text-align: center;
            font-family: Arial, sans-serif;
        }

        .container {
            border: 2px solid blue;
            padding: 20px;
            width: 400px;
            margin: auto;
            background-color: #FCDCA9;
            border-radius: 10px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            background-color: #FCDCA9;
        }

        input, textarea, select {
            width: 80%;
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #555;
            margin-top: 5px;
        }

        textarea {
            height: 80px;
            resize: none;
        }

        button {
            margin-top: 15px;
            border-radius: 20%;
            height: 35px;
            width: 80px;
            background-color: white;
            border: 1px solid #333;
            cursor: pointer;
        }

        button:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>

<body>

    <h1>REGISTRATION PAGE</h1>

    <div class="container">
        <form method="POST" action="patasxan.php">

            <label for="fname">First Name</label>
            <input type="text" name="name" id="fname" placeholder="Enter first name" required>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="second-name" placeholder="Enter last name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="my-email" placeholder="example@mail.com" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="confirm">Confirm Password</label>
            <input type="password" id="confirm" name="confirmed" placeholder="Confirm password" required>

            <label for="username">Username</label>
            <input type="text" id="username" name="user-name" placeholder="Enter username" required>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="+374 00 000 000" required>

            <label for="dob">Date of Birth</label>
            <input type="date" name="date" id="dob" required>

            <label>Gender</label>
            <div style="background:#FCDCA9;">
                <label><input type="radio" name="gender" value="male" required> Male</label>
                <label><input type="radio" name="gender" value="female" required> Female</label>
            </div>

            <label for="address">Address</label>
            <textarea id="address" name="address" placeholder="Enter your address"></textarea>
            <label for="file">Choose file to upload</label>
            <input type="file" id="file" name="file" enctype= />
            
            <button type="submit">SEND</button>

        </form>
    </div>
   <?php
            session_start();
              var_dump($_SESSION);
       if(isset($_SESSION['errors']) && !empty($_SESSION['errors'])){
        foreach ($_SESSION['errors'] as $error){
            echo "<p style='color:red;'>{$error}</p>";
        }
       } elseif (isset($_SESSION['success'])){
        echo "<p style='color:green;'>{$_SESSION['success']}</p>";
      }
       

        ?>
</body>
</html>