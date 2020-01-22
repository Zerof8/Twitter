<!DOCTYPE html>
<?php
//    if(!isset($_SESSION['user_name']))
//    {
//        header('location: login.php');
//    }
?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1" name="viewport" />		
        <title>Stenden Support Desk</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div id="container">
            <header>
                <div id="logout"><p><a href="logout.php">Logout</a></p></div>
                <div id="logo_box">
                    <img src="images/logo.png" alt="Logo"/>
                </div>
                <h1 id="title">Twitter</h1>
  
            </header>
            <h2><a href="message.php">Submit your messege</a></h2>
            <?php
            session_start();
            $username=$_SESSION["user_name"];
            $pimage=$_SESSION["user_image"];
            include 'DBConnect.php';
            $SQLquery = "SELECT nhl_stenden_users.username,nhl_stenden_messages.message
                     FROM `nhl_stenden_messages`,`nhl_stenden_users`
                     WHERE nhl_stenden_users.userid = nhl_stenden_messages.userid
                     ORDER BY msgid DESC
                     LIMIT 10;";
            if ($stmt = mysqli_prepare($DBConnect, $SQLquery)) {
                $execute = mysqli_stmt_execute($stmt);
                if (!$execute) {
                    echo "<p>Error code "
                    . mysqli_errno($DBConnect)
                    . ": " . mysqli_error($DBConnect)
                    . "</p>";
                } else {
                    mysqli_stmt_bind_result($stmt, $username, $mess);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) == 0) {
                        echo "<p>There are no messages!</p>";
                    } else {
                        echo "<div id='messtitle'><p>The following messages has been submitted:</p></div>";

                        while (mysqli_stmt_fetch($stmt)) {
                            echo $username."<img src='images/profiles/$pimage' id='pimage'>"."<br>".$mess."<br><br>";
                        }
                    }
                }

                mysqli_stmt_close($stmt);
            }
            ?>

      </div>

    </body>
</html>
