<?php
session_start();
if (isset($_SESSION['adminid']))
{
    //timeout
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }
    //logged in as admin
    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Trips rating</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="trips-top-box">
    <h2>Trips overview</h2>
    <table>
    <tr>
    <th>Trip</th>
    <th>Recommended</th>
    <th>Top </br> Recommended</th>
    <th>Top </br> Comfort</th>
    <th>Top </br> Family</th>
    <th>Top </br> Eco Tourism</th>
    <th>Top </br> Deluxe</th>
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

        //get records
        while ($row = $res->fetch())
        {
            //assign records to variables
            $id = $row['id'];
            $name = htmlentities($row['name']);
            $type = htmlentities($row['type']);
            $recommended = htmlentities($row['recommended']);
            $top = htmlentities($row['top']);
            $topco = htmlentities($row['topco']);
            $topfa = htmlentities($row['topfa']);
            $topeco = htmlentities($row['topeco']);
            $topde = htmlentities($row['topde']);

            //change int into string
            if ($recommended != 0)
            {
                $recommended = 'Recommended';
            }
            else
            {
                $recommended = 'Default';
            }

            if ($top != 0)
            {
                $top = 'Top </br> Recommended';
            }
            else
            {
                $top = 'Default';
            }

            if ($topco != 0)
            {
                $topco = 'Top </br> Comfort';
            }
            else
            {
                $topco = 'Default';
            }

            if ($topfa != 0)
            {
                $topfa = 'Top </br> Family';
            }
            else
            {
                $topfa = 'Default';
            }

            if ($topeco != 0)
            {
                $topeco = 'Top </br> Eco Tourism';
            }
            else
            {
                $topeco = 'Default';
            }

            if ($topde != 0)
            {
                $topde = 'Top </br> Deluxe';
            }
            else
            {
                $topde = 'Default';
            }
            //create page content
            $content .= '<td>' . $name . ' ' . $type . '</td>';
            $content .= '<td>' . $recommended . '</td>';
            $content .= '<td>' . $top . '</td>';
            $content .= '<td>' . $topco . '</td>';
            $content .= '<td>' . $topfa . '</td>';
            $content .= '<td>' . $topeco . '</td>';
            $content .= '<td>' . $topde . '</td>';
            $content .= '<td><a href="edit-tript.php?id=' . $id . '">Change</a></td>';
            $content .= '</tr>';
        }
    }
    else
    {
        //problem with connection
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
