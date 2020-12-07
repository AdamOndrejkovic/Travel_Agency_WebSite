<?php
//session
session_start();
if (isset($_SESSION['adminid']))
{
    //take parameters from url
    $id = (int)$_GET['id'];

    $content = '<div id="show-tprice-box">';

    //make connection
    $conn = false;
    $file = '../connection.php';
    if (file_exists($file))
    {
        include ($file);
    }

    if (!$conn)
    {
        //problem with connection
        $content .= '<p>Cannot connect to the database.</p>';
    }
    else
    {
        //sql command
        $res = $conn->query('SELECT * FROM  tripsmodel WHERE id=' . $id);
        $row = $res->fetch();
        if (!$row == '')
        {
            //get the records
            $name = htmlentities($row['name']);
            $type = htmlentities($row['type']);
            $days = htmlentities($row['time']);
            $bprice = htmlentities($row['bprice']);
            //put the into text
            $content .= '<a href="trips-pricing.php">Back</a><a href="edit-tripsm.php?id=' . $id . '">Edit trip</a><h3>Trip ' . $name . ' of type ' . $type . ' </h3>
                <h4>During of the trip ' . $days . ' days <br> Begin Price ' . $bprice . ' &euro;</h4> ';
        }
        else
        {
            //nothing found
            $content .= '<p>No Trip was found</p>';
        }
    }

    if ($conn)
    {
        //sql command
        $res = $conn->query('SELECT * FROM pricemodel WHERE pricemodel.tmid=' . $id);

        //get records while they equal to the condition
        while ($row = $res->fetch())
        {
            //assign records to the variable
            $priceId = $row['id'];
            $adult = htmlentities($row['adult']);
            $kid = htmlentities($row['kid']);
            $flightS = htmlentities($row['flightS']);
            $flightB = htmlentities($row['flightB']);
            $hotel3 = htmlentities($row['hotel3']);
            $hotel4 = htmlentities($row['hotel4']);
            $hotel5 = htmlentities($row['hotel5']);
            $singleR = htmlentities($row['singleR']);
            $storno = htmlentities($row['storno']);
            $flightI = htmlentities($row['flightI']);
            $insurance = htmlentities($row['insurance']);
            $insuranceP = htmlentities($row['insuranceP']);
            $administration = htmlentities($row['administrationC']);

            //create the front-end
            $content .= '
      <table>
      <tr><th>Adult</th><td>' . $adult . ' &euro;</td> <tr/>
      <tr><th>Kid</th><td>' . $kid . ' &euro;</td> <tr/>
      <tr><th>Flight Standard</th><td>' . $flightS . ' &euro;</td> <tr/>
      <tr><th>Flight Bussines</th><td>' . $flightB . ' &euro;</td> <tr/>
      <tr><th>Hotel ***</th><td>' . $hotel3 . ' &euro;</td> <tr/>
      <tr><th>Hotel ****</th><td>' . $hotel4 . ' &euro;</td> <tr/>
      <tr><th>Hotel *****</th><td>' . $hotel5 . ' &euro;</td> <tr/>
      <tr><th>Single room</th><td>' . $singleR . ' x</td> <tr/>
      <tr><th>Storno</th><td>' . $storno . ' &euro;</td> <tr/>
      <tr><th>Flight Insurance</th><td>' . $flightI . ' &euro;</td> <tr/>
      <tr><th>Insurance</th><td>' . $insurance . ' &euro;</td> <tr/>
      <tr><th>Insurance premium</th> <td>' . $insuranceP . ' &euro;</td> <tr/>
      <tr><th>Administration cost</th><td>' . $administration . ' &euro;</td> <tr/>
        </table>
        ';
        }
    }
    else
    {
        //problem with connection
        $content = '</table><p>Can not connect to the database </p>';
    }

    $content .= '</div>';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Nieuwsberichten</title>
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
    echo "No access </br>";
}
?>
