<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Matieres.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $matiere = new Matieres($db);

  // Matieres read query
  $result = $matiere->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any matiere
  if($num > 0) {
        // mat array
        $mat_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $mat_item = array(
            'idMat' => $idMat,
            'libelle' => $libelle
          );

          // Push to "data"
          array_push($mat_arr, $mat_item);
        }

        // Turn to JSON & output
        echo json_encode($mat_arr);

  } else {
        echo json_encode(
          array('message' => 'No Matieres Found')
        );
  }
