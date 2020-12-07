<?php
$file="./head.php";
if (file_exists($file)) { include($file); }
//set all the variables
$formulier=true;
$err = $nameErr = $fnameErr = $emailErr = $birthErr = '';
$name = $fname = $email = $birth = '';
$sqlErr='';
$active='1';
$content='';
if($_SERVER['REQUEST_METHOD']=='POST') 
{
if (!$conn) 
{
//problem with connection
$content .= "<script>alert('Could not connect with our database. Try again later');</script>";
$formulier = false;
} 
else
{
function test_input($data) 
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
//check all posted fields
if(empty($_POST['name'])) 
{
$nameErr = 'required'; 
}
else 
{ 
$name = test_input($_POST['name']); 
}
if(empty($_POST['fname'])) 
{
$fnameErr = 'required';
}
else 
{
$fname = test_input($_POST['fname']); 
}
if(empty($_POST['email'])) 
{
$emailErr = 'required';
}
else 
{
$email = test_input($_POST['email']);
}
if(empty($_POST['birth'])) 
{
$birthErr = 'required';
}
else 
{
$birth = test_input($_POST['birth']);
}
try
{
//select all fields and check if the email is not used
$sql='SELECT * FROM newsletter WHERE email = ?';
$res = $conn->prepare($sql);
$res->execute(array($email));
$aantal = $res->rowCount(); 
if($aantal>0)
{
//if email already used
$emailErr ="<script>alert('E-mail is already being used.');</script>";
$content.= $emailErr; 	
}
} 
//if something went wrong
catch(Exception $e)
{
$sqlErr='<p>Something went wrong. Try again later.</p>';
$content. = $sqlErr ;
$formulier = false;
}  
//check if not empty
$err=$nameErr.$fnameErr.$emailErr.$birthErr.$sqlErr;
if ($err=='') 
{  
$formulier = false;
try 
{
//insert into database
$sql='INSERT INTO newsletter (name, familyName, email, birthday, active, date) VALUES (?, ?, ?, ?, ?, NOW())';
$res = $conn->prepare($sql);
$res->execute(array($name, $fname, $email, $birth, $active)); 
$content.="<script>alert('Thanks for subscribing our newsletter.');</script>";
//send email if possible
// $to_email = ''.$email.'';
// $subject = 'Testing PHP Mail';
//$message = 'This mail is sent using the PHP mail function';
//$headers = 'From: noreply@company.com';
// mail($to_email,$subject,$message,$headers);
}
catch (Exception $e) 
{
$$sqlErr.="<script>alert('There was a problem with the data transfer. Try again later.');</script>"; 
$content.= $sqlErr; 		
} 
} 
} 
}
else
{
} 
//form to subscribe
$content.='
<form method="post" id="form" action="" onsubmit="return checkformm(this)">
<h1 id="ask-title">Subscribe our newsletter</h1>
<h2>Name</h2>
<input type="text" id="name" name="name" required>
<h2>Family name</h2>
<input type="text" id="fname" name="fname" required>
<h2>E-mail</h2>
<input type="text" id="email" name="email" required>
<h2>Birthday</h2>
<input type="type" id="birth" name="birth" required>
<br>
<input type="submit" value="Send" id="newsletter-btn">
</form>';
//show page
echo '<div class="newsletter-box">';
echo $content;
echo '</div>';
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
