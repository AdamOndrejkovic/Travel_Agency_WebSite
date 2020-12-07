<?php
$file="./head.php";
if (file_exists($file)) { include($file); }
//all the html page content
$content='<section id="con-sec">
<div class="banner">
<h1>Contact us</h1>
<h4>While were good with smoke signals, there are simpler ways <br> for us to get in touch and answer your questions.</h4>
</div>
<div class="main">
<div class="help-box">
<img src="img/btn/faq.png" alt="">
<h3>FAQS</h3>
<a href="faq.php">Find your answer</a>
</div>
<div class="help-box">
<img src="img/btn/gift.png" alt="">
<h3>Gift Cards</h3>
<a href="gift.php">Find out more</a>
</div>
<div class="help-box">
<img src="img/btn/plane.png" alt="">
<h3>Our Trips</h3>
<a href="help-trip.php">Find out more</a>
</div>
<div class="help-box">
<img src="img/btn/forum.png" alt="">
<h3>Forum</h3>
<a href="forum.php">Join</a>
</div>
</div>
<div class="supp-box">
<h1>STILL CANT FIND WHAT
YOURE LOOKING FOR?</h1>
<a href="ask.php">Send us a mail</a>
</div>
<div class="con-box">
<div class="con-info">
<h2>Customer Service Team</h2>
<p>00 32 458 54 98 65
<br>
Monday – Friday
<br>
7:00AM – 7:00PM</p>
<a href="ask.php">Email us</a>
</div>
<div class="con-info">
<h2>Management of the Agency</h2>
<p>Old Markt
<br>
Brussel 1000
<br>
Belgium</p>
</div>
<div class="con-info">
<h2>Travel Agency Store</h2>
<p>Old Markt
<br>
Brussel 1000
<br>
Belgium</p>
<a href="">More information</a>
</div>
</div>
</section>';
//show to page
echo $content;
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
