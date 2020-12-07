<?php
$file="./head.php";
if (file_exists($file)) { include($file); }
//get variable from previous page to select neccesery row in the database
$tripId = $_GET['id'];
?>
<section id="order-sec">
    <h2>Order overview
    </h2>
    <?php
$content = '';
if (!$conn) {  
//If not connected 
$content.= "Can not conect with database !!!";
}
else 
{
//If connection succes execute sql
$res = $conn->query("SELECT * FROM trips, tripsmodel WHERE tripId ='$tripId' AND tripsmodel.id = trips.tmid");
while($row=$res->fetch()) { 
//Get all the records and assign them to variables
$name = htmlentities($row['name']);
$days = htmlentities($row['time']);
$adult = htmlentities($row['adult']);
$kid = htmlentities($row['kid']);
$flightS = htmlentities($row['flightS']);
$flightB = htmlentities($row['flightB']);
$hotel3 = htmlentities($row['hotel3']);
$hotel4 = htmlentities($row['hotel4']);
$hotel5 = htmlentities($row['hotel5']);
$storno = htmlentities($row['storno']);
$flightI = htmlentities($row['flightI']);
$insurance = htmlentities($row['insurance']);
$insuranceP = htmlentities($row['insuranceP']);
$administrationC = htmlentities($row['administrationC']);
//define begin price        
$bprice= $adult + $flightS + ( $hotel3 * $days) + $insurance + $administrationC;
//change  the format of the date fields
$newDateB = date("d-m-Y", strtotime($row["dateB"]));
$newDateE = date("d-m-Y", strtotime($row["dateE"]));
//put all the variables in the text
echo '
<h4> Destination: '.$name.'</h4>
<h4>Scheduled from '. $newDateB.' " to "'. $newDateE.' </h4>
<h4>Begin price: from '. $bprice. ' € /person</h4>
<form id="form" action="passangers.php" method="post" >
<input type="hidden" name="id" value="'.$tripId.'">
<input type="hidden" name="days" id="days" value="'.$days.'">
<input type="hidden" name="adultp" id="adultp" value="'.$adult.'">
<input type="hidden" name="kidp" id="kidp" value="'.$kid.'">
<br><br>
<label>Adults:</label>
<select id="adults" name="adults">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
<br><br>
<label>Kids:</label>
<select id="kids" name="kids">
<option value="0">0</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
</select>
<br><br>
<label>Flight Standard:</label>
<select id="flight" name="flight">
<option value="'.$flightS.'">Standard</option>
<option value="'.$flightB.'">Business</option>
</select>
<br><br>
<label>Hotel:</label>
<select id="hotel" name="hotel">
<option value="'.$hotel3.'">3 stars</option>
<option value="'.$hotel4.'">4 stars</option>
<option value="'.$hotel5.'">5 stars</option>
</select>
<br><br>
<label>Storno:</label>
<select id="storno" name="storno">
<option value="0">No</option>
<option value="'.$storno.'">Yes</option>
</select>
<br><br>
<label>Flight Insurance:</label>
<select id="flight-insurance" name="flight-insurance">
<option value="0">No</option>
<option value="'.$flightI.'">Yes</option>
</select>
<br><br>
<label>Insurance:</label>
<select id="insurance" name="insurance">
<option value="'.$insurance.'">Insurance</option>
<option value="'.$insuranceP.'">Insurance Premium</option>
</select>
<br><br>
<input type="hidden" id="administrationC" name="administrationC" value="'.$administrationC.'">
<br> <br> 
<label>Total:</label>
<input type="number" name="sum" id="sum" readonly />
<br><br><br> 
<input type="submit" value="Order" />    </form>
';
}
}
?>
    <!---The script code for the calulations --->
    <script>
        //select fields and event which is onClick
        $(function() {
            $('#adults, #kids,#adultp, #kidp,#flight,#hotel,#days,#storno,#flightI,#insurance,#administrationC').click(function() {
                //define variables 
                var adults = parseFloat($('#adults').val()) || 0;
                var kids = parseFloat($('#kids').val()) || 0;
                var adultp = parseFloat($('#adultp').val());
                var kidp = parseFloat($('#kidp').val()) || 0;
                var flight = parseFloat($('#flight').val()) || 0;
                var hotel = parseFloat($('#hotel').val()) || 0;
                var days = parseFloat($('#days').val()) || 0;
                var storno = parseFloat($('#storno').val()) || 0;
                var flightI = parseFloat($('#flight-insurance').val()) || 0;
                var insurance = parseFloat($('#insurance').val()) || 0;
                var administrationC = parseFloat($('#administrationC').val()) || 0;
                //formule for the calculation of the trip and put it show it in the field
                $('#sum').val((adultp * adults) + (kids * kidp) + (adults * flight) + (kids * flight) + (adults * hotel * days) + (kids * hotel * days) + (adults * storno) + (kids * storno) + (adults * flightI) + (kids * flightI) + (adults * insurance) + (kids * insurance) + (adults * administrationC) + (kids * administrationC));
            });
        });

    </script>
</section>
<?php
$file="./foot.php";
if (file_exists($file)) { include($file); }
?>
