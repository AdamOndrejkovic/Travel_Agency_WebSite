<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //page top content
    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Support Travelers</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="support-box">
    <h2>Support</h2>
    <table>
    <tr>
    <th>&nbsp;</th>
    <th>Full Name</th>
    <th>Sector</th>
    <th>Date</th>
    <th>Status</th>
     <th>&nbsp;</th>
    </tr>';
    //make connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if ($conn)
    {
        //sql command
        $res = $conn->query('SELECT * FROM help ORDER BY id DESC');

        //find all the records
        while ($row = $res->fetch())
        {
            //get the data and assign them to the variables
            $id = $row['id'];
            $name = htmlentities($row['name']);
            $familyName = htmlentities($row['familyName']);
            $sector = htmlentities($row['sector']);
            $status = htmlentities($row['status']);
            $newDate = date("d-m-Y", strtotime($row["date"]));
            //create a content
            $content .= '<td><a href="delete-support.php?id=' . $id . '">Delete</a></td>';
            $content .= '<td>' . $name . ' ' . $familyName . '</td>';
            $content .= '<td>' . $sector . '</td>';
            $content .= '<td>' . $newDate . '</td>';
            $content .= '<td>' . $status . '</td>';
            $content .= '<td><a href="show-support.php?id=' . $id . '">More</a></td>';
            $content .= '</tr>';
        }
    }
    else
    {
        $content = '</table><p>Can not connect to the database </p>';
    }
    $content .= '</table></div>';
    $content .= '</body></html>';
    //show the page
    echo $content;
}
else
{
    //not logged in
    echo 'No access </br>';
}
?>
