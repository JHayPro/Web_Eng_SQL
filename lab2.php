<!DOCTYPE html>
<?php
    session_start();
    $mysqli = new mysqli("localhost", "root", "root", "lab2", 3306); //Connects to database, stores reference as mysqli
    
    if ($mysqli->connect_error) { //Reports errors if database did not connect correctly
        print('Errno-'.$mysqli->connect_errno);
        print('<br>');
        print('Error- '.$mysqli->connect_error);
        exit();
    }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jude Hayes Lab 2</title>
        <style>
            body {background-color: lightsalmon;}
            #buttonBox{
            display: inline-flex;
            flex-wrap: wrap;
            gap: 10px;
            }
        </style>
    </head>
    <body>
        <form action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
            <div id="usernameBox">
                <label for="usernameInput"style="color:Gray;"> Enter Username </label><br>
                <input type="text" id="usernameInput" name="usernameInput"> <br><br>
            </div>
            <div id="passwordBox">
                <label for="passwordInput"style="color:Gray;"> Enter Password </label><br>
                <input type="password" id="passwordInput" name="passwordInput"> <br><br>
            </div>
            <div id="buttonBox">
                <input type="submit" name = "loginSubmit" value="Log In" id = "submitLogIn"> <br>
                <input type="submit" name = "registerSubmit" value="Register" id = "submitReg"> 
            </div> <br><br>
        </form>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") //Waits for post request
                $usernameInput = $_POST['usernameInput']; //Stores username input
                $passwordInput = $_POST['passwordInput']; //Stores password input

                if(($_POST['registerSubmit'] || $_POST['loginSubmit']) && ($usernameInput == "" || $passwordInput == ""))//If username or password is missing, display error message
                    print("Username/Password Box Is Empty");

                else if ($_POST['registerSubmit']) //Checks for register submission
                    if ($mysqli -> query("INSERT INTO Users (username, password) VALUES('$usernameInput', '$passwordInput')") === TRUE) //If the input username is not taken, the account will be created 
                        print("Account Created!");
                    else 
                        print("Account Creation Failed!");

                else if ($_POST['loginSubmit']) {//Checks for valid log in submission
                    $selectedInfo = $mysqli -> query("SELECT * FROM Users WHERE '$usernameInput' = (username)") -> fetch_assoc(); //Looks for account in database
                    if ($selectedInfo["password"] == $passwordInput) //checks if password matches selectedInfo username
                        if ($selectedInfo["username"] == "Administrator")//Sends admin to admin page
                            header('Location: admin.php');
                        else {//sends user to welcome page
                            header('Location: welcome.php');
                            $_SESSION['usernameInput'] = $usernameInput; //Stores username input as global for welcome page
                        }
                    else //if the password does not match, the account does not exist or the wrong password was entered
                        print("Invalid Username/Password");
                }
        ?>
    </body>
</html>