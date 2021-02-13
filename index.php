<?php
    session_start();

    $con = mysqli_connect("localhost", "root", "", "test");

    if(filter_has_var(INPUT_POST, 'submit')){
        $fName = htmlentities($_POST['fName']);
        $fName = str_replace(" ", "", $fName);
        $fName = ucfirst(strtolower($fName)); 
        $_SESSION['reg_fName'] = $fName;

        $lName = htmlentities ($_POST['lName']);
        $lName = str_replace(" ", "", $lName);
        $lName = ucfirst(strtolower($lName)); 
        $_SESSION['reg_lName'] = $lName;
        
        $email = htmlentities($_POST['email']);
        $email = str_replace(" ", "", $email);
        $email = ucfirst(strtolower($email)); 
        $_SESSION['reg_email'] = $email;

        $chechEmail = htmlentities($_POST['emailCheck']);
        $chechEmail = str_replace(" ", "", $chechEmail);
        $chechEmail = ucfirst(strtolower($chechEmail));
        $_SESSION['reg_checkEmail'] = $chechEmail;

        $pass = strip_tags($_POST['pass']);
        $passVerify = strip_tags($_POST['passVerify']);
        $date = date("d-m-Y");
        //echo $fName . " " . $lName . " " . $email . " " . $chechEmail . " " . $pass . " " . $passVerify . " " . $date;

        $errorArray = array();

        if($email == $chechEmail){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                

                //Chech if email exists in database
                $checkEmail = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                $numOfRows = mysqli_num_rows($checkEmail);

                if($numOfRows > 0){
                    array_push($errorArray, "Email postoji u bazi </br>"); 
                }else{
                    //Email is ok
                }
            }   

        }else{
            array_push($errorArray, "Email nije vlidnog formata </br>");
        }

        if($pass != $passVerify){
            array_push($errorArray,"Lozinke se ne podudaraju </br>" );
        }

        if(strlen($fName) > 50 || strlen($fName) <= 1){
            array_push($errorArray, "Vase ime mora bit izmedju 2 i 50 karaktera </br>");
        }
        if(strlen($lName) > 50 || strlen($lName) <= 1){
            array_push($errorArray, "Vase prezime mora bit izmedju 2 i 50 karaktera </br>");
        }

        //Ovo sto je cudno proverava da li se lozinka slaze sa nekim standardom, tj da li ima slovo, broj i neki od znakova, takodje gleda da li je manje od 8 ili vise od 50 karakatera
        if(preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,50}$/", $pass)){
            
        }else{
            array_push($errorArray, "Lozinka mora sadrzati bar jedno slovo, broj i mora imati bar 8 karaktera </br>");
        }
        

        //echo $_SESSION["reg_fName"] . " " . $_SESSION["reg_lName"];
        echo implode($errorArray);
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
            <input type="text" class="input emailCheck" placeholder="Enter email again" name="emailCheck" value="<?php echo isset($_POST['lName']) ? $chechEmail  : ''; ?>">
            <input type="password" class="input password" placeholder="Password" name="pass">
            <input type="password" class="input passwordCheck" placeholder="Enter password again" name="passVerify">
            <input type="submit" class="btn btnSubmit" name="submit">
            <?php if(!empty($errorArray)){
                echo "<p class='error'>." . implode($errorArray) . "</p>";
            } ?>
        </form>
    </div>
    <script src="app.js"></script>
</body>
</html>