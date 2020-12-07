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
$content='<section>';
$content.='<div class="forum-box">
<p>Welcome to our forum. Here you can add all your questions or recommendations. Our visitors on this page can answer or comment them. Do not worry and join our community</p></div>';
//connect to the database and create the form
if ($conn) {  
// show comments
$content.='
<div class="forum-add-comment"><form id="formulier" action="post_forum.php" method="post" >
<p><input type="hidden" name="id" value="" ><br />';
if(isset($_SESSION['user_name']))
{
$user_name = $_SESSION['user_name'];
$content.=''.$user_name.'</strong>
<input type="hidden" name="name" value="'.$user_name.'" /><br>';
}
else
$content.=' <input type="text" id="f-add-name" name="name" placeholder="Enter your name"><br>';
$content.=' <input type="text" id="f-title" name="title" placeholder="Enter your question"><br>';
$content.='
<textarea rows="10" cols="79" name="text" placeholder="Add your comment " onkeyup="countChar(this)"></textarea><div id="b-post-btn"><div id="charNum"></div>
<input type="submit"  value="Post" name="Send"></div>
</p>
</form></div>';
}
else
{
$content.='<p>Can not connect to the database.</p>';
}
//get all the needed information from the database
$content.='<div class="forum-comments-box"><div class="forum-show-comments">';
$res = $conn->query('SELECT * FROM forum');
$number = $res->rowCount();
if($number>0){
while($row=$res->fetch()) {
$id = $row['id'];
$name = $row['name'];
$name= htmlentities($name);
$title = $row['title'];
$title= htmlentities($title);
$text = $row['text'];
$text = htmlentities($text);
$text = nl2br($text);
$date = $row['date'];
//show the information
$content.='<div class="forum-comments-info-box"><h3>'.$name.'</h3><br>';   
$content.='<p>'.$title.'</p><span><p>'.$date.'</p></span> <a href="forums.php?id='.$id.'">More</a></div>'; 
}
}
else {
//In case that there are no forum post
$content.='<p>There are no forum post.</p>'; 
}
$content.='</section>';
//show the page
echo $content;
$file='./foot.php';
if(file_exists($file)) {include($file);}  
?>
