<?php
if(isset($_POST['submit'])){
    $name = $_POST['name']; //name
    $name = strip_tags($name); //removing special chars
    $name = ucfirst(strtolower($name)); //seting name to be first letter capital

    $email = $_POST['email']; //email
    $email = strip_tags($email);
    $email = ucfirst(strtolower($email));

    $emailVerify = $_POST['email2']; //For email verification
    $emailVerify = strip_tags($emailVerify);
    $emailVerify = ucfirst(strtolower($emailVerify));

    $pass = $_POST['pass']; //password

    $passVerify = $_POST['pass2']; //For password verification

    $date = date("d-m-yy"); // Current date
    

}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="index.php" method="POST">
        <input type="text" name="name" placeholder="Name">
        <br>
        <input type="text" name="email" placeholder="Email">
        <br>
        <input type="text" name="email2" placeholder="Verify Email">
        <br>
        <input type="password" name="pass" placeholder="Password">
        <br>
        <input type="password" name="pass2" placeholder="Verify Password">
        
        <br>
        <input type="submit" name="submit" value="Registruj se">
    </form>
</body>
</html>