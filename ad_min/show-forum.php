<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //get the parameter from the url
    $tid = (int)$_GET['id'];

    $content = '<div id="show-forum-box">';

    //make connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        $content .= '<p>Can not connect to the database.</p>';
    }
    else
    {
        //sql command
        $res = $conn->query('SELECT * FROM forum WHERE id =' . $tid);
        $row = $res->fetch();
        if (!$row == '')
        {
            //get the data and assign them to variables
            $title = htmlentities($row['title']);
            $name = htmlentities($row['name']);
            $text = htmlentities($row['text']);
            $text = nl2br($text);
            $date = $row['date'];

            //page content
            $content .= '<div id="sforum-info">
               <a href="forum.php">Back</a><a href="delete-forum.php?id=' . $tid . ' ">
      Delete</a>
               <h3>' . $title . '</h3>';

            $content .= '</p>' . $text . '<span>' . $date . '';
            $content .= '</div>';

            //all comments on the forum topic
            $res = $conn->query('SELECT * FROM forumre WHERE tid = ' . $tid);
            $amount = $res->rowCount();
            if ($amount > 0)
            {
                $content .= '<table><tr><th>&nbsp;</th><th>Name</th><th>Comment</th>
                <th>Date</th></tr>';
                //find all the records
                while ($row = $res->fetch())
                {
                    //get the data and assign them to the variables
                    $id = $row['id'];
                    $name = $row['name'];
                    $name = htmlentities($name);
                    $comment = $row['comment'];
                    $comment = htmlentities($comment);
                    $comment = nl2br($comment);
                    $newDate = date("d-m-Y", strtotime($row["post_time"]));
                    //create a page content
                    $content .= '<tr>
            <td><a href="delete-forumre.php?id=' . $id . '">Delete</a></td>
            <td>' . $name . '</td>
            <td>' . $comment . '</td> 
            <td>' . $newDate . '</td></tr>';
                }
                $content .= '</table>';
            }
            else
            {
                //no reactions
                $content .= '<p>No reactions where found.</p>';
            }
        }
        else
        {
            $content .= '<p>Nothing was found.</p>';
        }
    }
    $content .= '</div>';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Forum specific</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <?php
    //show the page
    echo $content; ?>
</body>

</html>
<?php
}
else
{
    echo "No access</br>";
}
?>
