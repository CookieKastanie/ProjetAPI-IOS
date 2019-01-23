<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Prof.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $prof = new Prof($db);

  // Matieres read query
  $result = $prof->read();

  // Get row count
  $num = $result->rowCount();

  // Check if any prof
  if($num > 0) {
        // prof array
        $prof_array = array();
        $prof_array['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $prof_item = array(
            'mailProf' => $mailProf,
            'nom' => $nom,
            'prenom' => $prenom,
            'presentation' => $presentation
          );

          // Push to "data"
          array_push($prof_array['data'], $prof_item);
        }

        // Turn to JSON & output
        echo json_encode($prof_array);

  } else {
        echo json_encode(
          array('message' => 'No Profs Found')
        );
  }
