<?php
   $file="./head.php";
   if (file_exists($file)) { include($file); }
   ?>
<section id="about-us-sec">
    <!-- Welcome page about us with changing text -->
    <div class="us-welcome-box">
        <h1>Our goal is</h1>
        <div class="dropping-texts">
            <h2>to make</h2>
            <h2>your dreams</h2>
            <h2>come</h2>
            <h2>TRUE!</h2>
        </div>
    </div>
    <!-- What we do information -->
    <div id="intro">
        <div>
            <h2>What do we do</h2>
            <p>Traveller´s is not just a travel agency. We are increasing company of people who have passion for travelling. We also travel a lot and search for the latest news. Our company consists of more than 200 employees. That means that we have over 100 travel guides and the rest is our office staff. We are known for our high-quality services that we provide to each of our customers. We do as much as possible to avoid any failing. Our guides must undergo very though training and special education. Our travel agency is first on market with its unique Traveller´s academy. If you want to be the part of us, you must pass all the exams and get to know with as much as possible when it comes to knowledge of numerous countries. And that is not everything – if you want to be promoted, you will have to constantly proceed. Colleagues in back-end office spend so much time by looking for the best possibilities and get along well with foreign partners. Traveller´s is the only travel agency, which owns its private airplane and buses. We organize the trips around the world. Besides the regular tours according to the offer, we organize the specialized tours, as well. It does not matter if you are planning to go on a trip as a couple or family, smaller or the group of more than 100 people. We strive to meet all your special requirements. We also offer a transfer to and from the airport by luxury cars at a reasonable price. For us, each client is a VIP!</p>
        </div>
    </div>
    <!-- Our values section -->
    <div class="our-values">
        <div>
            <h2>Our Values</h2>
            <p>This is the <i>fabric of our culture</i> and the framework for all decisions made within these walls. Heads up, they tend to be contagious.
            </p>
            <div>
                <h3>Authenticity. <br> <span>To be genuine,be vulnerable.</span></h3>
                <h3>Simplicity. <br><span>Distill to the meaningful and balanced.</span></h3>
                <h3>Drive. <br><span>Do what you love.</span></h3>
                <h3>Adventure. <br> <span>Take risks and embrace where they take you.</span></h3>
                <h3>Mindfulness. <br> <span>Excercise a nuanced,articulate understanding.</span></h3>
                <h3>Appreciation. <br> <span>Dwell on the good.</span></h3>
            </div>
        </div>
    </div>
    <!-- Team connected to database -->
    <div class="our-team-box">
        <h1>Meet the Team</h1>
        <div class='our-team'>
            <?php 
            //set variables and check for connection
            $content = '';
            if (!$conn) {  
                //If not connected 
            $content.= "Can not conect with database !!!";
            }
            else 
            {
            //If connection succes execute sql
            $res = $conn->query('SELECT * FROM workers');
            while($row=$res->fetch()) { 
            //Get all the records and assign them to variables
            $id= htmlentities($row['id']);      
            $name = htmlentities($row['name']);
            $position = htmlentities($row['position']);
            
            //Put those variables into html code set in variable
            $content.= '<div class="our-team-info">
               <img src="img/workers/'.$id.'.jpg">
                <div >
                <h3>'.$name.'</h3>
                <h3>'.$position.'</h3>
            </div>
               </div>';
            }
            }
            //Show where statement is true
            echo $content;
            
            ?>
        </div>
    </div>
</section>
<?php
   $file="./foot.php";
   if (file_exists($file)) { include($file); }
   ?>
