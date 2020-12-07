<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //make connetion
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //can not connect to the database
        $content = 'Can not connect to the database.';
    }
    else
    {
        //server post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form && and yes
            if ($_POST['delete'] == 'yes')
            {

                $content = 'The comment will be deleted.';
                //get the parameter from url
                $id = (int)$_POST['id'];
                $tid = (int)$_POST['tid'];
                //sql command
                $sql = 'DELETE FROM forumre WHERE id = ' . $id;
                $res = $conn->query($sql);

                //update the forum table
                $sql = 'SELECT * FROM forum WHERE id = ' . $tid;
                $res2 = $conn->query($sql);
                $row = $res2->fetch();
                $answers = $row['answers'];
                $answers = $answers - 1;
                $sql = 'UPDATE forum SET answers = ' . $answers . ' WHERE id = ' . $tid;
                $res3 = $conn->query($sql);
            }
            else
            {
                //choosen not to be deleted
                $content = 'You choose not to delete the comment.';
            }
        }
        else
        {
            //get the url parameter
            $id = (int)$_GET['id'];
            //sql command
            $sql = 'SELECT * FROM forumre WHERE id=' . $id;
            $res = $conn->query($sql);
            if ($res)
            {
                //find all the records
                $row = $res->fetch();
                //get the data from the db and assign them to variables
                $name = $row['name'];
                $comment = $row['comment'];
                $tid = $row['tid'];

                //create a page content
                $content = '<strong> ' . $name . ' </strong><br /><br /> ' . $comment . ' <br />';

                //form
                $content .= '</p>';
                $content .= '<form method="post"><p>Do you want to delete this comment?<br /><br /><br /><br />';
                $content .= '<input type="hidden" name="id" value="' . $id . '" />';
                $content .= '<input type="hidden" name="tid" value="' . $tid . '" />';
                $content .= '<input type="submit" name="delete" value="yes" />';
                $content .= '<input type="submit" name="delete" value="no" />';
                $content .= '</p></form></p>';
            }
            else
            {
                //nothing was found
                $content = 'No comment was found !!';
            }
        }
    }
}
else
{
    // not logged in as admin
    $content = 'No access</br>';
}

?>
<html>

<head>
    <title>Delete forum comment</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-forum-comment">

        <a href="forum.php">Back</a>
        <h2> Delete forum comment </h2>
        <?php
//show the page content
echo $content; ?>
    </div>
</body>

</html>