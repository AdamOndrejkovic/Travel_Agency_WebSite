<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //timeout for extra safety
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }
    //top of the page
    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Newsletter Travelers</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="news-box">
    <h2>Newsletter overview</h2>
    <table>
    <tr>
    <th>&nbsp;</th>
    <th>Full Name</th>
     <th>Email</th>
    <th>Date of Birth</th>
    <th>Active</th>
     <th>Date of </br> (un)Subscription</th>
    </tr>';
    //make connection with database
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if ($conn)
    {
        //sql command
        $res = $conn->query('SELECT * FROM newsletter ORDER BY id DESC');

        //find all the records
        while ($row = $res->fetch())
        {
            //assign data to variables
            $id = $row['id'];
            $name = htmlentities($row['name']);
            $familyName = htmlentities($row['familyName']);
            $email = htmlentities($row['email']);
            $birthday = htmlentities($row['birthday']);
            $active = htmlentities($row['active']);
            //change int to string
            if ($active = 1)
            {
                $active = 'Active';
            }
            else
            {
                $active = 'Non-active';
            }

            //change the date format
            $newDate = date("d-m-Y", strtotime($row["date"]));
            //create a page content for the overview
            $content .= '<td><a href="delete-newsletter.php?id=' . $id . '">Delete</a></td>';
            $content .= '<td>' . $name . ' ' . $familyName . '</td>';
            $content .= '<td>' . $email . '</td>';
            $content .= '<td>' . $birthday . '</td>';
            $content .= '<td>' . $active . '</td>';
            $content .= '<td>' . $newDate . '</td>';
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
    echo 'No access</br>';
}
?>
