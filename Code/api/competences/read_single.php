<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Competences.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $competences = new Competences($db);

  // Get ID
  $competences->mailProf = isset($_GET['mailProf']) ? $_GET['mailProf'] : die();
  $competences->idNiveau = isset($_GET['idNiveau']) ? $_GET['idNiveau'] : die();
  $competences->idMat = isset($_GET['idMat']) ? $_GET['idMat'] : die();

  // Get competences
  $competences->read_single();

  // Create array
  $competences_arr = array(
    'mailProf' => $competences->mailProf,
    'idNiveau' => $competences->idNiveau,
    'idMat' => $competences->idMat,
    'matiere' => $competences->matiere,
    'niveau' => $competences->niveau
  );

  // Make JSON
  print_r(json_encode($competences_arr));
