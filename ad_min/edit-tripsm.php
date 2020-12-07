<?php
   session_start();
     if (!isset($_SESSION['adminid']))
     {
       //not logged in or timeout
       $content ='Access denied';
     }
     else  
     { //get the parameter
       $id = (int)$_GET['id'];
       
       // connect to the database
       $conn=false;
       $file='../connection.php';
       if(file_exists($file)) { include($file); }
       if ($conn) 
       {  
         if($_SERVER['REQUEST_METHOD']=='POST')
         {
         	//process the form
           if($_POST['name'] && $_POST['type'] && $_POST['time'] && $_POST['adult'] && $_POST['kid'] && $_POST['flightS'] && $_POST['flightB'] && $_POST['hotel3'] && $_POST['hotel4'] && $_POST['hotel5'] && $_POST['storno'] && $_POST['flightI'] && $_POST['insurance'] && $_POST['insuranceP'] && $_POST['administrationC']) 
           {
             //process all the data and put them in variables
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
                 //update all fields in tabel tripsmodel
               $res = $conn->prepare("UPDATE tripsmodel SET name = ?, type = ?, time = ?, bprice = ? WHERE id = ?");
               $res->execute(array($name, $type, $time,$bprice, $id)); 
                
                 //update the tabel pricemodel
                 $res1 = $conn->prepare("UPDATE pricemodel SET adult = ?, kid = ?, flightS = ?, flightB = ?, hotel3 = ?, hotel4 = ?, hotel5 = ?, storno = ?, flightI = ?, insurance = ?, insuranceP = ? , administrationC = ? WHERE tmid = ? ");
                 
                 $res1->execute(array($adult, $kid, $flightS, $flightB, $hotel3, $hotel4, $hotel5, $storno, $flightI, $insurance, $insuranceP, $administration, $id));
                 
                 //redirect
               header("Location:trips-overview.php");
             }
             catch(Exception $e ) { 
               //error message
               $content='<p>Something went wrong your changes were not saved.</p>';
             }  
           }
           else 
           { // fields empty  
            $content = '<p>You need to fill all the fields in !!1</p>';
           }
         }
         else // opened from url
         {
         	// get the fields from the form
           $sql="SELECT * FROM tripsmodel, pricemodel WHERE pricemodel.tmid = tripsmodel.id AND tripsmodel.id = $id ";
           $res = $conn->query($sql);
           $aantal = $res->rowCount();
           if($aantal==0)
           {
             //error message
             $content = '<p>No trip was found !!!</p>'; 
           }
           else
           {
          
             $row = $res->fetch();
             //assign the records to the variables
             $name = htmlspecialchars($row['name']); 
             $type = htmlspecialchars($row['type']);
             $time = htmlspecialchars($row['time']);
             $bprice = htmlspecialchars($row['bprice']);
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
             //show the form
             $content='
             <form method="post">
               <h3>Edit '.$name.' '.$type.'</h3>
             <label>Name:</label> <input type="text" name="name" size="50" value="'.$name.'"><br>
              <label>Type:</label>
              <select id="type" name="type" >
                   <option value="'.$type.'" selected>Last: '.$type.'</option>
                   <option value="Family">Family</option>
                   <option value="Comfort">Comfort</option>
                   <option value="Eco Tourism">Eco Tourism</option>
                   <option value="Deluxe">Deluxe</option>
                   </select>
                   <br> 
              <label>Time:</label> <input type="text" name="time"  value="'.$time.'" maxlength="2"><br>
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
             <input type="submit" value="Add">
             </form>';
           }
         }
       }
       else 
       {
         $content='<p>Can not connect to the database !!!</p>'; 
       }
     }
   ?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit the trip</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="edit-trips-model">
        <a href="trips-overview.php">Back</a>
        <?php echo $content; ?>
    </div>
</body>

</html>
