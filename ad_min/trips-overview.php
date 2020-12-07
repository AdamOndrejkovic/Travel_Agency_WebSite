<?php
session_start();
if (isset($_SESSION['adminid'])) {
    //timeout  
    $file = './timeout.php';
    if (file_exists($file)) {
        include($file);
    }
    //head of the page
    $content = '<!DOCTYPE html>
<html>
<head>
<title>TripsOverview Travelers</title>
<link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>
<body>
<div id="trip-overview-box">
<h2>Trips overview</h2>
<a href="add-tripsm.php" id="add">Add Trip</a>
<table>
<tr>
<th>&nbsp;</th>
<th>Trip Name</th>
<th>Type</th>
<th>Days</th>
<th>Begin Price</th>
<th>&nbsp;</th>
</tr>';
    //connect to the database
    $conn    = false;
    $file    = '../connection.php';
    if (file_exists($file)) {
        include($file);
    }
    if ($conn) {
        //sql command
        $res = $conn->query('SELECT * FROM tripsmodel ORDER BY id DESC');
        //find all records
        while ($row = $res->fetch()) {
            //get all the records
            $id     = $row['id'];
            $name   = htmlentities($row['name']);
            $type   = htmlentities($row['type']);
            $time   = htmlentities($row['time']);
            $bprice = htmlentities($row['bprice']);
            //show the records
            $content .= '<td><a href="delete-tripsm.php?id=' . $id . '">Delete</a></td>';
            $content .= '<td>' . $name . '</td>';
            $content .= '<td>' . $type . '</td>'; 
            $content .= '<td>' . $time . ' days</td>';
            $content .= '<td>' . $bprice . ' &euro; </td>';
            $content .= '<td><a href="show-tripsp.php?id=' . $id . '">Show</a></td>';
            $content .= '</tr>';
        }
    } else {
        //problem with connection
        $content = '</table><p>Can not connect to the database </p>';
    }
    $content .= '</table></div>';
    $content .= '</body></html>';
    //show the page
    echo $content;
} else {
    //Not logged in or timeout 
    echo 'Access denied';
}
?>
