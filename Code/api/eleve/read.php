<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Eleve.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $eleve = new Eleve($db);

  // Eleve read query
  $result = $eleve->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any eleve
  if($num > 0) {
        // mat array
        $eleve_arr = array();
        $eleve_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $eleve_item = array(
            'mailEleve' => $mailEleve,
            'nom' => $nom,
            'prenom' => $prenom,
            'adresse' => $adresse,
            'idNiv' => $idNiv,
            'niveau' => $niveau
          );

          // Push to "data"
          array_push($eleve_arr['data'], $eleve_item);
        }

        // Turn to JSON & output
        echo json_encode($eleve_arr);

  } else {
        echo json_encode(
          array('message' => 'No Eleve Found')
        );
  }
