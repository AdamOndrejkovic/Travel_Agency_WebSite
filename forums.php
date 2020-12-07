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
$file='./head.php';
if(file_exists($file)) {include($file);}
session_start();
//get the id for the specific forum topic
$tid = (int)$_GET['id'] ;
$content='<section>';
if ($conn) {  
$res = $conn->query('SELECT * FROM forum WHERE id = '.$tid);
$row=$res->fetch();
if(!$row=='') {   
//get the information from the database
$name = $row['name'];
$name= htmlentities($name);
$title = $row['title'];
$title = htmlentities($title);
$text = $row['text'];
$text= htmlentities($text);
$text = nl2br($text);
$date = $row['date'];
//show the forum artikel
$content.='<div class="forums-box">
<h1>'.$title.'</h1>
</div>';
$content .= '<div class="forum-s-content"><p>'.$text.'</p>'; 
$content .='<h2>Writen by: '.$name.' on: '.$date.'</h2></div>'; 
//Create the form to post reactions
$content.='<div class="forums-add-comment"><form id="formulier" action="post_forum-comment.php" method="post" >
<p><input type="hidden" name="id" value="'.$tid.'" /><br />';
if(isset($_SESSION['user_name']))
{
$user_name = $_SESSION['user_name'];
$content.='Comment from:<strong>'.$user_name.'</strong>
<input type="hidden" name="name" value="'.$user_name.'" /><br>';
}
else
$content.=' <input type="text" id="fs-add-name" name="name" placeholder="Enter your name"><br>';
$content.='
<textarea rows="10" cols="79" name="comment" placeholder="Add your comment " onkeyup="countChar(this)"></textarea><div id="b-post-btn"><div id="charNum"></div>
<input type="submit"  value="Post" name="Send"></div>
</p>
</form></div>';
}
else {
$content.='<p class="fout">Dit bericht bestaat niet!</p>';
}
}
else
{
$content.='<p class="fout">kan niet verbinden met DataBase.</p>';
}
$content.='<div class="forums-comments-box"><div class="forums-show-comments">';
$res = $conn->query('SELECT * FROM forumre WHERE tid = '.$tid);
$number = $res->rowCount();
if($number>0){
while($row=$res->fetch()) {
// get information from the database
$id = $row['id'];
$name = $row['name'];
$name= htmlentities($name);
$comment = $row['comment'];
$comment = htmlentities($comment);
$comment = nl2br($comment);
$date = $row['post_time'];
//show the information 
$content.='<div class="forums-comments-info-box"><h3>'.$name.'</h3><br>';   
$content.='<p>'.$comment.'</p><span><p>'.$date.'</p></span></div>'; 
}
}
else {
//No reactions
$content.='<p>There are none reactions</p>'; 
}
$content.='</div></div>';
$content.='</section>';
//show the page
echo $content;
$file='./foot.php';
if(file_exists($file)) {include($file);}  
?>
