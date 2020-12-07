<?php
session_start();
 $content = '';

$id=$_POST['tripId'];
$price=$_POST['price'];

 




//if there are no children make sure that it won't crash so set their variables to empty
$kname = $_POST['kname'] = isset($_POST['kname']) ? $_POST['kname'] : '';
$kfname = $_POST['kfname'] = isset($_POST['kfname']) ? $_POST['kfname'] : '';
$kbirth = $_POST['kbirth'] = isset($_POST['kbirth']) ? $_POST['kbirth'] : '';

//all the needed session variables
$_SESSION['tripId']=$_POST['tripId'];


$_SESSION['aname']=$_POST['aname'];
$_SESSION['afname']=$_POST['afname'];
$_SESSION['birth']=$_POST['birth'];
$_SESSION['mail']=$_POST['mail'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['kname']=$kname;
$_SESSION['kfname']=$kfname;
$_SESSION['kbirth']=$kbirth;
$_SESSION['price']=$price;

$_SESSION['oadult'];
$_SESSION['okid'];
$_SESSION['oflight'];
$_SESSION['ohotel'];
$_SESSION['ostorno'];
$_SESSION['oflightI'];
$_SESSION['oinsurance'];

$file="./head.php";
if (file_exists($file)) { include($file); }

?>
<section id="paym-sec">
    <?php       
if ($conn)
  {  
    $res = $conn->query('SELECT * FROM trips, tripsmodel WHERE tripId ='.$id.' AND tripsmodel.id = trips.tmid');

    while($row=$res->fetch())
     {
        //take all the needed records and put them in variables
          $name = htmlentities($row['name']);
          $days = htmlentities($row['time']);
          $adult = htmlentities($row['adult']);
          $kid = htmlentities($row['kid']);
          $flightS = htmlentities($row['flightS']);
          $hotel3 = htmlentities($row['hotel3']);
          $hotel4 = htmlentities($row['hotel4']);
          $hotel5 = htmlentities($row['hotel5']);
          $storno = htmlentities($row['storno']);
          $flightI = htmlentities($row['flightI']);
          $insurance = htmlentities($row['insurance']);
          $insuranceP = htmlentities($row['insuranceP']);
          $administrationC = htmlentities($row['administrationC']);
    }
}

    //change number variables into String based on their values
    //and after that put them into session variables
     if($flightS == $_SESSION['oflight']){
            $flight='Standard';
        }
        else{
            $flight='Bussines';
        }
    
    $_SESSION['flight']= $flight;
    
    if ($hotel3 == $_SESSION['ohotel']) {
        $hotel='3 stars';
        } elseif ($hotel4 == $_SESSION['ohotel']) {
            $hotel='4 stars';
            } else {
            $hotel='5 stars';
        }
    
    $_SESSION['hotel']= $hotel;
    
     if($storno == $_SESSION['ostorno']){
            $storno='Yes';
        }
        else{
            $storno='No';
        }
    
    $_SESSION['storno']= $storno;
    
     if($flightI == $_SESSION['oflightI']){
            $flightI='Yes';
        }
        else{
            $flightI='No';
        }
    
    $_SESSION['flightI']= $flightI;
    
     if($insurance == $_SESSION['oinsurance']){
            $insurance='Standard';
        }
        else{
            $insurance='Premium';
        }
   
    $_SESSION['insurance']= $insurance;
        

  //fit all the variables into the variable for html code
    //part for the review
    $content.='<h1>Finish your order</h1>';
    $content.='<h3>Review your order</h3>';
    $content.='<table id="pay-overview">';
    $content.='<tr><th>Adults</th><td>'.$_SESSION['oadult'].'</td></tr>'; $content.='<tr><th>Kids</th><td>'.$_SESSION['okid'].'</td></tr>'; 
    $content.='<tr><th>Flight</th><td>'.$flight.'</td></tr>'; 
    $content.='<tr><th>Hotel</th><td>'.$hotel.'</td></tr>'; 
    $content.='<tr><th>Storno</th><td>'.$storno.'</td></tr>';
    $content.='<tr><th>Flight Insurance</th><td>'.$flightI.'</td></tr>';
    $content.='<tr><th>Insurance</th><td>'.$insurance.'</td></tr>';
    $content.='</table>';
    
    //part with the payment methods
    $content.='<table id="payment">';
    $content.='<tr><td>
    <form action="bancontact.php" method="post"><span>
    <input type="image" src="img/pay/kbc.png" height="100" alt="PayPal" 
                                       title="Direct payment with Bancontact"><input type="text" value="Bancontact" readonly></span>
                                       
    <input type="hidden" name="accountid" value="1">
    <input type="hidden" name="price" value="'.$price.'">
    <input type="submit" id="paym-btn" value="Pay with KBC bank" /> 
          </form></td></tr>';
    
    $content.='<tr><td>
    <form action="creditcard.php" method="post">
    <span><input type="image" src="img/pay/credit.png" height="100" alt="PayPal" 
                                       title="Direct payment with CreditCard"><input type="text" value="CreditCard" readonly></span>
    <input type="hidden" name="accountid" value="1">
    <input type="hidden" name="price" value="'.$price.'">
    <input type="submit" id="paym-btn" value="Pay with credit card" /> 
          </form></td></tr>';
    
    
    $content.='<tr><td>
    <form action="http://127.0.0.1:8888/paypalTravelers/payshop.php" method="post">
    <input type="hidden" name="url" value="http://127.0.0.1:8888/Travelers/order-paid.php">
    <input type="hidden" name="accountid" value="1"><span>
    <input type="image" src="img/pay/PayPal.png" height="100" alt="PayPal" 
                                       title="Direct payment with PayPal"><input type="text" value="PayPal" readonly></span>
                                       
    <input type="hidden" name="accountid" value="1">
    <input type="hidden" name="price" value="'.$price.'">
    <input type="submit" id="paym-btn" value="Pay with PayPal" /> 
          </form></td></tr>';
    
    $content.='<tr><td>
    <form action="transfer.php" method="post">
    <span><input type="image" src="img/pay/transfer.png" height="100" alt="PayPal" 
                                       title="Transfer money"><input type="text" value="Transfer" readonly></span>
    <input type="hidden" name="accountid" value="1">
    <input type="hidden" name="price" value="'.$price.'">
    <input type="submit" id="paym-btn"value="Pay with transfer" /> 
          </form></td></tr>';
    $content.='</table>';
    
    //show all the content
echo $content;
?>
</section>

<?php
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
