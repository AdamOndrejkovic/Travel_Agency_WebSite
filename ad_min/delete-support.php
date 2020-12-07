<?php
//session start
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
        $content = 'Can not connect to the database !!';
    }
    else
    {
        //if post
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form
            if ($_POST['delete'] == 'yes')
            {

                $content = 'The message was deleted.';
                //get the parameter from the url
                $id = (int)$_POST['id'];
                //sql command
                $sql = 'DELETE FROM help WHERE id = ' . $id;
                $res = $conn->query($sql);
            }
            else
            {
                //else not to delete
                $content = 'You chose not to delete the message.';
            }
        }
        else
        {
            //get the parameter from url
            $id = (int)$_GET['id'];
            //sql command
            $sql = 'SELECT * FROM help WHERE id=' . $id;
            $res = $conn->query($sql);
            if ($res)
            {
                //find all the records
                $row = $res->fetch();
                //assign the data to variables
                $name = $row['name'];
                $familyName = $row['familyName'];
                $sector = $row['sector'];
                $date = $row['date'];
                $status = $row['status'];

                //create the content
                $content = '<p>Message sent by <strong> ' . $name . ' ' . $familyName . '</strong><br />on ' . $date . '<br />to ' . $sector . ' <br />status ' . $status . '</p>';

                //form
                $content .= '</p>';
                $content .= '<form method="post"><p>Do you want to delete the message?<br /><br /><br /><br />';
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
    //not logged
    $content = 'No access </br>';
}
?>
<html>

<head>
    <title>Delete support</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-support">
        <a href="support.php">Back</a>
        <h2> Delete support </h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
