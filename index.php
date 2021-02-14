<?php
    session_start();

    $con = mysqli_connect("localhost", "root", "", "test");
    

    if(filter_has_var(INPUT_POST, 'submit')){
        $fName = htmlentities($_POST['fName']);
        $fName = str_replace(" ", "", $fName);
        $fName = ucfirst(strtolower($fName)); 

        $lName = htmlentities ($_POST['lName']);
        $lName = str_replace(" ", "", $lName);
        $lName = ucfirst(strtolower($lName)); 

        $username = htmlentities($_POST['username']);

        $email = htmlentities($_POST['email']);
        $email = str_replace(" ", "", $email);
        $email = ucfirst(strtolower($email)); 

        $chechEmail = htmlentities($_POST['emailCheck']);
        $chechEmail = str_replace(" ", "", $chechEmail);
        $chechEmail = ucfirst(strtolower($chechEmail));

        $pass = strip_tags($_POST['pass']);
        $passVerify = strip_tags($_POST['passVerify']);

        //Used as boolean to give user feedback if registration was succesful or not
        $registerSuccess;
        
        //echo $fName . " " . $lName . " " . $email . " " . $chechEmail . " " . $pass . " " . $passVerify . " " . $date;
        //test 122...ASAas
        //anoteh
        //to be used for user errors i.e. wrong password, email in use...
        $errorArray = array();

        //Email check
        if($email == $chechEmail){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                //Chech if email exists in database
                $checkEmail = mysqli_query($con, "SELECT email FROM users WHERE email='$email'");

                $numOfRows = mysqli_num_rows($checkEmail);

                if($numOfRows > 0){
                    array_push($errorArray, "Email postoji u bazi </br>"); 
                }else{
                    //Email is ok and stored in session
                    $_SESSION['reg_email'] = $email;
                }
            }else{
                //Email is not valid format
                array_push($errorArray, "Email nije vlidnog formata </br>");
            }   

        }else{
            //email do not match
            array_push($errorArray, "Mejlovi se ne podudaraju");
        }

        //name check
        if(strlen($fName) > 50 || strlen($fName) <= 1){
            array_push($errorArray, "Vase ime mora bit izmedju 2 i 50 karaktera </br>");
        }else{
            $_SESSION['reg_fName'] = $fName;
        }

        //Last name check
        if(strlen($lName) > 50 || strlen($lName) <= 1){
            array_push($errorArray, "Vase prezime mora bit izmedju 2 i 50 karaktera </br>");
        }else{
            $_SESSION['reg_lName'] = $lName;
        }

        //Username check
        if(strlen($username) > 50 || strlen($username) <= 3){
            array_push($errorArray, "Korisnicko ime ne sme biti duze od 50 karaktera niti manje od 3</br>");
        }else{

            //check if username is in database
            $usernameQuery = mysqli_query($con, "SELECT username FROM users where username='$username'");
            $userNameQueryResult = mysqli_num_rows($usernameQuery);
            if($userNameQueryResult > 0){
                //username in use
                array_push($errorArray, "Korisnicko ime postoji");
            }else{
                //username is free to use
                $_SESSION['reg_username'] = $username;

            }
        }

        //Password check
        if($pass != $passVerify){
            array_push($errorArray,"Lozinke se ne podudaraju </br>" );
        }

        //Check if user password is in certian parameters, if it has at least one letter, one number and if it's between 8 and 50 characters long
        if(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{8,50}$/", $pass)){
            array_push($errorArray, "Lozinka mora sadrzati bar jedno slovo, broj i mora imati bar 8 karaktera </br>");
        }
 
        
        if(empty($errorArray)){
           //######################################
           //#######  SUCCESFUL DATA CHECK  #######
           //######################################
            //hashing password
            $pass = password_hash($pass, PASSWORD_BCRYPT);

            //Used for default profile pic they are labeled from 1-11
            $rand = rand(1, 11);
            
            $profilePic = "Assets/profile_pics/defaults/pic" . $rand;
            $date = date("Y-m-d");
            $insertDataQuery = mysqli_query($con, "INSERT INTO users VALUES('', '$fName', '$lName', '$username', '$email', '$pass', '$date', '$profilePic', '0', '0', 'no', ',')");
     

            // if($insertDataQuery == true){
            //     $registerSuccess = true;
            //     echo $registerSuccess;
            // }else{
            //     $registerSuccess = false;
            //     echo $registerSuccess;
            // }

        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/css/style.css">
    <title>Ucenjeeee</title>
</head>
<body>
    <div class="container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h3>Register</h3>
            <input type="text" class="input inputFname" placeholder = "Enter name" name="fName" value="<?php echo isset($_POST['fName']) ? $fName : ''; ?>">
            <input type="text" class="input inputLname" placeholder = "Enter name" name="lName" value="<?php echo isset($_POST['lName']) ? $lName : ''; ?>">
            <input type="text" class="input inputUsername" placeholder="Choose username" name="username" value="<?php echo isset($_POST['username']) ? $username : '' ?>">
            <input type="text" class="input email" placeholder="Enter email" name="email" value="<?php echo isset($_POST['lName']) ? $email : ''; ?>">
            <input type="text" class="input emailCheck" placeholder="Enter email again" name="emailCheck" value="<?php echo isset($_POST['lName']) ? $chechEmail  : ''; ?>">
            <input type="password" class="input password" placeholder="Password" name="pass">
            <input type="password" class="input passwordCheck" placeholder="Enter password again" name="passVerify">
            <input type="submit" class="btn btnSubmit" name="submit">
            <?php if(!empty($errorArray)){
                echo "<p class='error'>." . implode($errorArray) . "</p>";
            } ?>
            <?php if(filter_has_var(INPUT_POST, 'registerSuccess')){
                    if($registerSuccess === true){
                        echo "<p class='regSuccess'>Registration was succesfull</p>";
                    }elseif($registerSuccess === false){
                        echo "<p class='regFail'>Registration was not successful</p>";
                    }
            } ?>
        </form>
    </div>
    <script src="Assets/js/app.js"></script>
</body>
</html>