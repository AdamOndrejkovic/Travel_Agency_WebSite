<?php
session_start();
$content='<section><h1>Comment on the blog</h1>';
//get the blog id
$tid = (int)$_POST['id']; 
//get the information from the form
if (!empty($_POST['comment']) && !empty($_POST['name']))
{
$name = stripslashes($_POST['name']); 
$name = htmlentities($name);  
$comment = stripslashes($_POST['comment']);
$comment = htmlentities($comment); 
//connect to the database
if ($conn)
{  
// put the information in the database
$sql = "INSERT INTO blogre (tid, name, comment, post_time) 
VALUES ('$tid','$name','$comment',NOW())";
$res = $conn->query($sql);
if($res)
{
//if all is ok redirect
header('Location: blog-s.php?id='.$tid);
}
else
{
//something went wrong
$content.= '<p>Your post was not added</p>';
}  
}
else
{
$content.= '<p>Cannot connect to the database</p>';
}
}
else
{  
$content.='<p>You need to fill all the fields in. In order tho post a comment on the blog.</p>';
}
$content.='</section>';
//show the page
$file='./head.php';
if(file_exists($file)) { include($file); }
//show all the information 
echo $content;
$file='./foot.php';
if(file_exists($file)) { include($file); } 
?>
