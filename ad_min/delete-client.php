<?php
   session_start();
   //logged in as admin
   if (isset($_SESSION['adminid']))
   {
     //connection file
     $conn=false;
     $file='../connection.php';
     if(file_exists($file)) { include($file); }
     if (!$conn)
     { 
       //problem with connection
       $content = 'Can not connect to the database !!!';
     }
     else
     {
       //if form post
       if($_SERVER['REQUEST_METHOD']=='POST')
       {
         //selected "yes"
         if ($_POST['delete']=='yes')
         {
             
           $content = 'Scheduled trip was deleted.';
           //specific id
           $id = (int)$_POST['id'];
           //sql command
           $sql= 'DELETE FROM trips WHERE id = '.$id;
           $res = $conn->query($sql);
         }
         else
         {
           //selected "no"
           $content = 'Choosen not to delete.';
         }
       }
       else
       {
         $id = (int)$_GET['id'];
         //sql command 
         $sql='SELECT * FROM trips, tripsmodel, clients WHERE clients.tripId = trips.tmid = tripsmodel.id  AND clients.id='.$id ;
         $res = $conn->query($sql);
         
         if ($res)
         {
           //get the data
           $row=$res->fetch();
           $name = $row['name'];
           $fname= $row['fname'];
           
           $fullname = " ".$name.  " "  .$fname." ";
             
             //create the content and form
           $content= '<p>Do you want to delete passanger: '.$fullname.'</p>';
           $content .= '</p>'; 
           $content .= '<form method="post"><p><br /><br /><br /><br /><br />';
           $content .= '<input type="hidden" name="id" value="'.$id.'" />';
           $content .= '<input type="submit" name="delete" value="yes" />';
           $content .= '<input type="submit" name="delete" value="no" />';
           $content .= '</p></form></p>'; 
         }
         else
         {
           //nothing was found
           $content = 'No info was found !!!';   
         } 
       }
     }
   }
   else
   {
     //not logged in or timeout
     $content = 'No access</br>';
   }
   ?>
<html>

<head>
    <title>Delete Passanger</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-passanger">
        <a href="client.php">Back</a>
        <h2>Delete the passanger information </h2>
        <?php echo $content; ?>
    </div>
</body>

</html>
