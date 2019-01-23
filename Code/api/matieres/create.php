<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Matieres.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $matiere = new Matieres($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $matiere->libelle = $data->libelle;

  // Create matiere
  if($matiere->create()) {
    echo json_encode(
      array('message' => 'Matiere Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Matiere Not Created')
    );
  }
