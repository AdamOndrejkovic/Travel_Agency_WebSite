<?php
//start session for the order
session_start();
$content = '';
$file="./head.php";
if (file_exists($file)) { include($file); }
?>
<section id="passengers-sec">
    <?php 
//put the neccesary information into session variables
$oadult=$_POST['adults'];
$okid=$_POST['kids'];
$oflight=$_POST['flight'];    
$ohotel=$_POST['hotel'];
$ostorno=$_POST['storno'];
$oflightI=$_POST['flight-insurance'];
$oinsurance=$_POST['insurance'];
$_SESSION['oadult']=$oadult;
$_SESSION['okid']=$okid;   
$_SESSION['oflight']=$oflight;
$_SESSION['ohotel']=$ohotel;
$_SESSION['ostorno']=$ostorno;
$_SESSION['oflightI']=$oflightI;
$_SESSION['oinsurance']=$oinsurance;    
$id=$_POST['id'];
$price=$_POST['sum'];    
//create a loop form for the passangers separated for adults and children
$content .= '<h1>Passengers information</h1>';
$content .= '<form id="form" action="pay-method.php" method="post" >';
$content .= $price;
$content .= '<input type="hidden" name="price" value="'.$price.'"/>';
$content .= '<input type="hidden" name="tripId" value="'.$id.'"/>';
$content .= '<h3>Adults Information</h3>';
$content .= '<table>';
$content .= '<tr><th></th><th>Name</th><th>Family Name</th><th>Date of birth</th><th>E-mail</th><th>Phone Number</th></tr>';
for ($x = 1; $x <= $oadult; $x++) {
$content .='<tr><td><input type="hidden" name="tmid['.$x.']" value="'.$id.'"/><input type="hidden" name="aid['.$x.']"/></td><td><input type="text" name="aname['.$x.']" required/></td>
<td><input type="text" name="afname['.$x.']" required/></td>
<td><input type="date" name="birth['.$x.']" required/></td>
<td><input type="text" name="mail['.$x.']" required/></td>
<td><input type="text" name="phone['.$x.']" required/></td>';
}
$content .= '</table>';   
$content .= '<h3>Kids Information</h3>'; 
$content .= '<table>'; 
$content .= '<tr><th></th><th>Name</th><th>Family Name</th><th>Date of birth</th>';    
for ($x = 1; $x <= $okid; $x++) {
$content .= '<tr><td><input type="hidden" name="tmid['.$x.']" value="'.$id.'"/></td><td><input type="text" name="kname['.$x.']" required/></td>
<td><input type="text" name="kfname['.$x.']" required/></td>
<td><input type="date" name="kbirth['.$x.']" required/></td></tr>';
}
$content .= '</table>';
$content .= '<br><br><input type="submit" value="Got to pay method" />';
$content .= '</form>';
echo $content;
?>
</section>
<?php
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
