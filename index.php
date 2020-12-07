<?php
   $file="./head.php";
   if (file_exists($file)) { include($file); }
   ?>
<section id="main-sec">
    <!-- Ellipse for main page welcome -->
    <div class="welcome-box">
        <div class="ellipse-container">
            <h2 class="greeting">explore</h2>
            <div class="ellipse ellipse_outer--thin">
                <div class="ellipse ellipse_orbit"></div>
            </div>
            <div class="ellipse ellipse_outer--thick"></div>
        </div>
    </div>
    <!-- Information over us -->
    <div class="info-us">
        <h2>About us</h2>
        <p>The Traveller´s is here to make your dream come true. Are you willing to travel to some place where it is hard to get ? It is not a problem for us, we will provide you any permission to every continent. Our travel agency will provide you a total comfort and surely grant you an memorable experience. We garantee you a 100 % fulfilment. Don´t worry, our emergency service is always there for you. We are proud to say our travel agency has the best contractual bankruptcy insurance on market - up to 7 500 000 €. Do not hesitate and check our today´s offer! </p>
    </div>
    <!-- Recommended trips with database connection -->
    <div class="recom-main">
        <h1>Recommended Trips</h1>
        <a href="trips.php">All trips</a>
        <div class='recom-trips'>
            <?php 
            // variable is set empty
            $content = '';
            //if conn false can not connect to database
            if (!$conn) {  
            $content.= "Can not conect with database !!!";
            }
            else 
            {
            //if connection succes execute sql and shorecords
            $res = $conn->query('SELECT * FROM tripsmodel Where recommended =1');
            while($row=$res->fetch()) { 
            //get records from database
            $name = htmlentities($row['name']);
            $type = htmlentities($row['type']);
            $time = htmlentities($row['time']);
            $bprice = htmlentities($row['bprice']);
            $id= htmlentities($row['id']);
            
            //put records into html code and put them in variable
            $content.= '
            <div class="recom-trip-box"">
            <img src=" img/trip-card/'.$name.'.jpg">
            <div class="recom-trip-info">
            <h3> '.$name.'</h3>
            <h4> '.$type.' </h4>
            <h4> '.$time.' days</h4>
            <h4> '.$bprice.' €</h4>
            <a href="trip.php?tmid="'.$id.'">More</a>
            </div>
            </div>';
            }
            }
            //show result if false can not connect else show records
            echo $content;        
            ?>
        </div>
    </div>
    <!-- Choose country box -->
    <div class="choose-country">
        <h2>How to choose
            <br> a country
        </h2>
        <p>
            It is a big responsibility from our side to help you when choosing a country. We use our “travel questionnaire” where you write all your expectations. We will then create a custom made tour. When you want to travel to some country on your own or with friends, you can surely try the most adventurous trips connected with comfort. Every day will be different and you will explore the world's greatest gems. When you think ecologically and want to spend holidays with children like family you can try our “eco-tourism” trips which are quite new, but becoming very popular. You will sleep at treehouse or at the house on the lake. It´s a perfect experience to undergo something like this! If you want both rest as much as possible and have luxury in one, you can choose from our deluxe collections. You will experience many tastings of great food and delicious wines and sail on a luxury boat. You will also discover many interesting places in the Mediterranean.
        </p>
    </div>
    <!-- Interactive map section -->
    <div class="mapmain-box">
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d46523620.77604764!2d18.871845300470994!3d46.3820872072537!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e1!3m2!1snl!2ssk!4v1576496580751!5m2!1snl!2ssk" allowfullscreen=""></iframe>
    </div>
    <!-- Top section with tabs -->
    <div class="top-trips">
        <ul class="top-main" id="tabs">
            <li>
                <a href="#top">Top
                    Recommended</a>
            </li>
            <li>
                <a href="#top-comfort">Top
                    Comfort</a>
            </li>
            <li>
                <a href="#top-family">Top
                    Family</a>
            </li>
            <li>
                <a href="#top-eco">Top
                    Eco Tourism</a>
            </li>
            <li>
                <a href="#top-deluxe">Top
                    Deluxe</a>
            </li>
        </ul>
        <div id="top-content">
            <!-- Here comes the content which is set default on top recommended -->
            <ol>
                <?php 
               //Set variable and check connection
               $content = '';
               //Connection false can not connect
               if (!$conn) {  
               $content.= "Can not conect with database !!!";
               }
               else
               {
               //Sql execute to get the records
               $res = $conn->query('SELECT * FROM tripsmodel Where top  > 0  ORDER BY  top ASC');
               while($row=$res->fetch()) { 
               //Get the records and assign them to variable
               $name = htmlentities($row['name']);
               $id= htmlentities($row['id']);
               
               //Put the records into html text stored in variable
               $content.= ' <li><a href="trip.php?tmid="'.$id.'">'. $name. '</a></li>';
               }
               }
               //Show result if true or false
               echo $content;
               ?>
            </ol>
        </div>
    </div>
    <!-- Section with link to trips,ask,forum and newsletter -->
    <div class="us2-con">
        <div class="info-us2">
            <img src="img/btn/plane.png" alt="">
            <h3>Trips</h3>
            <a href="trips.php">Find your trip</a>
        </div>
        <div class="info-us2">
            <img src="img/btn/gift.png" alt="">
            <h3>Get in touch</h3>
            <a href="ask.php">Need some help</a>
        </div>
        <div class="info-us2">
            <img src="img/btn/forum.png" alt="">
            <h3>Forum</h3>
            <a href="forum.php">Join our Forum</a>
        </div>
        <div class="info-us2">
            <img src="img/btn/forum.png" alt="">
            <h3>Newsletter</h3>
            <a href="newsletter.php">Join</a>
        </div>
    </div>
    <!-- JavaScript slider -->
    <div class="slider">
        <script>
            //set the begin variable for slider
            var i = 0;
            var images = [];
            var time = 3000;

            //Image list with images stored in folder img/slider
            images[0] = 'img/slider/1.jpg';
            images[1] = 'img/slider/2.jpg';
            images[2] = 'img/slider/3.jpg';
            images[3] = 'img/slider/4.jpg';
            images[4] = 'img/slider/5.jpg';
            images[5] = 'img/slider/6.jpg';
            images[6] = 'img/slider/7.jpg';
            images[7] = 'img/slider/8.jpg';
            images[8] = 'img/slider/9.jpg';
            images[9] = 'img/slider/10.jpg';


            //Change Image Slider    
            function changeImg() {
                document.slider.src = images[i];

                if (i < images.length - 1) {
                    i++;
                } else {
                    i = 0;
                }
                setTimeout("changeImg()", time);
            }

            window.onload = changeImg;

        </script>
        <!-- Show the images -->
        <img name="slider">
    </div>
</section>
<?php
   $file="./foot.php";
   if (file_exists($file)) { include($file); }
   ?>
