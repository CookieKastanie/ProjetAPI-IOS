<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Cours.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $cours = new Cours($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to UPDATE
  $cours->mailEleve = $data->mailEleve;
  $cours->mailProf = $data->mailProf;
  $cours->idMat = $data->idMat;
  $cours->idNiveau = $data->idNiveau;
  $cours->dateCours = $data->dateCours;

  if($cours->delete()) {
    echo json_encode(
      array('message' => 'Cours deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Cours not deleted')
    );
  }
