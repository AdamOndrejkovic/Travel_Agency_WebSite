<?php
$file='./head.php';
if(file_exists($file)) { include($file); }
session_start();
$content='<section><h1>Add a forum post</h1>';
//process information if not empty
if (!empty($_POST['text']) && !empty($_POST['name']) && !empty($_POST['title']))
{
$name = stripslashes($_POST['name']); 
$name = htmlentities($name);
$title = stripslashes($_POST['title']);
$title = htmlentities($title);
$text = stripslashes($_POST['text']);
$text = htmlentities($text); 
//connect to the database
if ($conn)
{  
$sql = "INSERT INTO forum (id, name, title , text , date) 
VALUES ('?','$name','$title', '$text', NOW())";
$res = $conn->query($sql);
if($res)
{
//if insert ok redirect 
header('Location: forum.php');
}
else
{
//something went wrong
$content .= '<p>Your reaction was not added.</p>';
}  
}
else
{
//something wrong with connection
$content.= '<p>Can not connect to the database.</p>';
}
}
else
{  
$content.='<p>Something went wrong with the adding of your question.</p>';
}
$content.='</section>';
//show the page
echo $content;
$file='./foot.php';
if(file_exists($file)) { include($file); } 
?>
