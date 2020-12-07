<?php
 
 session_start();
 $err='';
$content='';
 if (isset($_SESSION['adminid'])) {
   if ($_SERVER['REQUEST_METHOD']=='POST') { 
       // procces the form (all the posted fields)
     if($_POST['name'] && $_POST['type'] && $_POST['time'] && $_POST['adult'] && $_POST['kid'] && $_POST['flightS'] && $_POST['flightB'] && $_POST['hotel3'] && $_POST['hotel4'] && $_POST['hotel5'] && $_POST['storno'] && $_POST['flightI'] && $_POST['insurance'] && $_POST['insuranceP'] && $_POST['administrationC']) { 
       //post photo
       $uploadname = $_FILES['userfile']['name']; 
       if ($uploadname!='') { 
           //check if the photo jpeg is
         if (($_FILES["userfile"]["type"] == "image/pjpeg") 
           || ($_FILES["userfile"]["type"] == "image/jpeg")) { 
             //connection with the database
           $conn=false;
           $file='../connection.php';
           if(file_exists($file)) { include($file); }
           if ($conn) { 
               //procces the data
       	     $name = stripslashes($_POST['name']);
             $name = htmlspecialchars($name); 
             $type = stripslashes($_POST['type']);
             $type = htmlspecialchars($type);
             $time = stripslashes($_POST['time']);
             $time = htmlspecialchars($time);
               
             $adult = stripslashes($_POST['adult']);
             $adult = htmlspecialchars($adult);
             $kid = stripslashes($_POST['kid']);
             $kid = htmlspecialchars($kid);
             $flightS = stripslashes($_POST['flightS']);
             $flightS = htmlspecialchars($flightS);
             $flightB = stripslashes($_POST['flightB']);
             $flightB = htmlspecialchars($flightB);
             $hotel3 = stripslashes($_POST['hotel3']);
             $hotel3 = htmlspecialchars($hotel3);
             $hotel4 = stripslashes($_POST['hotel4']);
             $hotel4 = htmlspecialchars($hotel4);
             $hotel5 = stripslashes($_POST['hotel5']);
             $hotel5 = htmlspecialchars($hotel5);
             $storno = stripslashes($_POST['storno']);
             $storno = htmlspecialchars($storno);
             $flightI = stripslashes($_POST['flightI']);
             $flightI = htmlspecialchars($flightI);
             $insurance = stripslashes($_POST['insurance']);
             $insurance = htmlspecialchars($insurance);
             $insuranceP = stripslashes($_POST['insuranceP']);
             $insuranceP = htmlspecialchars($insuranceP);
             $administration = stripslashes($_POST['administrationC']);
             $administration = htmlspecialchars($administration); 
               
               //calculate the begin price
               $bprice = $adult + $flightS + ($hotel3 * $time) + $insurance + $administration;
               
             try {
                 //insert data into the tripsmodel
               $res = $conn->prepare("INSERT INTO tripsmodel ( name, type, time, bprice)
                                      VALUES ( ?, ?, ?, ?)");
               $res->execute(array($name, $type, $time, $bprice));
                 
                 //get the last inserte Id
                 $last_id = $conn->lastInsertId(); 
                 $tmid = $last_id;
                 
                 //insert into price model with the id of the trip from tripsmodel
                 $res1 = $conn->prepare("INSERT INTO pricemodel ( tmid, adult, kid, flightS, flightB, hotel3, hotel4, hotel5, storno, flightI, insurance, insuranceP , administrationC )
                 VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
               $res1->execute(array($tmid ,$adult, $kid, $flightS, $flightB, $hotel3, $hotel4, $hotel5, $storno, $flightI, $insurance, $insuranceP, $administration));
               
                 //save the photo based on the id
               $uploadname=$name.'.JPG';
               if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {   
                 move_uploaded_file($_FILES['userfile']['tmp_name'], "../img/trip-card/$uploadname");  
                 $err="OK";
                   //redirect back to the trips overview
                 header("Location:trips-overview.php");
               }
               else { // photo not saved
                 $err.='Upload of the foto went wrong !!!</p>';
               }
             }
             catch(Exception $e ) {  // error
               $err.='<p>Something went wrong with storing the data into database</p>';
            
             } 
           }
           else {
             $err.='<p>Can not connect to the database</p>'; 
           }
         } 
         else { // error photo file type
           $err='<p>This file is not supported (only jpeg)!</p>';
         }
       }
     }
     else { // error not all fields filled in 
       $err ='<p>You need to fill all the fields in !!!</p>';
     }
   }
   else  { 
   }
     //the form
   $content.= $err.'<div id="atrip-form"><a href="trips-overview.php">Back</a>
         <h2>Add new trip</h2>
   <form method="post" enctype="multipart/form-data">
          <label>Trip Name:</label> <input type="text" name="name"  /><br />
          <label>Foto:</label> <input type="file" name="userfile"  /><br />
          <label>Type:</label>   <select id="type" name="type">
                <option value="Family">Family</option>
                <option value="Comfort">Comfort</option>
                <option value="Eco Tourism">Eco Tourism</option>
                <option value="Deluxe">Deluxe</option>
              </select><br />
          <label>Time:</label> <input type="text" name="time"  maxlength="2" /><br/>
           <label>Adult:</label> <input type="text" name="adult" maxlength="6"><br>
          <label>Kid:</label> <input type="text" name="kid" maxlength="6"><br>
          <label>Flight Standard:</label> <input type="text" name="flightS" maxlength="6"><br>
          <label>Flight Bussines:</label> <input type="text" name="flightB" maxlength="6"><br>
          <label>Hotel 3*:</label> <input type="text" name="hotel3" maxlength="6"><br>
          <label>Hotel 4*:</label> <input type="text" name="hotel4" maxlength="6"><br>
          <label>Hotel 5*:</label> <input type="text" name="hotel5" maxlength="6"><br>
          <label>Storno:</label> <input type="text" name="storno" maxlength="6"><br>
          <label>Flight insurance:</label> <input type="text" name="flightI" maxlength="6"><br>
          <label>Insurance:</label> <input type="text" name="insurance" maxlength="6"><br>
          <label>Insurance premium:</label> <input type="text" name="insuranceP" maxlength="6"><br>
          <label>Administration cost:</label> <input type="text" name="administrationC" maxlength="6"><br>
         <input type="submit" value="Add" />
          </form></div>';
    
   ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="iso-8859-1">
    <title>Add blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <!-- Show the page --->
    <div id="add-trip">
        <?php  echo $content;  ?>
    </div>
</body>

</html>
<?php
 }
 else  { 
     //timeout or not logged in
     echo '<p>Access denied</p>'; 
 }
?>
