<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }

    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Forum Travelers</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="forum-box">
    <h2>Forum overview</h2>
    <table>
    <tr>
    <th>Title</th>
    <th>Text</th>
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
        $res = $conn->query('SELECT * FROM forum ORDER BY id DESC');

        //find records
        while ($row = $res->fetch())
        {
            //assign data to variable
            $id = $row['id'];
            $title = htmlentities($row['title']);
            $text = htmlentities($row['text']);
            //create page content
            $content .= '<td>' . $title . '</td>';
            $content .= '<td>' . $text . '</td>';
            $content .= '<td><a href="show-forum.php?id=' . $id . '">Show</a></td>';
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
