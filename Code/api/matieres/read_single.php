<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Matieres.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $matiere = new Matieres($db);

  // Get ID
  $matiere->idMat = isset($_GET['idMat']) ? $_GET['idMat'] : die();

  $matiere->read_single();

  // Create array
  $matiere_arr = array(
    'idMat' => $matiere->idMat,
    'libelle' => $matiere->libelle
  );

  // Make JSON
  print_r(json_encode($matiere_arr));
