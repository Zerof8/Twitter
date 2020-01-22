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
        
        $sql = "SELECT * FROM problems WHERE department = Marketing";
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
        
      
        $sql2 = "SELECT * FROM orders";
            $result2 = $DBConnect->query($sql2);
            
            echo "<table>
                <tr>
                <th>OrderID</th>
                <th>Billed to</th>
                <th>Order details</th>
                <th>Payment</th>
                <th>date</th>
                </tr>";
            
            if ($result2->num_rows > 0){
                // Output
                while($row = $result2->fetch_assoc()){ 
                    echo "<tr>";
                    echo "<td>" . $row['idOrders'] . "</td>";
                    echo "<td>" . $row['student_number'] . ", " . $row['address'] . " " . $row['post_code'] . " " . $row['city'] . "</td>";
                    echo "<td>" . $row['productid'] . " " . $row['amount'] . "</td>";
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
