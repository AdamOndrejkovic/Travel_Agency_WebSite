<?php
//session
session_start();
if (isset($_SESSION['adminid']))
{
    //connection file
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //error connection
        $content = 'Can not connect to the database';
    }
    else
    {
        // if post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //choosen yes
            if ($_POST['delete'] == 'yes')
            {

                $content = 'Comment was deleted.';
                $id = (int)$_POST['id'];
                //sql command
                $sql = 'DELETE FROM blogre WHERE reid = ' . $id;
                $res = $conn->query($sql);
            }
            else
            {
                //choosen not to be deleted
                $content = 'You choose not to delete the comment.';
            }
        }
        else
        {
            $id = (int)$_GET['id'];
            // sql command
            $sql = 'SELECT * FROM blogre WHERE reid=' . $id;
            $res = $conn->query($sql);
            if ($res)
            {
                //find the record
                $row = $res->fetch();
                //assign the data to variables
                $name = $row['name'];
                $comment = $row['comment'];

                //create the content for the page
                $content = '<strong> ' . $name . ' </strong><br /><br /> ' . $comment . ' <br />';

                //form
                $content .= '</p>';
                $content .= '<form method="post"><p>Wil je dit bericht en al de reacties erop echt verwijderen?<br /><br /><br /><br />';
                $content .= '<input type="hidden" name="id" value="' . $id . '" />';
                $content .= '<input type="submit" name="delete" value="yes" />';
                $content .= '<input type="submit" name="delete" value="no" />';
                $content .= '</p></form></p>';
            }
            else
            {
                // nothing was found
                $content = 'Nothing was found.';
            }
        }
    }
}
else
{
    //not logged in
    $content = 'No access';
}

?>
<html>

<head>
    <title>Delete the blog comment</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-blogre-box">
        <a href="blog.php">Back</a>
        <h2> Delete blog comment </h2>
        <p><?php
//show the page content
echo $content; ?></p>
    </div>
</body>

</html>
