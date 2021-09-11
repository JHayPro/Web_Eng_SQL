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
    <header>
        <meta charset="UTF-8">
        <title>Jude Hayes Lab 2 Admin</title>
        <style> body {background-color: lightsalmon;} </style>
    </header>
    <body>
        <div id="buttonBox">
            <a href="http://127.0.0.1:8080/lab2.php">
                <input type="button" id = "logOut" value="Log Out">
            </a>
        </div>
        <table border="1" style = "background-color:lightgrey;">
            <thead>
                <tr>
                    <td>Username</td>
                    <td>Password</td>
                </tr> <br>
            </thead>
            <tbody>
                <?php
                    $sqlData = "SELECT * FROM users ORDER BY username";
                    $sqlDataResult = $mysqli->query($sqlData);//Retrieves table data in order of usernames in alphabetical order
                    while($sqlDataResultRow = mysqli_fetch_row($sqlDataResult)) //Prints array
                        print("<tr><td>$sqlDataResultRow[1]</td>" . " "."<td>$sqlDataResultRow[2]</td></tr>");
                ?>
            </tbody>
        </table>
    </body>
</html>