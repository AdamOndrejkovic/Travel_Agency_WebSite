<?php
session_start();
//logged in as an admin
if (isset($_SESSION['adminid'])) {
//timeout file
$file = './timeout.php';
if (file_exists($file)) {
include($file);
}
$id = (int) $_GET['id'];
$content = '<div id="show-trip-box">';
//connect to the database
$conn = false;
$file = '../connection.php';
if (file_exists($file)) {
include($file);
}
//first part trip information
if (!$conn) {
$content .= '<p>Cannot connect to the database.</p>';
} else {
//sql command
$res = $conn->query('SELECT * FROM  tripsmodel WHERE id=' . $id);
$row = $res->fetch();
if (!$row == '') {
//get the records
$name   = htmlentities($row['name']);
$type   = htmlentities($row['type']);
$days   = htmlentities($row['time']);
$bprice = htmlentities($row['bprice']);
$content .= '<div id="trip-info"><a href="trips-overview.php">Back</a><h3>Trip ' . $name . ' of type ' . $type . ' </h3>
<h4>During of the trip ' . $days . ' days <br> Begin Price ' . $bprice . ' &euro; </h4>  <a href="add-tripsp.php?id=' . $id . '">Plan a trip</a><a href="edit-tripsm.php?id=' . $id . '">Edit trip</a></div>';
} else {
$content .= '<p>No Trip was found</p>';
}
}
//second part specific trip scheduled date
if ($conn) {
//sql command
$res = $conn->query('SELECT * FROM trips WHERE trips.tmid=' . $id);
//get all the records
while ($row = $res->fetch()) {
//get the records
$tripId         = $row['tripId'];
$dateB          = htmlentities($row['dateB']);
$dateE          = htmlentities($row['dateE']);
$places         = htmlentities($row['places']);
$status         = htmlentities($row['status']);
$adult          = htmlentities($row['adult']);
$kid            = htmlentities($row['kid']);
$flightS        = htmlentities($row['flightS']);
$flightB        = htmlentities($row['flightB']);
$hotel3         = htmlentities($row['hotel3']);
$hotel4         = htmlentities($row['hotel4']);
$hotel5         = htmlentities($row['hotel5']);
$singleR        = htmlentities($row['singleR']);
$storno         = htmlentities($row['storno']);
$flightI        = htmlentities($row['flightI']);
$insurance      = htmlentities($row['insurance']);
$insuranceP     = htmlentities($row['insuranceP']);
$administration = htmlentities($row['administrationC']);
//change value of places to String 
if ($places != 0) {
$available = 'Available';
} else {
$available = 'Full';
}
//change the format for date fields
$newDateB = date("d-m-Y", strtotime($row["dateB"]));
$newDateE = date("d-m-Y", strtotime($row["dateE"]));
//calculate the price
$bprice = $adult + $flightS + ($hotel3 * $days) + $insurance + $administration;
$content .= '<div id="trip-plan">
<table>
<tr>
<th>Scheduled</th>
<th>Available</th>
<th>Places</th>
<th>Begin price</th>
<th>Status</th>
</tr>
<tr>
<td>' . $newDateB . ' -- ' . $newDateE . '</td>
<td>' . $available . '</td>
<td>' . $places . '</td>
<td>' . $bprice . '</td>
<td>' . $status . '</td>
</tr>
</table>
<table>
<tr>
<th>Adult</th>
<th>Kid</th>
<th>Flight Standard</th>
<th>Flight Bussines</th>
<th>Hotel ***</th>
<th>Hotel ****</th>
<th>Hotel *****</th>
<th>Single room</th>
<th>Storno</th>
<th>Flight Insurance</th>
<th>Insurance</th>
<th>Insurance premium</th>
<th>Administration cost</th>
<tr/>
<tr>
<td>' . $adult . '</td>
<td>' . $kid . '</td>
<td>' . $flightS . '</td>
<td>' . $flightB . '</td>
<td>' . $hotel3 . '</td>
<td>' . $hotel4 . '</td>
<td>' . $hotel5 . '</td>
<td>' . $singleR . '</td>
<td>' . $storno . '</td>
<td>' . $flightI . '</td>
<td>' . $insurance . '</td>
<td>' . $insuranceP . '</td>
<td>' . $administration . '</td>
<tr/>
</table>
<a href="delete-tripsp.php?id=' . $tripId . '">Delete</a>
<a href="edit-tripsp.php?id=' . $tripId . '">Update</a>
<a href="set-tripsp-status.php?id=' . $tripId . '">Change Status</a></div>
';
}
} else {
$content = '</table><p>Can not connect to the database </p>';
}
//third part text for the specific trip
if (!$conn) {
$content .= '<p>Cannot connect to the database.</p>';
} else {
//sql command
$res = $conn->query('SELECT * FROM  tripplan WHERE tripplan.tmid =' . $id);
$row = $res->fetch();
if (!$row == '') {
//get the fields
$trippId = $row['id'];
$title   = htmlentities($row['title']);
$info    = htmlentities($row['info']);
$plan    = htmlentities($row['plan']);
$content .= '<div id="trip-text">
<h3>' . $title . '</h3>
<h4>Trips info</h4>
<p>' . $info . '</p>
<h4>Trips planning</h4>
<p>' . $plan . '</p>
<a href="edit-tripsi.php?id=' . $trippId . '">Update</a></div>
';
} else {
$content .= '<p class="fout">No trip information <br>
<a href="add-tripsi.php?id=' . $id . '">Add info</a>
</p>';
}
}
$content .= '</div>';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Nieuwsberichten
    </title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <?php
//show all
echo $content;
?>
</body>

</html>
<?php
} else {
//not logged in or timeout
echo "Access denied</br>";
}
?>
