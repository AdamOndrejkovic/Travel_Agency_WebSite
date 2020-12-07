<?php
   //connection to our database
   $servername = "localhost";
   $username = "root";
   $password = "";
   $dbname = "travelers";
   
    $connect = mysqli_connect($servername, $username, $password, $dbname); 
   //if something is in search bar psot
    if(isset($_POST["query"]))  
    {  
         $output = ''; 
        //find if it equals to any field from database
        $query = "SELECT * FROM tripsmodel WHERE name  LIKE '%".$_POST["query"]."%'";
         $result = mysqli_query($connect, $query);  
         $output = '<ul>'; 
        //if anything is found show it
        if(mysqli_num_rows($result) > 0)  
         {  
              while($row = mysqli_fetch_array($result))  
              {  
                   $output .= "<li><a href='trip.php?name=".$row["name"]."'>".$row["name"]."</a></li>";
              }  
         }  
         else  
         {  
             //if nothing was found print message
              $output .= '<li>Country Not Found</li>';  
         }  
         $output .= '</ul>';  
         echo $output;  
    }  
    ?>
