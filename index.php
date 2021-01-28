<?php

    $test = false;
    $test2 = false;

    if(filter_has_var(INPUT_POST, 'submit')){
        $name  = htmlentities($_POST['fName']);
        $lName = htmlentities ($_POST['lName']);
        $email = htmlentities($_POST['email']);
        $chechEmail = htmlentities($_POST['emailCheck']);

        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $test = true;
        }else{
            $test2 = true;
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
        <input type="text" class="input inputFname" placeholder = "Enter name" name="fName" value="<?php echo isset($_POST['fName']) ? $name : ''; ?>">
        <input type="text" class="input inputLname" placeholder = "Enter name" name="lName" value="<?php echo isset($_POST['lName']) ? $lName : ''; ?>">
        <input type="text" class="input email" placeholder="Enter email" name="email" value="<?php echo isset($_POST['lName']) ? $email : ''; ?>">
        <input type="text" class="input email" placeholder="Enter email again" name="emailCheck" value="<?php echo isset($_POST['lName']) ? $chechEmail  : ''; ?>">
        <input type="submit" class="btn btnSubmit" name="submit">
        </form>
        <?php if($test) : ?>
            <div class="userNotification">
                 <div class="notification">
                    <p id="success">Success!</p>     
                </div>
            </div>
        <?php endif; ?>

        <?php if($test2) : ?>
            <div class="userNotification">
                 <div class="notification">
                    <p id="fail">Please try again!</p>     
                </div>
            </div>
        <?php endif; ?>
        

        <!--######## Next practise ########-->
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <input type="text" name="testOne" onkeyup="showSuggestion(this.value)">
            <h4>Predlog: <span id="suggest"></span></h4>
        </form>
    </div>

    <script>
        let x;
            function showSuggestion(value){
                if(value.length == 0){
                    document.getElementById('suggest').innerHTML = '';
                }else{
                    //ajax request
                    let xml = new XMLHttpRequest();
                    xml.onreadystatechange = function(){
                        if(this.readyState === 4 && this.status === 200){
                            document.getElementById('suggest').innerHTML = this.responseText;
                        }
                    }

                    xml.open("GET", "names.php?q=" + value, true);
                    xml.send();
                }
            }
        //console.log(x);
    </script>
</body>
</html>