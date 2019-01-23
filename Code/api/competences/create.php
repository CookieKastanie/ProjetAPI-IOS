<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Competences.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $competence = new Competences($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $competence->mailProf = $data->mailProf;
  $competence->idMat = $data->idMat;
  $competence->idNiveau = $data->idNiveau;

  // Create eleve
  if($competence->create()) {
    echo json_encode(
      array('message' => 'Competence Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Competence Not Created')
    );
  }
