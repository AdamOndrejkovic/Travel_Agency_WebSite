<?php
session_start();
if (!isset($_SESSION['adminid']))
{
    //not logged in as admin
    $content = 'No access</br>';
}
else
{ //take parameter from url
    $id = (int)$_GET['id'];

    //connect to the database
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
            //process the form
            if ($_POST['name'] && $_POST['fname'] && $_POST['email'] && $_POST['phone'] && $_POST['birth'])
            {
                //put data into variables
                $name = stripslashes($_POST['name']);
                $name = htmlspecialchars($name);
                $fname = stripslashes($_POST['fname']);
                $fname = htmlspecialchars($fname);
                $email = stripslashes($_POST['email']);
                $email = htmlspecialchars($email);
                $phone = stripslashes($_POST['phone']);
                $phone = htmlspecialchars($phone);
                $birth = stripslashes($_POST['birth']);
                $birth = htmlspecialchars($birth);
                

                try
                {
                    //update the table
                    $res = $conn->prepare("UPDATE clients SET name = ?, fname = ? , email = ?, phone = ?, birth = ? WHERE id = ?");
                    $res->execute(array($name,$fname,$email,$phone,$birth,$id));
                    //if ok redirect
                    header("Location:client.php");
                }
                catch(Exception $e)
                {
                    //something went wrong
                    $content = '<p>Something went wrong. Changes were not saved.</p>';
                }
            }
            else
            { //all fields need to be filled in
                $content = '<p>All fields need to be filled in.</p>';
            }
        }
        else
        {
            //get the records from the table on the condition
            $sql = "SELECT * FROM clients WHERE id = $id ";
            $res = $conn->query($sql);
            $amount = $res->rowCount();
            if ($amount == 0)
            {
                //error message
                $content = '<p>Nothing was found.</p>';
            }
            else
            {
                //get the records
                $row = $res->fetch();
                //assign the records to the variables
                $name = htmlspecialchars($row['name']);
                $fname = htmlspecialchars($row['fname']);
                $email = htmlspecialchars($row['email']);
                $phone = htmlspecialchars($row['phone']);
                $birth = htmlspecialchars($row['birth']);
                
                

                //change int into string
                
                //create a text
                $content = '
          <form method="post">
          <p>
         <label>Name</label><br /> <input type="text" name="name" value="'.$name.'"maxlength="30"/><br />
         <label>Family Name</label><br /> <input type="text" name="fname" value="'.$fname.'" maxlength="30"/><br />
         <label>Email</label><br /> <input type="text" name="email" value="'.$email.'" maxlength="40"/><br />
         <label>Phone</label><br /> <input type="text" name="phone" value="'.$phone.'" maxlength="30"/><br />
         <label>Birth date</label><br /> <input type="date" name="birth" value="'.$birth.'"/><br />
          <br><br><br><br>   
          <input type="submit" value="Update"></p>
          </form>';
            }
        }
    }
    else
    {
        $content = '<p>Can not connect to the database !!!</p>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Client Information</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="edit-client">
        <a href="client.php">Back</a>
        <h2>Edit client</h2>
        <?php
//show the page content
echo $content; ?>
    </div>
</body>

</html>
