<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //make connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //not connected
        $content = 'Can not connect to the database !!';
    }
    else
    {
        //if post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form && if yes
            if ($_POST['delete'] == 'yes')
            {
                //get the parameter from the url
                $id = (int)$_POST['id'];
                //sql command
                $sql = 'DELETE FROM forum WHERE id = ' . $id;
                $res = $conn->query($sql);
                if ($res)
                {
                    $content = 'Forum was deleted.';
                    //delete the comments
                    $sql = 'DELETE FROM forumre WHERE tid = ' . $id;
                    $res = $conn->query($sql);
                }
                else $content = 'Problem with connecting to the database !!';
            }
            else
            {
                //chosen not to delete
                $content = 'You choose not to delete the forum post.';
            }
        }
        else
        {
            //get the parameter
            $id = (int)$_GET['id'];
            //sql command
            $sql = 'SELECT * FROM forum WHERE id=' . $id;
            $res = $conn->query($sql);
            if ($res)
            {
                //find the records
                $row = $res->fetch();
                //assign the data variables
                $date = $row['date'];
                $title = $row['title'];
                $text = $row['text'];
                $name = $row['name'];

                //create the page content
                $content = '<strong>' . $date . ' - by  ' . $name . ' </strong><br />' . $title . '<br /> ' . $text . ' <br />';

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
    <title>Delete forum</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-forum">
        <a href="forum.php">Back</a>
        <h2> Delete forum </h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
