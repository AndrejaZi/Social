<?php

$con = mysqli_connect("localhost", "root", "", "testno2");
if(mysqli_connect_errno()){
    echo "Oops. An error has occured: " . mysqli_connect_errno();
}else{
    if(isset($_POST['submit'])){


        //name------------------------------------------
        $name = $_POST['name']; 
        $name = strip_tags($name); //removing special chars
        $name = ucfirst(strtolower($name)); //seting name to be first letter capital
    
        //email-----------------------------------------
        $email = $_POST['email']; //email
        $email = strip_tags($email);
        $email = ucfirst(strtolower($email));
    
        //For email verification----------------------------
        $emailVerify = $_POST['email2'];
        $emailVerify = strip_tags($emailVerify);
        $emailVerify = ucfirst(strtolower($emailVerify));
    
        //password--------------------------------------
        $pass = $_POST['pass']; 
    
        //For password verification---------------------
        $passVerify = $_POST['pass2']; 
    
        $date = date("d-m-yy"); // Current date
    
        //Email verification----------------------------
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($emailVerify, FILTER_VALIDATE_EMAIL)){
            if($email == $emailVerify){

                //Checking if email is in use
                $emailCheck = mysqli_query($con, "SELECT * FROM User where email = '$email' ");
                $numberOfRows = mysqli_num_rows($emailCheck);
                if($numberOfRows > 0){
                    echo "Email is in use, try another";
                }else{
                    echo "Email is available";
                }
                

            }else{
                echo "nisu ist emjlovi";   
            }
        }else{
            echo "nije validno";
        }


    }//end of isset for submit
}//end of 'if' check for no errors in connection


    
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
    
    <div class="container">
        <h3>Marker</h3>
        <p>Enter sandman</p>
<<<<<<< HEAD
        <p>Exit light</p>
=======
        <p>Enter night</p> 
        <!-- Dont change! -->
>>>>>>> 2ee0027e95e5011273fc0280481122667c47f85e
    </div>
</body>
</html>