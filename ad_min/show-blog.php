<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //get the parameter from url
    $tid = (int)$_GET['id'];

    $inhoud = '<div id="show-blog-box">';
    //make connection
    $conn = false;
    $bestand = '../connection.php';
    if (file_exists($bestand))
    {
        include ($bestand);
    }
    if (!$conn)
    {
        $inhoud .= '<p>Can not connect to the database.</p>';
    }
    else
    {
        //sql command
        $res = $conn->query('SELECT * FROM blog WHERE blogid =' . $tid);
        $lijn = $res->fetch();
        if (!$lijn == '')
        {
            //assign the data to the variables
            $title = htmlentities($lijn['title']);
            $author = htmlentities($lijn['author']);
            $text = htmlentities($lijn['text']);
            $text = nl2br($text);
            $date = $lijn['date'];

            //create the content for the web
            $inhoud .= '<div id="sblog-info">
               <a href="blog.php">Back</a>
               <h3>' . $title . '</h3>';

            $inhoud .= '<p>' . $text . '</p><span>' . $date . '</span>';
            $inhoud .= '<a href="edit-blog.php?id=' . $tid . '">
      Edit</a>';
            $inhoud .= '<a href="delete-blog.php?id=' . $tid . '">
      Delete</a></div>';

            //part to show all the reactions
            //sql command
            $res = $conn->query('SELECT * FROM blogre WHERE tid = ' . $tid);
            $aantal = $res->rowCount();
            if ($aantal > 0)
            {
                $inhoud .= '<table><tr><th>&nbsp;</th><th>Name</th><th>Comment</th>
                <th>Date</th></tr>';
                //find all the records
                while ($lijn = $res->fetch())
                {
                    //assign the data to the variable
                    $id = $lijn['reid'];
                    $name = $lijn['name'];
                    $name = htmlentities($name);
                    $comment = $lijn['comment'];
                    $comment = htmlentities($comment);
                    $comment = nl2br($comment);

                    $newDate = date("d-m-Y", strtotime($lijn["post_time"]));
                    //show the content
                    $inhoud .= '<tr>
            <td><a href="delete-blogre.php?id=' . $id . '">Delete</a></td>
            <td>' . $name . '   </td>
            <td>' . $comment . '</td> 
            <td>' . $newDate . '</td></tr>';
                }
                $inhoud .= '</table>';
            }
            else
            {
                //If there are no reactions
                $inhoud .= '<p>There are no reactions.</p>';
            }
        }
        else
        {
            $inhoud .= '<p>Something went wrong!</p>';
        }
    }
    $inhoud .= '</div>';
    //show the page
    
?>
<!DOCTYPE html>
<html>

<head>
    <title>Show the blog</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css" />
</head>

<body>
    <?php echo $inhoud; ?>
</body>

</html>
<?php
}
else
{
    echo "No access</br>";
}
?>
