<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //add connection file
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //connection error
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

                $content = 'Subscriber of newsletter was deleted.';
                //get the parameter from url
                $id = (int)$_POST['id'];
                //sql command
                $sql = 'DELETE FROM newsletter WHERE id = ' . $id;
                $res = $conn->query($sql);
            }
            else
            {
                //chosen not to delete
                $content = 'You choose not to delete the subsciber.';
            }
        }
        else
        {
            //get the parameter from the url
            $id = (int)$_GET['id'];
            //sql command
            $sql = 'SELECT * FROM newsletter WHERE id=' . $id;
            $res = $conn->query($sql);
            //if not empty
            if ($res)
            {
                //find  all the fields
                $row = $res->fetch();
                //get the data and assign them to the variables
                $name = $row['name'];
                $familyName = $row['familyName'];
                $email = $row['email'];
                $active = $row['active'];
                //change int to string
                if ($active = 1)
                {
                    $active = 'Active';
                }
                else
                {
                    $active = 'Non-active';
                }

                //create the content
                $content = '<strong> ' . $name . ' ' . $familyName . ' </strong><br /><br /> ' . $email . '   ' . $active . ' <br />';

                //form
                $content .= '</p>';
                $content .= '<form method="post"><p>Do you want to delete the subscriber?<br /><br /><br /><br />';
                $content .= '<input type="hidden" name="id" value="' . $id . '" />';
                $content .= '<input type="submit" name="delete" value="yes" />';
                $content .= '<input type="submit" name="delete" value="no" />';
                $content .= '</p></form></p>';
            }
            else
            {
                //nothing was found
                $content = 'Nothing was found.';
            }
        }
    }
}
else
{
    //not logged in
    $content = 'No access</br>';
}
?>
<html>

<head>
    <title>Delete the newsletter</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <div id="delete-newsletter">
        <a href="newsletter.php">Back</a>
        <h2>Delete subscriber from newsletter </h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
