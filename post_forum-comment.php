<?php
$file='./head.php';
if(file_exists($file)) { include($file); }
session_start();
//process the form
$content='<section><h1>Comment on the forum</h1>';
//get the forum id
$tid = (int)$_POST['id'];
//get the information from the form if not empty
if (!empty($_POST['comment']) && !empty($_POST['name']))
{
//process the information
$name = stripslashes($_POST['name']); 
$name = htmlentities($name);
$comment = stripslashes($_POST['comment']);
$comment = htmlentities($comment);
//connect to the database
if ($conn)
{  
$sql = "INSERT INTO forumre (tid, name, comment, post_time) 
VALUES ('$tid','$name','$comment',NOW())";
$res = $conn->query($sql);
if($res)
{
//if the insert is ok redirect
header('Location: forums.php?id='.$tid);
}
else
{
//if something went wrong
$content .= '<p>Something went wrong your reaction was not added</p>';
}  
}
//problem with connecting to the database
else
{
$content.= '<p>Can not connect to the database</p>';
}
}
//if the field was empty
else
{  
$content.='<p>In order to post your reaction you have to fill in all the fields.</p>';
}
$content.='</section>';
//show the page
echo $content;
$bestand='./foot.php';
if(file_exists($file)) { include($file); } 
?>
