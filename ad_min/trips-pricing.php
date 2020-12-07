<?php
//session
session_start();
if (isset($_SESSION['adminid']))
{
    //timeout
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }
    //top of the page
    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Price overview</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="trip-pricing-box">
    <h2>Trips price overview</h2>
    <table>
    <tr>
    <th>Trip Name</th>
    <th>Type</th>
    <th>Begin Price</th>
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
        $res = $conn->query('SELECT * FROM tripsmodel ORDER BY id DESC');

        //get the records
        while ($row = $res->fetch())
        {
            $id = $row['id'];
            $name = htmlentities($row['name']);
            $type = htmlentities($row['type']);
            $bprice = htmlentities($row['bprice']);
            //show the records
            $content .= '<td>' . $name . '</td>';
            $content .= '<td>' . $type . '</td>';
            $content .= '<td>' . $bprice . ' &euro; </td>';
            $content .= '<td><a href="show-tpricing.php?id=' . $id . '">Show</a></td>';
            $content .= '</tr>';
        }
    }
    else
    {
        //something wrong with connection
        $content = '</table><p>Can not connect to the database </p>';
    }
    $content .= '</table></div>';
    $content .= '</body></html>';
    //show the page
    echo $content;
}
else
{
    //not logged in or timeout
    echo 'No access</br>';
}
?>