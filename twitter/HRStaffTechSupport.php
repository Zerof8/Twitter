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
        
        $sql = "SELECT * FROM problems WHERE department = Technical Support";
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
                while($row = $result3->fetch_assoc()){ 
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
        
        echo "<br>"; 
        ?>
    </body>
</html>
