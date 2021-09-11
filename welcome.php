<!DOCTYPE html>
<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Jude Hayes Lab 2 Home</title>
        <style> body {background-color: lightsalmon;} </style>
        <script>
            var backgroundColorBool = false; //Bool that tracks current color of page
            function colorChangeCallback() {
                if(backgroundColorBool === true){//If bool is true, change it to false and switch BG color
                    document.body.style.backgroundColor = "lightsalmon";
                    backgroundColorBool = false;
                }
                else{//If bool is false, change it to true and switch BG color
                    document.body.style.backgroundColor = "lightpink";
                    backgroundColorBool = true;
                }
            }
            function initFunction() {
                submitButton = document.getElementById('colorChange');
                submitButton.addEventListener('click', colorChangeCallback);//Waits for user input to switch background
            }  
            window.addEventListener('load', initFunction);
        </script>
    </head>
    <body>
        <form>
            <div id="welcomeBox" style="font-size:200%;">
                <?php print("Welcome! " . $_SESSION['usernameInput']) ?>
            </div> <br>
            <div id="buttonBox">
                <input type="button" id = "colorChange" value="Change Color!">
                <a href="http://127.0.0.1:8080/lab2.php">
                    <input type="button" id = "logOut" value="Log Out">
                </a>
            </div>
        </form>
    </body>
</html>