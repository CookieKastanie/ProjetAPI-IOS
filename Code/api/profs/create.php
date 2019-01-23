<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Prof.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $prof = new Prof($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

    $prof->mailProf = $data->mailProf;
    $prof->nom = $data->nom;
    $prof->prenom = $data->prenom;
    $prof->presentation = $data->presentation;

  // Create prof
  if($prof->create()) {
    echo json_encode(
      array('message' => 'Prof Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Prof Not Created')
    );
  }
