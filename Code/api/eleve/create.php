<?php
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization,X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Eleve.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $eleve = new Eleve($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $eleve->mailEleve = $data->mailEleve;
  $eleve->nom = $data->nom;
  $eleve->prenom = $data->prenom;
  $eleve->adresse = $data->adresse;
  $eleve->idNiv = $data->idNiv;

  // Create eleve
  if($eleve->create()) {
    echo json_encode(
      array('message' => 'Eleve Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Eleve Not Created')
    );
  }
