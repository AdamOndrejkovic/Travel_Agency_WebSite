<?php
   session_start();
     if (!isset($_SESSION['adminid']))
     {
       //not logged in or timeout
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
         	//process the form
           if($_POST['dateB'] && $_POST['dateE'] && $_POST['places'] && $_POST['time'] && $_POST['adult'] && $_POST['kid'] && $_POST['flightS'] && $_POST['flightB'] && $_POST['hotel3'] && $_POST['hotel4'] && $_POST['hotel5'] && $_POST['storno'] && $_POST['flightI'] && $_POST['insurance'] && $_POST['insuranceP'] && $_POST['administrationC']) 
           {
             //assign data to the variables
             $dateB = stripslashes($_POST['dateB']);
             $dateB = htmlspecialchars($dateB); 
             $time = stripslashes($_POST['time']);
             $time = htmlspecialchars($time);
             $dateE = stripslashes($_POST['dateE']);
             $dateE = htmlspecialchars($dateE);
             $dateE = date('Y-m-d', strtotime($dateB . " + " . $time . " day"));
             $places = stripslashes($_POST['places']);
             $places = htmlspecialchars($places);
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
               
               
             try {
                 //update the database tabel trips
               $res = $conn->prepare("UPDATE trips SET dateB = ?, dateE = ?, places = ?, adult = ?, kid = ?, flightS = ?, flightB = ?, hotel3 = ?, hotel4 = ?, hotel5= ?, storno = ?, flightI = ?, insurance = ?, insuranceP = ?, administrationC = ?   WHERE tripId = ?");
               $res->execute(array($dateB, $dateE, $places,$adult, $kid, $flightS, $flightB, $hotel3, $hotel4, $hotel5, $storno, $flightI, $insurance, $insuranceP, $administration, $id)); 
                 //if all ok redirect
               header("Location:show-tripsp.php?id=".$id);
             }
             catch(Exception $e ) { 
               //error message
               $content='<p>Something went wrong. Changes were not saved.</p>';
             }  
           }
           else 
           { //not all fields filled in
             $content ='<p>You need to fill in all fields.</p>';
           }
         }
         else
         {
         	//get the data
           $sql="SELECT * FROM trips, tripsmodel WHERE trips.tmid = tripsmodel.id  AND trips.tripId = $id";
           $res = $conn->query($sql);
           $amount = $res->rowCount();
           if($amount==0)
           {
             //error message
             $content = '<p>No records were found</p>'; 
           }
           else
           {
             //assign data to variables
             $row = $res->fetch();
             $name = htmlspecialchars($row['name']); 
             $type = htmlspecialchars($row['type']);
             $time = htmlspecialchars($row['time']);
             $dateB = $row['dateB'];
             $dateE = $row['dateE'];
             $places = $row['places'];
             $adult = htmlentities($row['adult']);
             $kid = htmlentities($row['kid']);
             $flightS = htmlentities($row['flightS']);
             $flightB = htmlentities($row['flightB']);
             $hotel3 = htmlentities($row['hotel3']);
             $hotel4 = htmlentities($row['hotel4']);
             $hotel5 = htmlentities($row['hotel5']);
             $storno = htmlentities($row['storno']);
             $flightI = htmlentities($row['flightI']);
             $insurance = htmlentities($row['insurance']);
             $insuranceP = htmlentities($row['insuranceP']);
             $administration = htmlentities($row['administrationC']);
   
               //create the form
             $content='<h3>'.$name.' '.$type.'</h3>
             <form method="post">
             <p>
             <label>Date Begin:</label> <input type="date" name="dateB"  value="'.$dateB.'"><br>
            <input type="hidden" name="dateE" value="'.$dateE.'"><input type="hidden" name="time" value="'.$time.'">
             <label>Places:</label> <input type="text" name="places"
             value="'.$places.'" maxlenght="3"><br>
              <label>Adult:</label> <input type="text" name="adult" value="'.$adult.'" maxlength="6"><br>
             <label>Kid:</label> <input type="text" name="kid" value="'.$kid.'" maxlength="6"><br>
             <label>Flight Standard:</label> <input type="text" name="flightS" value="'.$flightS.'" maxlength="6"><br>
             <label>Flight Bussines:</label> <input type="text" name="flightB" value="'.$flightB.'" maxlength="6"><br>
             <label>Hotel 3*:</label> <input type="text" name="hotel3" value="'.$hotel3.'" maxlength="6"><br>
             <label>Hotel 4*:</label> <input type="text" name="hotel4" value="'.$hotel4.'" maxlength="6"><br>
             <label>Hotel 5*:</label> <input type="text" name="hotel5" value="'.$hotel5.'" maxlength="6"><br>
             <label>Storno:</label> <input type="text" name="storno" value="'.$storno.'" maxlength="6"><br>
             <label>Flight insurance:</label> <input type="text" name="flightI" value="'.$flightI.'" maxlength="6"><br>
             <label>Insurance:</label> <input type="text" name="insurance" value="'.$insurance.'" maxlength="6"><br>
             <label>Insurance premium:</label> <input type="text" name="insuranceP" value="'.$insuranceP.'" maxlength="6"><br>
             <label>Administration cost:</label> <input type="text" name="administrationC" value="'.$administration.'" maxlength="6"><br>
             <br><br>
             <input type="submit" value="Update"></p>
             </form>';
               
           }
         }
       }
       else 
       {
         $content='<p>Can not connect to the database !!!</p>'; 
       }
     }
     //show the page
   ?>
<!DOCTYPE html>
<html>

<head>
    <title>Nieuwsberichten</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="update-trip-plan">
        <h2>Update scheduled trip</h2>
        <a href="trips-overview.php">Back</a>
        <?php echo $content; ?>
    </div>
</body>

</html>
