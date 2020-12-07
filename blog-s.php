<!-- Counts number of writen characters in the post --->
<script>
    function countChar(val) {
        var len = val.value.length;
        if (len >= 500) {
            val.value = val.value.substring(0, 500);
        } else {
            $('#charNum').text(500 - len);
        }
    };

</script>
<?php
//start session
session_start();
$tid = (int)$_GET['id'] ;
$content='<section>';
//first we take the needed information for the blog based on the value we got from the previous page
if ($conn) {  
$res = $conn->query('SELECT * FROM blog WHERE blogid = '.$tid);
$row=$res->fetch();
if(!$row=='') {   
//get all the information from the database
$title = $row['title'];
$title = htmlentities($title);  
$text = $row['text'];
$text= htmlentities($text);
$text = nl2br($text);
$date = $row['date'];
$author = $row['author'];
$source = 'img/blog/'.$tid.'.JPG'; 
//show the blog it self
$content.='<div class="blog-s-header" style="background-image: url('.$source.')">
<h1>'.$title.'</h1>
</div>';
$content .= '<div class="blog-s-content"><p>'.$text.'</p>'; 
$content .='<h2>Writen by: '.$author.' on: '.$date.'</h2></div>'; 
// form to add comment
$content.='<div class="add-comment"><form id="formulier" action="post_comment.php" method="post" >
<p><input type="hidden" name="id" value="'.$tid.'" /><br />';
if(isset($_SESSION['user_name']))
{
$user_name = $_SESSION['user_name'];
$content.='Reactie door:<strong>'.$user_name.'</strong>
<input type="hidden" name="name" value="'.$user_name.'" /><br>';
}
else
$content.=' <input type="text" id="add-name" name="name" placeholder="Enter your name"><br>';
$content.='
<textarea rows="10" cols="79" name="comment" placeholder="Add your comment " onkeyup="countChar(this)"></textarea><div id="b-post-btn"><div id="charNum"></div>
<input type="submit"  value="Post" name="Send"></div>
</p>
</form></div>';
}
else {
$content.='<p>There is no message.</p>';
}
}
else
{
$content.='<p>Cannot connect to the database.</p>';
}
//show all the post that there are 
$content.='<div class="blog-comments-box"><div class="show-comments">';
$res = $conn->query('SELECT * FROM blogre WHERE tid = '.$tid);
$aantal = $res->rowCount();
if($aantal>0){
// de recordset $res record per record doorlopen
while($row=$res->fetch()) {
// gegevens uit het record halen
$id = $row['reid'];
$name = $row['name'];
$name= htmlentities($name);
$comment = $row['comment'];
$comment = htmlentities($comment);
$comment = nl2br($comment);
$date = $row['post_time'];
$content.='<div class="comments-info-box"><h3>'.$name.'</h3><br>';   
$content.='<p>'.$comment.'</p><span><p>'.$date.'</p></span></div>'; 
}
}
else {
//Else there are no comments
$content.='<p>There are no comments op this blog post.</p>'; 
}
$content.='</div></div>';
$content.='</section>';
$file='./head.php';
if(file_exists($file)) {include($file);}
//show all the information
echo $content;
$file='./foot.php';
if(file_exists($file)) {include($file);}  
?>
