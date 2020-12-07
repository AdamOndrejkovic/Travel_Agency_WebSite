<?php
$content=' 
<div class="banner" id="faq-ban">
<h1>Frequently asked questions</h1>
<h4>Havent found your answer let us know</h4>
</div>
<div id="faq-info">
<h1>Trips</h1>
<h3>Can I change the day of my trip?</h3>
<p>Because are trips are schdedulled it may be difficult to change the date . But if possible we may be able to put you for the later date. All depending on the situation</p>
<h3>Can our trip get canceled</h3>
<p>The trip can get canceled. In which case the insurance will cover the loss. And we can book another plan term. Canceling trips depends onn various factors. But our customers safety is our priority</p> 
<h3>Are the countries safe</h3>
<p>We are constantly monitoring the situation for the trips destination. So if anything would change we would contact you.</p>
<h3>Can I have my own program</h3>
<p>We create program for every trip but you are not obliged to follow it. You can explore on your own if thats what you want.</p>
<h1>Payment</h1>
<h3>Can I pay in two</h3>
<p>This is sometimes difficult to say. But you will surely need to pay an amount of the total price beforehand. So that we can make all the neccesary arragements for your trip.</p>
<h3>Refound for canceled</h3>
<p>The refound for any canceled trip will be paid back as soon as possible. All depending on the insurance company and our partners.</p> 
<h3>Do I get money back if I cannt attend</h3>
<p>If you dont attend a trip and do not have any solid reason we wont be able to help you. But if possible we can do something about it.</p>
<h3>My card wont get accepted</h3>
<p>There are various possibilities to pay. If you have any difficulties you can just stop by are agancy. And finish your payment there.</p>
<h1>Another questions</h1>
<h3>Do I have to attend medical care</h3>
<p>You may need to get a check by doctor. But it all depends on the region where you go</p>
<h3>What do I need to take with me</h3>
<p>This all depends from person to person. You will recive instruction before the trip. But you should also check your destination in case.</p> 
<h3>How can I recive news</h3>
<p>To recive new information you should subscribe our newsletter where we try to put interesting information</p>
<h3>Unsubscribe newsletter</h3>
<p>If you no longer wish for our newsletter  you can unsuscribe via the email. Where on the bottom you have a link to unsuscribe.</p>
</div>
<div class="note">
<h1>Your question wasnt answered or do you need more information let us know in mail or call us.</h1>
<a href="ask.php">Drop note</a>
</div>
';
$file="./head.php";
if (file_exists($file)) { include($file); }
echo $content;
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
