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
$content = '<div id="planned-tripsclient-box">';
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
$content .= '<span><a href="client.php">Back</a></span><h3>Trip ' . $name . ' of type ' . $type . ' </h3>';
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
$content .= '
<table>
<tr>
<th>Scheduled</th>
<th>Available</th>
<th>Places</th>
<th>Status</th>
<th>&nbsp;</th>
</tr>
<tr>
<td>' . $newDateB . ' -- ' . $newDateE . '</td>
<td>' . $available . '</td>
<td>' . $places . '</td>
<td>' . $status . '</td>
<th><a href="passangers.php?id=' . $tripId . '">Show All Passangers</a></th>
</tr>
</table>
';
}
} else {
$content = '</table><p>Can not connect to the database </p>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Planned Trips</title>
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
