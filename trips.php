<?php
   $file="./head.php";
   if (file_exists($file)) { include($file); }
   ?>
<section class="all-trips">
    <!-- Search bar box with picture background -->
    <div class="all-trips-welcome">
        <input type="text" name="trip" id="trip-search" class="form-control" placeholder="Type your trip destination" />
        <div id="tripList"></div>
        <!-- JavaScript code for search bar -->
        <script>
            $(document).ready(function() {
                $('#trip-search').keyup(function() {
                    var query = $(this).val();
                    if (query != '') {
                        $.ajax({
                            url: "search.php",
                            method: "POST",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                $('#tripList').fadeIn();
                                $('#tripList').html(data);
                            }
                        });
                    }
                });
                $(document).on('click', 'li', 'a', function() {
                    $('#trip-search').val($(this).text());
                    $('#tripList').fadeOut();
                });
            });

        </script>
    </div>
    <!-- Information for trips -->
    <div class="trip-information">
        <h2>Trips offer</h2>
        <p>Our trips are made to measure. Every trip has its own specialization which is added by our employees. They strive to do their best and reach a perfection. We hunt for experiences which can´t become forgotten. In the workshop of our most experienced workers the four kinds of trips are made. You can choose according your preferences and taste which trip suits you the most. Usually, families with kids chose our family – trips. The program is adapted precisely tailored to high quality comfort even for the smallest travelers. Are you a lazy type? Or do you want to relax and enjoy the vacation? Then the comfort – trips are exactly what you need. If you´re fancy about a higher level, luxury accommodation, the most delicious food and tastings, relaxation and superior services, don´t hesitate and use our special offer – deluxe trips. And last but not least, we have something which is unique and becoming to develop, eco-tourism. If you´re a fan of looking after a nature, be its protector and preserve our planet for future generation then you´ll definitely go for ecological way of travelling. You will be sleeping at treehouses or house on the lakes, eating and supporting local producers, exploring the treasures of the purest and most mysterious places and a lot of another. You will never regret that ! </p>
    </div>
    <!-- Section where with help of tabs we can change content -->
    <div class="all-trips-infobox">
        <ul id="trips-tabs">
            <li><a href="#all-trips">All Trips</a></li>
            <li><a href="#comfort-trips">Comfort</a></li>
            <li><a href="#family-trips">Family</a></li>
            <li><a href="#eco-trips">Eco Tourism</a></li>
            <li><a href="#deluxe-trips">Deluxe</a></li>
        </ul>
        <!-- Here comes the content and default shows it all trips -->
        <div id="trips-content">
            <div class='all-trips-box'>
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
               $res = $conn->query('SELECT * FROM tripsmodel LIMIT 6');
               while($row=$res->fetch()) { 
               //Get all the records and assign them to variables
               $id= htmlentities($row['id']);      
               $name = htmlentities($row['name']);
               $type = htmlentities($row['type']);
               $time = htmlentities($row['time']);
               $bprice = htmlentities($row['bprice']);
               
               //Put those variables into html code set in variable
               $content.= '<div class="trip-box">
                  <img src="img/trip-card/'.$name.'.jpg">
                   <div class="trip-info">
               
                   <h3> '. $name. '</h3>
                   <h4> '. $type. ' </h4>
                   <h4> '. $time. ' days</h4>
                   <h4> '. $bprice. ' € </h4>
                   
                  <a href="trip.php?tmid='.$id.'">More</a>
               </div>
                  </div>';
               }
               }
               //Show where statement is true
               echo $content;
               
               ?>
                <!-- JavaScript code for load more trips -->
                <script>
                    $(document).ready(function() {
                        var tripsCount = 6;
                        $("button").click(function() {
                            tripsCount = tripsCount + 6;
                            $(".all-trips-box").load("load-trips.php", {
                                tripsNewCount: tripsCount
                            });
                        });
                    });

                </script>
            </div>
            <button class="load-btn"> Load more</button>
        </div>
    </div>
</section>
<?php
   $file="./foot.php";
   if (file_exists($file)) { include($file); }
   ?>
