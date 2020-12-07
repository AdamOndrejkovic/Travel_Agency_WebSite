<?php
$file='./head.php';
if(file_exists($file))
{
include($file);	
}
session_start();
//get all the session variables
$_SESSION['aname'];
$_SESSION['afname'];
$_SESSION['mail'];
$_SESSION['phone'];
$_SESSION['birth']; 
$_SESSION['oadult'];
$_SESSION['okid']; 
$_SESSION['tripId'];
$_SESSION['kname'];
$_SESSION['kfname'];
$_SESSION['kbirth'];    
$_SESSION['price'];
$_SESSION['flight'];
$_SESSION['hotel'];
$_SESSION['storno'];
$_SESSION['flightI'];
$_SESSION['insurance'];
//assign needed session variables to variables
$flight = $_SESSION['flight'];
$hotel = $_SESSION['hotel'];
$storno = $_SESSION['storno'];
$flightI = $_SESSION['flightI'];
$insurance = $_SESSION['insurance'];   
$tripId = $_SESSION['tripId'];
//get the statement and
$bet = (int)$_GET['bet'];
$notification=0;
//if bet is 1 to this procces 
if($bet==1)
{
$content='<p>The payment is finished</p>';
//store all the client information into database
//connect to the database    
$username="root";
$password="";
$database="travelers";
mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die("<b>Unable to specified database</b>");
//Insert information Adult
$sql_start = 'INSERT INTO `clients` VALUES '; 
$sql_array = array(); 
$queue_num = $_SESSION['oadult'];
//because is an array we make a loop 
foreach ($_SESSION['aname'] as $row=>$name)
{
$id= '';
$clientname = $name;
$fname = $_SESSION['afname'][$row];
$mail = $_SESSION['mail'][$row];
$phone = $_SESSION['phone'][$row];
$birth = $_SESSION['birth'][$row];
$tripId = $_SESSION['tripId'];
$sql_array[] = '("' .$id. '", "' .$clientname. '", "'.$fname.'", "'.$mail.'", "'.$phone.'", "'.$birth.'", "'.$tripId.'")'; 
if (count($sql_array) >= $queue_num) {
$query_single=$sql_start . implode(', ', $sql_array);
mysql_query($query_single); 
$sql_array = array(); 
}
}
if (count($sql_array) > 0)  {
$query=$sql_start . implode(', ', $sql_array);
mysql_query($query)or die(mysql_error());
}
//Insert information Kid    
$queue_num = $_SESSION['okid']; 
//because is an array we make a loop 
//but the loop will not be executed if the session variable kname is empty
if(!empty($_SESSION['kname'])) {   
foreach ($_SESSION['kname'] as $row=>$name)
{
$id= '';
$clientnamekid = $name;
$fnamekid = $_SESSION['kfname'][$row];
$mailkid =$_SESSION['mail']['1'];
$phonekid =$_SESSION['phone']['1'];
$birth = $_SESSION['kbirth'][$row];
$tripId = $_SESSION['tripId'];
$sql_array[] = '("' .$id. '", "' .$clientnamekid. '", "'.$fnamekid.'", "'.$mailkid.'", "'.$phonekid.'", "'.$birth.'", "'.$tripId.'")'; 
if (count($sql_array) >= $queue_num) {
$query_single=$sql_start . implode(', ', $sql_array);
mysql_query($query_single); 
$sql_array = array(); 
}
}
}
if (count($sql_array) > 0)  {
$query=$sql_start . implode(', ', $sql_array);
mysql_query($query)or die(mysql_error());
}    
//loop to get adult information for the billing order
foreach ($_SESSION['aname'] as $row=>$name)
{
$clientname = $name;
$fname = $_SESSION['afname'][$row];
$adult_array[] = '( "' .$clientname. '", "'.$fname.'")'; 
}
//loop to get kid information for the billing order    
//won't be executed unless the variable kname contains some information
$kid_info = '';
if(!empty($_SESSION['kname'])) { 
foreach ($_SESSION['kname'] as $row=>$name)
{
$clientnamekid = $name;
$fnamekid = $_SESSION['kfname'][$row];
$kid_array[] = '( "' .$clientnamekid. '", "'.$fnamekid.'")'; 
}
$kid_info = implode(', ',$kid_array);
}
//create a billing order based on the passangers information and their selected trip information
$content = '';
if (!$conn) {  
//If not connected 
$content.= "Can not conect with database !!!";
}
else 
{
//If connection succes execute sql
$res = $conn->query("SELECT * FROM tripsmodel, trips WHERE trips.tripId = $tripId AND tripsmodel.id = trips.tmid");
while($row=$res->fetch()) { 
//Get all the records and assign them to variables
$id= htmlentities($row['id']);      
$name = htmlentities($row['name']); 
$newDateB = date("d-m-Y", strtotime($row["dateB"]));
$newDateE = date("d-m-Y", strtotime($row["dateE"]));
//Put those variables into html code set in variable
$content.= '<h2>Billing information</h2>
<h3>Destination: '.$name.'<br>
Period '.$newDateB.' '.$newDateE.'<h3>
<p>Passangers:  <br>
Adults: '.implode(', ',$adult_array).' <br>
Kids: '.$kid_info.'
</p>';
$content.='<table id="pay-overview">';
$content.='<tr><th>Flight</th><td>'.$flight.'</td></tr>'; 
$content.='<tr><th>Hotel</th><td>'.$hotel.'</td></tr>'; 
$content.='<tr><th>Storno</th><td>'.$storno.'</td></tr>';
$content.='<tr><th>Flight Insurance</th><td>'.$flightI.'</td></tr>';
$content.='<tr><th>Insurance</th><td>'.$insurance.'</td></tr>';
$content.='</table>';
//make it possible to print and afterwards send them to the main page
$content.=' 
<button onclick="printBill()">Print</button>
<script>
function printBill() {
window.print();
window.location="index.php";
}
</script>
';
}
}
}
//if the bet equals to zero execute this
else
{
//alert to warn the client that something went wrong
//and also second alert which asks if you want to be redirected to the main page
$notification=$_GET['notification'];
$content='"<script>alert("Something went wrong with the payment '.$notification.'");
if(confirm("Redirect to the main page")) document.location = "index.php";
</script>
';
}
//show all the information
echo '<div id="order-paid">';
echo $content;
echo '</div>';
$file='./foot.php';
if(file_exists($file))
{
include($file);	
}
?>
<?php
$file='./head.php';
if(file_exists($file))
{
include($file);	
}
session_start();
//get all the session variables
$_SESSION['aname'];
$_SESSION['afname'];
$_SESSION['mail'];
$_SESSION['phone'];
$_SESSION['birth']; 
$_SESSION['oadult'];
$_SESSION['okid']; 
$_SESSION['tripId'];
$_SESSION['kname'];
$_SESSION['kfname'];
$_SESSION['kbirth'];    
$_SESSION['price'];
$_SESSION['flight'];
$_SESSION['hotel'];
$_SESSION['storno'];
$_SESSION['flightI'];
$_SESSION['insurance'];
//assign needed session variables to variables
$flight = $_SESSION['flight'];
$hotel = $_SESSION['hotel'];
$storno = $_SESSION['storno'];
$flightI = $_SESSION['flightI'];
$insurance = $_SESSION['insurance'];   
$tripId = $_SESSION['tripId'];
//get the statement and
$bet = (int)$_GET['bet'];
$notification=0;
//if bet is 1 to this procces 
if($bet==1)
{
$content='<p>The payment is finished</p>';
//store all the client information into database
//connect to the database    
$username="root";
$password="";
$database="travelers";
mysql_connect('localhost',$username,$password);
@mysql_select_db($database) or die("<b>Unable to specified database</b>");
//Insert information Adult
$sql_start = 'INSERT INTO `clients` VALUES '; 
$sql_array = array(); 
$queue_num = $_SESSION['oadult'];
//because is an array we make a loop 
foreach ($_SESSION['aname'] as $row=>$name)
{
$id= '';
$clientname = $name;
$fname = $_SESSION['afname'][$row];
$mail = $_SESSION['mail'][$row];
$phone = $_SESSION['phone'][$row];
$birth = $_SESSION['birth'][$row];
$tripId = $_SESSION['tripId'];
$sql_array[] = '("' .$id. '", "' .$clientname. '", "'.$fname.'", "'.$mail.'", "'.$phone.'", "'.$birth.'", "'.$tripId.'")'; 
if (count($sql_array) >= $queue_num) {
$query_single=$sql_start . implode(', ', $sql_array);
mysql_query($query_single); 
$sql_array = array(); 
}
}
if (count($sql_array) > 0)  {
$query=$sql_start . implode(', ', $sql_array);
mysql_query($query)or die(mysql_error());
}
//Insert information Kid    
$queue_num = $_SESSION['okid']; 
//because is an array we make a loop 
//but the loop will not be executed if the session variable kname is empty
if(!empty($_SESSION['kname'])) {   
foreach ($_SESSION['kname'] as $row=>$name)
{
$id= '';
$clientnamekid = $name;
$fnamekid = $_SESSION['kfname'][$row];
$mailkid =$_SESSION['mail']['1'];
$phonekid =$_SESSION['phone']['1'];
$birth = $_SESSION['kbirth'][$row];
$tripId = $_SESSION['tripId'];
$sql_array[] = '("' .$id. '", "' .$clientnamekid. '", "'.$fnamekid.'", "'.$mailkid.'", "'.$phonekid.'", "'.$birth.'", "'.$tripId.'")'; 
if (count($sql_array) >= $queue_num) {
$query_single=$sql_start . implode(', ', $sql_array);
mysql_query($query_single); 
$sql_array = array(); 
}
}
}
if (count($sql_array) > 0)  {
$query=$sql_start . implode(', ', $sql_array);
mysql_query($query)or die(mysql_error());
}    
//loop to get adult information for the billing order
foreach ($_SESSION['aname'] as $row=>$name)
{
$clientname = $name;
$fname = $_SESSION['afname'][$row];
$adult_array[] = '( "' .$clientname. '", "'.$fname.'")'; 
}
//loop to get kid information for the billing order    
//won't be executed unless the variable kname contains some information
$kid_info = '';
if(!empty($_SESSION['kname'])) { 
foreach ($_SESSION['kname'] as $row=>$name)
{
$clientnamekid = $name;
$fnamekid = $_SESSION['kfname'][$row];
$kid_array[] = '( "' .$clientnamekid. '", "'.$fnamekid.'")'; 
}
$kid_info = implode(', ',$kid_array);
}
//create a billing order based on the passangers information and their selected trip information
$content = '';
if (!$conn) {  
//If not connected 
$content.= "Can not conect with database !!!";
}
else 
{
//If connection succes execute sql
$res = $conn->query("SELECT * FROM tripsmodel, trips WHERE trips.tripId = $tripId AND tripsmodel.id = trips.tmid");
while($row=$res->fetch()) { 
//Get all the records and assign them to variables
$id= htmlentities($row['id']);      
$name = htmlentities($row['name']); 
$newDateB = date("d-m-Y", strtotime($row["dateB"]));
$newDateE = date("d-m-Y", strtotime($row["dateE"]));
//Put those variables into html code set in variable
$content.= '<h2>Billing information</h2>
<h3>Destination: '.$name.'<br>
Period '.$newDateB.' '.$newDateE.'<h3>
<p>Passangers:  <br>
Adults: '.implode(', ',$adult_array).' <br>
Kids: '.$kid_info.'
</p>';
$content.='<table id="pay-overview">';
$content.='<tr><th>Flight</th><td>'.$flight.'</td></tr>'; 
$content.='<tr><th>Hotel</th><td>'.$hotel.'</td></tr>'; 
$content.='<tr><th>Storno</th><td>'.$storno.'</td></tr>';
$content.='<tr><th>Flight Insurance</th><td>'.$flightI.'</td></tr>';
$content.='<tr><th>Insurance</th><td>'.$insurance.'</td></tr>';
$content.='</table>';
//make it possible to print and afterwards send them to the main page
$content.=' 
<button onclick="printBill()">Print</button>
<script>
function printBill() {
window.print();
window.location="index.php";
}
</script>
';
}
}
}
//if the bet equals to zero execute this
else
{
//alert to warn the client that something went wrong
//and also second alert which asks if you want to be redirected to the main page
$notification=$_GET['notification'];
$content='"<script>alert("Something went wrong with the payment '.$notification.'");
if(confirm("Redirect to the main page")) document.location = "index.php";
</script>
';
}
//show all the information
echo '<div id="order-paid">';
echo $content;
echo '</div>';
$file='./foot.php';
if(file_exists($file))
{
include($file);	
}
?>
