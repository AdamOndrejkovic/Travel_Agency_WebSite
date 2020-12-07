<?php
session_start();
if (isset($_SESSION['adminid'])) {
    //timeout  
    $file = './timeout.php';
    if (file_exists($file)) {
        include($file);
    }
    
    $tripId = (int) $_GET['id'];
    //head of the page
    $content = '<!DOCTYPE html>
<html>
<head>
<title>Passangers</title>
<link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>
<body>
<div id="passangers">
<h2>Trips overview</h2>
<table>
<tr>
<th>&nbsp;</th>
<th>Name</th>
<th>Family Name</th>
<th>E-mail</th>
<th>Phone number</th>
<th>Date of Birth</th>
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
        $res = $conn->query('SELECT * FROM clients WHERE tripId ='.$tripId);
        //find all records
        while ($row = $res->fetch()) {
            //get all the records
            $id = htmlentities($row['id']);
            $name   = htmlentities($row['name']);
            $fname   = htmlentities($row['fname']);
            $email   = htmlentities($row['email']);
            $phone   = htmlentities($row['phone']);
            $birth   = htmlentities($row['birth']);
            //show the records
            $content .= '<td><a href="delete-client.php?id=' . $id . '">Delete</a></td>';
            $content .= '<td>' . $name . '</td>';
            $content .= '<td>' . $fname . '</td>'; 
            $content .= '<td>' . $email . '</td>';
            $content .= '<td>' . $phone . '</td>'; 
            $content .= '<td>' . $birth . '</td>';
            $content .= '<td><a href="edit-client.php?id=' . $id . '">Edit</a></td>';
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
