<?php
@include 'config.php';
if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['confpassword']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysgli_query($conn, $select);
    if(mysql_num_rows($result)>0){
        $error[] = 'user already exist!';

    }else{
        if($pass != $cpass){
            $error[] = 'password not matched!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name', '$email','$pass','$user_type')";
            mysqli_query($conn, $insert);
            header('location:login_form.php');
        }
    }
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>register form</title>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css" />
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="form-container">
    <form action="" method="post">
        <h3>register now</h3>
        <?php
        if(isset($error)){
            foreach($error as $error){
                echo'<span class ="error msg">'.$error.'</span>';
            };
        };
        ?>
        <input type="text" name="name" required placeholder="enter your name">
        <input type="email" name="email" required placeholder="enter your email">
        <input type="password" name="password" required placeholder="enter your password">
        <input type="password" name="confpassword" required placeholder="confirm your password">
        <select name="user_type">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <input type="submit" name="submit" value="regester now" class="form-btn">
        <p>already have an account? <a href="/register_form/login_form.php"></a>login now</p>
    </form>
</div>
</body>
</html>