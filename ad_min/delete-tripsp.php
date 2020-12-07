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
         $sql='SELECT * FROM trips, tripsmodel WHERE trips.tmid = tripsmodel.id  AND tripId='.$id ;
         $res = $conn->query($sql);
         
         if ($res)
         {
           //get the data
           $row=$res->fetch();
           $name = $row['name'];
           $type = $row['type'];
           $date = $row['dateB'].' - '.$row['dateE'];
           $status = $row['status'];
             
             //create the content and form
           $content= '<p>Trip <strong> '.$name.'</strong><br />on '.$date.'<br />Trip is: '.$status.'</p>';
           $content .= '</p>'; 
           $content .= '<form method="post"><p>Do you want to delete scheduled trip ?<br /><br />';
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
    <title>nieuwsberichten verwijderen</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-plan-trip">
        <a href="trips-overview.php">Back</a>
        <h2>Delete scheduled trip </h2>
        <?php echo $content; ?>
    </div>
</body>

</html>
