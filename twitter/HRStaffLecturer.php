<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>        
        <?php
        include "DBConnect.php";
        
        $sql = "SELECT * FROM problems WHERE department = Lecturers";
            $result = $DBConnect->query($sql);
            
            echo "<table>
                <tr>
                <th>ProblemID</th>
                <th>Student</th>
                <th>Description</th>
                <th>date</th>
                </tr>";
            
            if ($result->num_rows > 0){
                // Output
                while($row = $result->fetch_assoc()){ 
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['student_number'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            }else{
                echo "Nothing to show";
            }
        
            
            $sql2 = "SELECT * FROM reservations";
                $result2 = $DBConnect->query($sql2);
                
                echo "<table>
                <tr>
                <th>ReservationID</th>
                <th>Reserved to</th>
                <th>Details</th>
                <th>Date</th>
                </tr>";
                
                if ($result2->num_rows > 0){
                // Output
                while($row = $result2->fetch_assoc()){ 
                    echo "<tr>";
                    echo "<td>" . $row['idReservation'] . "</td>";
                    echo "<td>" . $row['student_number'] . ", " . $row['group_name'] . "</td>";
                    echo "<td>Room " . $row['room_number'] . ", " . $row['time'] . "</td>";
                    echo "<td>" . $row['payment_method'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            }else{
                echo "Nothing to show";
            } 
        ?>
  
    </body>
</html>