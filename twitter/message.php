<!DOCTYPE html>
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
                <div id="logo_box">
                    <img src="images/logo.png" alt="Logo"/>
                </div>
                <h1 id="title">Twitter</h1>
            </header>
            <main>
                <div id="fillup_problem">
                    <div id="problemcontainer">
                        <div id="h1TitleProblem">
                            <h1>Submit you message!</h1>
                        <div id="ProblemsForm">
                        <form method="POST" action="#">
                            <label>Message</label><br><textarea name="message" id="InputFormTextArea"></textarea> <br>
                            <input type="submit" name="submitMessage" id="SubmitButton">
                            <p><a href="index.php">Back home--></a><p>
                        </form>
                    </div>	
                </div>
                </div>
                </div>

            </main>

            <footer>

            </footer>
        </div>	
 <?php
 session_start();
 $userid=$_SESSION["user_id"];
 if (isset ($_POST["submitMessage"])){
     if(!empty($_POST["message"])){
         $mess=$_POST["message"];
         include 'DBConnect.php';
         $messQuery="INSERT INTO `nhl_stenden_messages` (`msgid`, `userid`, `message`) VALUES (NULL, ?, ?);";
         if ($stmt=mysqli_prepare($DBConnect, $messQuery)){
              mysqli_stmt_bind_param($stmt, "is",$userid,$mess );
             if(mysqli_stmt_execute($stmt)){
                
                 echo "Message Submitted";
             }else{
               echo mysqli_stmt_error($stmt);
             }
             mysqli_stmt_close($stmt);
         }else{
             echo "Could not submit your message!";
         }
         mysqli_close($DBConnect);
     }else{
         echo "please fill in your message!";
     }
 }
 ?>
    </body>
</html>