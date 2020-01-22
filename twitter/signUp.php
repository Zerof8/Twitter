<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sign up form</title>
    </head>
    <body>
        <form action="#" method="POST" enctype="multipart/form-data">
            <p>Username</p>
            <input type="text" name="username"><br>
            <p>Email</p>
            <input type="text" name="email"><br>
            <p>Password</p>
            <input type="password" name="password"><br><br>
            <input type="file" name="image"><br>
            <input type="submit" name="signup" value="Sign up">
            <input type="reset" name="reset" value="reset">


        </form>

        <?php
        if (isset($_POST["signup"])) {
            $name = $email = $password = "";
            if (!empty($_POST["username"]) || (!empty(($_POST["email"]))) || (!empty($_POST["password"]))) {
                $name = $_POST["username"];
                $email = $_POST["email"];
                $DBPassword = $_POST["password"];

                if (empty($_FILES["image"]['name'])) {
                    $image = "default.jpg";
                } else {
                    $image = htmlentities($_FILES["image"]["name"]);
                    
                    if (((($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/png")) 
                            && ($_FILES["image"]["size"] < 50000000))) {
                        if ($_FILES["image"]["error"] > 0) {
                            echo "Error Code: " . $_FILES["uploadedFile"]["error"] . "<br>";
                        } else {
                            move_uploaded_file($_FILES["image"]["tmp_name"], "images/profiles/" . $_FILES["image"]["name"]);
                        }
                    } else {
                        echo "Invalid file";
                    }
                    
                }
                $hash = password_hash($DBPassword, PASSWORD_DEFAULT);
//                $verify = password_verify($DBPassword, $hash);
//                echo $hash."<br>";
//                echo $verify."<br>";
                include 'DBConnect.php';
                $insert = "insert into `nhl_stenden_users` values (null, ?, ?, ?,?)";
                if ($statement = mysqli_prepare($DBConnect, $insert)) {
                    mysqli_stmt_bind_param($statement, "ssss", $name, $hash, $email, $image);
                    if (mysqli_stmt_execute($statement)) {
                        echo"Sign up successful" . "<br><br>";
                    } else {
                        echo "not excuted" . "<br><br>";
                    }
                    mysqli_stmt_close($statement);
                }

            }
            mysqli_close($DBConnect);
        } else {
            echo "Please fill in all fields";
        }
        ?>
        <p><a href="logIn.php">Log in--></a></p>
    </body>
</html>

