<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){

            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');

        }elseif($row['user_type'] == 'user'){

            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        }
    }else{
        $error[] = 'incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bloomify</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="login_register.css">
</head>
<body>

<!-- Floating flower decorations -->
<div class="floating"><i class="fas fa-rose"></i></div>
<div class="floating"><i class="fas fa-sun"></i></div>
<div class="floating"><i class="fas fa-spa"></i></div>
<div class="floating"><i class="fas fa-leaf"></i></div>
<div class="floating"><i class="fas fa-feather-alt"></i></div>

<div class="form-container">
   <form action="" method="post">
        <div class="logo">
            <div class="logo-content">
                <i class="fas fa-seedling logo-icon"></i>
                <span>Bloomify</span>
            </div>
        </div>
        
        <h3>Welcome Back!</h3>
        
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Enter your password">
        <input type="submit" name="submit" value="Login Now" class="form-btn">
        <p>Don't have an account? <a href="register_form.php">Register now</a></p>
   </form>
</div> 
    
</body>
</html>