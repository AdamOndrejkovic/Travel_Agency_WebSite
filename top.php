    <ol>
        <?php 
   $inhoud = '';
             $conn = false;
  $bestand='./connection.php';
  if(file_exists($bestand)) {include($bestand);}
            if (!$conn) {  
     $inhoud.= "Can not conect with database !!!";
  }
  else
  {
    // de sql-opdracht bepalen en uitvoeren
    $res = $conn->query('SELECT * FROM tripsmodel WHERE top > 0  ORDER BY  top ASC');
      while($row=$res->fetch()) { 
      // gegevens uit het record halen
      $name = htmlentities($row['name']);
      $id= htmlentities($row['id']);

      
     $inhoud.= ' <li> <a href="trip.php?tmid="'.$id.'">'. $name. '</a></li>';
    }
       }
        echo $inhoud;
?>


    </ol>
