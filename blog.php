<?php
$file="./head.php";
if (file_exists($file)) { include($file); }
?>
<section>
    <div class="blog-welcome-box">
        <div class="blog-welcome">
            <h1>Welcome to library of our journeys
            </h1>
        </div>
        <div class="blog-welcome-info">
            <h2>Our journeys
            </h2>
            <p>We keep track of all the amazing things that we experience and make it into memories. To be sure that we don't forget, we created this special virtual library where all those stories can be stored. And than our visistors can come and read them and also share theirs special memories that they experienced with our travel agency. Those stories aren't only ours but also you as our client can write a story and we will add it to our collection. And now without any further hesitation pick your story and enjoy it. Imagine that you are there and that it is all a reality.
            </p>
        </div>
    </div>
    <div class='all-blog-box'>
        <?php
// connect to database
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'travelers');
// define how many results you want per page
$results_per_page = 6;
// find out the number of results stored in database
$sql='SELECT * FROM blog';
$result = mysqli_query($con, $sql);
$number_of_results = mysqli_num_rows($result);
// determine number of total pages available
$number_of_pages = ceil($number_of_results/$results_per_page);
// determine which page number visitor is currently on
if (!isset($_GET['page'])) {
$page = 1;
} else {
$page = $_GET['page'];
}
// determine the sql LIMIT starting number for the results on the displaying page
$this_page_first_result = ($page-1)*$results_per_page;
// retrieve selected results from database and display them on page
$sql='SELECT blogid,title, substring(text,1,200) , date FROM blog ORDER BY blogid DESC LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result)) {
echo "
<div class='blog-box'>
<img src='img/blog/".$row["blogid"].".jpg'>
<div class='blog-info'>
<p> ". $row["title"]. "</p>
<p> ". $row["substring(text,1,200)"]. " ...</p>
<p> ". $row["date"]. " </p>
<a href='blog-s.php?id=".$row["blogid"]."'>more</a>
</div>
</div>
";
}
?>
    </div>
    <div class="pages">
        <?php
// display the links to the pages
for ($page=1;$page<=$number_of_pages;$page++) {
echo '<a href="blog.php?page=' . $page . '">' . $page . '</a> ';
}
?>
    </div>
</section>
<?php
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
