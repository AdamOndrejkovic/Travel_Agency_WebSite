<?php
$content='
<div class="banner" id="gift-ban">
<h1>Gift Card</h1>
<h4>Havent found information you were looking for let us know</h4>
</div>
<div id="gift">
<h1>Gift Cards</h1>
<h3>What are they</h3>
<p>You can buy a customize Gift card with choosen amount of money on it. So that another person can use it to purchase a trip and pay a part or the full prize with it depending on amount on that card</p>
<h3>Where Can I buy them</h3>
<p>You can purchase the gift card in our travel agency store where our workers will be more than happy to explain everything.</p>
<h3>What can I use them for</h3>
<p>With a gift card you can pay a part or the whole price of the trip depending on amount of money on a gift card</p>
<h3>How long are they valid</h3>
<p>They are valid for one year. However you can still purchase trip which will me more a head. </p>
<h3>Who can use gift card</h3>
<p>The only person who can use the gift card is the one that they are addresed to.</p>
<div class="note">
<h1>Need more information about gift cards let us know in mail or call us.</h1>
<a href="ask.php">Drop note</a>
</div>
';
$file="./head.php";
if (file_exists($file)) { include($file); }
echo $content;
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
