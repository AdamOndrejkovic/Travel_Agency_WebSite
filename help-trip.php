<?php
$content='
<div class="banner" id="help-trip-ban">
<h1>Our Trip</h1>
<h4>Extra information about our trips and what we do</h4>
</div>
<div id="help-trip">
<h1>Our Trips</h1>
<h3>What are they</h3>
<p>Our trips are specialy made so that the fulfill all the expectations of our customers. We make every trip custom made so that all of them are unique.</p>
<h3>Why choose us</h3>
<p>We put a lot of effort in to our trips so that our customers are satisfied. And also their safety is our highes priority.</p>
<h3>What do you get</h3>
<p>You will get an unforgotable journey. And you can choose from multiple destinations. </p>
<h3>Standards</h3>
<p>We have a basic package but that can be easily upgraded into premium. For examle you can also get higher standard of hotel or the flight.</p>
<h3>Insurance</h3>
<p>Every single person has the basic insurance included in their trip. That is for the reason to protect our customers on the trips. You also can upgrade it the a premium insurance.</p>
</div>
<div class="note">
<h1>Do you still have some unanswered questions let us know in mail or call us.</h1>
<a href="ask.php">Drop note</a>
</div>
';
$file="./head.php";
if (file_exists($file)) { include($file); }
echo $content;
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
