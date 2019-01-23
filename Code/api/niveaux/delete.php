<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Niveaux.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $niveau = new Niveaux($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to DELETE
  $niveau->idNiveau = $data->idNiveau;

  if($niveau->delete()) {
    echo json_encode(
      array('message' => 'Niveau deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Niveau not deleted')
    );
  }
