<?php
//session protected
session_start();
if (isset($_SESSION['adminid']))
{
    //timeout for extra safety
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }
    $content = '<!DOCTYPE html>
    <html>
    <head>
    <title>Blog Admin</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
    </head>
    <body>
    <div id="blog-box">
    <a href="add-blog.php" id="add-blog-btn">Add Blog</a>
    <h2>Blog overview</h2>
    <table>';
    //make connection with the database
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if ($conn)
    {
        //sql command
        $res = $conn->query('SELECT * FROM blog ORDER BY blogid DESC');

        //find all the records
        while ($row = $res->fetch())
        {
            //get the data and assign them to the variable
            $blogid = $row['blogid'];
            $title = htmlentities($row['title']);
            $text = htmlentities($row['text']);
            $author = $row['author'];
            $date = $row['date'];
            $newText = substr($text, 0, 150);
            $source = '../img/blog/' . $blogid . '.JPG';
            $newDate = date("d-m-Y", strtotime($row["date"]));
            //picture
            if (file_exists($source))
            //create a content for page
            $content .= '<tr><td><img src="' . $source . '" alt="" " />';
            $content .= '<div id="info-box"><h3>' . $title . '</h3>';
            $content .= '<p> ' . $newText . ' ... <span>' . $newDate . '</span>';
            $content .= '<a href="show-blog.php?id=' . $blogid . '">Show</a></div></td>';
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
