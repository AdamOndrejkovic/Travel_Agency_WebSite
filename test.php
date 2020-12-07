<?php
$formulier=true;
$err = $nameErr = $fnameErr = $emailErr = $infoErr = '';
$name = $fname = $email = $info = '';
$sqlErr='';
 $inhoud=' 
     ';
if($_SERVER['REQUEST_METHOD']=='POST') 
{
  // geopend uit formulier - verwerk formulier
  // maak connectie met de database
  $conn=false;
  $bestand='./connectie.php';
  if(file_exists($bestand)) { include($bestand); }
  if (!$conn) 
  {
    // geen verbinding met db
    $inhoud .= '<p>Could not connect with our database<br>
                    Try again later</p>';
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
      
            if(empty($_POST['info'])) 
    {
      $infoErr = 'required';
    }
    else 
    {
      $info = test_input($_POST['info']);
    }
      
      
    $err=$nameErr.$fnameErr.$emailErr.$infoErr.$sqlErr;
    if ($err=='') 
    {  
      // alles ok - bewaar geg's in database
      $formulier = false;
      try 
      {

        $sql='INSERT INTO help (name, familyName, email, info) VALUES (?, ?, ?, ?)';
       // $sql="INSERT INTO help (name, familyName, email, info) VALUES ('$name','$fname','$email','$info')";
         // $inhoud.= '<input type="hidden name="sql" value="'.$sql.'"><br>';
        $res = $conn->prepare($sql);
        $res->execute(array($name, $fname, $email, $info)); 
        /*****************************************************************/
        //toon bericht over nieuwsbrief
         $inhoud.='Dear '.$name.', thanks for letting us know about <br>
                    your problem we are trying to fix it as soon as possible';
      }
      catch (Exception $e) 
      {
        $$sqlErr.='<p>Could not connect with our database<br>
                    Try again later</p>'; 
        $inhoud.= $sqlErr; 		
      } // einde catch	
    } // einde  foutberichten invoer
  } // einde connectie ok
} // einde verwerk formulier
else
{
  // geopend uit url
} // einde uit url

$inhoud.='
<form method="post" id="form" action="" onsubmit="return checkformm(this)">
     <h1 id="ask-title">Drop us a note we will answer as soon as possible</h1>
      <h2>Name</h2>
       <input type="text" id="name" name="name" required>
       <h2>Family name</h2>
       <input type="text" id="fname" name="fname" required>
       <h2>E-mail</h2>
       <input type="text" id="email" name="email" required>
       <h2>Write us about your issue</h2>
       <textarea name=""  cols="30" rows="10" id="info" name="info"></textarea>
       <br>
<input type="submit" value="Send">
   </form>';


// toon pagina
$bestand="./head.php";
if (file_exists($bestand)) { include($bestand); }
echo $inhoud;
$bestand="./foot.php";
if (file_exists($bestand)) { include($bestand); }
?>