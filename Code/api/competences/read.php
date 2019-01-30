<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Competences.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $competences = new Competences($db);

  // Competences read query
  $result = $competences->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any competences
  if($num > 0) {
        // mat array
        $competences_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $competences_item = array(
            'mailProf' => $mailProf,
            'idMat' => $idMat,
            'idNiveau' => $idNiveau,
            'matiere' => $matiere,
            'niveau' => $niveau
          );

          // Push to "data"
          array_push($competences_arr, $competences_item);
        }

        // Turn to JSON & output
        echo json_encode($competences_arr);

  } else {
        echo json_encode(
          array('message' => 'No Competences Found')
        );
  }
