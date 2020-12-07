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
            if ($_POST['recommended'] && $_POST['top'] && $_POST['topco'] && $_POST['topfa'] && $_POST['topeco'] && $_POST['topde'])
            {
                //put data into variables
                $recommended = stripslashes($_POST['recommended']);
                $recommended = htmlspecialchars($recommended);
                $top = stripslashes($_POST['top']);
                $top = htmlspecialchars($top);
                $topco = stripslashes($_POST['topco']);
                $topco = htmlspecialchars($topco);
                $topfa = stripslashes($_POST['topfa']);
                $topfa = htmlspecialchars($topfa);
                $topeco = stripslashes($_POST['topeco']);
                $topeco = htmlspecialchars($topeco);
                $topde = stripslashes($_POST['topde']);
                $topde = htmlspecialchars($topde);

                try
                {
                    //update the table
                    $res = $conn->prepare("UPDATE tripsmodel SET recommended = ?, top = ?,topco = ?,topfa = ?,topeco = ?,topde = ? WHERE id = ?");
                    $res->execute(array(
                        $recommended,
                        $top,
                        $topco,
                        $topfa,
                        $topeco,
                        $topde,
                        $id
                    ));
                    //if ok redirect
                    header("Location:trips-top.php");
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
            $sql = "SELECT * FROM tripsmodel WHERE id = $id ";
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
                $type = htmlspecialchars($row['type']);
                $recommended = htmlspecialchars($row['recommended']);
                $top = htmlspecialchars($row['top']);
                $topco = htmlspecialchars($row['topco']);
                $topfa = htmlspecialchars($row['topfa']);
                $topeco = htmlspecialchars($row['topeco']);
                $topde = htmlspecialchars($row['topde']);

                //change int into string
                if ($recommended != 0)
                {
                    $recommended = 'Recommended';
                }
                else
                {
                    $recommended = 'Default';
                }

                if ($top != 0)
                {
                    $top = 'Top Recommended';
                }
                else
                {
                    $top = 'Default';
                }

                if ($topco != 0)
                {
                    $topco = 'Top Comfort';
                }
                else
                {
                    $topco = 'Default';
                }

                if ($topfa != 0)
                {
                    $topfa = 'Top Family';
                }
                else
                {
                    $topfa = 'Default';
                }

                if ($topeco != 0)
                {
                    $topeco = 'Top Eco Tourism';
                }
                else
                {
                    $topeco = 'Default';
                }

                if ($topde != 0)
                {
                    $topde = 'Top Deluxe';
                }
                else
                {
                    $topde = 'Default';
                }
                //create a text
                $content = '<h3>Trip ' . $name . ' of type ' . $type . '</h3>
          <form method="post">
          <p>
          <label>Recommended:</label>
           <select id="type" name="recommended" >
                <option value="' . $recommended . '" selected>Last: ' . $recommended . '</option>
                <option value="1">Recommended</option>
                <option value="0">Default</option>
                </select>
                <br> 
                
           <label>Top Recommended:</label>
           <select id="type" name="top" >
                <option value="' . $top . '" selected>Last: ' . $top . '</option>
                <option value="1">Top Recommended</option>
                <option value="0">Default</option>
                </select>
                <br>
                
                <label>Top Comfort:</label>
           <select id="type" name="topco" >
                <option value="' . $topco . '" selected>Last: ' . $topco . '</option>
                <option value="1">Top Comfort</option>
                <option value="0">Default</option>
                </select>
                <br> 
                
                <label>Top Family:</label>
           <select id="type" name="topfa" >
                <option value="' . $topfa . '" selected>Last: ' . $topfa . '</option>
                <option value="1">Top Family</option>
                <option value="0">Default</option>
                </select>
                <br> 
                
                <label>Top Eco Tourism:</label>
           <select id="type" name="topeco" >
                <option value="' . $topeco . '" selected>Last: ' . $topeco . '</option>
                <option value="1">Top Eco Tourism</option>
                <option value="0">Default</option>
                </select>
                <br> 
                
                <label>Top Deluxe:</label>
           <select id="type" name="topde" >
                <option value="' . $topde . '" selected>Last: ' . $topde . '</option>
                <option value="1">Top Deluxe</option>
                <option value="0">Default</option>
                </select>
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
    <title>Edit Trips Rating</title>
    <link rel="stylesheet" media="screen" type="text/css" href="admin.css">
</head>

<body>
    <div id="edit-rating">
        <a href="trips-top.php">Back</a>
        <h2>Edit rating</h2>
        <?php
//show the page content
echo $content; ?>
    </div>
</body>

</html>
