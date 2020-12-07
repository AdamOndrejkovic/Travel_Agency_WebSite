<?php
//session start
session_start();
if (!isset($_SESSION['adminid']))
{
    //not logged in
    $content = 'No access</br>';
}
else
{ //get the parameter url
    $id = (int)$_GET['id'];

    //add the connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if ($conn)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //proccess the form
            if ($_POST['status'])
            {
                $status = stripslashes($_POST['status']);
                $status = htmlspecialchars($status);
                try
                {
                    //update the table
                    $res = $conn->prepare("UPDATE help SET status = ?
                                   WHERE id = ?");
                    $res->execute(array(
                        $status,
                        $id
                    ));
                    header("Location:show-support.php?id=" . $id);
                }
                catch(Exception $e)
                {
                    //error
                    $content = '<p>Something went wrong changes were not saved.</p>';
                }
            }
            else
            { //not all fields were filled in
                $err = '<p>Not all fields were filled in.</p>';
            }
        }
        else
        {
            //sql command
            $sql = "SELECT * FROM help WHERE id = $id ";
            $res = $conn->query($sql);
            $amount = $res->rowCount();
            if ($amount == 0)
            {
                //error
                $content = '<p>Nothing was found.</p>';
            }
            else
            {
                //find the records
                $row = $res->fetch();
                //get the data and assign them to the variables
                $status = htmlentities($row['status']);
                //create the content
                $content = '
          <h3>Status of the request: ' . $status . '</h3>
          <form method="post">
              <select id="status" name="status">
                <option value="Done">Done</option>
                <option value="Being processed">Being processed</option>
                <option value="Not Finished">Not Finished</option>
              </select></br></br></br></br></br>
          <input type="submit" value="Update"></p>
          </form>';
            }
        }
    }
    else
    {
        $content = '<p>Can not connect to the database.</p>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Set support</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="change-support">
        <a href="support.php">Back</a>
        <h2>Change status</h2>
        <?php
//show the page
echo $content; ?>
    </div>
</body>

</html>
