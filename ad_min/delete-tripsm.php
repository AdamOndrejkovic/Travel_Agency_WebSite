<?php
session_start();
if (isset($_SESSION['adminid']))
{
    $file = './timeout.php';
    if (file_exists($file))
    {
        include ($file);
    }
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        //can not connect
        $message = 'Can not connect to the database !!!';
    }
    else
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //procces the form
            if ($_POST['delete'] == 'yes')
            {
                //if yes
                $id = (int)$_POST['id'];
                //sql command with id value
                $sql = 'DELETE FROM tripsmodel WHERE id = ' . $id;
                $res = $conn->query($sql);
                if ($res)
                {
                    $message = 'Trip was deleted.';
                    //delete all scheduled trips
                    $sql = 'DELETE FROM trips WHERE tmid = ' . $id;
                    $res = $conn->query($sql);

                    //delete all information over trip
                    $sql = 'DELETE FROM tripplan WHERE tmid = ' . $id;
                    $res2 = $conn->query($sql);

                    //delete the price model
                    $sql = 'DELETE FROM pricemodel WHERE tmid = ' . $id;
                    $res3 = $conn->query($sql);

                }
                else $message = 'Something went wrong with the deleting of the trip. Try again later.';

            }

            else
            {
                // if no
                $message = 'Chosen not to delete';
            }
        }
        else
        {

            $id = (int)$_GET['id'];

            $sql = 'SELECT * FROM tripsmodel WHERE id=' . $id;

            $res = $conn->query($sql);

            if ($res)
            {
                //get the records
                $row = $res->fetch();

                $name = $row['name'];
                $type = $row['type'];

                $message = 'Trip <strong>' . $name . ' </strong> of type:  ' . $type . ' <br />';

                //form
                $message .= '</p>';
                $message .= '<form method="post"><p>Do you want to delete this trip ?<br /><br />';
                $message .= '<input type="hidden" name="id" value="' . $id . '" />';
                $message .= '<input type="submit" name="delete" value="yes" />';
                $message .= '<input type="submit" name="delete" value="no" />';
                $message .= '</p></form></p>';
            }
            else
            {
                //No trip was found
                $message = 'No trip was found';
            }
        }
    }
}
else
{
    //not logged in or timeout
    $message = 'Access denied';
}

?>
<html>

<head>
    <title>nieuwsberichten verwijderen</title>
    <link rel="stylesheet" media="screen" type="text/css" title="Test" href="admin.css" />
</head>

<body>
    <!-- show the page -->
    <div id="delete-trip">
        <a href="trips-overview.php">Back</a>
        <h2> Delete trip </h2>
        <?php echo $message; ?>
    </div>
</body>

</html>
