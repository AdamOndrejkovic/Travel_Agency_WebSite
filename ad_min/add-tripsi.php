<?php
   session_start();
   $err='';
   if (isset($_SESSION['adminid'])) {
       $id = (int)$_GET['id'];
     $content='<a href="trips-overview.php">Back</a>
           <h2>Add information about the trip</h2>';
       //if form post
     if ($_SERVER['REQUEST_METHOD']=='POST') {
         //proccess the form
       if($_POST['tmid'] && $_POST['title'] && $_POST['info'] && $_POST['plan']) { 
           //conntect to the database
             $conn=false;
             $file='../connection.php';
             if(file_exists($file)) { include($file); }
             if ($conn) { 
                 //assign data to variables
         	     $tmid = stripslashes($_POST['tmid']);
               $tmid = htmlspecialchars($tmid);
               $title = stripslashes($_POST['title']);
               $title = htmlspecialchars($title);
               $info = stripslashes($_POST['info']);
               $info = htmlspecialchars($info);
               $plan = stripslashes($_POST['plan']);
               $plan = htmlspecialchars($plan);
              
                 //insert into database
               try {
                 $res = $conn->prepare("INSERT INTO tripplan ( tmid, title, info, plan)
                                        VALUES ( ?, ?, ?, ?)");
                 $res->execute(array($tmid, $title, $info, $plan));
                   $err="OK";
                   //if ok redirect
                   header("Location:show-tripsp.php?id=".$id);
                
               }
               catch(Exception $e ) {  
                   //error message
                 $err.='<p>Something went wrong the data was not saved.</p>';
               } 
             }
             else {
               $err.='<p>Can not connect to the database</p>'; 
             } 
      
       }
       else { // not all fields filled
         $err ='<p>All fields must be filled in.</p>';
       }
     }
     else  {
     }
   
   //connect to the database
   $conn=false;
    $file='../connection.php';
    if(file_exists($file)) { include($file); }
    if ($conn)
    {  
      //sql command
      $res = $conn->query('SELECT * FROM tripsmodel WHERE id='.$id);
       
       
      //get the records
      while($row=$res->fetch())
      {
     	  //data from database assign to the variables
        $id = $row['id'];
        $name = htmlentities($row['name']);
        $type = htmlentities($row['type']);
             
          //create the form
           $content.= $err.'
           <h3>Add information for trip '.$name.' '.$type.'</h3>
           <form method="post" enctype="multipart/form-data">
             <input type="hidden" name="tmid" value="'.$id.'"/><br />
             <label>Title</label><br /> <input type="text" name="title" maxlength="30"/><br />
             <label>Info</label><br /> <textarea rows="10" cols="50" name="info"
             maxlength="250"></textarea><br />
             <label>Planning</label> <br /><textarea rows="10" cols="50" name="plan" maxlength="500"></textarea><br />
            <br /><br /><br /><br /><br /><br />
            <input type="submit" value="Add" /></p>
            </form>';
        
      }
        
           
       
    }
   else{
      //error can not connect to the database
      $err.='<p>Can not connect to the database.</p>';
   }
       //show the page 
     ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="iso-8859-1">
    <title>Add blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <div id="add-trip-info">
        <?php  echo $content;  ?>
    </div>
</body>

</html>
<?php
   }
   else  { echo '<p>No access</p>'; }
   ?>
