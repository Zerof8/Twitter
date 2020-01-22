<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
        <title>Stenden Support Desk</title>
        <link rel="stylesheet" type="text/css" href="login css.css">
    </head>
    <body>
        <div id="LogIncontainer">
            <div id="h2TitleLogIn">
                <h2>Log In</h2>
                <p><a href="signUp.php">Signup</a></p>
            </div>
            <div id="LogInLogo">
            </div>
            <div id="LogInForm">
                <form action="#" method="post">
                    <div class=InputWithIcon">
                        <p>Email Address:</p>
                        <input type="text" name="email" class="emailPassword" id="email" placeholder="E-mail Adress">
                    </div>
                    <p>Password<p>
                        <input type="password" name="password" class="emailPassword" id="password" placeholder="Password"><br>
                        <input type="submit" name="logIn" id="submit">
                </form>
            </div>

            <?php
            if (isset($_POST["logIn"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];


                if (!empty($email) || (!empty($password))) {
                    include "DBConnect.php";
                    $emailquery = "SELECT useremail,userpass,userid,username,userimagepath FROM `nhl_stenden_users` WHERE useremail=? LIMIT 1;";
                    if ($statement = mysqli_prepare($DBConnect, $emailquery)) {
                        mysqli_stmt_bind_param($statement, "s", $email);
                        if (mysqli_stmt_execute($statement)) {
                            mysqli_stmt_bind_result($statement, $email, $passwordver, $userid,$username,$pimage);
                            mysqli_stmt_store_result($statement);
                            if (mysqli_stmt_fetch($statement)) {

                                if (password_verify($password, $passwordver)) {
                                    session_start();
                                    $_SESSION["user_email"] = $email;
                                    $_SESSION["user_id"] = $userid;
                                    $_SESSION["user_name"]=$username;
                                    $_SESSION["user_image"]=$pimage;
                                    header("location: index.php");
                                } else {
                                    echo "The combination between Email and password is not correct!";
                                }
                            } else {
                                echo "Unknown user!";
                            }
                        } else {
                            echo "not excuted" . "<br><br>";
                        }
                        mysqli_stmt_close($statement);
                    }
                }

                mysqli_close($DBConnect);
            }
            ?>
        </div>
    </body>
</html>