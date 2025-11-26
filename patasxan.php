<?php
  session_start();
  var_dump($_SESSION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $errors = [];
    
    // Անուն
    $name = trim($_POST['name'] ?? '');
    if (empty($name)) {
        $errors[] = "Անունը պարտադիր է";
    } elseif (!preg_match("/^[a-zA-Zա-ֆԱ-Ֆ\s]+$/u", $name)) {
        $errors[] = "Անունը չպետք է պարունակի թվեր կամ սիմվոլներ";
    }
    
    // Ազգանուն
    $lastName = trim($_POST['second-name'] ?? '');
    if (empty($lastName)) {
        $errors[] = "Ազգանունը պարտադիր է";
    } elseif (!preg_match("/^[a-zA-Zա-ֆԱ-Ֆ\s]+$/u", $lastName)) {
        $errors[] = "Ազգանունը չպետք է պարունակի թվեր կամ սիմվոլներ";
    }
    
    // Էլ. փոստ
    $email = trim($_POST['my-email'] ?? '');
    if (empty($email)) {
        $errors[] = "Էլ. փոստը պարտադիր է";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Էլ. փոստի ֆորմատը սխալ է";
    }
    
    // Գաղտնաբառ
    $password = $_POST['password'] ?? '';
    if (empty($password)) {
        $errors[] = "Գաղտնաբառը պարտադիր է";
    }
    
    // Գաղտնաբառի հաստատում
    $confirmed = $_POST['confirmed'] ?? '';
    if (empty($confirmed)) {
        $errors[] = "Գաղտնաբառի հաստատումը պարտադիր է";
    } elseif ($password !== $confirmed) {
        $errors[] = "Գաղտնաբառերը չեն համընկնում";
    }
    
    // Օգտանուն
    $username = trim($_POST['user-name'] ?? '');
    if (empty($username)) {
        $errors[] = "Օգտանունը պարտադիր է";
    }
    
    // Հեռախոսահամար
    $phone = trim($_POST['phone'] ?? '');
    if (empty($phone)) {
        $errors[] = "Հեռախոսահամարը պարտադիր է";
    } elseif (!preg_match("/^\+374\s\d{2}\s\d{3}\s\d{3}$/", $phone)) {
        $errors[] = "Հեռախոսահամարը պետք է լինի +374 00 000 000 ֆորմատով";
    }
    
    // Ծննդյան ամսաթիվ և տարիք
    $dob = $_POST['date'] ?? '';
    if (empty($dob)) {
        $errors[] = "Ծննդյան ամսաթիվը պարտադիր է";
    } else {
        $birthDate = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        
        if ($age < 18) {
            $errors[] = "Դուք պետք է լինեք 18 տարեկան կամ ավելի մեծ";
        }
    }
    
    // Սեռ
    $gender = $_POST['gender'] ?? '';
    if (empty($gender)) {
        $errors[] = "Սեռը պարտադիր է ընտրել";
    }
    $_SESSION['errors'] = $errors;
    header("Location: das_form.php");
    exit();
    
    // Եթե սխալներ կան՝ ցուցադրել
    if (!empty($errors)) {
        echo "<!DOCTYPE html>
<html lang='hy'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Սխալներ</title>
    <style>
        body {
            background-color: #a9c9fc;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .error-container {
            background-color: #ffcccc;
            border: 2px solid red;
            border-radius: 10px;
            padding: 20px;
            max-width: 500px;
            margin: 20px auto;
        }
        h2 {
            color: #cc0000;
        }
        ul {
            text-align: left;
            display: inline-block;
        }
        li {
            margin: 10px 0;
            color: #cc0000;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: white;
            color: #333;
            text-decoration: none;
            border: 1px solid #333;
            border-radius: 5px;
        }
        a:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <div class='error-container'>
        <h2>Սխալներ գրանցման ժամանակ</h2>
        <ul>";
        
        foreach ($errors as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        
        echo "</ul>
        <a href='das_form.php'>Վերադառնալ ձևի էջ</a>
    </div>
</body>
</html>";
    } else {
        // Հաջող գրանցում
        echo "<!DOCTYPE html>
<html lang='hy'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Հաջողություն</title>
    <style>
        body {
            background-color: #a9c9fc;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .success-container {
            background-color: #ccffcc;
            border: 2px solid green;
            border-radius: 10px;
            padding: 20px;
            max-width: 500px;
            margin: 20px auto;
        }
        h2 {
            color: #006600;
        }
        .info {
            text-align: left;
            display: inline-block;
            margin: 20px 0;
        }
        .info p {
            margin: 10px 0;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: white;
            color: #333;
            text-decoration: none;
            border: 1px solid #333;
            border-radius: 5px;
        }
        a:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <div class='success-container'>
        <h2>Գրանցումը հաջողվեց!</h2>
        <div class='info'>
            <p><strong>Անուն:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Ազգանուն:</strong> " . htmlspecialchars($lastName) . "</p>
            <p><strong>Էլ. փոստ:</strong> " . htmlspecialchars($email) . "</p>
            <p><strong>Օգտանուն:</strong> " . htmlspecialchars($username) . "</p>
            <p><strong>Հեռախոսահամար:</strong> " . htmlspecialchars($phone) . "</p>
            <p><strong>Ծննդյան ամսաթիվ:</strong> " . htmlspecialchars($dob) . "</p>
            <p><strong>Սեռ:</strong> " . htmlspecialchars($gender) . "</p>
            <p><strong>Տարիք:</strong> " . $age . " տարեկան</p>
        </div>
        <a href='das_form.php'>Վերադառնալ ձևի էջ</a>
    </div>
</body>
</html>";
    }
} else {
  //  header("Location: das_form.php");
   // exit();
}

?>