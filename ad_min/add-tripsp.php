<?php
   session_start();
   $err='';
   if (isset($_SESSION['adminid'])) {
       //get the specific trip by id
        $id = (int)$_GET['id'];
     $content='<a href="show-tripsp.php?id='.$id.'">Back</a>
           <h2>Plan a trip</h2>';
       
       //process the form
     if ($_SERVER['REQUEST_METHOD']=='POST') { 
       if($_POST['tmid'] && $_POST['dateB'] && $_POST['dateE'] && $_POST['places'] && $_POST['time'] && $_POST['adult'] && $_POST['kid'] && $_POST['flightS'] && $_POST['flightB'] && $_POST['hotel3'] && $_POST['hotel4'] && $_POST['hotel5'] && $_POST['storno'] && $_POST['flightI'] && $_POST['insurance'] && $_POST['insuranceP'] && $_POST['administrationC']) { 
           //connect to the database
             $conn=false;
             $file='../connection.php';
             if(file_exists($file)) { include($file); }
             if ($conn) {
              //process data and assign them to variables   
            $tmid = stripslashes($_POST['tmid']);
            $tmid = htmlspecialchars($tmid);
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
                   //insert into table trips with the specific tripsmodel id
                 $res = $conn->prepare("INSERT INTO trips ( tmid, dateB, dateE, places , adult, kid, flightS, flightB, hotel3, hotel4, hotel5, storno, flightI, insurance, insuranceP , administrationC )
                   VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                 $res->execute(array($tmid, $dateB, $dateE, $places ,$adult, $kid, $flightS, $flightB, $hotel3, $hotel4, $hotel5, $storno, $flightI, $insurance, $insuranceP, $administration));
                   $err="OK";
                   //if ok redirect
                   header("Location:show-tripsp.php?id=".$id);
                
               }
               catch(Exception $e ) {  
                   //error message
                 $err.='<p>Something went wrong with storing data.</p>';
               } 
             }
             else {
               $err.='<p>Can not connect to the database.</p>'; 
             } 
      
       }
       else { 
           //some fields left empty 
         $err ='<p>You need to fill all the fields.</p>';
       }
     }
     else  {  
     }
   
   //show the form
   $conn=false;
    $file='../connection.php';
    if(file_exists($file)) { include($file); }
    if ($conn)
    {  
      //sql command
      $res = $conn->query('SELECT * FROM tripsmodel, pricemodel WHERE pricemodel.tmid = tripsmodel.id AND tripsmodel.id='.$id);
       
      $row=$res->fetch();
   
     	  //get the data from the database
        $id = $row['id'];
        $name = htmlentities($row['name']);
        $type = htmlentities($row['type']);
        $days = htmlentities($row['time']);
        $madult = htmlentities($row['adult']);
        $mkid = htmlentities($row['kid']);
        $mflightS = htmlentities($row['flightS']);
        $mflightB = htmlentities($row['flightB']);
        $mhotel3 = htmlentities($row['hotel3']);
        $mhotel4 = htmlentities($row['hotel4']);
        $mhotel5 = htmlentities($row['hotel5']);
        $mstorno = htmlentities($row['storno']);
        $mflightI = htmlentities($row['flightI']);
        $minsurance = htmlentities($row['insurance']);
        $minsuranceP = htmlentities($row['insuranceP']);
        $madministrationC = htmlentities($row['administrationC']);
            
        //form content
          $content.= $err.'<h3>'.$name.' '.$type.'</h3>
            <form method="post">
            <p>
            <input type="hidden" name="tmid" value="'.$id.'"><br>
            <label>Date Begin:</label> <input type="date" name="dateB"><br>
           <input type="hidden" name="dateE" value="2018-07-22"><input type="hidden" name="time" value="'.$days.'">
            <label>Places:</label> <input type="text" name="places"
             maxlenght="3"><br>
             <label>Adult:</label> <input type="text" name="adult" value="'.$madult.'" maxlength="6"><br>
             <label>Kid:</label> <input type="text" name="kid" value="'.$mkid.'" maxlength="6"><br>
             <label>Flight Standard:</label> <input type="text" name="flightS" value="'.$mflightS.'" maxlength="6"><br>
             <label>Flight Bussines:</label> <input type="text" name="flightB" value="'.$mflightB.'" maxlength="6"><br>
             <label>Hotel 3*:</label> <input type="text" name="hotel3" value="'.$mhotel3.'" maxlength="6"><br>
             <label>Hotel 4*:</label> <input type="text" name="hotel4" value="'.$mhotel4.'" maxlength="6"><br>
             <label>Hotel 5*:</label> <input type="text" name="hotel5" value="'.$mhotel5.'" maxlength="6"><br>
             <label>Storno:</label> <input type="text" name="storno" value="'.$mstorno.'" maxlength="6"><br>
             <label>Flight insurance:</label> <input type="text" name="flightI" value="'.$mflightI.'" maxlength="6"><br>
             <label>Insurance:</label> <input type="text" name="insurance" value="'.$minsurance.'" maxlength="6"><br>
             <label>Insurance premium:</label> <input type="text" name="insuranceP" value="'.$minsuranceP.'" maxlength="6"><br>
             <label>Administration cost:</label> <input type="text" name="administrationC" value="'.$madministrationC.'" maxlength="6"><br>
             <br><br>
            <input type="submit" value="Add"></p>
            </form>';
        
      
        
           
         
    }
   else{
      $err.='<p>Can not connect to the database</p>';
   }
     ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="iso-8859-1">
    <title>Add blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <div id="add-trip-plan">
        <?php  echo $content;  ?>
    </div>
</body>

</html>
<?php
   }
   else  { echo '<p>No access</p>'; }
   ?>
