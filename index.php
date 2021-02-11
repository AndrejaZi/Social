<?php


    $con = mysqli_connect("localhost", "root", "", "test");

    if(filter_has_var(INPUT_POST, 'submit')){
        $fName = htmlentities($_POST['fName']);
        $fName = str_replace(" ", "", $fName);
        $fName = ucfirst(strtolower($fName)); 

        $lName = htmlentities ($_POST['lName']);
        $lName = str_replace(" ", "", $lName);
        $lName = ucfirst(strtolower($lName)); 

        $email = htmlentities($_POST['email']);
        $email = str_replace(" ", "", $email);
        $email = ucfirst(strtolower($email)); 

        $chechEmail = htmlentities($_POST['emailCheck']);
        $chechEmail = str_replace(" ", "", $chechEmail);
        $chechEmail = ucfirst(strtolower($chechEmail));

        $pass = strip_tags($_POST['pass']);

        $passVerify = strip_tags($_POST['passVerify']);

        $date = date("d-m-Y");
        //echo $fName . " " . $lName . " " . $email . " " . $chechEmail . " " . $pass . " " . $passVerify . " " . $date;

        if($email == $chechEmail){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                

                //Chech if email exists in database
                $checkEmail = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                $numOfRows = mysqli_num_rows($checkEmail);

                if($numOfRows > 0){
                    echo "Email postoji";
                }else{
                    echo "Email validan za bazu";
                }
            }
        }else{
            echo "Email not same"; //Yo what is this shit???
        }
        
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ucenjeeee</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h3>Email validation</h3>
            <input type="text" class="input inputFname" placeholder = "Enter name" name="fName" value="<?php echo isset($_POST['fName']) ? $fName : ''; ?>">
            <input type="text" class="input inputLname" placeholder = "Enter name" name="lName" value="<?php echo isset($_POST['lName']) ? $lName : ''; ?>">
            <input type="text" class="input email" placeholder="Enter email" name="email" value="<?php echo isset($_POST['lName']) ? $email : ''; ?>">
            <input type="text" class="input email" placeholder="Enter email again" name="emailCheck" value="<?php echo isset($_POST['lName']) ? $chechEmail  : ''; ?>">
            <input type="password" class="input password" placeholder="Password" name="pass" value="<?php echo isset($_POST['pass']) ? $pass : '' ?>">
            <input type="password" class="input password" placeholder="Enter password again" name="passVerify" value="<?php echo isset($_POST['passVerify']) ? $passVerify : '' ?>">
            <input type="submit" class="btn btnSubmit" name="submit">
        </form>
    </div>
    <script src="app.js"></script>
</body>
</html>