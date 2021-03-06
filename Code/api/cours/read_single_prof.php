<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Cours.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $cours = new Cours($db);

  $cours->mailProf = isset($_GET['mailProf']) ? $_GET['mailProf'] : die();

  // Cours read query
  $result = $cours->read_single_prof();

  // Get row count
  $num = $result->rowCount();

  // Check if any matiere
  if($num > 0) {
        // mat array
        $cours_arr = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $cours_item = array(
            'mailEleve' => $mailEleve,
            'mailProf' => $mailProf,
            'idMat' => $idMat,
            'idNiveau' => $idNiveau,
            'dateCours' => $dateCours,
            'etat' => $etat,
            'matiere' => $matiere,
            'niveau' => $niveau
          );

          // Push to "data"
          array_push($cours_arr, $cours_item);
        }

        // Turn to JSON & output
        echo json_encode($cours_arr);

  } else {
        echo json_encode(
          array('message' => 'No Cours Found')
        );
  }