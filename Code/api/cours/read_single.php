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

  // Get ID
  $cours->mailEleve = isset($_GET['mailEleve']) ? $_GET['mailEleve'] : die();
  $cours->mailProf = isset($_GET['mailProf']) ? $_GET['mailProf'] : die();
  $cours->idMat = isset($_GET['idMat']) ? $_GET['idMat'] : die();
  $cours->idNiveau = isset($_GET['idNiveau']) ? $_GET['idNiveau'] : die();
  $cours->dateCours = isset($_GET['dateCours']) ? $_GET['dateCours'] : die();

  $cours->read_single();

  // Create array
  $cours_arr = array(
    'mailEleve' => $cours->mailEleve,
    'mailProf' => $cours->mailProf,
    'idMat' => $cours->idMat,
    'idNiveau' => $cours->idNiveau,
    'dateCours' => $cours->dateCours,
    'etat' => $cours->etat,
    'matiere' => $cours->matiere,
    'niveau' => $cours->niveau
  );

  // Make JSON
  print_r(json_encode($cours_arr));
