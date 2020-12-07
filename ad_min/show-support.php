<?php
//session start
session_start();
if (isset($_SESSION['adminid']))
{
    //get the parameter from url
    $id = (int)$_GET['id'];

    $content = '<div id="show-support-box">';
    //connection file
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }
    if (!$conn)
    {
        $content .= '<p>Can not connect to the database !!.</p>';
    }
    else
    {
        //sql command
        $res = $conn->query('SELECT * FROM help WHERE id =' . $id);
        $row = $res->fetch();
        if (!$row == '')
        {
            //assign data to the variables
            $name = htmlentities($row['name']);
            $familyName = htmlentities($row['familyName']);
            $email = htmlentities($row['email']);
            $sector = htmlentities($row['sector']);
            $info = htmlentities($row['info']);
            $info = nl2br($info);
            $date = htmlentities($row['date']);
            $status = htmlentities($row['status']);

            //show content
            $content .= '<div id="ssupport-box">
      <a href="support.php">Back</a>
              <h2> Message overview</h2>
      <a href="delete-support.php?id=' . $id . '">
      Delete</a>
      <h3>Sender info: </h3> 
      <table>
      <tr><th>Full Name</th><th>Email</th><th>Message for ' . $sector . '</th></tr>
      <tr><td>' . $name . ' ' . $familyName . '</td><td>' . $email . '</td><td>' . $info . '</td></tr>
      </table> <span>Sent on ' . $date . '</span>';
            $content .= '<span>Status: ' . $status . '</span><a href="set-support.php?id=' . $id . '">
      Change Status</a></div>';
        }
        else
        {
            $content .= '<p>Nothing was found!</p>';
        }
    }
    $content .= '</div>';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Specific support</title>
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
