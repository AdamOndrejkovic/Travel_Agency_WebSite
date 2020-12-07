<?php
   session_start();
     if (!isset($_SESSION['adminid']))
     {
       //not logged or timeout
       $content ='No access';
     }
     else  
     { //get the parameter from the url
       $id = (int)$_GET['id'];
       
       //connect to the database
       $conn=false;
       $file='../connection.php';
       if(file_exists($file)) { include($file); }
       if ($conn) 
       {  
         if($_SERVER['REQUEST_METHOD']=='POST')
         {
         	//proccess the form
           if($_POST['status']) 
           {
              $status = stripslashes($_POST['status']);
              $status = htmlspecialchars($status);
             try {
                 //update the status in the table
               $res = $conn->prepare("UPDATE trips SET status = ?
                                      WHERE tripId = ?");
               $res->execute(array($status, $id)); 
                 //redirect if all ok
               header("Location:show-tripsp.php?id=".$id);
             }
             catch(Exception $e ) { 
               //error message
               $content='<p>Something went wrong. The changes were not saved.</p>';
             }  
           }
           else 
           { //not all filled in
             $err ='<p>All fields must be filled in.</p>';
           }
         }
         else
         {
         	//get the data
           $sql="SELECT * FROM trips WHERE tripId = $id ";
           $res = $conn->query($sql);
           $amount = $res->rowCount();
           if($amount==0)
           {
             //error message
             $content = '<p>Nothing was found.</p>'; 
           }
           else
           {
             //get the record
             $row = $res->fetch();
             
             $status = htmlentities($row['status']);
             //create the form
             $content='
             <h3>Status of the trip: '.$status.'</h3>
             <form method="post">
                 <select id="status" name="status">
                   <option value="Done">Done</option>
                   <option value="Cancelled">Cancelled</option>
                   <option value="Planned">Planned</option>
                 </select>
             <input type="submit" value="Change"></p>
             </form>';
           }
         }
       }
       else 
       {
         $content='<p>Can not connect to the database !!!</p>'; 
       }
     }
     //show the page or the error
   ?>
<!DOCTYPE html>
<html>

<head>
    <title>Nieuwsberichten</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="set-tripplan-status">
        <a href="trips-overview.php">Back</a>
        <h2> Change planned trip status</h2>
        <?php echo $content; ?>
    </div>
</body>

</html>
