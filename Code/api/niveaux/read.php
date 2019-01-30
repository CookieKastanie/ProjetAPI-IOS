<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Niveaux.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $niveau = new Niveaux($db);

  // Niveaux read query
  $result = $niveau->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any niveaux
  if($num > 0) {
        // niv array
        $niv_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $niv_item = array(
            'idNiveau' => $idNiveau,
            'libelle' => $libelle
          );
          // Push to "data"
          array_push($niv_arr, $niv_item);
        }

        // Turn to JSON & output
        echo json_encode($niv_arr);

  } else {
        echo json_encode(
          array('message' => 'No niveaux Found')
        );
  }
