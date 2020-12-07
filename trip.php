<?php
session_start();
$file = "./head.php";
if (file_exists($file))
{
    include ($file);
}
?>
<section id="trip">
    <?php
$tmid = $_GET['tmid'];
$_SESSION["trip"] = $tmid;
$content = '';
//if conn false can not connect to database
if (!$conn)
{
    $content .= "Can not conect with database !!!";
}
else
{
    //if connection succes execute sql and shorecords
    $res = $conn->query("SELECT * FROM tripsmodel, tripplan WHERE tripplan.tmid = '$tmid' AND tripsmodel.id = '$tmid'");
    while ($row = $res->fetch())
    {
        //get records from database
        $name = htmlentities($row['name']);
        $title = htmlentities($row['title']);
        $info = htmlentities($row['info']);
        $map = htmlentities($row['map']);
        $plan = htmlentities($row['plan']);
        $source = 'img/tripBg/' . $name . '.JPG'; // een mogelijke afbeelding bij een bericht
        //put records into html code and put them in variable
        $content .= " 
<div id='trip-intro' style='background-image: url(" . $source . ");background-size: cover;'>
<h4> " . $title . " </h4>
</div>
<div id='trip-info'>    
<p> " . $info . "</p>
</div>
<div id='trip-planning'>
<div id='itinerary'>
<p> " . $plan . " </p>
</div>
<div id='trip-map'>
<iframe  " . $map . " frameborder='0'></iframe>
</div>
</div>
";
    }
}
//show result if false can not connect else show records
echo $content;
?>
    <!-- JavaScript slider -->
    <div class="Tslider">
        <script>
            //set the begin variable for slider
            var i = 0;
            var images = [];
            var time = 3000;
            var name = '<?php echo $name ?>';
            //Image list with images stored in folder img/tripSlider/' + name + '/ 
            //name is php variable stored in js variable
            images[0] = 'img/tripSlider/' + name + '/1.jpg';
            images[1] = 'img/tripSlider/' + name + '/2.jpg';
            images[2] = 'img/tripSlider/' + name + '/3.jpg';
            images[3] = 'img/tripSlider/' + name + '/4.jpg';
            images[4] = 'img/tripSlider/' + name + '/5.jpg';
            images[5] = 'img/tripSlider/' + name + '/6.jpg';
            images[6] = 'img/tripSlider/' + name + '/7.jpg';
            images[7] = 'img/tripSlider/' + name + '/8.jpg';
            images[8] = 'img/tripSlider/' + name + '/9.jpg';
            images[9] = 'img/tripSlider/' + name + '/10.jpg';
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
    <table class='table-trip'>
        <tr>
            <th>Name
            </th>
            <th>Type
            </th>
            <th>Date
            </th>
            <th>Available
            </th>
            <th>Price
            </th>
            <!-- <th>Intinerary</th> -->
            <th>Order
            </th>
        </tr>
        <?php
$content = '';
//if conn false can not connect to database
if (!$conn)
{
    $content .= "Can not conect with database !!!";
}
else
{
    //if connection succes execute sql and shorecords
    $res = $conn->query("SELECT * FROM  tripsmodel , trips WHERE  tripsmodel.id = '$tmid' AND trips.tmid = '$tmid' AND trips.places != 0");
    while ($row = $res->fetch())
    {
        //get records from database
        $name = htmlentities($row['name']);
        $type = htmlentities($row['type']);
        $days = htmlentities($row['time']);
        $adult = htmlentities($row['adult']);
        $flightS = htmlentities($row['flightS']);
        $hotel3 = htmlentities($row['hotel3']);
        $insurance = htmlentities($row['insurance']);
        $administration = htmlentities($row['administrationC']);
        $bprice = $adult + $flightS + ($hotel3 * $days) + $insurance + $administration;
        if ($row["places"] != 0)
        {
            $available = 'Available';
        }
        else
        {
            $available = 'Full';
        }
        $newDateB = date("d-m-Y", strtotime($row["dateB"]));
        //put records into html code and put them in variable
        $content .= " 
<tr>
<td>" . $name . "</td>
<td>" . $type . "</td>
<td>" . $newDateB . "</td>
<td>" . $available . "</td>
<td>" . $bprice . " €</td>
<td><a href='order.php?id=" . $row["tripId"] . "'>More</a></td>
</tr>
";
    }
}
//show result if false can not connect else show records
echo $content;
?>
    </table>
</section>
<?php
$file = "./foot.php";
if (file_exists($file))
{
    include ($file);
}
?>
