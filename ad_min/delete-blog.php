<?php
//start the session
session_start();
if (isset($_SESSION['adminid']))
{
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //can not connect to the database
        $content = 'kan niet verbinden met database';
    }
    else
    {
        // if post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form
            if ($_POST['delete'] == 'yes')
            {
                // choose to delete
                $id = (int)$_POST['id'];
                //sql command
                $sql = 'DELETE FROM blog WHERE blogid = ' . $id;
                $res = $conn->query($sql);
                if ($res)
                {
                    $content = 'Blog was deleted.';
                    //delete the comments
                    $sql = 'DELETE FROM blogre WHERE tid = ' . $id;
                    $res = $conn->query($sql);
                }
                else $content = 'Can not delete the blog.';
            }
            else
            {
                //choose not to delete
                $content = 'Blog will not be deleted.';
            }
        }
        else
        {
            $id = (int)$_GET['id'];
            //sql command
            $sql = 'SELECT * FROM blog WHERE blogid=' . $id;
            $res = $conn->query($sql);
            if ($res)
            {
                //get the selected record
                $row = $res->fetch();
                //assign the data to the variables
                $date = $row['date'];
                $title = $row['title'];
                $text = $row['text'];

                //create the page content
                $content = '<strong>' . $title . ' </strong><br /><br /> ' . $text . ' <br /><span>' . $date . '</span><br /><br />';

                //form
                $content .= '</p>';
                $content .= '<form method="post"><p>All the reactions will be deleted too !!!<br /><br /><br /><br />';
                $content .= '<input type="hidden" name="id" value="' . $id . '" />';
                $content .= '<input type="submit" name="delete" value="yes" />';
                $content .= '<input type="submit" name="delete" value="no" />';
                $content .= '</p></form></p>';
            }
            else
            {
                //nothing was found
                $content = 'No records were found.';
            }
        }
    }
}
else
{
    //not logged in as admin
    $content = 'No access</br>';
}
?>
<html>

<head>
    <title>Delete blog</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-blog">
        <a href="blog.php">Back</a>
        <h2> Delete blog </h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
