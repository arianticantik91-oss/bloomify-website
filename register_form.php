<?php
// --- BAGIAN PERTAMA: PHP CODE ---
@include 'config.php';

if(isset($_POST['submit'])){
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    // Default user type adalah 'user'
    $user_type = 'user';

    // Cek apakah email sudah terdaftar
    $select = "SELECT * FROM user_form WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
         $error[] = 'User already exists!';
    } else {
        if($pass != $cpass){
            $error[] = 'Password not matched!';
        } else {
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
            exit();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bloomify</title>
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
        
        <h3>Join Bloomify!</h3>
        
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
        };
        ?>
        
        <input type="text" name="name" required placeholder="Enter your full name">
        <input type="email" name="email" required placeholder="Enter your email">
        <input type="password" name="password" required placeholder="Create password">
        <input type="password" name="cpassword" required placeholder="Confirm password">
        <input type="submit" name="submit" value="Register Now" class="form-btn">
        <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>
</div> 
    
</body>
</html>