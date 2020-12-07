<?php
   session_start();
     if (!isset($_SESSION['adminid']))
     {
       //not logged in or timeout
       $content ='No access</br>';
     }
     else  
     { //get the parameter from the url
       $trippId = (int)$_GET['id'];
       
       //connect to the database
       $conn=false;
       $file='../connection.php';
       if(file_exists($file)) { include($file); }
       if ($conn) 
       {  
         if($_SERVER['REQUEST_METHOD']=='POST')
         {
         	//proccess the form
           if($_POST['tmid'] && $_POST['title'] && $_POST['info'] && $_POST['plan']) 
           {
             //assign the data to variables
                $tmid = stripslashes($_POST['tmid']);
                $tmid = htmlspecialchars($tmid);
                $title = stripslashes($_POST['title']);
                $title = htmlspecialchars($title);
                $info = stripslashes($_POST['info']);
                $info = htmlspecialchars($info);
                $plan = stripslashes($_POST['plan']);
                $plan = htmlspecialchars($plan);
               
             try {
                 //update the data
               $res = $conn->prepare("UPDATE tripplan SET title = ?, info = ?, plan = ? WHERE id = ?");
               $res->execute(array($title, $info, $plan, $trippId)); 
                 //redirect if all ok
               header("Location:show-tripsp.php?id=".$tmid);
             }
             catch(Exception $e ) { 
               //error message
               $content='<p>Something went wrong. Changes were not saved.</p>';
             }  
           }
           else 
           { //not all fields filled in 
             $content ='<p>All fields must be filled in.</p>';
           }
         }
         else
         {
         	//get the data from the database
           $sql="SELECT * FROM tripplan, tripsmodel WHERE tripplan.tmid = tripsmodel.id  AND tripplan.id = $trippId";
           $res = $conn->query($sql);
           $amount = $res->rowCount();
           if($amount==0)
           {
             //error message
             $content = '<p>No data</p>'; 
           }
           else
           {
             // get the data
             $row = $res->fetch();
             //assign data to the variables
             $id = $row['id'];
             $name = htmlentities($row['name']);
             $type = htmlentities($row['type']);
             $title = htmlentities($row['title']);
             $info = htmlentities($row['info']);  
             $plan = htmlentities($row['plan']);
   
               //create the form
             $content='<h3>Add information for trip '.$name.' '.$type.'</h3>
            <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="tmid" maxlength="30" value="'.$id.'"/>
              <label>Title</label><br /> <input type="text" name="title" maxlength="30" value="'.$title.'"/><br />
              <label>Info</label><br /> <textarea rows="10" cols="50" name="info" maxlength="500">'.$info.'</textarea><br />
              <label>Planning</label> <br />
              <textarea rows="10" cols="50" name="plan" maxlength="500">'.$plan.'</textarea>
             <br /><br /><br /><br />
             <input type="submit" value="Update" /></p>
             </form>';
               
           }
         }
       }
       else 
       {
         $content='<p>Can not connect to the database.</p>'; 
       }
     }
     //show the page or error message
   ?>
<!DOCTYPE html>
<html>

<head>
    <title>Nieuwsberichten</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="edit-trip-info">
        <a href="trips-overview.php">Back</a>
        <h2> Trip information</h2>
        <?php echo $content; ?>
    </div>
</body>

</html>
