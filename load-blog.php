          <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "travelers";

$tripsNewCount = $_POST['tripsNewCount'];
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT name, type, time , bprice, tripcode FROM tripsmodel LIMIT $tripsNewCount";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
        echo "
            <div class='blog-box'>
               <img src='img/trip-card/".$row["name"].".jpg'>
                <div class='blog-info'>
        
                <h3> ". $row["name"]. "</h3>
                <h4> ". $row["type"]. " </h4>
                
               <a href='trip.php?name=".$row["name"]."'>Read more</a>
            </div>
               </div>
               
            ";
    }
} else {
    echo "No trip was found please try again later.";
}
?>