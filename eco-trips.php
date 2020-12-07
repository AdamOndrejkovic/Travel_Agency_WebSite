<!-- Tabs file for eco trips -->
<div class='all-trips-box'>
    <?php 
      $conn = false;
          $file='./connection.php';
          if(file_exists($file)) {include($file);}
             //set variables and check for connection
             $content = '';
             if (!$conn) {  
             //If not connected 
             $content.= "Can not conect with database !!!";
             }
             else 
             {
             //If connection succes execute sql
             $res = $conn->query('SELECT * FROM tripsmodel Where type = "Eco Tourism" LIMIT 6');
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
    <!-- Code to show more trips -->
    <script>
        $(document).ready(function() {
            var tripsCount = 6;
            $("button").click(function() {
                tripsCount = tripsCount + 6;
                $(".all-trips-box").load("load-etrips.php", {
                    tripsNewCount: tripsCount
                });
            });
        });

    </script>
</div>
<button class="load-btn"> Load more</button>
